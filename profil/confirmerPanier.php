<?php
include("../connexion/data_class.php");

$email = $_GET['email'];
$obj=new data();
$obj->setconnection();
$obj->confirmerPanier($email);