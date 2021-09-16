<?php
require_once("./api.php");

try{
    if(!empty($_GET['demande'])){
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "auth" : 
                if( (!empty($url[1])) and (!empty($url[2])) ) {
                   //echo'authentification';
                    authentification($url[1],$url[2]);
                } else {
                    throw new Exception ("Impossible de joindre le serveur");
                }
            break;
            case "insererPointageEntre" : 
                if( (!empty($url[1])) and (!empty($url[2])) and (!empty($url[3])) ){
                   //echo ' ',$url[1],' ',$url[2],' ',$url[3];
                   insererPointageEntre($url[1],$url[2],$url[3]);
                } else {
                    throw new Exception ("Impossible de joindre le serveur");
                }
            break;
            case "historiqueByEmploye" : 
                if(!empty($url[1])){
                    echo'historiquePointageByEmploye';
                   // historiquePointageByEmploye($url[1]);
                } else {
                    throw new Exception ("Impossible de joindre le serveur");
                }
            break;

            default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
        }
    } else {
        throw new Exception ("Problème de récupération de données.");
    }
} catch(Exception $e){
    $erreur =[
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}
