<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = filter_var($_POST['user'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($username != FALSE && $password != FALSE){
        $conn = mysqli_connect('127.0.0.1','root','','mydata');
        if($conn != false){
            $result = mysqli_query($conn, 'SELECT * FROM userdb');
            
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $valid = false;
            foreach($rows as $row){
                if ($username == $row['users'] && $password == $row['password']){
                    $_SESSION['id'] = $row['id'];
                    $valid = true;
                    
                    
                }
            }
            if ($valid == true){
                
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location: notes.php");

            }else{
                echo'username or password are not true';
                mysqli_close($conn);
                header("Refresh: 3; URL=login.html");
                exit;
            };
            













        }elseif($conn == false){
            echo'server db connection error';
            header("Refresh: 3; URL=login.html");
            exit;
        };



    }else{
        echo'input not valid';
        
        header("Refresh: 3; URL=login.html");
        exit;
    };

}else{
    header("Location: login.html");
    exit;

};