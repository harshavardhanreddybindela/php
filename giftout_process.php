<?php
include("includes/db_connect.php");
include("includes/status_message.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $selectedOption = $_POST["gift"];
    $donated_to = $_POST["donated_to"];
    $receiver_dob = $_POST["receiver_dob"];
    $kiddogender = $_POST["gender"];
    $shelter = $_POST["shelter"];
    $deliverydate = $_POST["delivery_date"];

    // Extract GiftId and GiftName from the selected option
    list($selectedGiftId, $selectedGiftName) = explode('-', $selectedOption);

    // Check if the selected gift is available (available_quantity > 0)
    $check_available = "SELECT available_quantity FROM iybigiftinventory WHERE GiftId = '$selectedGiftId'";
    $result_available = mysqli_query($conn, $check_available);

    if ($result_available && mysqli_num_rows($result_available) > 0) {
        $available_quantity = mysqli_fetch_assoc($result_available)['available_quantity'];
        if ($available_quantity > 0) {
            // Insert the data into the iybigiftsout table
            $insert_scanout = "INSERT INTO iybigiftsout (GiftId, GiftName, BirthdayHeroName, KiddoDOB, KiddoGender, Shelter, DateOfDelivery) 
                               VALUES ('$selectedGiftId', '$selectedGiftName', '$donated_to', '$receiver_dob', '$kiddogender', '$shelter', '$deliverydate')";
            $result_scanout = mysqli_query($conn, $insert_scanout);

            // Check if the insertion was successful
            if ($result_scanout) {
                $status="Scanout form submitted successfully";
                header("Location: giftout.php?status=".$status);
                // Decrease the available quantity in the iybigiftinventory table for the given GiftId
                $update_toylist = "UPDATE iybigiftinventory SET available_quantity = available_quantity - 1 WHERE GiftId = '$selectedGiftId' AND available_quantity > 0";
                $result_update_toylist = mysqli_query($conn, $update_toylist);

                // Check if the update was successful
                if ($result_update_toylist) {
                    $status = "Toylist updated successfully.";
                    header("Location: toylist.php?status=".$status);
                } else {
                    echo "Error updating toylist: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting into scanout: " . mysqli_error($conn);
            }
        } else {
            echo '<script>alert("Sorry! We are currently out of stock.")</script>';
        }
    } else {
        echo "Error checking availability: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
