<?php
  include_once('inc/header.php');
  include_once('inc/navbar.php');
  include_once('inc/checklogin.php');
  $check = false;
  if (!empty(@$_GET['id'])){
    include_once("class/recipe.php");
    $recipe = new Recipe();
    if($recipe->get($_GET['id']) == null){
      
    }else{
      if($recipe->get($_GET['id'])['author'] == $_SESSION['nickname']){
        $check = true;
        $final_recipe = $recipe->get($_GET['id']);
      }else{
        if($_SESSION['role'] == "admin"){
          $check = true;
          $final_recipe = $recipe->get($_GET['id']);
        }else{
          echo("<script>alert('Dlaczego Chcesz edytować nie swój przepis?'); window.location = 'edit.php'</script>");
        }
      }
    }
  }
?>
<main>
<!-- Main Section -->
  <div class="container-fluid" style="margin: 5%;">
    <div class="row">
      <div class="col-12 col-xl-8 colored">
      <form method="post" id="login">
      <h1>Tworzenie przepisu.. <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  BBCode
</button></h1>
        <label for="exampleInputEmail1" class="form-label">Nazwa przepisu</label>
        <?php
          if ($check){
              echo('<input type="text" class="form-control" name="title"  id="title" aria-describedby="emailHelp" value="'.$final_recipe['title'].'">');
          }else{
            echo('<input type="text" class="form-control" name="title"  id="title" aria-describedby="emailHelp">');
          }
        ?>
        <label for="exampleInputEmail1" class="form-label">Wykonanie</label>
        <?php
          if ($check){
              echo('<textarea class="form-control" aria-label="With textarea" name="recipe"  id="recipe">'.$final_recipe['recipe'].'</textarea><button type="submit" class="btn btn-success" style="margin: 5px;">Zedytuj!</button>');
          }else{
            echo('<textarea class="form-control" aria-label="With textarea" name="recipe"  id="recipe"></textarea><button type="submit" class="btn btn-success" style="margin: 5px;">Utwórz!</button>');
          }
        ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black;">BBCode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p style="color: black;">[b]Cześć[/b] - Pogrubia tekst<br>[u]Dzień Dobry[/u] - Podkreśla tekst<br>To jest [i]Świetne![/i] - Pochyla tekst<br>[color=red]Cześć![/color] - Zmienia kolor tekstu wspiera również kolory w hexie<br>[size=9]MAŁY[/size] - Zmienia wielkość tekstu<br>[url=https://Xmon.cf]Odwiedź![/url] - Pozwala dodać przekierowanie na daną stronę<br>[img]https://i.imgur.com/zCSfft6.png[/img] - Pozwala dodać obrazek do naszego przepisu.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-2 offset-xl-1">
          <div class="container">
            <div class="row">
              <div class="colored" style="padding-bottom: 10px;">
              <h4>Składniki: </h4> 
              <?php
                if ($check){
                    echo('<textarea class="form-control" aria-label="With textarea" name="ingredients"  id="ingredients">'.$final_recipe['ingredients'].'</textarea>');
                }else{
                  echo('<textarea class="form-control" aria-label="With textarea" name="ingredients"  id="ingredients"></textarea>');
                }
              ?>
              </div>
            </div>
            <div class="row">
              <div class="colored" style="padding-bottom: 10px; margin-top:25px;">
                <h4>Informacje: </h4>
                <label for="exampleInputEmail1" class="form-label">Czas</label>
                <?php
                  if ($check){
                      echo('<input type="text" class="form-control" name="time"  id="time" aria-describedby="emailHelp" value="'.$final_recipe['time'].'">');
                  }else{
                    echo('<input type="text" class="form-control" name="time"  id="time" aria-describedby="emailHelp">');
                  }
                ?>
                <label for="exampleInputEmail1" class="form-label">Ilość porcji</label>
                <?php
                  if ($check){
                      echo('<input type="text" class="form-control" name="portions"  id="portions" aria-describedby="emailHelp" value="'.$final_recipe['portions'].'">');
                  }else{
                    echo('<input type="text" class="form-control" name="portions"  id="portions" aria-describedby="emailHelp">');
                  }
                ?>
                <label for="exampleInputEmail1" class="form-label">Trudność</label>
                <?php
                  if ($check){
                      echo('<input type="text" class="form-control" name="difficulty"  id="difficulty" aria-describedby="emailHelp" value="'.$final_recipe['difficulty'].'">');
                  }else{
                    echo('<input type="text" class="form-control" name="difficulty"  id="difficulty" aria-describedby="emailHelp">');
                  }
                ?>
                <label for="exampleInputEmail1" class="form-label">Zdjęcie</label>
                <?php
                  if ($check){
                      echo('<input type="text" class="form-control" name="image"  id="image" aria-describedby="emailHelp" value="'.$final_recipe['image'].'">');
                  }else{
                    echo('<input type="text" class="form-control" name="image"  id="image" aria-describedby="emailHelp">');
                  }
                ?>
                <label for="exampleInputEmail1" class="form-label">Koszt</label>
                <?php
                  if ($check){
                      echo('<input type="text" class="form-control" name="cost"  id="cost" aria-describedby="emailHelp" value="'.$final_recipe['cost'].'">');
                      echo('<input type="hidden" class="form-control" name="id"  id="id" aria-describedby="emailHelp" value="'.$final_recipe['id'].'">');
                  }else{
                    echo('<input type="text" class="form-control" name="cost"  id="cost" aria-describedby="emailHelp">');
                  }
                  echo('<input type="hidden" class="form-control" name="author"  id="author" aria-describedby="emailHelp" value="'.$_SESSION['nickname'].'">');
                ?>
              </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</main>
<?PHP
include_once("inc/footer.php");
?>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<?php
if($check){
 //update
  echo("<script> $(document).ready(function(){
    $('#login').submit(function(e){
      e.preventDefault();
      console.log($(this).serialize());
      $.ajax({
        type: 'POST',
        url: 'class/recipe__.php',
        data: $(this).serialize(),
        success: function (date){
          if (date === 'true'){
            window.location = 'view.php?id=".@$_GET['id']."'
          }else{
            alert(date);
            alert('Nie prawidłowe dane!');
          }
        }
      });
    });
  });</script>");
}else{
  //create
  echo("<script>$(document).ready(function(){
    $('#login').submit(function(e){
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'class/recipe_.php',
        data: $(this).serialize(),
        success: function (date){
          window.location = 'view.php?id=' + date;
        }
      });
    });
  });</script>");
}
include_once("inc/end.php");
?>