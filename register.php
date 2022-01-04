<?php
include 'dbb.php';
include 'function.php';

// verifiaction si les champs sont vide
if (!empty($_POST['email'])&& !empty($_POST['nom'])&& !empty($_POST['prenom'])&& !empty($_POST['password'])){

//variables
    $email=str_secur($_POST['email']);
    $nom=str_secur($_POST['nom']);
    $prenom=str_secur($_POST['prenom']);
    $password=str_secur($_POST['password']);


    //regex minuscule / majuscule / 6-13 caractères /caractère spéciaux
    $regex = "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,13}$/";
    if(preg_match($regex,$_POST['password'])) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    else{
        header('Location: register.php?error=1&message=Le mot de passe doit contenir: -une majuscule, -une miniscule,-un chiffre, -un caractère spécial,-un nombre de lettre entre 6 et 13');
        exit;
    }

    //vérification si l'email est au bon format
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('Location: register.php?erreur=1&message= email invalide' );

    }

    // vérification si l'email est déja utilisé dans la bdd
    ($reqemail=$db->prepare('SELECT COUNT(*) as countLogin FROM utilisateur WHERE email=?'));
    $reqemail->execute([$email]);

    while($emailfetch=$reqemail->fetch()){if($email['countLogin']!=0){
            header('Location: register.php?error=1&message=Adresse mail déjà utilisé');
            exit;
        }
        else{
            var_dump($db);
            $reqInsert=$db->prepare('INSERT INTO utilisateur(email,nom,prenom,password) VALUE(?,?,?,?)');
            $reqInsert->execute([$email,$nom,$prenom,$password]);

            header('Location: register.php?succes=1&message=Inscription Effectué');
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="tachecontainer">
    <h1 class="box-title">S'inscrire</h1>
    <input type="email" class="box-input" name="email" placeholder="Adresse email" required />
    <input type="text" class="box-input" name="nom" placeholder="nom" required />
    <input type="text" class="box-input" name="prenom" placeholder="prenom" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="connection.php">Connectez-vous ici</a></p>
</div>
<form class="box" method="post">


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