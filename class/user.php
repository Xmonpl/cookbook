<?php

class User {
    function login($email, $password){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('SELECT * FROM `users` WHERE `email` = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result != null){
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])){
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['nickname'] = $row['nickname'];
                $_SESSION['role'] = $row['role'];
                @mysqli_close($db);
                return '{"success": "loged"}';
            }else{
                @mysqli_close($db);
                return '{"error": "invalid password"}';
            }
        }else{
            @mysqli_close($db);
            return '{"error": "invalid email"}';
        }
    }

    function register($email, $nickname, $password){
        $db = mysqli_connect("localhost", "root", "", "xmon_cookbook");
        $stmt = $db->prepare('SELECT * FROM `users` WHERE `email` = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!empty($result->fetch_assoc())){
            @mysqli_close($db);
            return '{"error": "email already exists"}';
        }else{
            $stmt = $db->prepare('SELECT * FROM `users` WHERE `nickname` = ?');
            $stmt->bind_param('s', $nickname);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!empty($result->fetch_assoc())){
                @mysqli_close($db);
                return '{"error": "nickname already exists"}';
            }else{
                $stmt = $db->prepare('INSERT INTO `xmon_cookbook`.`users` (`id`, `nickname`, `email`, `password`, `role`, `created_at`) VALUES (null, ?, ?, ?, ?, ?);');
                $role = "user";
                $passwordhash = password_hash($password, PASSWORD_BCRYPT);
                $date = date("Y-m-d H:i:s");
                $stmt->bind_param('sssss', $nickname, $email, $passwordhash, $role, $date);
                $stmt->execute();
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['nickname'] = $nickname;
                $_SESSION['role'] = $role;
                @mysqli_close($db);
                return '{"success": "registered"}';
            }
        }
    }
}

?>