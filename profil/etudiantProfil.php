<?php

session_start();



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Etudiant Profil</title>
</head>
<style>
/* Importer la police Roboto de Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
    color: #333333;
    font-size: 16px;
    line-height: 1.6;
}

.container,
.row,
.imglogo {
    margin: auto;
    padding: 20px;
}

.innerdiv {
    text-align: center;
    margin: 50px auto;
}

.greenbtn {

    background-color: #4CAF50;
    color: white;
    width: 95%;
    height: 40px;
    margin-top: 8px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.greenbtn:hover {
    background-color: #45a049;
    /* Légère variation pour l'effet de survol */
}

a {
    text-decoration: none;
    color: #4CAF50;
    font-size: 18px;
}

a:hover {
    color: #388E3C;
}

th {
    background-color: #607D8B;
    color: white;
    padding: 10px;
    text-align: left;
    font-size: 18px;
}

td {
    background-color: #CFD8DC;
    color: #333333;
    padding: 10px;
    border: 1px solid #B0BEC5;
    font-size: 16px;
}

tr:last-child td {
    border: none;
}

label {
    color: #333333;
    font-weight: bold;
    font-size: 18px;
}

input {
    margin-left: 20px;
    padding: 5px;
    border: 1px solid #B0BEC5;
    border-radius: 3px;
    font-size: 16px;
}

.leftinnerdiv {
    float: left;
    width: 25%;
    padding: 10px;
    box-sizing: border-box;
}

.rightinnerdiv {
    float: right;
    width: 75%;
    padding: 10px;
    box-sizing: border-box;
}

.innerright {
    background-color: #FAFAFA;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-size: 16px;
}

.imglogo {
    max-width: 100%;
    height: auto;
}
</style>

<body>

    <?php
   include("../connexion/data_class.php");
   $email=$_GET['userlogid'];
    ?>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><a href=" etudiantProfil.php?userlogid=<?php echo"$email";?>"><img class="imglogo"
                        src="../logo.png" /></a>
            </div>
            <div class="leftinnerdiv">
                <br>
                <Button class="greenbtn" onclick="openpart('myaccount')"> <img class="icons"
                        src="../images/icon/profile.png" width="30px" height="30px" /> Mon Compte</Button>
                <Button class="greenbtn" onclick="openpart('requestbook')"><img class="icons"
                        src="../images/icon/book.png" width="30px" height="30px" /> Emprunter un livre</Button>
                <Button class="greenbtn" onclick="openpart('panier')"><img class="icons"
                        src="../images/icon/monpanier.png" width="30px" height="30px" /> Mon panier</Button>
                <Button class="greenbtn" onclick="openpart('issuereport')"> <img class="icons"
                        src="../images/icon/meslivres.png" width="30px" height="30px" /> Mes livres</Button>
                <a href="../index.php"><Button class="greenbtn"><img class="icons" src="../images/icon/logout.png"
                            width="30px" height="30px" /> Se déconnecter</Button></a>
            </div>


            <!-- Mon Compte -->
            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion">
                    <h1 class="titre">Mes information</h1>

                    <?php
                    $userloginid=$email;
                    $u=new data;
                    $u->setconnection();
                    $u->userdetail($userloginid);
                    $recordset=$u->userdetail($userloginid);
                    foreach($recordset as $row){

                    $email= $row[0];
                    $name= $row[1];
                    $prenom= $row[2];
                    $date= $row[3];
                   }               
                    ?>
                    <label>Nom: </label>
                    <label> <?php echo $name;?> </label>
                    </br>
                    <label>Prenom: </label>
                    <label> <?php echo $prenom;?> </label>
                    </br>
                    <label>email: </label>
                    <label> <?php echo $email;?> </label>
                    </br>
                    <label>Date de naissance: </label>
                    <label> <?php echo $date;?> </label>
                    </br>
                </div>
            </div>

            <!-- Livres Disponibles -->
            <style>
            /* CSS pour supprimer la couleur de fond du bouton */
            button[type="submit"] {
                background-color: transparent;
                border: none;
                padding: 0;
                margin: 0;
                transition: background-color 0.1s;
                /* Ajout d'une transition pour une animation fluide */
            }

            /* CSS pour le bouton au survol */
            button[type="submit"]:hover {
                background-color: lightgreen;
            }

            .titre {
                color: #DAAB3A;
            }
            </style>
            <div class="rightinnerdiv">
                <div id="requestbook" class="innerright portion">
                    <h1 class="titre">Rechercher un livres</h1>
                    <form action="etudiantProfil.php" method="GET">
                        <input type="hidden" name="div" value="requestbook">
                        <input type="hidden" name="userlogid" value="<?php echo "$email"; ?>">
                        <label for="search">Recherche :</label>
                        <input type="text" id="search" name="search" required>

                        <label for="criteria">Critère :</label>
                        <select id="criteria" name="criteria">
                            <option value="titre">Titre</option>
                            <option value="auteur">Auteur</option>
                            <option value="categorie">Catégorie</option>
                        </select>

                        <button type="submit" value="Rechercher">
                            <img class="icons" src="../images/icon/recherche.png" alt="Delete" width="25px"
                                height="25px">
                        </button>
                    </form>

                    </br>
                    <label class="greenbtn">Livres Disponibles</label>
                    </br>
                    <?php
                   $search = $_GET['search'];
                    $criteria = $_GET['criteria'];
                    $email =$_GET['userlogid'];
                    $div =$_GET['div'];
                     if ($search != null && $criteria !=null){
                        echo '<a href="etudiantProfil.php?userlogid=' . $email . '&div=requestbook" style="color: blue">Effacer les filtres</a>';
                    }
                    $recordset=$u->getbookissue($search,$criteria);
                    $s = $recordset;
                    $div="issuereport";
                    $table="<table style='font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;'>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Editeur</th>
                        <th>Categorie</th>
                        <th>Année</th>
                        <th>Ajouter a mon panier</th>
                    </tr>";
            foreach($recordset as $row) {
                $table .= "<tr>";
                $table .= "<td><img src='$row[8]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
                $table .= "<td>$row[0]</td>";
                $table .= "<td>$row[1]</td>";
                $table .= "<td>$row[2]</td>";
                $table .= "<td>$row[4]</td>";
                $table .= "<td>$row[3]</td>";
                $table .= "<td>
                                <form action='ajouterPanier.php?' method='post'>
                                    <input type='hidden' id='ajoutPhoto' name='ajoutPhoto' value='$row[8]'>
                                    <input type='hidden' id='ajoutTitre' name='ajoutTitre' value='$row[0]'>
                                    <input type='hidden' id='ajoutAuteur' name='ajoutAuteur' value='$row[1]'>
                                    <input type='hidden' id='email' name='email' value='$email'>
                                    <button type='submit' name='submit'>   
                                        <img class='icons' src='../images/icon/addPanier.png' alt='Delete' width='30px' height='30px'>
                                    </button>
                                </form>
                           </td>";
                $table .= "</tr>";
            }
            $table .= "</table>";
            echo $table;
            if ($s->rowCount()==0 ) {
                echo '<label class="message-bas-gauche">';
                echo 'Rien trouvé';
                echo '</label>';
            }
            
                ?>

                </div>
            </div>
            <style>
            .message-bas-gauche {
                position: fixed;
                bottom: 0;
                left: 0;
                background-color: #607D8B;
                padding: 30px;
                color: white;
            }
            </style>
            <!-- Mon panier -->
            <div class="rightinnerdiv">
                <div id="panier" class="innerright portion">
                    <h1 class="titre">Mon panier</h1>
                    <table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                        <tr>
                            <th style='padding: 8px;'>Photo </th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Retirer</th>
                        </tr>
                        <?php
                            $panier=new data();
                            $panier->setconnection();
                            $pan=$panier->panier($email);
                            $ss=$pan;           
                            foreach($pan as $element){
                            $t.="<tr>";
                            $t.="<td><img src='$element[3]' width='100px' height='100px'
                                    style='border:1px solid #333333;'></td>";
                            $t.="<td>$element[1]</td>";
                            $t.="<td>$element[2]</td>";
                            $t .= '<td>
                            <form action="retirerpanier.php?userlogid="$email"&div=panier"   method="post">
                                <input type="hidden" id="retirerTitre" name="retirerTitre" value="' . $element[1] . '">
                                <input type="hidden" id="retirerAuteur" name="retirerAuteur" value="' . $element[2] . '">
                                <input type="hidden" id="email" name="email" value="' . $email . '">
                                <button type="submit" name="retirer">
                                <img class="icons" src="../images/icon/croix.png" alt="Delete" width="25px" height="25px">
                            </button>                            
                            </form>
                        </td>';
                            $t.="</tr>";
                            }
                            if ($t!= null){
                                    $t.="<tr>";
                                    $t.= "<td></td>";
                                    $t .= '<td>
                                    <a href="annulerPanier.php?email=' . $email . '">
                                        <button>
                                        <img class="icons" src="../images/icon/croix.png" alt="Delete" width="25px" height="25px">
                                        Annuler</button>
                                    </a>
                                    <a href="confirmerPanier.php?email=' . $email . '">
                                        <button>
                                        <img class="icons" src="../images/icon/confirmer.png" alt="Delete" width="25px" height="25px">
                                        Confirmer</button>
                                    </a>
                                  </td>';
                            
                                    $t.="<td></td>";
                                    $t.= "<td></td>";
                                    $t.="</tr>";
                                }
                            echo $t;
                            echo "</table>";
                            if ($ss->rowCount()==0 ) {
                                echo '<label class="message-bas-gauche">';
                                echo 'Panier vide';
                                echo '</label>';
                            }
                            
                        ?>

                </div>
            </div>
            <!-- Livres emprenté -->

            <div class="rightinnerdiv">
                <div id="issuereport" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo "display:none"; }?>">
                    <h1 class="titre">Livres empruntés</h1>

                    <?php
          
            $u=new data;
            $u->setconnection();
         $recordset=$u->getissuebook($email);

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
            padding: 8px;'>Photo </th><th>Titre</th><th>Date d'emprunt</th><th>Date de retour</th><th>Statut</th><th>Prolonger</th><th>Rendre</th></tr>";
            $div="issuereport";
            foreach($recordset as $row){
                $email=$row[0];
                $titre=$row[1];
                $auteur=$row[2];
                $dateE=$row[3];
                $dateR=$row[4];
                $statut = $u->getStatut($dateR);
                $photo =$u->getbook($titre,$auteur);
                $table.="<tr>";
                foreach($photo  as $row) {
                $table.="<td><img src='$row[8]' width='100px' height='100px'
                style='border:1px solid #333333;'></td>";
                }
                $table.="<td>$titre</td>";
                $table.="<td>$dateE</td>";
                $table.="<td>$dateR</td>";
                $table.="<td>$statut</td>";
                $table .= "<td> 
                <form action='livreProloge.php?email=$email&titre=$titre&auteur=$auteur&div=$div' method='POST'> 
                    <input type='date' min='" . date('Y-m-d', strtotime($dateR . ' +1 days')) . "' id='dateprolog' name='dateprolog' required>
                    <input type='submit' value='prolonger'>           
                </form>
            </td>";
            
                $table.="<td><a href='rendreLivre.php?email=$email&titre=$titre&auteur=$auteur&div=$div'><button type='button' class='btn btn-primary'>Rendre</button></a></td>";
                    $table.="</tr>";
                    // $table.=$row[0];
                    }
                    $table.="</table>";

                    echo $table;

                    ?>

                </div>
            </div>





            <script>
            function openpart(portion) {
                var i;
                var x = document.getElementsByClassName("portion");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                var element = document.getElementById(portion);
                if (element) {
                    element.style.display = "block";
                } else {
                    console.error("Element with id " + portion + " not found.");
                }
                remouveMsg();
                //  var url = window.location.href.split('?')[0];
                //history.replaceState(null, null, url);
            }

            function remouveMsg() {
                var label = document.getElementById('msg');
                if (label != null) {
                    label.style.display = 'inline';
                    label.parentNode.removeChild(label);
                }
            }
            </script>
            <?php
$div=$_GET['div'];
if($div== null){
$div="myaccount";
}            

echo "<script>";
echo "div = '" . $div . "';";
echo "openpart(div);";
echo "</script>"; 

$msg=$_GET['msg'];
if($msg!= null){
echo "<div id='msg'  >";
echo "<label class='message-bas-gauche' id='monLabel'>";
echo "$msg";
echo "</label>";
echo "</div>";
}
?>
</body>

</html>