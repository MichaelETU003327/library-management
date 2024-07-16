<?php
include("../connexion/data_class.php");

$email=$_GET['email'];
$div=$_GET['div'];

$obj=new data();
$obj->setconnection();
$obj->deleteUser($email,$div);