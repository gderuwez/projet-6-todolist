<?php
  include 'contenu.php';
  include 'checklist.php';
  include 'head.php';
?>
<p>A FAIRE</p>
<form class="" action="" method="post">
  <?php
    if(isset($_POST["submit"])){
      foreach ($decoded_tasks as $value) {
        echo '<input type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
      }
    }
    elseif (isset($_POST["save"])) {
      $tokeep = array_diff($decoded_tasks, $_POST["taskstodo"]);
      foreach ($tokeep as $value) {
        echo '<input type="checkbox" name="taskstodo[]" value="'.$value.'"> '.$value.'<br>';
      }
    }
  ?>
  <input type="submit" name="save" value="enregistrer">
</form>
<hr>
<p>ARCHIVE</p>
<?php
  if(isset($_POST["save"])){
    $check = $_POST["taskstodo"];
    foreach ($check as $value) {
      echo '<input checked type="checkbox" name="taskdone[]" value="'.$value.'"> <s>'.$value.'</s><br>';
    }
  }
 ?>
<hr>
<form class="" action="" method="post">
  <label for="task">Task to realise</label>
  <br>
  <textarea name="task" rows="8" cols="80"></textarea>
  <br>
  <input type="submit" name="submit" value="submit">
</form>
<?php
  include 'footer.php';
?>
