<?php
session_start();
require 'config/connect.php';
// isset($_POST['submit'])
// filter_has_var(INPUT_POST, 'submit') 
if (isset($_POST['submit'])){
    $email=htmlspecialchars($_POST['email']);
    $password=htmlspecialchars($_POST['password']);

    $email=mysqli_real_escape_string($conn,$email);
    $password=mysqli_real_escape_string($conn,$password);
    if (!empty($email) && !empty($password)){
        $query="SELECT * FROM customers WHERE email='$email' && password ='$password'";
        // get result
        $result=mysqli_query($conn,$query);
        $result_check=mysqli_num_rows($result);
        if ($result_check<1){
              header('Location: index.php?login=error');
              exit();
          }else{
            if ($row=mysqli_fetch_assoc($result)){
                $_SESSION['email']=$row['email'];
                $_SESSION['phone_num']=$row['phone_num'];
                header('Location: index.php?login=success');
                exit();
            }
          } 
    }else{
        header('Location: signup.php');
    }
}else{
    header('Location: signup.php');
}

?>