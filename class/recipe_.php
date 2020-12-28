<?php
    $title = @$_POST['title'];
    $author = @$_POST['author'];
    $recipee = @$_POST['recipe'];

    $ingredients = @$_POST['ingredients'];	
	$time = @$_POST['time'];
	$portions = @$_POST['portions'];
	$difficulty = @$_POST['difficulty'];
    $cost = @$_POST['cost'];
    $image = @$_POST['image'];
    if (empty($image)){
        $image = "image/defaultimg.png";
    }
    include_once("recipe.php");
    $recipe = new Recipe();
    $test = $recipe->create($author, $title, $recipee, $ingredients, $time, $portions, $difficulty, $cost, $image);
    echo($test['id']);
?>