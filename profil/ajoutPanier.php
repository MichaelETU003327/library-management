<?php
include("../connexion/data_class.php");
$titre=$_GET['titre'];
$auteur=$_GET['auteur'];
$email=$_GET['email'];
$div=$_GET['div'];

$obj=new data();
$obj->setconnection();
$obj->ajoutPanier();