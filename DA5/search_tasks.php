<!-- search_tasks.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Tasks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Search Tasks</h1>
    <form action="" method="get">
        <label for="keyword">Enter Keyword:</label>
        <input type="text" id="keyword" name="keyword" required>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">

        <button type="submit">Search</button>
    </form>

    <?php
    if (isset($_GET['keyword'])) {
        $keyword = htmlspecialchars($_GET['keyword']);
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        $tasks = file_get_contents('tasks.txt');

        $pattern = "/Date: (.*)\nEmployee Name: (.*)\nTask: (.*$keyword.*)\n-------------------------------\n/iU";
        preg_match_all($pattern, $tasks, $matches, PREG_SET_ORDER);

        if ($matches) {
            echo "<table>
                    <tr>
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Task Description</th>
                    </tr>";
            foreach ($matches as $match) {
                $task_date = $match[1];
                $task_timestamp = strtotime($task_date);
                $include = true;

                if ($start_date) {
                    $start_timestamp = strtotime($start_date);
                    if ($task_timestamp < $start_timestamp) {
                        $include = false;
                    }
                }

                if ($end_date) {
                    $end_timestamp = strtotime($end_date . ' +1 day');
                    if ($task_timestamp >= $end_timestamp) {
                        $include = false;
                    }
                }

                if ($include) {
                    echo "<tr>
                            <td>{$match[1]}</td>
                            <td>{$match[2]}</td>
                            <td>{$match[3]}</td>
                          </tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<p>No tasks found containing '$keyword'.</p>";
        }
    }
    ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
