<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $ancienGroupe = $_POST['ancienGroupe'];
        $ancienNomTache = $_POST['ancienNomTache'];
        $nouveauGroupe = $_POST['nomGroupe'];
        $nouveauNomTache = $_POST['nomTache'];

        if (($handle = fopen('../data/todolist.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if ($data[0] == $ancienGroupe && $data[1] == $ancienNomTache) {
                    $data[0] = $nouveauGroupe;
                    $data[1] = $nouveauNomTache;
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

        // Redirection
        header('Location: ../index.php');

    }


?>