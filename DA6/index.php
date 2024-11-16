<!DOCTYPE html>
<html>
<head>
    <title>Create Driver</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Create Driver</h2>
        <?php
        include 'db_connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $driver_id = $_POST['driver_id'];
            $name = $_POST['name'];
            $license_number = $_POST['license_number'];
            $phone_number = $_POST['phone_number'];
            $vehicle_type = $_POST['vehicle_type'];
            $experience_level = $_POST['experience_level'];

            $stmt = $conn->prepare("INSERT INTO drivers (driver_id, name, license_number, phone_number, vehicle_type, experience_level) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $driver_id, $name, $license_number, $phone_number, $vehicle_type, $experience_level);

            if ($stmt->execute()) {
                echo "<p class='message'>Driver added successfully!</p>";
            } else {
                echo "<p class='message' style='color: red;'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        $conn->close();
        ?>
        <form action="index.php" method="POST">
            <div>
                <label for="driver_id">Driver ID:</label>
                <input type="number" id="driver_id" name="driver_id" required>
            </div>
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" maxlength="50" required>
            </div>
            <div>
                <label for="license_number">License Number:</label>
                <input type="text" id="license_number" name="license_number" required>
            </div>
            <div>
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" maxlength="15" required>
            </div>
            <div>
                <label for="vehicle_type">Vehicle Type:</label>
                <select id="vehicle_type" name="vehicle_type" required>
                    <option value="">--Select Vehicle Type--</option>
                    <option value="Truck">Truck</option>
                    <option value="Van">Van</option>
                    <option value="Car">Car</option>
                    <option value="Bike">Bike</option>
                </select>
            </div>
            <div>
                <label>Experience Level:</label>
                <input type="radio" name="experience_level" value="Beginner" required> Beginner
                <input type="radio" name="experience_level" value="Intermediate"> Intermediate
                <input type="radio" name="experience_level" value="Expert"> Expert
            </div>
            <div>
                <input type="submit" value="Add Driver">
            </div>
        </form>
    </div>
</body>
</html>
