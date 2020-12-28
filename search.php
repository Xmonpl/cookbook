<?php
  include_once('inc/header.php');
  include_once('inc/navbar.php');
  function stripBBCode($text_to_search) {
    $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
    $replace = '';
    return preg_replace($pattern, $replace, $text_to_search);
   }
?>
<main>

<div class="container">
  <div class="row">
  <?php
  $search = @$_POST["search"];
  $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
  if (empty($search)){
    $stmt = $db->prepare('SELECT * FROM `recipes` ORDER BY `created_at` DESC LIMIT 1000');
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      echo('  <div class="card">
      <div class="row no-gutters">
          <div class="col-sm-5">
              <img class="card-img" src="'.$row['image'].'" alt="'.$row['title'].'">
          </div>
          <div class="col-sm-7">
              <div class="card-body">
                  <h5 class="card-title" style="color: black;">'.stripBBCode($row['title']).'</h5>
                  <p class="card-text" style="color: black;">'.mb_substr(stripBBCode($row['recipe']), 0, 50, "utf-8").'...</p>
                  <a href="view.php?id='.$row['id'].'" class="btn btn-primary">Zobacz przepis</a>
              </div>
          </div>
      </div>
  </div>');
    }
  }else{
    $stmt = $db->prepare('SELECT * FROM `recipes` WHERE LOWER(`title`) LIKE ?');
    $f = '%'.strtolower($search).'%';
    $stmt->bind_param("s", $f);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      echo('  <div class="card">
      <div class="row no-gutters">
          <div class="col-sm-5">
              <img class="card-img" src="'.$row['image'].'" alt="'.$row['title'].'">
          </div>
          <div class="col-sm-7">
              <div class="card-body">
                  <h5 class="card-title" style="color: black;">'.$row['title'].'</h5>
                  <p class="card-text" style="color: black;">'.mb_substr(stripBBCode($row['recipe']), 0, 50, "utf-8").'</p>
                  <a href="view.php?id='.$row['id'].'" class="btn btn-primary">Zobacz przepis</a>
              </div>
          </div>
      </div>
  </div>');
    }
  }
  @mysqli_close($db);
?>
</div>
</div>


</main>
<?PHP
include_once("inc/footer.php");
include_once("inc/end.php");
?>
