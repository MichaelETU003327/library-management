<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
</head>

<body>
    <h1>Résultats de recherche</h1>

    <?php
    $search = $_GET['search'];
    $criteria = $_GET['criteria'];

    if(isset($search) && isset($criteria)) {
        $query = "SELECT * FROM livres WHERE $criteria LIKE '%$search%'";

        $result = $db->query($query);

        if ($result->rowCount() > 0) {
            echo "<ul>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>{$row['titre']} - {$row['auteur']} - {$row['categorie']}</li>";
            }
            echo "</ul>";
        } else {
            echo "Aucun résultat trouvé.";
        }
    } else {
        echo "Veuillez effectuer une recherche.";
    }
    ?>
</body>

</html>