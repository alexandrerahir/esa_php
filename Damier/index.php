<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Document</title>
</head>

<body>
    
    <div class="damier">

        <?php
                // Lignes
                for($i=0; $i<8; $i++) {

                    echo "<div class=\"ligne\">";

                    // Colonnes
                    for ($j = 0; $j < 8; $j++) {
                        $classe = ($i + $j) % 2 == 0 ? "case1" : "case2";
                        echo "<div class=\"$classe\"></div>";
                    }

                    echo "</div>";
                }
        ?>
        
    </div>

</body>
</html>