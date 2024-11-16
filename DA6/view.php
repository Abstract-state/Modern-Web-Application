<!DOCTYPE html>
<html>
<head>
    <title>View Drivers</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>View Drivers</h2>
        <?php
        include 'db_connect.php';

        $sql = "SELECT * FROM drivers ORDER BY driver_id ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Driver ID</th>
                    <th>Full Name</th>
                    <th>License Number</th>
                    <th>Phone Number</th>
                    <th>Vehicle Type</th>
                    <th>Experience Level</th>
                  </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['driver_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['license_number']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['vehicle_type']}</td>
                        <td>{$row['experience_level']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No driver records found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
