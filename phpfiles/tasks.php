<?php
require_once "db.php";

//function is used for making the reading part of the CRUD - selection all of the table and showing it
function getTasks()
{
    global $conn;
     //will return an associate array - easier to work with
    $data = $conn->query("SELECT * FROM mariadb WHERE done = 0")->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

/*function is used to get the ID - helps with updating part of crud also added in WHERE
so it only updates on specific ID rather than everywhere*/
function getTaskId($taskId)
{
    global $conn;

    $data = $conn->query("SELECT * FROM mariadb WHERE id = $taskId")->fetch(PDO::FETCH_ASSOC);

    return $data;
}



//function is used to create in CRUD
function addTask($taskData)
{
    global $conn;

    $query = $conn->prepare("INSERT INTO mariadb (task, description) VALUES (:task, :description)");
    //binds parameters to prepared statements
    $query->bindParam(':task', $taskData['task']);
    $query->bindParam(':description', $taskData['description']);

    $query->execute();

    // Will bring you back to the home page after you have done an add or an update
    header("Location: http://localhost/src/index.php");
}

/*function for the update in CRUD - nearly the same as the create but
with SQL differences and adding the ID in the bindparam*/
function editTask($taskData)
{
    global $conn;

    $query = $conn->prepare("UPDATE mariadb SET task = :task, description = :description WHERE id = :id");
    
    $query->bindParam(':task', $taskData['task']);
    $query->bindParam(':description', $taskData['description']);
    $query->bindParam(':id', $taskData['id']);

    $query->execute();

    // Will bring you back to the home page after you have done an add or an update
    header("Location: http://localhost/src/index.php");
}

function deleteTask($taskId)
{
    global $conn;
    
    $conn->exec("DELETE FROM mariadb WHERE id = $taskId");

    header("Location: http://localhost/src/index.php");
}

// Function to mark task as done (done = 1)
function taskDone($taskId)
{
    global $conn;

    
    $query = $conn->prepare("UPDATE mariadb SET done = 1 WHERE id = :id");
    $query->bindParam(':id', $taskId); // Bind task ID
    $query->execute();

        
    header("Location: http://localhost/src/index.php");  // Redirect to the homepage
}

// Function to display task as done
function displayTaskDone()
{
    global $conn;

    $data = $conn->query("SELECT * FROM mariadb WHERE done = 1")->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

// Function to add the task back from the Completed Tasks to the Awaiting Tasks
function addBack($taskId)
{
    global $conn;

    $query = $conn->prepare("UPDATE mariadb SET done = 0 WHERE id = :id");
    $query->bindParam(':id', $taskId);
    $query->execute();

    header("Location: http://localhost/src/index.php");
    exit();
}

//getting the post to work for the create and update by allowing for the functions to be called
if (isset($_POST['crud'])) {
    if ($_POST['crud'] == 'add') {
        addTask(['task' => $_POST['task'], 'description' => $_POST['description']]);
    } elseif ($_POST['crud'] == 'edit') {
        editTask(['id' => $_POST['id'], 'task' => $_POST['task'], 'description' => $_POST['description']]);
    } elseif ($_POST['crud'] == 'delete') {
        deleteTask($_POST["id"]);
    } elseif ($_POST['crud'] == 'back') {
        header("Location: http://localhost/src/index.php");
    }
}
if (isset($_GET['crud']) && $_GET['crud'] == 'done' && isset($_GET['id'])) {
    $taskId = $_GET['id'];
    taskDone($taskId);
}
if (isset($_GET['crud']) && $_GET['crud'] == 'orNot' && isset($_GET['id'])) {
    $taskId = $_GET['id'];
    addBack($taskId);
}
