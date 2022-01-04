<?php
include 'dbb.php';
include 'function.php';

if (!empty($_POST['email'])&& !empty($_POST['nom'])&& !empty($_POST['prenom'])&& !empty($_POST['pseudo'])&& !empty($_POST['password'])){


    $email=str_secur($_POST['email']);
    $nom=str_secur($_POST['nom']);
    $prenom=str_secur($_POST['prenom']);
    $pseudo=str_secur($_POST['pseudo']);
    $password=str_secur($_POST['password']);
    $regex = "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,13}$/";

    if(preg_match($regex,$_POST['password'])) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    else{
        header('Location: login.php?error=1&message=Le mot de passe doit contenir: -une majuscule, -une miniscule,-un chiffre, -un caractère spécial,-un nombre de lettre entre 6 et 13');
        exit;
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('Location: login.php?erreur=1&message= email invalide' );

    }

    ($reqemail=$db->prepare('SELECT COUNT(*) as countLogin FROM utilisateur WHERE email=?'));
    $reqemail->execute([$email]);

    while($emailfetch=$reqemail->fetch()){if($email['countLogin']!=0){
            header('Location: login.php?error=1&message=Adresse mail déjà utilisé');
            exit;
        }
        else{
            var_dump($db);
            $reqInsert=$db->prepare('INSERT INTO utilisateur(email,nom,prenom,pseudo,password) VALUE(?,?,?,?,?)');
            $reqInsert->execute([$email,$nom,$prenom,$pseudo,$password]);

            header('Location: login.php?succes=1&message=Inscription Effectué');
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="" />
</head>
<body>

<form class="box" method="post">
    <h1 class="box-title">S'inscrire</h1>
    <input type="email" class="box-input" name="email" placeholder="Adresse email" required />
    <input type="text" class="box-input" name="nom" placeholder="nom" required />
    <input type="text" class="box-input" name="prenom" placeholder="prenom" required />
    <input type="text" class="box-input" name="pseudo" placeholder="pseudo" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="connection.php">Connectez-vous ici</a></p>

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
</body>
</html>