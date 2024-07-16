<?php
include("../connexion/data_class.php");

$titre=$_GET['titre'];
$auteur=$_GET['auteur'];
$email=$_GET['email'];
$div=$_GET['div'];
$date=$_POST['dateprolog'];

echo"$div";

$obj=new data();
$obj->setconnection();
$obj->dateBookProlog($email,$titre,$auteur,$date,$div);