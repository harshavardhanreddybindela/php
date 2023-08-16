<?php
include("includes/db_connect.php");

$status = ""; // Initialize the status message

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT iybigiftsout.Id AS giftin_id,
               iybigiftsin.GiftReceivingStatus,
               iybigiftsin.GiftReceivedDate,
               iybigiftsin.GiftId,
               iybigiftsin.GiftName,
               iybigiftsin.GiftPrice,
               iybigiftsout.Shelter,
               iybigiftsout.KiddoDOB,
               iybigiftsout.KiddoGender,
               iybigiftsout.DateOfDelivery,
               iybigiftsout.BirthdayHeroName,
               iybigiftsout.GiftOutTime
        FROM iybigiftsin
        INNER JOIN iybigiftsout ON iybigiftsin.id = iybigiftsout.id
        WHERE iybigiftsout.id = '$id'";

    $rs = mysqli_query($conn, $sql);

    if ($rs !== false) {
        if (mysqli_num_rows($rs) > 0) {
            $rs = mysqli_fetch_assoc($rs);
        } else {
            $status = "No records found for the selected ID.";
        }
    } else {
        $status = "Error in SQL query: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Remove duplicate form opening tag
// Add the 'myForm' id to the form for JavaScript submission validation
?>

<!DOCTYPE html>
<html>
<head>
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
    <h1>Edit Record</h1>
    <?php echo $status ? "<p>$status</p>" : ""; ?>

    <form id="myForm" action="update_record.php" method="post">
        <div class="form-group">
            <label for="gift">Gift:</label>
            <select id="gift" name="gift">
                <option value="">Name of the Gift</option>
                <?php
                include("includes/db_connect.php");

                $query = "SELECT GiftId, GiftName FROM iybigiftinventory";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($rs['GiftName'] == $row['GiftName']) ? "selected" : "";
                    echo '<option value="' . $row['GiftId'] . '" ' . $selected . '>' . $row['GiftName'] . '</option>';
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>
        </div>
        <div class="form-group">
            <label for="giftprice">Price:</label>
            <input type="text" id="giftprice" name="giftprice" value=" <?php echo $rs['GiftPrice']; ?>" readonly required>
        </div>
        <div class="form-group">
            <label for="donated-or-purchased">Denoted or Purchased:</label>
            <select id="donated-or-purchased" name="donated-or-purchased" required>
                <option value="">Select option</option>
                <option value="Donated" <?php if ($rs['GiftReceivingStatus'] == 'Donated') echo "selected"; ?>>Donated</option>
                <option value="Purchased" <?php if ($rs['GiftReceivingStatus'] == 'Purchased') echo "selected"; ?>>Purchased</option>
            </select>
        </div>


        <div class="form-group">
            <label for="received_date">Received Date:</label>
            <td><input type="date" id="received_date" name="received_date" value="<?php echo isset($rs['GiftReceivedDate']) ? date('Y-m-d', strtotime($rs['GiftReceivedDate'])) : ''; ?>"></td>
        </div>
        <div class="form-group">
            <label for="donated_to">Birthday Hero/Heroine Name:</label>
            <input type="text" id="donated_to" name="donated_to" value="<?php echo isset($rs['BirthdayHeroName']) ? $rs['BirthdayHeroName'] : ''; ?>" required>
        </div>

      <div class="form-group">
          <label for="gender">Kiddo Gender:</label>
          <input type="radio" name="gender" value="male" <?php if (isset($rs['KiddoGender']) && $rs['KiddoGender'] == 'male') echo 'checked'; ?>> Male
          <input type="radio" name="gender" value="female" <?php if (isset($rs['KiddoGender']) && $rs['KiddoGender'] == 'female') echo 'checked'; ?>> Female
      </div>

      <div class="form-group">
          <label for="receiver_dob">B'day Hero/Heroine DOB:</label>
          <input type="date" id="receiver_dob" name="receiver_dob" value="<?php echo isset($rs['KiddoDOB']) ? $rs['KiddoDOB'] : ''; ?>" required>
      </div>

      <div class="form-group">
          <label for="delivery_date">Delivery Date:</label>
          <input type="date" id="delivery_date" name="delivery_date" value="<?php echo isset($rs['DateOfDelivery']) ? $rs['DateOfDelivery'] : ''; ?>" required>
      </div>

      <div class="form-group">
          <label for="shelter">Shelter Name:</label>
          <input type="text" id="shelter" name="shelter" value="<?php echo isset($rs['Shelter']) ? $rs['Shelter'] : ''; ?>" required>
      </div>


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
    <!-- Include any additional content or scripts if needed -->
</body>
</html>
