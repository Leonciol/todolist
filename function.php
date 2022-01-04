<?php
function str_secur($string){
    return trim(htmlspecialchars($string));
}
function debug($var){
    echo '<pre>';
    var_dump($var);
    echo '<pre>';

}
function ifconnected(){
session_start();

    if (!isset($_SESSION["connect"])) {
        header("Location: connection.php");
        exit();
    }
}