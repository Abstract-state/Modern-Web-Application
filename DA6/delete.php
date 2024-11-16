<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Driver</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Delete Driver</h2>
        <?php
        if (isset($_POST['search_id'])) {
            $driver_id = $_POST['search_id'];

            $stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_id=?");
            $stmt->bind_param("i", $driver_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $driver = $result->fetch_assoc();

            if ($driver) {
                ?>
                <h3>Driver Details</h3>
                <table>
                    <tr>
                        <th>Driver ID</th>
                        <th>Full Name</th>
                        <th>License Number</th>
                        <th>Phone Number</th>
                        <th>Vehicle Type</th>
                        <th>Experience Level</th>
                    </tr>
                    <tr>
                        <td><?php echo $driver['driver_id']; ?></td>
                        <td><?php echo $driver['name']; ?></td>
                        <td><?php echo $driver['license_number']; ?></td>
                        <td><?php echo $driver['phone_number']; ?></td>
                        <td><?php echo $driver['vehicle_type']; ?></td>
                        <td><?php echo $driver['experience_level']; ?></td>
                    </tr>
                </table>
                <p>Are you sure you want to delete this driver?</p>
                <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                    <input type="hidden" name="confirm_delete_id" value="<?php echo $driver['driver_id']; ?>">
                    <div>
                        <input type="submit" value="Delete Driver">
                    </div>
                </form>
                <?php
            } 
            else {
                echo "<p>No driver found with ID $driver_id.</p>";
                echo '<p><a href="delete.php">Go back to Delete Page</a></p>'; 
            }

            $stmt->close();
        } elseif (isset($_POST['confirm_delete_id'])) {
            $driver_id = $_POST['confirm_delete_id'];

            
            $stmt = $conn->prepare("DELETE FROM drivers WHERE driver_id=?");
            $stmt->bind_param("i", $driver_id);

            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<p class='message'>Driver with ID $driver_id deleted successfully!</p>";
                } else {
                    echo "<p>No driver found with ID $driver_id.</p>";
                    echo '<p><a href="delete.php">Go back to Delete Page</a></p>'; 
                }
            } else {
                echo "<p class='message' style='color: red;'>Error deleting record: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            ?>
            <form method="POST" action="delete.php">
                <div>
                    <label for="search_id">Enter Driver ID to Delete:</label>
                    <input type="number" id="search_id" name="search_id" required>
                </div>
                <div>
                    <input type="submit" value="Search Driver">
                </div>
            </form>
            <?php
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
