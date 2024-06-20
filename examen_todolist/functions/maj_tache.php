<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $groupe = $_POST['groupe'];
        $tache = $_POST['tache'];
        $newStatus = $_POST['nouveauStatut'];

        $todolist = [];
        $fileData = [];

        // Lire le CSV et mettre à jour le statut de la tâche
        if (($handle = fopen('../data/todolist.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if ($data[0] == $groupe && $data[1] == $tache) {
                    $data[2] = $newStatus;
                }
                $fileData[] = $data;
            }

            fclose($handle);
        }

        // Écrire les données mises à jour dans le CSV
        if (($handle = fopen('../data/todolist.csv', 'w')) !== FALSE) {
            foreach ($fileData as $line) {
                fputcsv($handle, $line, ';');
            }

            fclose($handle);
        }

    }

    // Redirection
    header('Location: ../index.php');

?>
