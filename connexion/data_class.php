<?php include("db.php");

class data extends db {

    function adminLogin($email, $password) {
        $q = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            header("location: ../profil/adminProfil.php");
            exit; 
        } else {
            header("location: ../authentification/authentificationAdmin.php?msg=Email ou mot de passe incorrect !");
            exit; 
        }
    }
    
// user -------------------------------------------------------------------------------------------

    function addNewUser($email, $nom, $prenom, $date, $password,$div) {
        $check_query = "SELECT COUNT(*) as count FROM etudiant WHERE email = :email";
        $stmt = $this->connection->prepare($check_query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result['count'] > 0) {
            header("Location:../profil/adminProfil.php?msg=Email déjà utilisé !&div=$div");
            exit;
        } else {
            $q = "INSERT INTO etudiant (email, nom, prenom, date, password) VALUES (:email, :nom, :prenom, :date, :password)";
            $stmt = $this->connection->prepare($q);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':password', $password);
    
            if ($stmt->execute()) {
                header("Location:../profil/adminProfil.php?msg=succes &div=$div");
                exit;
            } else {
                header("Location:../profil/adminProfil.php?msg=Erreur lors de l'insertion &div=$div");
                exit;
            }
        }
    }

    function deleteUser($email,$divId){
        $q="DELETE from etudiant where email='$email'";
        if($this->connection->exec($q)){
            $msg="$email supprimé avec succes";          
        }
        else{
            $msg="échec";
        }
        header("Location:adminProfil.php?div=$divId&msg=$msg");
    }

    function userLogin($email, $password) {
        $q = "SELECT * FROM etudiant WHERE email = :email AND password = :password";
        $stmt = $this->connection->prepare($q);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $logid = $user['email'];
            header("location: ../profil/etudiantProfil.php?userlogid=$logid");
            exit;
        } else {
            header("location:../authentification/authentificationEtudiant.php?msg=Email ou mot de passe incorrect !");
            exit; 
        }
    }
    function userdata() {
        $q="SELECT * FROM etudiant ";
        $data=$this->connection->query($q);
        return $data;
    }
    function userdetail($email){
        $q="SELECT * FROM etudiant where email ='$email'";
        $data=$this->connection->query($q);
        return $data;
    }

// book--------------------------------------------------------------------------------------------


    function addbook($booktitre,$bookautor,$bookedition,$bookyear,$Categorie,$bookquantity,$bookphoto){     
        $q = "SELECT * FROM livres WHERE titre = '$booktitre' AND auteur = '$bookautor'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {
            header("Location:../profil/adminProfil.php?msg=livre deja ajouté &div=addbook");
        }else{
        
        $q="INSERT INTO livres (titre,auteur,editeur, année, categorie, quantité,stock,nbemprunte, photo)
       VALUES('$booktitre','$bookautor', '$bookedition', '$bookyear', '$Categorie', '$bookquantity', '$bookquantity',0, '$bookphoto')";
    
       if($this->connection->exec($q)) {
            header("Location:../profil/adminProfil.php?msg=ajouté avec succes &div=addbook");
        }
        else {
            header("Location:../profil/adminProfil.php?msg=erreur lors de l'ajout");
        }
      }
    }

    function deletebook($titre,$auteur,$div){
        $q = "DELETE FROM livres WHERE titre = '$titre' AND auteur = '$auteur'";
        if($this->connection->exec($q)){
            $msg="($titre,$auteur) supprimé avec succes";          
        }
        else{
            $msg='échec';
        }
        header("Location:adminProfil.php?div=$div&msg=$msg");
    }
    function getbooks() {
        $q="SELECT * FROM livres ";
        $data=$this->connection->query($q);
        return $data;
    }
    function getbook($titre,$auteur){
        $q = "SELECT * FROM livres WHERE auteur = '$auteur' AND titre = '$titre'";
        $data=$this->connection->query($q);
     return $data;
    }
   
    function updatebook($oldbooktitre,$oldbookautor,$booktitre, $bookautor, $bookedition, $bookyear, $Categorie, $bookquantity, $bookphoto, $div) {
        $q = "UPDATE livres 
              SET 
                titre = '$booktitre',
                auteur = '$bookautor',
                editeur = '$bookedition',
                année = '$bookyear',
                categorie = '$Categorie',
                stock= stock +'$bookquantity'- quantité ,
                quantité = '$bookquantity',
                photo = '$bookphoto'
              WHERE 
                titre = '$oldbooktitre' 
                AND auteur = '$oldbookautor'";
    
        if ($this->connection->exec($q)) {
            $msg = "($oldbooktitre, $oldbookautor) modifié avec succès";
        }
        header("Location: adminProfil.php?div=$div&msg=$msg");
    }
    
    function getbookissue($search,$criteria){
        if($search == null ||$criteria == null){
        $q="SELECT * FROM livres where stock >0 ";
        }else{
        $q = "SELECT * FROM livres WHERE $criteria LIKE '%$search%'";   
        }
        $data=$this->connection->query($q);
        return $data;
        
    }
    
    function getissuebook($userloginid) {
        $q="SELECT * FROM emprunt where email='$userloginid'";
        $data=$this->connection->query($q);
        return $data;
    }

    function getStatut($date) {
        // Convertir la date en timestamp
        $dateTimestamp = strtotime($date);
        
        // Timestamp de la date actuelle
        $dateActuelle = time();
    
        // Vérifier si la date est déjà passée
        if ($dateTimestamp < $dateActuelle) {
            // Calculer le nombre de jours de retard
            $diff = floor(($dateActuelle - $dateTimestamp) / (60 * 60 * 24));
            return "En retard de $diff jour(s)";
        }elseif($dateTimestamp == $dateActuelle){
            return "Dernier jour";
        } 
        else {
            // Calculer le nombre de jours restants
            $diff = floor(($dateTimestamp - $dateActuelle) / (60 * 60 * 24));
            return "Il reste $diff jour(s)";
        }
    }

    function getphotobook($titre,$auteur){
        $q = "SELECT photo FROM livres WHERE auteur = '$auteur' AND titre = '$titre'";
        $data=$this->connection->query($q);
        return $data;
    }

    function dateBookProlog($email,$titre,$auteur,$date,$div){

        $q_update = "UPDATE emprunt SET dateR = '$date' WHERE email='$email' AND auteur = '$auteur' AND titre = '$titre'";
        if($this->connection->exec($q_update)){
            $msg="$titre prolonger avec succes";
        }else{
            $msg="échec";
        }
        header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
    }

    function bookBack($titre,$auteur,$email,$div){
        
        $q = "DELETE FROM emprunt WHERE auteur = '$auteur' AND titre = '$titre' AND email = '$email'";
        if($this->connection->exec($q)){
            $q_update = "UPDATE livres SET stock = stock + 1 WHERE auteur = '$auteur' AND titre = '$titre'";
            $this->connection->exec($q_update);     
            $msg="$titre rendu avec succes";   
        }
        else{
            $msg='échec';
        }
        header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
    }
    function panier($email){
        $v = "SELECT * FROM panier WHERE email ='$email'";
        $d = $this->connection->query($v);
      return $d;
    }
    


    function ajoutPanier($email, $aTitre, $aAuteur, $aPhoto) {
        $v = "SELECT * FROM emprunt WHERE titre ='$aTitre' AND auteur ='$aAuteur' AND email ='$email'";
        $recordSet = $this->connection->query($v);
        $result = $recordSet->rowCount();
        if ($result > 0) {
            $msg = 'Vous avez déjà prêté un exemplaire !';
           // echo $msg;
        }else{
    
            $q = "SELECT * FROM panier WHERE email ='$email' AND titre = '$aTitre' AND auteur = '$aAuteur'";
            $recordSet = $this->connection->query($q);
            $result = $recordSet->rowCount();
            
            if ($result > 0) {
                $msg = 'Déjà ajouté au panier !';
                // echo $msg;
            }else{
                    $q = "INSERT INTO panier (email, titre, auteur, photo) VALUES ('$email', '$aTitre', '$aAuteur', '$aPhoto')";
                    if($this->connection->exec($q)) {
                        $msg = "Ajouté au panier";
                            } else {
                                $msg = "Échec";
                            }
                    echo $msg;
            }
        }
         header("Location:etudiantProfil.php?userlogid=$email&msg=$msg&div=requestbook");

    }
     
    function retirerPanier($email,$titre,$auteur,$msg){
        $q="DELETE from panier where email='$email' AND titre = '$titre' AND auteur = '$auteur'";
        $div ="panier";
        if($this->connection->exec($q)){
            $msg = 'retirer avec succes';
            header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
        }else{
            $msg='échec';
            echo "$msg";
            header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
        }
    }
    
    function annulerPanier ($email,$msg){
        $q="DELETE from panier where email='$email'" ;
        $div ="panier";
        if($this->connection->exec($q)){
            header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
        }else{
            $msg='échec';
            echo "$msg";
            header("Location:etudiantProfil.php?userlogid=$email&div=$div&msg=$msg");
        }
    }

    function confirmerPanier($email){
        $this->setconnection();
        $pan =$this->panier($email);
        if ($pan == null){
            echo "aaaaaaaaaaaaa";
        }   else{
        
        foreach($pan as $element){
            $titre = $element[1]; 
            $auteur = $element[2]; 
            $this->validCard($email,$titre, $auteur,"panier");
        }
        
        $msg='panier validé avec succes';
        $this ->annulerPanier($email,$msg);
        }
     }
    
    
    function validCard($email,$titre,$auteur,$div){
 
        $v="SELECT * FROM emprunt WHERE titre ='$titre' AND auteur ='$auteur' AND email ='$email'";
        $recordSet=$this->connection->query($v);
        $result=$recordSet->rowCount();
        if ($result > 0) {
            $msg = 'Vous avez déjà prêté un exemplaire ! (' . $titre . '/' . $auteur . ')';
            $this->retirerPanier($email,$titre,$auteur,$msg);
            exit();
        }
        $dateE= date("Y-m-d");
        $dateR = date("Y-m-d", strtotime($date_du_jour . "+15 days")); 
        $q = "INSERT INTO emprunt (email, titre, auteur, dateE, dateR) VALUES ('$email','$titre','$auteur','$dateE', '$dateR')";
        if($this->connection->exec($q)){
            $q_update = "UPDATE livres SET stock = stock -1 WHERE auteur = '$auteur' AND titre = '$titre'";
            $this->connection->exec($q_update);  
            $msg='panier validé avec succes';
        }else{
            $msg='echec';
        }
    }

}