<?php
class Recipe{
    function get($id){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('SELECT * FROM `recipes` WHERE `id` = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        @mysqli_close($db);
        return $row;
    }

    function create($author, $title, $recipe, $ingredients, $time, $portions, $diffiulty, $cost, $image){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $date = date("Y-m-d H:i:s");
        $stmt = $db->prepare('INSERT INTO `xmon_cookbook`.`recipes` (`id`, `author`, `title`, `recipe`, `ingredients`, `time`, `portions`, `difficulty`, `cost`, `image`,`created_at`, `view`) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,1);');
        $stmt->bind_param('ssssssssss', $author, $title, $recipe, $ingredients, $time, $portions, $diffiulty, $cost, $image, $date);
        $stmt->execute();
        $stmt = $db->prepare('SELECT * FROM `recipes` WHERE `author` = ? AND `title` = ? AND `recipe` = ? AND `created_at` = ?');
        $stmt->bind_param('ssss', $author, $title, $recipe, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        @mysqli_close($db);
        return $row;
    }

    function edit($id, $author, $title, $recipe, $ingredients, $time, $portions, $diffiulty, $cost, $image){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('UPDATE `xmon_cookbook`.`recipes` SET `author`= ?, `title`= ?, `recipe`= ?, `ingredients`= ?, `time`= ?, `portions`= ?, `difficulty`= ?, `cost`= ?, `image` = ? WHERE `id`= ?;');
        $stmt->bind_param('ssssssssss', $author, $title, $recipe, $ingredients, $time, $portions, $diffiulty, $cost, $image, $id);
        $stmt->execute();
        @mysqli_close($db);
        return true;
    }

    function addView($id){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('SELECT * FROM `recipes` WHERE `id` = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $view = $row['view'] + 1;
        $stmt = $db->prepare('UPDATE `xmon_cookbook`.`recipes` SET `view`= ? WHERE `id`= ?;');
        $stmt->bind_param('is', $view, $id);
        $stmt->execute();
        @mysqli_close($db);
    }

    function delete($id){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('DELETE FROM `xmon_cookbook`.`recipes` WHERE  `id` = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        @mysqli_close($db);
    }
}
?>