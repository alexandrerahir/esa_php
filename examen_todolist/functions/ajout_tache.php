<?php

    $todolistCSV = fopen('data/todolist.csv', 'a+');

    $groupe = $_POST['nomGroupe'];
    $tache = $_POST['nomTache'];
    $faire = 'false';

    fputcsv($todolistCSV, [$groupe,$tache, $faire], ';');

    fclose($todolistCSV);

    // Redirection
    header('Location: ../index.php');

?>