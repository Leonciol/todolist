<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php

require('dbb.php');
include ('function.php');
session_start();
// on vérifie si les champs sont vides
if (!empty($_POST['email'])&&!empty($_POST['password'])){
    $email=str_secur($_POST['email']);
    $password=str_secur($_POST['password']);
//on filtre si l'email est bien au bon format
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header('Location: connection.php?error=1&message=Erreur Adresse mail non valide');
        exit;
    }

    //recupération du mails dans la bdd
    $reqlogin=$db->prepare('SELECT * FROM utilisateur WHERE email=?');
    $reqlogin->execute([$email]);
    $logintab=$reqlogin->fetch();


    // rérification du mail et du password dans la bdd+ connection
    if ($email===$logintab['email']){
        if (password_verify($password, $logintab['password'])){
            $_SESSION['connect']=1;
            $_SESSION['email']=$logintab['email'];
            $_SESSION['userid']=$logintab['id'];
            header("Location: index.php");
            exit;

        }
        else{
            header('Location: connection.php?error=1&message=password introuvable');
            exit;
        }
    }
    else{
        header('Location: connection.php?error=1&message=email introuvable');
        exit;
    }
}
?>

<div class="tachecontainer">
    <form class="box" method="post" >
        <h1 class="box-title">Connexion</h1>
        <input type="email" class="box-input" name="email" placeholder="Adresse email">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
        <?php
        if (isset($_GET['succes'])){ ?>
            <div class="succes">
                <h2> <?= htmlspecialchars($_GET['message'])?></h2>
            </div>
        <?php }
        if (isset($_GET['error'])){ ?>
            <div class="error">
                <h2> <?= htmlspecialchars($_GET['message'])?></h2>
            </div>
        <?php } ?>
    </form>
</div>

</body>
</html>