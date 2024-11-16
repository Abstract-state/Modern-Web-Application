<!-- monthly_summary.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Task Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Monthly Task Summary</h1>
    <?php
    $tasks = file_get_contents('tasks.txt');
    $pattern = "/Date: (.*)\nEmployee Name: (.*)\nTask: (.*)\n-------------------------------\n/";
    preg_match_all($pattern, $tasks, $matches, PREG_SET_ORDER);

    $summary = [];
    $current_month = date('Y-m');

    foreach ($matches as $match) {
        $date = $match[1];
        $employee_name = $match[2];
        $task_date = date('Y-m', strtotime($date));

        if ($task_date == $current_month) {
            if (!isset($summary[$employee_name])) {
                $summary[$employee_name] = 0;
            }
            $summary[$employee_name]++;
        }
    }

    if ($summary) {
        echo "<ul>";
        foreach ($summary as $employee => $count) {
            echo "<li>$employee: $count tasks</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No tasks logged for the current month.</p>";
    }
    ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
