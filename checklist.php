<?php
  $json = "todo.json"; //path to json
  $jsonTasks = file_get_contents($json); //reading json file
  $decoded_tasks = json_decode($jsonTasks, true);
?>
