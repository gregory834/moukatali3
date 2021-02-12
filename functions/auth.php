<?php

session_start();  //Démarrarage la session

require_once '../src/formUser/connection.php';

if(isset($_POST['email']) && isset($_POST['password']))
{
    $email= htmlspecialchars($_POST['password']);
    $password= htmlspecialchars($_POST['password']);

    $check= $bd->prepare('SELECT pseudo, email, password FROM utilisateur WHERE email = ?');
    $check -> execute(array($email));
    $data =$check ->fetch();
    $row=$check->rowCount();

    if($row == 1)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $password = hash('sha256', $password);
            if($data['password'] === $password)
            {
                $_SESSION['user'] = $data['peudo'];

                header('Location:landing.php');

            }else header ('Location:index.php?login_err=password');
        } else header ('Location:index.php?login_err=email');
    } else header ('Location:index.php?login_err=already');
}else header('Location:index.php');


?>

