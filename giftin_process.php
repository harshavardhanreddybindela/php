<?php
include("includes/db_connect.php");
include("includes/status_message.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $selectedOption = $_POST["gift"];
    $giftprice = $_POST["giftprice"];
    $donation_status = $_POST["donated-or-purchased"];
    $receiveddate = $_POST["received_date"];

    // Extract GiftId and GiftName from the selected option
    list($selectedGiftId, $selectedGiftName) = explode('-', $selectedOption);

    // Insert the data into the iybigiftsin table
    $insert_scanin = "INSERT INTO iybigiftsin (GiftId, GiftName, GiftReceivingStatus, GiftReceivedDate, GiftPrice) 
                      VALUES ('$selectedGiftId', '$selectedGiftName', '$donation_status', '$receiveddate','$giftprice')";
    $result_scanin = mysqli_query($conn, $insert_scanin);

    // Check if the insertion was successful
    if ($result_scanin) {
        echo "Scanin form submitted successfully";
        header("Location: giftin.php?status=".$status);

        // Increase the available quantity in the iybigiftinventory table for the given GiftId
        $update_toylist = "UPDATE iybigiftinventory SET available_quantity = available_quantity + 1 WHERE GiftId = '$selectedGiftId'";
        $result_update_toylist = mysqli_query($conn, $update_toylist);

        // Check if the update was successful
        if ($result_update_toylist) {
            $status = "Toylist updated successfully";
            header("Location: giftin.php?status=".$status);
        } else {
            echo "Error updating toylist: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into scanin: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
