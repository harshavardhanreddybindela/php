<?php
include("includes/db_connect.php");
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $pname = $_POST['giftname'];
        $price = $_POST['GiftPrice'];
    }


    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "INSERT INTO iybigiftinventory ( GiftName, GiftPrice) VALUES ('$pname', '$price')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Product Added!";
    }
  
    // close connection
    mysqli_close($con);

?>