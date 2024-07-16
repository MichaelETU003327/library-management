<?php

include("../connexion/data_class.php");

$email=$_POST['email'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$password=$_POST['password'];
$div =$_GET['div'];
echo "lll";
if($email == null || $nom == null ||$prenom == null ||$date == null ||$password== null ){
    $msg ="veillez remplir tout les champs !";
    header("Location:adminProfil.php?msg=$msg");
}else{
$obj = new data();
$obj->setconnection();
$obj->addNewUser($email,$nom,$prenom,$date,$password,$div);
}