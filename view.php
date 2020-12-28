<?php
  include_once('inc/header.php');
  include_once('inc/navbar.php');
  if (empty(@$_GET['id'])){
    header('Location: index.php'); 
  }else{
    include_once("class/recipe.php");
    $recipe = new Recipe();
    if($recipe->get($_GET['id']) == null){
      header('Location: index.php'); 
    }else{
      $final_recipe = $recipe->get($_GET['id']);
      $recipe->addView($_GET['id']);
    }
  }
  function replaceBBcodes($text){
    $text = strip_tags($text);
  // BBcode array
  $find = array(
    '~\[b\](.*?)\[/b\]~s',
    '~\[i\](.*?)\[/i\]~s',
    '~\[u\](.*?)\[/u\]~s',
    '~\[quote\]([^"><]*?)\[/quote\]~s',
    '~\[size=([^"><]*?)\](.*?)\[/size\]~s',
    '~\[color=([^"><]*?)\](.*?)\[/color\]~s',
    '~\[url\]((?:ftp|https?)://[^"><]*?)\[/url\]~s',
    '~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
    '~\[br\](.*?)~s'
  );
  // HTML tags to replace BBcode
  $replace = array(
    '<b>$1</b>',
    '<i>$1</i>',
    '<span style="text-decoration:underline;">$1</span>',
    '<pre>$1</'.'pre>',
    '<span style="font-size:$1px;">$2</span>',
    '<span style="color:$1;">$2</span>',
    '<a href="$1">$1</a>',
    '<img src="$1" alt="" class="img-responsive img-rounded" style="max-height: 300px; max-width: 300px;"/>',
    '<br>$1'
  );
  // Replacing the BBcodes with corresponding HTML tags
  return preg_replace($find, $replace, $text);
}
?>
<main>
<!-- Main -->
<div class="container-fluid margines">
  <div class="row">
    <div class="col-12 col-xl-8 colored">
          <h2 class="text-center"><?php echo($final_recipe['title']);?></h2>
          <p style="white-space: pre-wrap;"><?php echo(replaceBBcodes($final_recipe['recipe']));?></p>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Czy na pewno chcesz usunąć przepis o id <?php echo($final_recipe['id']);?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Potwierdzając tą operacje permamentnie usunie przepis o tytule <strong><?php echo($final_recipe['title']);?></strong> ?<br />
            <strong><u style="color:red;"><span style="color:red;">Operacji tej nie będzie można cofnąć..</span></u></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Wróć</button>
            <a class="btn btn-success" role="button" href='delete.php?id=<?php echo($final_recipe['id']);?>'>Usuń permamentnie!</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-2 offset-xl-1">
        <div class="container">
            <div class="row">
              <div class="colored">
                  <h4>Składniki: </h4> 
                  <p style="white-space: pre-wrap;"><?php echo(replaceBBcodes($final_recipe['ingredients']));?></p>
              </div>
            </div>
            <div class="row">
              <div class="colored">
                  <h4>Informacje: </h4>
                  <ul>
                      <li>Czas: <?php echo(replaceBBcodes($final_recipe['time']));?></li>
                      <li>Ilość porcji: <?php echo(replaceBBcodes($final_recipe['portions']));?></li>
                      <li>Trudność: <?php echo(replaceBBcodes($final_recipe['difficulty']));?></li>
                      <li>Koszt: <?php echo(replaceBBcodes($final_recipe['cost']));?></li>
                      <li>Wyświetleń: <?php echo(replaceBBcodes($final_recipe['view']));?></li>
                      <li>Autorstwa: <?php echo(replaceBBcodes($final_recipe['author']));?></li>
                  </ul>
              </div>
            </div>
            <?php
    if ($final_recipe['author'] == @$_SESSION['nickname']){
      echo('  <div class="row">
      <div class="col-1">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Usuń
        </button>
          <a class="btn btn-warning" role="button" href="edit.php?id='.$final_recipe['id'].'">Zedytuj</a>
        </div>
      </div>
    </div>');
    }else{
      if(@$_SESSION['role'] == "admin"){
        echo('  <div class="row">
      <div class="col-1">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Usuń
        </button>
          <a class="btn btn-warning" role="button" href="edit.php?id='.$final_recipe['id'].'">Zedytuj</a>
        </div>
      </div>
    </div>');
      }
    }
  ?>
        </div>
    </div>
  </div>
</div>
</main>
<?PHP
include_once("inc/footer.php");
include_once("inc/end.php");
?>