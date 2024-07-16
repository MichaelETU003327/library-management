<?php
include("../connexion/data_class.php");

        $aTitre=$_POST['ajoutTitre'];
        $aAuteur=$_POST['ajoutAuteur'];
        $aPhoto=$_POST['ajoutPhoto'];
        $email =$_POST['email'];
        $obj=new data();
        $obj->setconnection();
       $obj->ajoutPanier($email,$aTitre,$aAuteur,$aPhoto);
        