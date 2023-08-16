<?php
include("includes/db_connect.php");
include("includes/status_message.php");
if (isset($_GET['id'])) {

    $Id = $_GET['id'];
    $giftName = $_POST["gift"];
    $giftPrice = $_POST["giftprice"];
    $giftReceivingStatus = $_POST["donated-or-purchased"];
    $giftReceivedDate = $_POST["received_date"];
    $birthdayHeroName = $_POST["donated_to"];
    $kiddoGender = $_POST["gender"];
    $receiverDOB = $_POST["receiver_dob"];
    $deliveryDate = $_POST["delivery_date"];
    $shelterName = $_POST["shelter"];

    // Sanitize and validate input data before using in SQL query

    // Update giftin table
    $updateGiftInQuery = "UPDATE iybigiftsin
                          SET GiftReceivingStatus = '$giftReceivingStatus',
                              GiftReceivedDate = '$giftReceivedDate'
                          WHERE id = '$id'";
    $resultGiftIn = mysqli_query($conn, $updateGiftInQuery);

    // Update giftout table
    $updateGiftOutQuery = "UPDATE iybigiftsout
                           SET GiftName = '$giftName',
                               GiftPrice = '$giftPrice',
                               Shelter = '$shelterName',
                               KiddoDOB = '$receiverDOB',
                               KiddoGender = '$kiddoGender',
                               DateOfDelivery = '$deliveryDate',
                               BirthdayHeroName = '$birthdayHeroName'
                           WHERE id = '$id'";
    $resultGiftOut = mysqli_query($conn, $updateGiftOutQuery);

    // Check if both queries were successful
    if ($resultGiftIn && $resultGiftOut) {
        $status = "Record updated successfully.";
        header("Location: toylist.php?status=".$status);
    } else {
        $status = "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
    <!-- Include your CSS and JavaScript files if needed -->
</head>
<body>
    <h1>Update Record</h1>
    <?php echo isset($status) ? "<p>$status</p>" : ""; ?>

    <!-- Display the form with the populated values -->
    <!-- Add your form fields here, similar to the edit_record.php form -->
</body>
</html>
