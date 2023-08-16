<?php
include("includes/db_connect.php");
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $giftid = $_POST['giftid'];
        $pname = $_POST['giftname'];
        $pri = $_POST['GiftPrice'];

    }


    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "UPDATE iybigiftinventory SET GiftName='$pname', GiftPrice='$pri' where GiftId='$giftid'";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Successfully edited the product!";
    }
  
    // close connection
    mysqli_close($con);

?>