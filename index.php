<?php
  include_once('inc/header.php');
  include_once('inc/navbar.php');
?>
<main>
<!-- Main Section -->
<div class="container-fluid margines">
  <div class="row">
    <div class="col-xl-8 col-12 colored marginez">
          <h2 class="text-center">Witaj na książce kucharskiej - Xmon.cf - CookBook 🥘</h2>
          <p class="text-center">Są tutaj przerózne przepisy, tipy, poradniki jak co ugotować! <br> Aby dodać swój przepis musisz być administratorem tejże strony WWW.</p>
    </div>
    <div class="col-xl-2 col-12 offset-xl-1">
        <div class="contaner">
            <div class="row">
              <div class="colored">
                  <h4>Ostatnio dodane przepisy:</h4> 
                  <ol>
                      <?php 
                          $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
                          $stmt = $db->prepare('SELECT * FROM `recipes` ORDER BY `created_at` DESC LIMIT 5');
                          $stmt->execute();
                          $result = $stmt->get_result();
                          while ($row = $result->fetch_assoc()) {
                            echo('<li><a href="view.php?id='.$row['id'].'">'.$row['title'].'</a></li>');
                          }
                      ?>
                  </ol>
              </div>
            </div>
            <div class="row">
              <div class="colored">
                  <h4>Najpopularniejsze przepisy:</h4>
                  <ol>
                  <?php 
                          $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
                          $stmt = $db->prepare('SELECT * FROM `recipes` ORDER BY `view` DESC LIMIT 5');
                          $stmt->execute();
                          $result = $stmt->get_result();
                          while ($row = $result->fetch_assoc()) {
                            echo('<li><a href="view.php?id='.$row['id'].'">'.$row['title'].'</a></li>');
                          }
                      ?>
                  </ol>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
</main>
<?PHP
include_once("inc/footer.php");
include_once("inc/end.php");
?>