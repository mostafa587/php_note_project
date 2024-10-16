<?php
session_start();
if ($_SESSION['username'] !== null && $_SESSION['password'] !== null && $_SESSION['id'] !== null){


    $conn = mysqli_connect('127.0.0.1','root','','mydata');
    $id = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $theNote = filter_var($_POST['thenote'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $addNoteSql = "INSERT INTO notes (id, note) VALUES ('$id', '$theNote')";

        mysqli_query($conn, $addNoteSql);



    };




    
    

    //mysqli_query to get information about data
    $results = mysqli_query($conn, "SELECT note FROM notes WHERE id = $id");
    // to get the data as array
    $notes = mysqli_fetch_all($results, MYSQLI_ASSOC);
 
    




    

}else{
    header("Location: login.html");
    exit;
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label>NOTES</label>
        <input type="text" name="thenote">
        <input type="submit" value = "save">
    </form>

</body>
</html>

<?php foreach($notes as $note) {
        echo '<h5>' . $note['note'] . '</h5>';


    }?>
