<?php
    $groupesCSV = fopen('data/groupes.csv', 'a+');

    $groupe = $_POST['nomGroupe'];

    fputcsv($groupesCSV, [$groupe], ';');

    fclose($groupesCSV);

    // Redirection
    header('Location: ../index.php');
?>