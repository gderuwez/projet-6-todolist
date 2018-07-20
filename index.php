<?php
  include 'process.php';
  include 'head.php';
?>
<form action="" method="post" class="w3-display-container">
  <h3 class="w3-deep-purple w3-center">A FAIRE</h3>
  <div class="todo">
    <?php
      echo todoprint();
      // echo todoprint2();
    ?>
  </div>
  <br>
  <!-- <div class="w3-center">
    <input type="submit" name="save" value="enregistrer" class="w3-btn w3-mobile w3-round w3-purple">
  </div> -->
  <hr>
  <h3 class="w3-deep-purple w3-center">ARCHIVE</h3>
  <div class="archive">
    <?php
      // echo doneprint();
      // echo doneprint2();
     ?>
  </div>
</form>
<hr>
<form action="" method="post" class="w3-container">
  <label class="w3-large w3-deep-purple w3-center w3-show" for="task">Input your task here</label>
  <br>
  <textarea class="w3-input w3-border" name="task" rows="8" cols="80"></textarea>
  <div class="w3-center">
    <input type="submit" name="submit" value="submit" class="w3-btn w3-round w3-purple w3-mobile w3-margin-top">
    <input type="submit" name="clear" value="clear" class="w3-btn w3-round w3-purple w3-mobile w3-margin-top">
  </div>
</form>
<?php
  include 'footer.php';
?>
