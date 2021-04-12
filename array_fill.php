<?php
include "head.php";
$page = 'array_fill';

?>

<div class="container"><?php
                        include "head.php";
                        $page = 'array_fill';

                        ?>

    <style>
        td {
            border: 1px solid black;
        }
    </style>

    <div class="container">
        <?php include "navigation.php"; ?>

    </div>


    <?php

    function printTable($table)
    {
        echo "<table>";
        for ($i = 0; $i <= 2; $i++) {
            echo "<tr>";
            for ($i = 0; $i <= 2; $i++) {
                echo "<td>";
                echo $i;
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    ?>
    <?php include "navigation.php"; ?>

</div>