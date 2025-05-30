<?php
    session_start();
    include "cms/includes/connect.php";
    
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$user' AND password='$pass'");

        if(mysqli_num_rows($result)!=0){
            header('Location: cms/index.php');
            $_SESSION['mail'] = $user; 
        }
    }
?>