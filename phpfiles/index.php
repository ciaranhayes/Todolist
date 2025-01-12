<?php
//adding in the other php files code usability 
include 'db.php';

include "tasks.php";

?>
<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <title>2-Du</title>
    <style>
    
    </style>
  </head>
  <body>
    <div class="holder">
        <div class="todoTitle">
            <h1>Todo 📋</h1>
            <form action="index.php" method="get">
                <button class='add' type="submit" name="crud" value="add">Add</button>
            </form>
        </div>
            <?php
            if (isset($_GET['crud'])) {
                if ($_GET['crud'] == "add") {
            ?>

            <div class="addEditTasks">
                <h2>Add A Task:</h2>

                <form action="tasks.php" method="POST">
                        <div class="labels">
                            <label>Task</label>
                            <input type="text" name="task">
                            <br>
                            <label>Description</label>
                            <input type="text" name="description">
                            <div class="buttons">
                                <button type="submit" name="crud" value="add">Save</button>
                                <button type="submit" name="crud" value="back">Back</button>
                            </div>
                        </div>
                </form>

                <?php
                    } elseif ($_GET['crud'] == "edit") {
                        $task = getTaskId($_GET['id']);
                ?>

                <h2>Edit Your Task:</h2>
                <form action="tasks.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <div class="labels">
                        <label>Task</label>
                        <input type="text" name="task" value="<?php echo $task['task']; ?>">
                    
                        <label>Description</label>
                        <input type="text" name="description" value="<?php echo $task['description']; ?>">
                    
                        <button class= 'edit' type="submit" name="crud" value="edit">Save</button>
                    </div>
                </form>

                <?php
                    }
                }
                ?>
            </div>  
        <div class="currentTasks">
            <h2>Awaiting Tasks 😤</h2>

            <?php
            $tasks = getTasks();
            
            if (!$tasks) {
                echo "<p>No tasks awaiting you, king 😔</p>";
            } else {
                echo "<ul>";
                foreach ($tasks as $task) {
                    echo "<div class='addedTask'><li>";
                    echo "<h3>" . $task['task'] . "</h3>";
                    echo "<br>";
                    echo "<p>" . $task['description'] . "</p>";
                    echo "</li>";
                    echo "<div class='buttons'>
                        <form action='index.php' method='get'>
                        <input type='hidden' name='id' value='{$task["id"]}'>
                        <button type='submit' name='crud' value='edit'>Edit 🖊️</button> 
                        </form>";
                    echo "<form action='tasks.php' method='get'>
                        <input type='hidden' name='id' value='{$task["id"]}'>
                        <button type='submit' name='crud' value='done'>Done 🥵</button> 
                        </form>";
                    echo "<form action='tasks.php' method='post'>
                        <input type='hidden' name='id' value='{$task["id"]}'>
                        <button type='submit' name='crud' value='delete'>Delete ✌️</button> 
                        </form>";
                    echo "</div>
                    </div>";  
                    echo "</ul>";
                }
            }
            ?>

            <h2>Completed Tasks 😈</h2>
            <?php
            // Fetch completed tasks
            $doneTasks = displayTaskDone();  // Call the function to get completed tasks

            // Check if there are completed tasks and display them
            if (!$doneTasks) {
                echo "<p>No Completed Tasks 😰</p>";
            } else {
                echo "<ul>";
                foreach ($doneTasks as $doneTask) {
                    echo "<div class='addedTask'><li>";
                    echo "<h3 class='done'>" . $doneTask['task'] . "</h3>";
                    echo "<br>";
                    echo "<p class='done'>" . $doneTask['description'] . "</p>";
                    echo "</li>";
                    echo "<div class='buttons'>
                        <form action='index.php' method='get'>
                        <input type='hidden' name='id' value='{$doneTask["id"]}'>
                        <button type='submit' name='crud' value='edit'>Edit 🖊️</button> 
                        </form>";
                    echo "<form action='tasks.php' method='get'>
                        <input type='hidden' name='id' value='{$doneTask["id"]}'>
                        <button type='submit' name='crud' value='orNot'>Or Not 😱</button> 
                        </form>";
                    echo "<form action='tasks.php' method='post'>
                        <input type='hidden' name='id' value='{$doneTask["id"]}'>
                        <button type='submit' name='crud' value='delete'>Delete ✌️</button> 
                        </form>";
                    echo "</div>
                    </div>";  
                    echo "</ul>";
                }
            }
            ?>
        </div>
    </div>
  </body>
</html>
