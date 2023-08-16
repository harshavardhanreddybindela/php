<!DOCTYPE html>
<html>
<head>
<style>
/* Adding colors to the page using CSS */
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1000px;
    margin: 20px;
    padding: 16px;
    border: 1px solid #ccc;
    background-color: #fff;
}

.container p {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}

input[type=text], input[type=price] {
    width: 90%;
    padding: 10px;
    margin: 5px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 5px;
}

input[type=text]:focus, input[type=price]:focus {
    background-color: #ddd;
    outline: 1px;
}

button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    border-radius: 5px;
}

button:hover {
    opacity: 1;
}

.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

.cancelbtn, .signupbtn {
    width: 100%;
    border-radius: 5px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Styling for forms to be side by side */
.forms-container {
    display: flex;
    justify-content: space-between;
    max-width: 1000px;
}
</style>
</head>
<body>

<div class="forms-container">
    <!-- Add Product Form -->
    <form method="POST" action="Add_product.php" class="container">
        <p>Add a Product</p>
        <label for="gift"><b>Gift Name:</b></label>
        <input type="text" name="giftname" required placeholder="Enter Gift Name">
        <label for="GiftPrice"><b>Gift Price:</b></label>
        <input type="price" name="GiftPrice" required placeholder="Enter Gift Price">
        <button type="submit" class="signupbtn" name="submit" id="submit">Add Product</button>
    </form>

    <!-- Delete Product Form -->
    <form method="POST" action="delete_product.php" class="container">
        <p>Delete a Product</p>
        <label for="giftid"><b>Gift ID:</b></label>
        <input type="text" name="giftid" required placeholder="Enter Gift ID">
        <label for="gift"><b>Gift Name:</b></label>
        <input type="text" name="giftname" required placeholder="Enter Gift Name">
        <button type="submit" class="signupbtn" name="submit" id="submit">Delete Product</button>
    </form>

    <!-- Update Product Form -->
    <form method="POST" action="update_product.php" class="container">
        <p>Edit a Product</p>
        <label for="giftid"><b>Gift ID:</b></label>
        <input type="text" name="giftid" required placeholder="Enter Gift ID">
        <label for="giftname"><b>Gift Name:</b></label>
        <input type="text" name="giftname" required placeholder="Enter Gift Name">
        <label for="GiftPrice"><b>Gift Price:</b></label>
        <input type="price" name="GiftPrice" required placeholder="Enter Gift Price">
        <button type="submit" class="signupbtn" name="submit" id="submit">Update Product</button>
    </form>
</div>

</body>
</html>
