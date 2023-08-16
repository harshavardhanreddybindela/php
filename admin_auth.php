<?php
if(isset($_POST['submit']))
{
    $username=$_POST['login_txt'];
    $password=$_POST['password_txt'];
}
$host = "localhost";
$usern = "root";
$pass = "";
$dbname = "toyinventory";
$con = mysqli_connect($host, $usern, $pass, $dbname);
$user="SELECT * from admin_details where name='$username' and password='$password'";
$result=mysqli_query($con,$user);
if(mysqli_num_rows($result)==1)
{
    header('location:current_inventory.php');
}
else
{
echo '<script>alert("Wrong Credentials, Please retry to login")</script>';
}
?>