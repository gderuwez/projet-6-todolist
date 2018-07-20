<?php
  $json = 'todo.json';
  $archive = 'archived.json';
  function jsonDecode($path) {
    $decoded = file_get_contents($path);
    return json_decode($decoded, true);
  }
  function sanitize() {
    $sanitizedTasks = filter_input(INPUT_POST, "task", FILTER_SANITIZE_STRING);
    $trimmed = trim($sanitizedTasks);
    return explode ("\r\n", $trimmed);
  }

  // on submit put the string in the to do list
  function todoprint(){
    global $json, $archive;
    $archived = jsonDecode($archive);
    $decodeJson = jsonDecode($json);
    $arrayTasks = sanitize();
    if(isset($_POST["submit"])){
      if ($_POST["task"] !== '' && isset($decodeJson) && isset($Archived)) {
        $tojs = array_merge($decodeJson, $arrayTasks);
        $toPrint = array_diff($tojs, $Archived);
        foreach ($toPrint as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
        $tosend = json_encode($tojs, true);
        file_put_contents($json, $tosend);
      }
      elseif ($_POST["task"] !== '' && isset($decodeJson) && isset($Archived) == false) {
        $toPrint = array_merge($decodeJson, $arrayTasks);
        foreach ($toPrint as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
        $tosend = json_encode($toPrint, true);
        file_put_contents($json, $tosend);
      }
      elseif ($_POST["task"] !== '' && isset($decodeJson) == false ) {
        foreach ($arrayTasks as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
        $tosend = json_encode($arrayTasks, true);
        file_put_contents($json, $tosend);
      }
      elseif ($_POST["task"] == '' && isset($decodeJson) && isset($Archived) ) {
        $toPrint = array_diff($decodeJson, $Archived);
        foreach ($toPrint as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
      }
      elseif ($_POST["task"] == '' && isset($decodeJson) && isset($Archived) == false ) {
        foreach ($decodeJson as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
      }
    }
  }
  // on submit set the archive
  function doneprint2(){
    global $json, $archive;
    $archived = jsonDecode($archive);
    $decodeJson = jsonDecode($json);
    $arrayTasks = sanitize();
    if(isset($_POST["submit"])){
      if ($_POST["task"] !== '' && isset($decodeJson) && isset($Archived)) {
        foreach ($Archived as $value) {
          echo '<input class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
        }
      }
      elseif ($_POST["task"] == '' && isset($decodeJson) && isset($Archived) ) {
        foreach ($Archived as $value) {
          echo '<input  class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
        }
      }
    }
  }
  // on  save set and modify the archive
  function doneprint() {
    global $archive;
    $archived = jsonDecode($archive);
    if(isset($_POST['save'])){
      //if task checked and no previous task archived
      if(isset($_POST['taskstodo']) && isset($Archived) === false) {
        $toArchive = $_POST['taskstodo'];
        foreach ($toArchive as $value) {
          echo '<input  class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
        }
        $archiveEncode = json_encode($toArchive, true);
        file_put_contents($archive, $archiveEncode);
      }
      // if task checked but previous tasks archived
      elseif (isset($_POST['taskstodo']) && isset($Archived)) {
        $NewCheck = $_POST['taskstodo'];
        if (isset($_POST['taskdone'])) {
          $test = $_POST['taskdone'];
          $toArchive = array_merge($test, $NewCheck);
          foreach ($toArchive as $value) {
            echo '<input class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
          }
          $archiveEncode = json_encode($toArchive, true);
          file_put_contents($archive, $archiveEncode);
        }
        else {
          foreach ($NewCheck as $value) {
            echo '<input class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
          }
          $archiveEncode = json_encode($NewCheck, true);
          file_put_contents($archive, $archiveEncode);
        }
      }
      //no task checked but previous tasks archived
      elseif (isset($_POST['taskstodo']) === false && isset($Archived)) {
        if (isset($_POST['taskdone'])) {
          $test = $_POST['taskdone'];
          foreach ($test as $value) {
            echo '<input class="w3-check w3-margin-left" checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
          }
          $archiveEncode = json_encode($test, true);
          file_put_contents($archive, $archiveEncode);
        }
        else {
          $archiveEncode = null;
          file_put_contents($archive, $archiveEncode);
        }
      }
    }
  }
  // on save set and modify the to do list
  function todoprint2(){
    global $json, $archive;
    $archived = jsonDecode($archive);
    $decodeJson = jsonDecode($json);
    if(isset($_POST['save'])){
      //task checked and archive empty
      if(isset($_POST['taskstodo']) && isset($Archived) === false) {
        $tokeeparchived = $_POST['taskstodo'];
        $tokeep = array_diff($decodeJson, $tokeeparchived);
        foreach ($tokeep as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
      }
      // task checked and archive not empty
      elseif (isset($_POST['taskstodo']) && isset($Archived) === true) {
        $toDoChecked = $_POST['taskstodo'];
        $toDoNotChecked = array_diff($decodeJson, $Archived, $toDoChecked);
        if (isset($_POST['taskdone'])) {
          $archiveChecked = $_POST['taskdone'];
          $archiveNotChecked = array_diff($Archived, $archiveChecked);
          $toPrint = array_merge($toDoNotChecked, $archiveNotChecked);
          foreach ($toPrint as $value) {
            echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
          }
        }
        else {
          $toPrint = $Archived;
          foreach ($toPrint as $value) {
            echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
          }
        }

      }
      // no tasks checked and archive not empty
      elseif (isset($_POST['taskstodo']) === false && isset($toArchive) === true) {
        if (isset($_POST['taskdone'])) {
          $toKeepArchived = $_POST['taskdone']; // element still checked in archive
          $toPutBack = array_diff($decodeJson, $toKeepArchived); // elements from archive to put back in to do
          foreach ($toPutBack as $value) {
            echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
          }
        }
        else {
          foreach ($decodeJson as $value) {
            echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
          }
        }
      }
      //no task checked and archive empty
      else {
        foreach ($decodeJson as $value) {
          echo '<input class="w3-check w3-margin-left" type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
        }
      }
    }
  }
  // clear the archive and todo json
  if(isset($_POST["clear"])){
    $empty = null;
    file_put_contents($json, $empty);
    file_put_contents($archive, $empty);
  }
?>
