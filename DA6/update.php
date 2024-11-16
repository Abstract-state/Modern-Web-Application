<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Driver</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Update Driver</h2>
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
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $driver['id']; ?>">
                    <div>
                        <label for="driver_id">Driver ID:</label>
                        <input type="number" id="driver_id" name="driver_id" value="<?php echo $driver['driver_id']; ?>" required>
                    </div>
                    <div>
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" maxlength="50" value="<?php echo $driver['name']; ?>" required>
                    </div>
                    <div>
                        <label for="license_number">License Number:</label>
                        <input type="text" id="license_number" name="license_number" value="<?php echo $driver['license_number']; ?>" required>
                    </div>
                    <div>
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" id="phone_number" name="phone_number" maxlength="15" value="<?php echo $driver['phone_number']; ?>" required>
                    </div>
                    <div>
                        <label for="vehicle_type">Vehicle Type:</label>
                        <select id="vehicle_type" name="vehicle_type" required>
                            <option value="">--Select Vehicle Type--</option>
                            <option value="Truck" <?php if($driver['vehicle_type']=='Truck') echo 'selected'; ?>>Truck</option>
                            <option value="Van" <?php if($driver['vehicle_type']=='Van') echo 'selected'; ?>>Van</option>
                            <option value="Car" <?php if($driver['vehicle_type']=='Car') echo 'selected'; ?>>Car</option>
                            <option value="Bike" <?php if($driver['vehicle_type']=='Bike') echo 'selected'; ?>>Bike</option>
                        </select>
                    </div>
                    <div>
                        <label>Experience Level:</label>
                        <input type="radio" name="experience_level" value="Beginner" <?php if($driver['experience_level']=='Beginner') echo 'checked'; ?> required> Beginner
                        <input type="radio" name="experience_level" value="Intermediate" <?php if($driver['experience_level']=='Intermediate') echo 'checked'; ?>> Intermediate
                        <input type="radio" name="experience_level" value="Expert" <?php if($driver['experience_level']=='Expert') echo 'checked'; ?>> Expert
                    </div>
                    <div>
                        <input type="submit" name="update_driver" value="Update Driver">
                    </div>
                </form>
                <?php
            } else {
                echo "<p>No driver found with ID $driver_id.</p>";
            }

            $stmt->close();
        } elseif (isset($_POST['update_driver'])) {

            $id = $_POST['id'];
            $driver_id = $_POST['driver_id'];
            $name = $_POST['name'];
            $license_number = $_POST['license_number'];
            $phone_number = $_POST['phone_number'];
            $vehicle_type = $_POST['vehicle_type'];

            $stmt = $conn->prepare("UPDATE drivers SET driver_id=?, name=?, license_number=?, phone_number=?, vehicle_type=?, experience_level=? WHERE id=?");
            $stmt->bind_param("isssssi", $driver_id, $name, $license_number, $phone_number, $vehicle_type, $experience_level, $id);

            if ($stmt->execute()) {
                echo "<p class='message'>Driver updated successfully!</p>";
            } else {
                echo "<p class='message' style='color: red;'>Error updating record: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            ?>
            <form method="POST" action="update.php">
                <div>
                    <label for="search_id">Enter Driver ID to Update:</label>
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
