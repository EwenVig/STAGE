<html> 
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="../../styles/defaultAP.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->

            <form class='formConnexion' action="updateMdp.php" method="GET">
            
                <h1>MDP OUBLIE</h1>
                
                <label><b>Nouveau mot de passe</b></label>
                <input type="password" placeholder="Entrer le nouveau mdp" name="pwd1" required>

                <label><b>Confirmer le nouveau mot de passe</b></label>
                <input type="password" placeholder="Entrer le nouveau mdp" name="pwd2" required>

                <input type="submit" id='submit' value='Mettre à jour le mdp' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Les 2 mots de passes ne sont pas identiques</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>