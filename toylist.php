<!DOCTYPE html>
<html>
<head>
    <title>Gift Inventory List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Styles for the table */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="menu">
        <a href="giftin.php"><i class="fas fa-list-alt"></i>Gift In Form</a>
        <a href="giftout.php"><i class="fas fa-sign-out-alt"></i>Gift Out Form</a>
        <a href="toylist.php"><i class="fas fa-toys"></i>Toy List</a>
        <a href="current_inventory.php"><i class="fas fa-box"></i>Current Inventory</a>
    </div>
    <div class="container">
        <?php
            include("includes/db_connect.php");
            include("includes/status_message.php");
            
            // Pagination settings
            $results_per_page = 50;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $results_per_page;

            // Filter and sort settings
            $filter = isset($_GET['filter']) ? $_GET['filter'] : 'GiftReceivingStatus';
            $sort = isset($_GET['sort']) && $_GET['sort'] === 'desc' ? 'DESC' : 'ASC';

            $counter = 0;
            // Retrieve data from the iybigiftsin and iybigiftsout tables
            $sql = "SELECT s.Id, s.GiftReceivingStatus, s.GiftReceivedDate, s.GiftName, s.GiftPrice, o.Shelter, o.KiddoDOB, o.KiddoGender, o.DateOfDelivery, o.BirthdayHeroName, o.GiftOutTime
                    FROM iybigiftsin AS s
                    LEFT JOIN iybigiftsout AS o ON s.GiftName = o.GiftName
                    ORDER BY $filter $sort
                    LIMIT $offset, $results_per_page";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                // If there was an error in the query, print the error message and stop the execution
                die("Error in the SQL query: " . mysqli_error($conn));
            }
        ?>

        <div class="menu">
            <!-- Your menu links... -->
        </div>

        <h1>Gift Inventory List</h1>
        <form method="GET" action="">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter GiftName or BirthdayHeroName">
            <input type="submit" value="Search">
        </form>

        <form method="GET" action="">
            <label for="filter">Filter By:</label>
            <select id="filter" name="filter">
                <option value="GiftReceivingStatus">Gift Receiving Status</option>
                <option value="GiftReceivedDate">Gift Received Date</option>
                <option value="GiftName">Gift Name</option>
                <option value="GiftPrice">Gift Price</option>
                <option value="Shelter">Shelter</option>
                <option value="KiddoDOB">Kiddo DOB</option>
                <option value="KiddoGender">Kiddo Gender</option>
                <option value="DateOfDelivery">Date of Delivery</option>
                <option value="BirthdayHeroName">Birthday Hero/Heroine Name</option>
                <option value="GiftOutTime">Gift Out Time</option>
            </select>

            <label for="sort">Sort By:</label>
            <select id="sort" name="sort">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <input type="submit" value="Apply">
        </form>

        <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>
                        <th>S.No.</th>
                        <th>Gift Receiving Status</th>
                        <th>Gift Received Date</th>
                        <th>Gift Name</th>
                        <th>Gift Price</th>
                        <th>Shelter</th>
                        <th>Kiddo DOB</th>
                        <th>Kiddo Gender</th>
                        <th>Date of Delivery</th>
                        <th>Birthday Hero/Heroine Name</th>
                        <th>Gift Out Time</th>
                        <th>Action</th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $counter += 1;
                    echo "<tr>
                    <td>" . $counter . "</td>
                    <td>" . $row['GiftReceivingStatus'] . "</td>
                    <td>" . $row['GiftReceivedDate'] . "</td>
                    <td>" . $row['GiftName'] . "</td>
                    <td>" . $row['GiftPrice'] . "</td>
                    <td>" . $row['Shelter'] . "</td>
                    <td>" . $row['KiddoDOB'] . "</td>
                    <td>" . $row['KiddoGender'] . "</td>
                    <td>" . $row['DateOfDelivery'] . "</td>
                    <td>" . $row['BirthdayHeroName'] . "</td>
                    <td>" . $row['GiftOutTime'] . "</td>
                    <td><a href='delete_record.php?id=" . $row['Id'] . "' class='btn btn-danger'>Delete</a>
                        <a href='edit_record.php?id=" . $row['Id'] . "' class='btn btn-warning'>Edit</a>
                    </td>

                    </tr>";
                }
                echo "</table>";

                // Pagination links
                $total_pages_sql = "SELECT COUNT(*) AS total FROM iybigiftsin";
                $result_total_pages = mysqli_query($conn, $total_pages_sql);
                $row_total_pages = mysqli_fetch_assoc($result_total_pages);
                $total_pages = ceil($row_total_pages['total'] / $results_per_page);

                echo "<div>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                }
                echo "</div>";
            } else {
                echo "No data found in the database.";
            }

            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
