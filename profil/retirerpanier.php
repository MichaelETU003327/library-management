<?php
include("../connexion/data_class.php");


if (isset($_POST['retirer'])) {
    $email =$_POST['email'];
    $rTitre=$_POST['retirerTitre'];
    $rAuteur=$_POST['retirerAuteur'];
    $obj=new data();
    $obj->setconnection();
    $obj->retirerPanier($email,$rTitre,$rAuteur,"");
}