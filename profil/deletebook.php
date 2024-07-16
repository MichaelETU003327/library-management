<?php
include("../connexion/data_class.php");

$titre=$_GET['titre'];
$auteur=$_GET['auteur'];
$div=$_GET['div'];

$obj=new data();
$obj->setconnection();
$obj->deletebook($titre,$auteur,$div);