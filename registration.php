<?php

use function PHPSTORM_META\type;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($username != FALSE && $password != FALSE){

        $conn = mysqli_connect('127.0.0.1','root','','mydata');
        if ($conn != false){


            $result = mysqli_query($conn, 'SELECT * FROM userdb');
            
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $exist = false;
            foreach($rows as $row){
                if ($username == $row['users']){
                    $exist = true;
                    
                };

            };
            if ($exist == true){

                echo'user name is already exist';
                mysqli_close($conn);
                header("Refresh: 3; URL=registration.html");
                exit;

            }else{
                $insertsql = "INSERT INTO userdb (users, password) VALUES ('$username', '$password')";
                mysqli_query($conn, $insertsql);
                mysqli_close($conn);
                header("Location: login.html");
                

            }

            

            
        }else {
            echo 'server error ----->>>> '. $conn ;
        }




    }else {
        // Invalid input, handle error
        header("Location: registration.html");
        exit;
    }


    

}else{
    header("Location: registration.html");
    exit;
}