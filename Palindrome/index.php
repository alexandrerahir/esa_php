<?php

    $mot = readline("Entrez votre mot : ");
    $palindrome = strrev($mot);

    if($mot != $palindrome) {
        echo "Le mot " . $mot . " n'est pas un palindrome.";
    } else {
        echo "Le mot " . $mot . " est un palindrome.";
    }

?>