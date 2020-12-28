<?php
    $title = @$_POST['title'];
    $author = @$_POST['author'];
    $recipee = @$_POST['recipe'];
    $id = @$_POST['id'];
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
    //function create($author, $title, $recipe, $other){
    $recipe->edit($id, $author, $title, $recipee, $ingredients, $time, $portions, $difficulty, $cost, $image);
    echo("true");
?>