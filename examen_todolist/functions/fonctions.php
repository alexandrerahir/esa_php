<?php

    // Lecture du fichier CSV todolist
    function lectureTodolist($csv) {
        $todolist = [];
        $id = 0;

        if (($handle = fopen($csv, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if (!isset($todolist[$data[0]])) {
                    $todolist[$data[0]] = [];
                }

                $todolist[$data[0]][] = ['id' => ++$id, 'groupe' => $data[0], 'tache' => $data[1], 'faire' => $data[2]];
            }
            fclose($handle);
        }

        return $todolist;
    }

    // Lecture du fichier CSV groupes
    function lectureGroupes($csv) {
        $groupes = [];

        if (($handle = fopen($csv, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                $groupes[] = $data[0];
            }

            fclose($handle);
        }

        return $groupes;
    }


    // Nombre de tâche non terminée
    function nbTacheNonTerminee($todolist) {
        $nbTacheNonTerminee = 0;

        foreach ($todolist as $groupe => $taches) {

            foreach ($taches as $tache) {
                if ($tache['faire'] !== 'true') {
                    $nbTacheNonTerminee++;
                }
            }

        }

        return $nbTacheNonTerminee;
    }


    // Nombre de groupes crée
    function nbGroupes($groupes) {
        return count($groupes);
    }


    // Affiche la liste de tâche en fonction du groupe
    function afficheListeTaches($todolist) {
        foreach ($todolist as $groupe => $taches) {

            // HTML de groupe
            echo "<div class='groupe'>";
            echo "<h3>$groupe</h3>";
            echo "<ul>";

            // Variable pour sotcket les tâches
            $tachesNonTerminees = [];
            $tachesTerminees = [];

            // Ajout dans les variables
            foreach ($taches as $tache) {
                if ($tache['faire'] === 'true') {
                    $tachesTerminees[] = $tache;
                } else {
                    $tachesNonTerminees[] = $tache;
                }
            }

            // Affiche d'abord les tâches pas terminées
            foreach ($tachesNonTerminees as $tache) {
                afficheTache($tache);
            }

            // Affiche ensuite les tâche déjà termiées
            foreach ($tachesTerminees as $tache) {
                afficheTache($tache);
            }

            echo "</ul>";
            echo "</div>";

        }
    }

    // Afficher une tâche individuelle
    function afficheTache($tache) {
        // Variables pour les boutons
        $nouveauStatut = $tache['faire'] === 'true' ? 'false' : 'true';
        $classBouton = $tache['faire'] === 'true' ? 'boutonValide' : 'boutonNonValide';
        $imageBouton = $tache['faire'] === 'true' ? 'assets/images/valide.png' : 'assets/images/croix.png';
        $tacheNom = $tache['faire'] === 'true' ? "<del>{$tache['tache']}</del>" : $tache['tache'];

        // HTML de la tâche
        echo "<li>";
        echo "<div>";
        echo "<form method='post' action='functions/maj_tache.php'>";
        echo "<input type='hidden' name='groupe' value='" . $tache['groupe'] . "'>";
        echo "<input type='hidden' name='tache' value='" . $tache['tache'] . "'>";
        echo "<input type='hidden' name='nouveauStatut' value='" . $nouveauStatut . "'>";
        echo "<button class='$classBouton' type='submit'>";
        echo "<img src='$imageBouton'>";
        echo "</button>";
        echo "</form> ";
        echo "<p>$tacheNom</p>";
        echo "</div>";
        echo "<div>";
        echo "<button onclick=\"modalModifierTache('{$tache['groupe']}', '{$tache['tache']}')\">Modifier</button>";
        echo "<form method='post' action='functions/supprimer_tache.php'>";
        echo "<input type='hidden' name='groupe' value='" . $tache['groupe'] . "'>";
        echo "<input type='hidden' name='tache' value='" . $tache['tache'] . "'>";
        echo "<input type='submit' value='Supprimer'>";
        echo "</form>";
        echo "</div>";
        echo "</li>";

    }

?>
