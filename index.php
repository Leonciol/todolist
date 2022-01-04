<?php
include 'dbb.php';
include 'function.php';

ifconnected();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="" />

</head>
<body>

<div id="container">
    <div id="tachecontent">
    </div>

    <form action="">
        <input id="input" type="text" placeholder="ajouter une tache" >
        <button class="bouton" id="bouton">valider</button>
        <button class="bouton" id="supp" >supprimer</button>
    </form>


</div>
<a href="logout.php">Deconnexion</a>

</body>
<script src="js.js"></script>
</html>

