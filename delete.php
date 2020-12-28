<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        include_once("class/recipe.php");
        $recipe = new Recipe();
        if($recipe->get($id) != null){
            session_start();
            if($recipe->get($id)['author'] == $_SESSION['nickname']){
                $recipe->delete($id);
                header('Location: index.php');
            }else{
                if($_SESSION['role'] == "admin"){
                    $recipe->delete($id);
                    header('Location: index.php');
                }
            }
        }
    }
?>