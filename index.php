<?php
  include 'process.php';
  include 'head.php';
?>
<form action="" method="post" class="w3-container">
  <label class="w3-xlarge w3-deep-purple w3-center w3-show" for="task">Input your task here</label>
  <br>
  <input class="w3-input w3-border" type="text" name="task" id="task">
  <div class="w3-center">
    <input type="submit" name="submit" value="submit" class="w3-btn w3-round w3-purple w3-mobile w3-margin-top">
  </div>
</form>
<hr>
<form action="" method="post" class="w3-display-container">
  <h3 class="w3-deep-purple w3-center">To Do</h3>
  <div class="todo">
    <?php
      echo todoprint();
    ?>
  </div>
  <br>
  <hr>
  <h3 class="w3-deep-purple w3-center">Archive</h3>
  <div class="archive">
  </div>
  <br>
  <hr>
  <div class="w3-center">
    <input type="submit" name="clear" value="clear" class="w3-btn w3-round w3-purple w3-mobile w3-margin-top">
  </div>
</form>
<?php
  include 'footer.php';
?>
