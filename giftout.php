<!DOCTYPE html>
<html>
<head>
    <title>Toy Inventory Scanout Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        select {
            cursor: pointer;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Additional Styling for the Form */
        .form-title {
            text-align: center;
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }
        
        /* Styling for the Menu Links */
        .menu {
            text-align: center;
            margin: 30px 0;
        }

        .menu a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }

        .menu a:hover {
            color: #0056b3;
        }

        .menu i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="menu">
        <a href="giftin.php"><i class="fas fa-list-alt"></i>Gift In Form</a>
        <a href="giftout.php"><i class="fas fa-sign-out-alt"></i>Gift Out Form</a>
        <a href="toylist.php"><i class="fas fa-toys"></i>Toy List</a>
        <a href="current_inventory.php"><i class="fas fa-box"></i>Current Inventory</a>
    </div>
    <form method="POST" action="giftout_process.php">
    <div class="form-title"><b>Gifts Out Form</b></div>
        <div class="form-group">
            <label for="gift">Gift:</label>
            <select id="gift" name="gift">
                <option value="">Name of the Gift</option>
                <?php
                // Include your database connection
                include("includes/db_connect.php");

                // Fetch data from the database
                $query = "SELECT GiftId, GiftName FROM iybigiftinventory";
                $result = mysqli_query($conn, $query);

                // Loop through the results and generate options
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['GiftId'] . '-' . $row['GiftName'] . '">' . $row['GiftName'] . '</option>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="donated_to">Birthday Hero/Heroine Name:</label>
            <input type="text" id="donated_to" name="donated_to" required>
        </div>
        <div class="form-group">
            <label for="gender">Kiddo Gender:</label>
            <input type="radio" name="gender" value="male"> Male <input type="radio" name="gender" value="female"> Female
        </div>
        <div class="form-group">
            <label for="receiver_dob">B'day Hero/Heroine DOB:</label>
            <input type="date" id="receiver_dob" name="receiver_dob" required>
        </div>

        <div class="form-group">
            <label for="delivery_date">Delivery Date:</label>
            <input type="date" id="delivery_date" name="delivery_date" required>
        </div>

        <div class="form-group">
            <label for="shelter">Shelter Name:</label>
            <input type="text" id="shelter" name="shelter" required>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
