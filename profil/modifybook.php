<?php
include("../connexion/data_class.php");

$oldtitre=$_GET['oldtitle'];
$oldautor=$_GET['oldautor'];

$booktitre=$_POST['booktitle'];
$bookautor=$_POST['bookautor'];
$bookedition=$_POST['bookedition'];
$bookyear=$_POST['bookyear'];
$Categorie=$_POST['Categorie'];
$bookquantity=$_POST['bookquantity'];
$bookphoto=$_POST['bookphoto'];
$div="bookreport";

$obj=new data();
$obj->setconnection();

$obj->updatebook($oldtitre,$oldautor,$booktitre,$bookautor,$bookedition,$bookyear,$Categorie,$bookquantity,$bookphoto,$div);