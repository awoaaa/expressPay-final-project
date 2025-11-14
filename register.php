<?php
session_start();

include 'db_connect.php';

if(isset($_POST['signUp'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $checkEmail="SELECT * FROM users WHERE email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "Email Address Already Exists!";
    }
    else{
        $insertQUERY="INSERT INTO users(firstname, lastname, email, phone, password)
                        VALUES ('$firstname', '$lastname', '$email', '$phone', '$password')";

        if ($conn->query($insertQUERY) === TRUE) {
            header("Location: welcome.php");
            exit;
        }
    }
}
if (isset($_POST['signIn'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // fetch by email, then verify password hash
    $sql = "SELECT id, email, firstname, password FROM users WHERE email='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {            // <- secure one-liner
            $_SESSION['user_id']   = (int)$row['id'];
            $_SESSION['email']     = $row['email'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname']  = $row['lastname'];
            $_SESSION['phone']     = $row['phone'];
            header("Location: welcome.php");
            exit;
        }
    }
    echo "Incorrect credentials. Please try again.";
}
?>