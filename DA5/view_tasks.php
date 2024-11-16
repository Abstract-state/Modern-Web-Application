<!-- view_tasks.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Task History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>View Task History</h1>
    <form action="" method="get">
        <label for="employee_name">Enter Your Name:</label>
        <input type="text" id="employee_name" name="employee_name" required>
        <button type="submit">View Tasks</button>
    </form>

    <?php
    if (isset($_GET['employee_name'])) {
        $employee_name = htmlspecialchars($_GET['employee_name']);
        $tasks = file_get_contents('tasks.txt');

        $pattern = "/Date: (.*)\nEmployee Name: $employee_name\nTask: (.*)\n-------------------------------\n/";
        preg_match_all($pattern, $tasks, $matches, PREG_SET_ORDER);

        if ($matches) {
            echo "<table>
                    <tr>
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Task Description</th>
                    </tr>";
            foreach ($matches as $match) {
                echo "<tr>
                        <td>{$match[1]}</td>
                        <td>$employee_name</td>
                        <td>{$match[2]}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No tasks found for $employee_name.</p>";
        }
    }
    ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
