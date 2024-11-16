<!-- submit_task.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_name = htmlspecialchars($_POST['employee_name']);
    $task_description = htmlspecialchars($_POST['task_description']);
    $date = date('Y-m-d H:i:s');

    $entry = "Date: $date\nEmployee Name: $employee_name\nTask: $task_description\n-------------------------------\n";

    file_put_contents('tasks.txt', $entry, FILE_APPEND);

    header('Location: index.php');
    exit();
}
?>
