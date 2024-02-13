<?php
function openDB()
//connecte à la base de donnée
{
    try {
        $BDD = new PDO("mysql:host=localhost; dbname=RescueRH;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $BDD;
    } catch (Exception $e) {
        die('Erreur fatale : ' . $e->getMessage());
    }
}

function escape($value)
//evite les saisies dangereuses 
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

function redirect($url)
//redirige vers une autre page
{
    header("Location: $url");
}

?>