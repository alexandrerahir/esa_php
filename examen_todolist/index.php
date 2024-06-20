<!-- Appels des fonctions -->
<?php
    require_once 'functions/fonctions.php';

    $todolistCSV = 'data/todolist.csv';
    $groupesCSV = 'data/groupes.csv';

    $todolist = lectureTodolist($todolistCSV);
    $groupes = lectureGroupes($groupesCSV)
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/styles.css">

    <!-- Titre onglet -->
    <title>Todolisto - Repertoire de tâches</title>
</head>

<body>

    <!--Header  -->
    <header>
        <h1>Todolisto</h1>
        <nav>
            <button class="boutonAjouterGroupe">Ajouter un groupe</button>
            <button class="boutonAjouterTache">Ajouter une tâche</button>
        </nav>
    </header>


    <!-- Section informations -->
    <section class="informations">
        <div class="tachesNonTerminees">
            <h3>
                <?php echo nbTacheNonTerminee($todolist); ?>
            </h3>
            <p>tâches non terminées</p>
        </div>

        <div class="groupesCree">
            <h3>
                <?php echo nbGroupes($groupes); ?>
            </h3>
            <p>groupes disponible</p>
        </div>
    </section>


    <!-- Section tâches -->
    <section class="taches">
        <?php afficheTaches($todolist); ?>
    </section>


    <!-- Footer bas de page -->
    <footer>
        <p>Designé et développé par Alexandre Rahir</p>
    </footer>


    <!-- Modal ajout groupe et tache -->
    <div class="ajoutGroupe">
        <form action="functions/ajout_groupe.php" method="post" enctype="multipart/form-data"> 
            <h3>Ajout d'un nouveau groupe</h3>
            <p>Un groupe dans une liste de tâches permet de trier et d'organiser les tâches en catégories distinctes.</p>
            <input type="text" name="nomGroupe" size="15" placeholder="Nom du groupe" required/>
            <div>
                <button class="creerGroupe" type="submit">Ajouter</button>
                <button class="annulerGroupe" type="button" >Annuler</button> 
            </div>
        </form>
    </div>

    <div class="ajoutTache">
        <form action="functions/ajout_tache.php" method="post" enctype="multipart/form-data"> 
            <h3>Ajouter une tâche</h3>
            <p>Ajouter une tâche permet de planifier et de suivre les actions à réaliser, assurant ainsi une meilleure organisation et productivité.</p>
            <select name="nomGroupe" required>
                <option value="" disabled selected>Choisir un groupe</option>
                <?php
                    foreach ($groupes as $groupe) {
                        echo "<option value='$groupe'>$groupe</option>";
                    }
                ?>
            </select>
            <input type="text" name="nomTache" placeholder="Nom de la tâche" size="50" required/>
            <div>
                <button class="creerTache" type="submit">Ajouter</button>
                <button class="annulerTache" type="button" >Annuler</button>
            </div>    
        </form>
    </div>

    <!-- Modal modifier tache -->
    <div class="modifierTache">
        <form id="modifierForm" action="functions/modifier_tache.php" method="post" enctype="multipart/form-data"> 
            <h3>Modifier une tâche</h3>
            <p>Modifier une tâche permet de changer de nom et de groupe d'une tâche.</p>
            <input type="hidden" name="ancienGroupe" id="ancienGroupe">
            <input type="hidden" name="ancienNomTache" id="ancienNomTache">
            <select name="nomGroupe" required>
                <option value="" disabled selected>Choisir un groupe</option>
                <?php
                    foreach ($groupes as $groupe) {
                        echo "<option value='$groupe'>$groupe</option>";
                    }
                ?>
            </select>
            <input type="text" name="nomTache" placeholder="Nom de la tâche" size="50" required/>
            <div>
                <button class="modifier" type="submit">Modfier</button>
                <button class="annulerTache" type="button" >Annuler</button>
            </div>    
        </form>
    </div>


    <!-- Ajout du script -->
    <script src="/scripts/scripts.js"></script>

</body>

</html>