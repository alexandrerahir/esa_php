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

// Affichage des tâches
function afficheTaches($todolist) {
    foreach ($todolist as $groupe => $taches) {
        echo "<div class='groupe'>";
        echo "<h3>$groupe</h3>";
        echo "<ul>";

        foreach ($taches as $tache) {

            // Variables pour les boutons
            $nouveauStatut = $tache['faire'] === 'true' ? 'false' : 'true';
            $classBouton = $tache['faire'] === 'true' ? 'boutonValide' : 'boutonNonValide';
            $imageBouton = $tache['faire'] === 'true' ? '../assets/images/valide.png' : '../assets/images/croix.png';
            
            echo "<li><div>";
            echo "<form method='post' action='functions/maj_tache.php'>";
            echo "<input type='hidden' name='groupe' value='" . $tache['groupe'] . "'>";
            echo "<input type='hidden' name='tache' value='" . $tache['tache'] . "'>";
            echo "<input type='hidden' name='nouveauStatut' value='" . $nouveauStatut . "'>";
            echo "<button class='$classBouton' type='submit'>";
            echo "<img src='images/$imageBouton'>";
            echo "</button>";
            echo "</form> ";
            echo "<p>{$tache['tache']}</p>";
            echo "</div>";
            echo "<div><button onclick=\"modalModifierTache('{$tache['groupe']}', '{$tache['tache']}')\">Modifier</button>";
            echo "<form method='post' action='functions/supprimer_tache.php'>";
            echo "<input type='hidden' name='groupe' value='" . $tache['groupe'] . "'>";
            echo "<input type='hidden' name='tache' value='" . $tache['tache'] . "'>";
            echo "<input type='submit' value='Supprimer'>";
            echo "</form>";
            echo "</div>";
            echo "</li>";
        }

        echo "</ul>";
        echo "</div>";

    }
}

?>