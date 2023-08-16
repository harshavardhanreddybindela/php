<?php
include("includes/db_connect.php");

if (isset($_GET['id'])) {

    $Id = $_GET['id'];

    // Delete record from iybigiftsin table
    $delete_giftin = "DELETE FROM iybigiftsin WHERE Id = '$Id'";
    $result_giftin = mysqli_query($conn, $delete_giftin);

    // Delete record from iybigiftsout table
    $delete_giftout = "DELETE FROM iybigiftsout WHERE Id = '$Id'";
    $result_giftout = mysqli_query($conn, $delete_giftout);

    if ($result_giftin && $result_giftout) {
        $status = "Record deleted successfully";
        header("Location: toylist.php?status=".$status);
    }
    else
    {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
