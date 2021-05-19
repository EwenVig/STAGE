<?php

function connexion(){
    $host = '127.0.0.1';
    $db   = 'AP2DB';
    $port = "3307";
    $charset = 'utf8mb4';
    /* développement */
    $user = 'root';
    $pass = '';
    
    /* exploitation */
    /*
    $user = 'ap2';
    $pass = 'AP2SQL&Iroise29!!';
    */

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
    try {
        $pdo = new \PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    
    
    if (!$pdo) {
        echo "Echec Connexion<br />";
        ecritRequeteSQL("Echec Connexion");
    } else {
        
        echo "<pre>";
        //echo "Connexion reussie<br />";
        /*echo "Server addr : ".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'];
         echo " -- IPV4 : ".adresseIPV4($_SERVER['SERVER_ADDR'])."<br />";
         echo "Remote addr : ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'];
         echo " -- IPV4 : ".adresseIPV4($_SERVER['REMOTE_ADDR'])."<br />";
         echo "Host : $host:$port<br />";
         echo "Utilisateur : $user";
         */ echo "</pre>";
         $str = "Server addr : ".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'];
         ecritRequeteSQL($str);
         $str = "Remote addr : ".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT'];
         ecritRequeteSQL($str);
         $str = "Host : $host:$port<br />";
         ecritRequeteSQL($str);
         $str = "Utilisateur : $user";
         ecritRequeteSQL($str);
    }
    return $pdo;
}

function erreurSQL() {
    global $cnxBDD;
    
    $err = mysqli_errno($cnxBDD) . ": " . mysqli_error($cnxBDD). "\n";
    return $err;
}

function afficheErreur($sql, $erreur) {
    
    $uneChaine = "ERREUR SQL : ".date("j M Y - G:i:s.u --> ").$sql." : ($erreur[0] - $erreur[1] - $erreur[2]) \r\n";
    echo $uneChaine;
    ecritRequeteSQL($uneChaine);
    
    return "Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"].
    "</b>.<br />Dans le fichier : ".__FILE__.
    " a la ligne : ".__LINE__.
    "<br />".$erreur.
    "<br /><br /><b>REQUETE SQL : </b>$sql<br />";
    
}

function ecritRequeteSQL($uneChaine) {

    $handle=fopen("requete.log","a");
    $laDate = "--> ".date("j M Y - G:i --> ")." ".__FILE__." ".__LINE__." ";
    fwrite($handle, $laDate );
    fwrite($handle, $uneChaine);
    fclose($handle);
}

?>