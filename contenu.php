<?php
  $json = "todo.json"; //path to json
  if(isset($_POST["submit"])){
    $sanitizedTasks = filter_input(INPUT_POST, "task", FILTER_SANITIZE_STRING); //sanitize the user input
    $arrayTasks = explode ("\r\n", $sanitizedTasks); //split the input into an array of tasks
    $encodedTasks = json_encode($arrayTasks, true); //encode the array as a json
    file_put_contents($json, $encodedTasks); //write the tasks into json
    // header('Location: http://localhost/projet-6-todolist/san.php');
  }
?>
