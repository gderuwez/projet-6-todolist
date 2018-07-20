<?php
  $json = 'todo.json';
  $archive = 'archived.json';

  function jsonDecode($path) {
    $decoded = file_get_contents($path);
    return json_decode($decoded, true);
  }
  function jsonEncode($path, $data) {
    $encoded = json_encode($data, true);
    return file_put_contents($path, $encoded);
  }
  function sanitize() {
    $sanitizedTasks = filter_input(INPUT_POST, "task", FILTER_SANITIZE_STRING);
    $trimmed = trim($sanitizedTasks);
    return explode ("\r\n", $trimmed);
  }
  function printToDo($sub) {
    foreach ($sub as $value) {
      echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> <span>'.$value.'</span><br>';
    }
  }

  function todoprint(){
    global $json, $archive;
    $archived = jsonDecode($archive);
    $decodeJson = jsonDecode($json);
    $arrayTasks = sanitize();
    if (isset($_POST['submit'])) {
      if ($_POST['submit'] == '' && isset($decodeJson)) {
        printToDo($decodeJson);
      }
      elseif ($_POST['submit'] !== '' && isset($decodeJson) == false) {
        printToDo($arrayTasks);
        jsonEncode($json, $arrayTasks);
      }
      elseif ($_POST['submit'] !== '' && isset($decodeJson)) {
        $fullToDo = array_merge($decodeJson, $arrayTasks);
        printToDo($fullToDo);
        jsonEncode($json, $fullToDo);
      }
    }
    else {if(isset($decodeJson)) {printToDo($decodeJson);}}
  }

  // clear the archive and todo json
  if(isset($_POST["clear"])){
    $empty = null;
    file_put_contents($json, $empty);
    file_put_contents($archive, $empty);
    $_POST = $empty;
    // var_dump($_POST);
  }
 ?>
