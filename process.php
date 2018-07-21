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
    global $json;
    $decodeJson = jsonDecode($json);
    $arrayTasks = sanitize();
    if (isset($_POST['submit'])) {
      if ($_POST['task'] == '' && isset($decodeJson)) {
        $toPrint = $decodeJson;
      }
      elseif ($_POST['task'] !== '' && isset($decodeJson) == false) {
        $toPrint = $arrayTasks;
      }
      elseif ($_POST['task'] !== '' && isset($decodeJson)) {
        $toPrint = array_merge($decodeJson, $arrayTasks);
      }
      printToDo($toPrint);
      jsonEncode($json, $toPrint);
      unset($_POST);
    }
    else {
      if(isset($decodeJson)) {
        printToDo($decodeJson);
      }
    }
  }

  // clear the archive and todo json
  if(isset($_POST["clear"])){
    $empty = null;
    file_put_contents($json, $empty);
    file_put_contents($archive, $empty);
    unset($_POST);
  }

  function easy($keyword, $code1, $code2) {
    if(isset($_POST[$keyword])) {
      $data = [$_POST[$keyword]];
      $decoded = jsonDecode($code1);
      $decodedJson = jsonDecode($code2);
      $new = array_diff($decodedJson, $data);
      if(isset($decoded)) {
        $toprint = array_merge($decoded, $data);
      }
      else {
        $toprint = $data;
      }
      jsonEncode($code1, $toprint);
      jsonEncode($code2, $new);
    }
  }

  easy('archive', $archive, $json);

  easy('todo', $json, $archive);
 ?>
