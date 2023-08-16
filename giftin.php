<!DOCTYPE html>
<html>
<head>
    <title>Toy Inventory Scan In Form</title>
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

        .form-icon {
            display: inline-block;
            margin-right: 10px;
        }

        .form-desc {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
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
    </style>
</head>
<body>
    <div class="menu">
        <a href="giftin.php"><i class="fas fa-list-alt"></i>Gift In Form</a>
        <a href="giftout.php"><i class="fas fa-sign-out-alt"></i>Gift Out Form</a>
        <a href="toylist.php"><i class="fas fa-toys"></i>Toy List</a>
        <a href="current_inventory.php"><i class="fas fa-box"></i>Current Inventory</a>
    </div>

    <form id="myForm" action="giftin_process.php" method="post">
        <div class="form-title">Gifts In Form</div>
        <div class="form-group">
        <label for="gift">Gift:</label>
        <select id="gift" name="gift">
        <option value="">Name of the Gift</option>
        <div class="container">
        <div class="status-message">
            <?php echo $status; ?>
        </div>
    </div>
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

        </div>
        <div class="form-group">
            <label for="giftprice">Price:</label>
            <input type="text" id="giftprice" name="giftprice" readonly required>
        </div>
        <div class="form-group">
            <label for="donated-or-purchased">Donated or Purchased:</label>
            <select id="donated-or-purchased" name="donated-or-purchased" required>
                <option value="">Select option</option>
                <option value="Donated">Donated</option>
                <option value="Purchased">Purchased</option>
            </select>
        </div>
        <div class="form-group">
            <label for="received_date">Received Date:</label>
            <input type="date" id="received_date" name="received_date" required>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        // JavaScript code to fetch and set the price based on the selected product label
        document.getElementById("gift").addEventListener("change", function () {
            // Get the selected product label from the dropdown
            const selectedProduct = document.getElementById("gift").value;
            // Make an AJAX request to fetch the price from the server
            console.log("Before AJAX request");
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `get_price.php?gift=${selectedProduct}`, true);
            xhr.onreadystatechange = function () {
                console.log("onreadystatechange: " + xhr.readyState);
                if (xhr.readyState === 4) {
                    console.log("Request completed with status: " + xhr.status);
                    if (xhr.status === 200) {
                        // Update the price input field with the retrieved price
                        document.getElementById("giftprice").value = xhr.responseText;
                        console.log("Price received: " + xhr.responseText);
                    } else {
                        console.error("Error fetching price: Status " + xhr.status);
                    }
                }
            };
            xhr.send();
            console.log("After AJAX request");
        });
    </script>
</body>
</html>
