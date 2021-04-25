<?php
include "head.php";
$page = 'array_fill';

?>

<style>
    td {
        border: 1px solid black;
    }
</style>

<div class="container">
    <?php include "navigation.php";

    $template = [
        [0, 0, 0],
        [0, 0, 0],
        [0, 0, 0]
    ];

    /*
    Piemērs #1
        [x, x, x],
        [x, x, x],
        [x, x, x]
    */
    $table = $template;
    for ($r = 0; $r <= 2; $r++) {
        for ($c = 0; $c <= 2; $c++) {
            $table[$r][$c] = 'x';
        }
    }

    printTable($table);

    /*
    Piemērs #2
        [x, 0, x],
        [x, 0, x],
        [x, 0, x]
    */
    $table = $template;
    for ($r = 0; $r <= 2; $r++) {
        for ($c = 0; $c <= 2; $c += 2) {
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    /*
    Piemērs #3
        [x, x, x],
        [x, x, x],
        [0, 0, 0]
    */
    $table = $template;
    for ($r = 0; $r <= 1; $r++) {
        for ($c = 0; $c <= 2; $c++) {
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    /*
    Piemērs #4
        [x, 0, 0],
        [0, x, 0],
        [0, 0, x]
    */
    $table = $template;
    for ($r = 0; $r <= 2; $r++) {
        $table[$r][$r] = 'x';
    }
    printTable($table);
    /*
    Piemērs #5 - Paliku šajā - jāizmanto if nosacījums
        [0, 0, x],
        [0, 0, x],
        [x, x, x]
    */
    $table = $template;
    for ($r = 2; $r >= 0; $r--) {
        for ($c = 2; $c >= 0; $c--) {
            if ($r < 2 && $c < 2) {
                break;
            }
            $table[$r][$c] = 'x';
        }
    }
    printTable($table);

    //6.-8. uzd bez if nosacījumiem
    /*
    Piemērs #6 - Līdzīgs ar 2.uzd, Aizpildīšanas viriezns uz otru pusi kollonu sākt index 2 - 2, rindas no 2. uz 0. 
        [6, 0, 5],
        [4, 0, 3],
        [2, 0, 1]
    */
    $table = $template;

    for ($r = 0; $r <= 2; $r++) {
        for ($c = 0; $c <= 1; $c += 2) {
            $x = 6;
            $table[$r][$c] = $x - $r * 2;
            for ($c = 2; $c <= 2; $c += 2) {
                $y = 5;
                $table[$r][$c] = $y - $r * 2;
            }
        }
    }
    printTable($table);

    /*
    Piemērs #7 - Fibunači virkne (fibonacci sequence)
        [8, 0, 5],
        [3, 0, 2],
        [1, 0, 1]

        Jāizvada:
        [$r[0]$c[0], 0, $r[0]$c[2]],
        [$r[1]$c[0], 0, $r[1]$c[2]],
        [$r[2]$c[0], 0, $r[2]$c[2]]

    */
    $table = $template;

    $num_1 = 1; // Initialize variable, ar kuru sāk virkni
    $num_2 = 0;
    $output = 0;
    for ($r = 2; $r >= $output; $r--) {
        for ($c = 2; $c >= $output; $c -= 2) {
            $num_3 = $num_1 + $num_2; // Katru for izpildes reizi saskaita $num_1 & $num_2
            $table[$r][$c] = $num_3; // Attēlo rezultāta vērtību tabulā
            $num_1 = $num_2; // Pievieno pēdējo vērtību priekšpēdējai
            $num_2 = $num_3; // Pievieno rezultāta vērtību pēdējai
        }
    }

    printTable($table);

    /*
    Piemērs #8 Fibunači virkne (fibonacci sequence)
        [5, -1, 1],
        [-8, 2, 0],
        [13, -3, 1]
        
        Virknes aizpilde sākās no $r[0]$c[2], $r-- un $c++
        [$r[0]$c[0], $r[0]$c[1], $r[0]$c[2]],
        [$r[1]$c[0], $r[1]$c[1], $r[1]$c[2]],
        [$r[2]$c[0], $r[2]$c[1], $r[2]$c[2]]
    */
    $table = $template;

    $num_1 = 1; // Norāda sākontējo vērtību, ar kuru sāk virkni
    $num_2 = 1;
    for ($r = 2; $r >= 0; $r--) {
        for ($c = 0; $c <= 2; $c++) {
            $num_3 = $num_1 + (-$num_2); // Katru for izpildes reizi saskaita $num_1 & $num_2
            $table[$c][$r] = $num_3; // Attēlo rezultāta vērtību tabulā
            $num_1 = $num_2; // Pievieno pēdējo vērtību priekšpēdējai
            $num_2 = $num_3; // Pievieno rezultāta vērtību pēdējai
        }
    }
    printTable($table);
    ?>

</div>


<?php

function printTable($table)
{
    static $count = 0;
    $count++;
    echo "<h2>$count</h2>";
    echo "<table>";
    for ($i = 0; $i <= 2; $i++) {
        echo "<tr>";
        for ($k = 0; $k <= 2; $k++) {
            echo "<td>";
            echo $table[$i][$k];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table><br>";
}

?>