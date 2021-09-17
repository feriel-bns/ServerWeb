<?php 
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS'])? "https" : "http").
"://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));



function authentification($user_name,$user_pass){
 $pdo = getConnexion();
$req = "select username,password from heroku_abde6316f609ed5.compte  where login like '$user_name' and  motdepasse like '$user_pass';";
//$stmt = $pdo->prepare($req);
//$stmt->execute();
if ($stmt = mysqli_prepare($pdo, $req)) {

    /* Exécution de la requête */
    mysqli_stmt_execute($stmt);

    /* Association des variables de résultat */
    mysqli_stmt_bind_result($stmt, $name, $code);
mysqli_stmt_fetch($stmt);
    
    if( !empty($name) and !empty($code) ){
       $result="login success";
      sendJSON( $result);
    } else {
        $result="login failed";
         sendJSON( $result);
    }
    /* Fermeture de la commande */
   mysqli_stmt_close($stmt);
}

}

function insererPointageEntre($idUser,$datePointage,$heure){
    $pdo = getConnexion();
    $reponse = array();
    
   
    if (isset($idUser) &&  isset( $datePointage) && isset($heure) ) {
        
        $mysql_query="INSERT INTO pointage(idemploye,datepointage,entre) "
    . "VALUES('$idUser','$datePointage','$heure')";
    $resultat = mysqli_query($pdo, $mysql_query);
echo $resultat;
    // tester si les données sont bien insérées
    if ($resultat) {
        // Données bien insérées
        $reponse["success"] = 1;
        $reponse["message"] = "Données bien insérées";
       // afficher  la reponse JSON
        sendJSON($reponse);
    } else {
        // errur d'insertion
        $reponse["success"] = 0;
        $reponse["message"] = "Oops! Erreur d'insertion.";
      // afficher  la réponse JSON
       sendJSON($reponse);
    }
} else {
    // Champ(s) manquant(s)
    $reponse["success"] = 0;
    $reponse["message"] = "Champ(s) manquant(s)";
    // afficher  la réponse JSON
    sendJSON($reponse);
}
}




function historiquePointageByEmploye($idUser){
    
}

function getConnexion(){
    
   // DB Params
   $host = 'us-cdbr-east-04.cleardb.com';
   $db_name = 'heroku_abde6316f609ed5';
   $username = 'b4a84a4b9166f9';
   $password = '8e08be0f';
   $conn;

  // DB Connect

  $this->conn = null;

  try { 
    $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo 'Connection Error: ' . $e->getMessage();
  }

  return $this->conn;
}



function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}
