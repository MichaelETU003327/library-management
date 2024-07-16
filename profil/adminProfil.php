<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Profil</title>

</head>
<style>
.innerright,
label {
    color: rgb(16, 170, 16);
    font-weight: bold;
}

.container,
.row,
.imglogo {
    margin: auto;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}

input {
    margin-left: 20px;
}

.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: #f3bd7e;
}

.greenbtn {
    background-color: #ffe3e3;
    color: black;
    width: 95%;
    height: 40px;
    margin-top: 8px;
}

.greenbtn,
a {
    text-decoration: none;
    color: black;
    font-size: large;
}

th {
    background-color: #16DE52;
    color: black;
}

td {
    background-color: #b1fec7;
    color: black;
}

td,
a {
    color: black;
}



label {
    margin-left: 50px;
    padding-Top: 10px;
    font-size: 18px;
    color: rgb(51, 51, 51);
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=text]:focus,
input[type=email]:focus,
input[type=number]:focus,
input[type=pasword]:focus,

select:focus,
textarea:focus {
    outline: none;
}

input[type=text],
input[type=email],
input[type=number],
input[type=pasword],
select,
textarea {

    width: 40%;
    padding: 2px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    margin-top: 2px;
    margin-bottom: 2px;
    resize: vertical;
}

body {
    font-family: 'Roboto';

}

::placeholder {
    color: rgb(189, 184, 184);
    font-style: italic;
    font-size: 14px;
}

.book-info {
    margin-top: 20px;
}

.book-info p {
    margin: 5px 0;
}

.book-info img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 10px auto;
}
</style>


<body>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><a href=" adminProfil.php"><img class="imglogo" src="../logo.png" /></a></div>
            <div id="main" class="leftinnerdiv">
                <!-- <Button class="greenbtn"> ADMIN</Button> -->
                <br>
                <Button class="greenbtn" onclick="openpart('addbook')"><img class="icons" src="../images/icon/book.png"
                        width="30px" height="30px" /> Ajouter un livre</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')"> <img class="icons"
                        src="../images/icon/meslivres.png" width="30px" height="30px" /> Liste des livres</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> <img class="icons"
                        src="../images/icon/add-user.png" width="30px" height="30px" /> Ajouter un étudiant</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> <img class="icons"
                        src="../images/icon/liste.png" width="30px" height="30px" /> Liste étudiants</Button>
                <a href="../index.php"><Button class="greenbtn"><img class="icons" src="../images/icon/logout.png"
                            width="30px" height="30px" /> Se déconnecter</Button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <label class="greenbtn">Ajouter un étudiant</label>
                    <form action="ajoutEtudiant.php?div=addperson" method="post" enctype="multipart/form-data">
                        <label>Nom:</label><input type="text" name="nom" required />
                        </br>
                        <label>Prenom:</label><input type="text" name="prenom" required />
                        </br>
                        <label>Email:</label><input type="email" name="email" required />
                        </br>
                        <label>Date de naissance</label><input type="Date" name="date" required />
                        </br>
                        <label>Mot de passe :</label><input type="password" name="password" required />
                        </br>
                        </br>
                        <input type="submit" value="Ajouter" />
                        </br>
                        </br>
                    </form>
                </div>
            </div>
            <!--   Liste étudiant déja enregisté -->

            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
                    <label class="greenbtn style=" display:none">Liste etudiant</label>

                    <?php
              
              include('../connexion/data_class.php');
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();
            $div= "studentrecord";

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style=' 
            padding: 8px;'> Email</th><th>nom</th><th>prenom</th><th>Date de naissance</th><th>supprimer</th></tr>";
            foreach($recordset as $row){
                $table.="<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                // $table.=$row[0];
                $table .= '<td><a href="deleteuser.php?email=' . $row[0] . '&div=' . $div . '">
                <button><img class="icons"
                src="../images/icon/delete.png" width="30px" height="30px"></button></a></td>';
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>
                </div>
            </div>
            <!--   Ajouter un nouveau livre -->
            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion">
                    <label class="greenbtn">Ajouter un livre</label>
                    <br>
                    <form action="ajouterUnLivre.php" method="post" enctype="multipart/form-data">
                        <label>Titre:</label>
                        <input type="text" name="booktitle" required />
                        </br>
                        <label>Auteur:</label>
                        <input type="text" name="bookautor" required />
                        </br>
                        <label>Edition:</label>
                        <input type="text" name="bookedition" required />
                        </br>
                        <label>Année de publication</label>
                        <input type="number" name="bookyear" required />
                        </br>
                        <div id="choix">
                            <label>Catégorie:</label>
                            <select name="Categorie" required>
                                <option value="">-- Sélectionnez une catégorie --</option>
                                <option value="roman">roman</option>
                                <option value="essai">essai</option>
                                <option value="théâtre">théâtre</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <label>Quantité:</label>
                        <input type="number" min=1 name="bookquantity" value=1 required />
                        </br>
                        <label>Photo</label>
                        <input type="file" name="bookphoto" />
                        </br>
                        </br>
                        <input type="submit" value="Ajouter" />
                        </br>
                        </br>

                    </form>
                </div>
            </div>

            <!--   Liste des livres déja enregisté -->
            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display:none">
                    <label class="greenbtn">Liste des livres</label>
                    <?php
            $u=new data;
            $u->setconnection();
            $u->getbooks();
            $recordset=$u->getbooks();
            $div="bookreport";
            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style=' 
            padding: 8px;'>Titre</th><th>Auteur</th><th>Catégorie</th><th>Quantité</th><th>Stock</th></th><th>Détails</th><th>Modifier</th><th>Supprimer</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
                $table.="<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";

                $table .= '<td><a href="adminProfil.php?titre=' . $row[0] .'&auteur='.$row[1] .'&div=detailsbook">
                <button>Détails</button></a></td>';
                
                $table .= '<td><a href="adminProfil.php?titre=' . $row[0] .'&auteur='.$row[1] .'&div=modifybook">
                <button><img class="icons"
                src="../images/icon/modifier.png" width="25px" height="25px"></button></a></td>';

                $table .= '<td><a href="deletebook.php?titre=' . $row[0] .'&auteur='.$row[1] .'&div=' . $div . '">
                <button><img class="icons"
                src="../images/icon/delete.png" width="25px" height="25px"></button></a></td>';  
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

                </div>
            </div>

            <!--   Modifer un livre -->

            <div class="rightinnerdiv">
                <div id="modifybook" class="innerright portion" style="display:none">
                    <?php
                    $titre=$_GET['titre'];
                    $auteur=$_GET['auteur'];
                    $u=new data;
                    $u->setconnection();                    
                    $r=$u->getbook($titre,$auteur);
                    $res=$r->rowCount();
                    foreach($r as $row){
                        $editeur =$row[2];
                        $année=$row[3];
                        $categorie=$row[4];
                        $quantité=$row[5];
                        $photo=$row[8];
                    }
                    ?>
                    <label class="greenbtn">Modifier un livre</label>
                    <br>
                    <form action="modifybook.php?oldtitle=<?php echo $titre;?>&oldautor=<?php echo $auteur;?>"
                        method="post" enctype="multipart/form-data">
                        <label>Titre:</label>
                        <input type="text" name="booktitle" value=<?php echo $titre;?> required />
                        </br>
                        <label>Auteur:</label>
                        <input type="text" name="bookautor" value=<?php echo $auteur;?> required />
                        </br>
                        <label>Edition:</label>
                        <input type="text" name="bookedition" value=<?php echo $editeur;?> required />
                        </br>
                        <label>Année de publication</label>
                        <input type="number" name="bookyear" value=<?php echo $année;?> required />
                        </br>
                        <div id="choix">
                            <label>Catégorie:</label>
                            <select name="Categorie" required>
                                <option value="">-- Sélectionnez une catégorie --</option>
                                <option value="roman" <?php if ($categorie == "roman") echo "selected"; ?>>roman
                                </option>
                                <option value="essai" <?php if ($categorie == "essai") echo "selected"; ?>>essai
                                </option>
                                <option value="théâtre" <?php if ($categorie == "théâtre") echo "selected"; ?>>théâtre
                                </option>
                                <option value="Autres" <?php if ($categorie == "Autres") echo "selected"; ?>>Autres
                                </option>
                            </select>

                        </div>
                        <label>Quantité:</label>
                        <input type="number" min=1 name="bookquantity" value=<?php echo $quantité;?> required />
                        </br>
                        <label>Photo</label>
                        <input type="file" name="bookphoto" value=<?php echo $photo;?> />
                        </br>
                        </br>
                        <input type="submit" value="modifier" />
                        <button type="button" class="btn btn-secondary"
                            onclick="openpart('bookreport')">Annuler</button>
                        </br>
                        </br>

                    </form>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="detailsbook" class="innerright portion" style="display:none">
                    <?php
                    $titre=$_GET['titre'];
                    $auteur=$_GET['auteur'];
                    $u=new data;
                    $u->setconnection();                    
                    $r=$u->getbook($titre,$auteur);
                    $res=$r->rowCount();
                    foreach($r as $row){
                        $editeur =$row[2];
                        $année=$row[3];
                        $categorie=$row[4];
                        $quantité=$row[5];
                        $stock =$row[6];
                        $nbemp=$row[7];
                        $photo=$row[8];
                    }
                    ?>
                    <label class="greenbtn">Détails du Livre</label>
                    </br>
                    </br>
                    <img id="photobook" src="<?php echo htmlspecialchars($photo); ?>" width="100px" height="100px"
                        style="border:1px solid #333333;">

                    </br>
                    <label>Titre: </label>
                    <label> <?php echo $titre;?> </label>
                    </br>
                    <label>Auteur: </label>
                    <label> <?php echo $auteur;?> </label>
                    </br>
                    <label>editeur: </label>
                    <label> <?php echo $editeur;?> </label>
                    </br>
                    <label>Année: </label>
                    <label> <?php echo $année;?> </label>
                    </br>
                    <label>categorie: </label>
                    <label> <?php echo $categorie;?> </label>
                    </br>
                    <label>quantité: </label>
                    <label> <?php echo $quantité;?> </label>
                    </br>
                    <label>stock: </label>
                    <label> <?php echo $stock;?> </label>
                    </br>
                    <label>Exemplaire emprunté: </label>
                    <label> <?php echo $nbemp;?> </label>
                    </br>
                    </br>
                    <button type="button" class="btn btn-secondary" onclick="openpart('bookreport')">Fermer</button>
                    <a href="adminProfil.php?titre=<?php echo $titre; ?>&auteur=<?php echo $auteur; ?>&div=modifybook">
                        <button type="button" class="btn btn-secondary">Modifier</button>
                    </a>
                    </br>
                    </br>
                </div>
            </div>
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
        var url = window.location.href.split('?')[0];
        history.replaceState(null, null, url);
    }
    // supprime message
    function remouveMsg() {
        var label = document.getElementById('monLabel');
        if (label != null) {
            label.style.display = 'inline';
            label.parentNode.removeChild(label);
        }
    }
    </script>
    <?php
$div=$_GET['div'];
if($div== null){
$div="addbook";
}            

echo "<script>";
echo "div = '" . $div . "';";
echo "openpart(div);";
echo "</script>"; 

$msg=$_GET['msg'];
if($msg!= null){
echo "<div id='msg' class='leftinnerdiv' >";
echo '<label id="monLabel">';
echo "$msg";
echo "</label>";
echo "</div>";
}
?>
</body>

</html>