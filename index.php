<?php
include 'dbb.php';
include 'function.php';

ifconnected();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" />

    </head>
    <body>
        <div>
            <navbar>
                <img src="download.png" alt="img_promeo" width="50px" height="50px">
                <h2>TODOLIST</h2>
                <a href="logout.php">Deconnexion</a>
            </navbar>
            <div class="tachecontainer">
                <img src="https://cdn.pixabay.com/photo/2016/09/24/20/11/dab-1692452_640.png" id="task" alt="img_tache" width="100px" height="100px">
                <div class="tacheinput">
                    <form action="">
                        <input id="input" type="text" placeholder="Ajouter une tache" >
                        <div class="divbouton">
                            <button class="box-button" id="bouton">valider</button>
                            <button class="box-button" id="supp" >supprimer</button>
                        </div>
                    </form>
                </div>

                <div id="container">
                    <div id="tachecontent">
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="js.js"></script>
</html>

