<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Task Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Employee Task Tracker</h1>
    <form action="submit_task.php" method="post">
        <label for="employee_name">Employee Name:</label>
        <input type="text" id="employee_name" name="employee_name" required>

        <label for="task_description">Task Description:</label>
        <textarea id="task_description" name="task_description" required></textarea>

        <button type="submit">Submit Task</button>
    </form>

    <div class="links">
        <a href="view_tasks.php">View Task History</a>
        <a href="search_tasks.php">Search Tasks</a>
        <a href="monthly_summary.php">Monthly Summary</a>
    </div>
</body>
</html>
