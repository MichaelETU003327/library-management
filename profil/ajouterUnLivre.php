<?php
include("../connexion/data_class.php");



$booktitre=$_POST['booktitle'];
$bookautor=$_POST['bookautor'];
$bookedition=$_POST['bookedition'];
$bookyear=$_POST['bookyear'];
$Categorie=$_POST['Categorie'];
$bookquantity=$_POST['bookquantity'];
$bookphoto=$_FILES['bookphoto'];

$photo_path = "";
if ($bookphoto['error'] == UPLOAD_ERR_OK) {
    $photo_tmp_name = $bookphoto['tmp_name'];
    $photo_name = basename($bookphoto['name']);
    $photo_path = "livres/" . $photo_name;
    move_uploaded_file($photo_tmp_name, $photo_path);
}


$obj=new data();
$obj->setconnection();
$obj->addbook($booktitre,$bookautor,$bookedition,$bookyear,$Categorie,$bookquantity,$photo_path);
 