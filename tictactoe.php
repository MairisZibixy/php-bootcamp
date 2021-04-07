<?php
include "head.php";
$page = 'tictactoe';

include "DataManager.php";
$manager = new DataManager('db.json');
$winner = new DataManager('winner.json');

?>
<style>
    .tictac {
        display: grid;
        grid-template: repeat(3, 1fr) / repeat(3, 1fr);
        grid-gap: 10px;
        height: 360px;
        width: 360px;
        margin: 50px auto;
    }

    .tictac a {
        border: 1px solid black;
        text-align: center;
        line-height: 100%;
        font-size: 80px;
        text-decoration: none;
    }
</style>

<div class="container">
    <?php include "navigation.php"; ?>

    <?php
    /*
$table = [
    ["-", "-", "-"],
    ["-", "-", "-"],
    ["-", "-", "-"]
];
*/
    $table = [];

    if ($winner->get(0, 'winner') !== '') {
        $manager->deleteAll();
        $winner->deleteAll();
    }

    if (
        array_key_exists('restart', $_GET) &&
        $_GET['restart'] === '1'
    ) {
        $manager->deleteAll();
        $winner->deleteAll();
    } elseif (
        array_key_exists('r', $_GET) &&
        array_key_exists('c', $_GET) &&
        is_string($_GET['r']) &&
        is_string($_GET['c'])
    ) {
        $r = $_GET['r'];
        $c = $_GET['c'];

        echo '<div class="alert alert-warning">';
        echo 'Rinda ' . $r . ', kollona ' . $c;
        echo '</div>';

        if ($manager->get($r, $c) === '') {
            if ($manager->count() % 2 === 0) {
                $current_value = 'x';
            } else {
                $current_value = 'o';
            }

            $manager->save($r, $c, $current_value);

            //START validation
            //Sākas rindas 
            if (
                $current_value == $manager->get(1, 1) &&
                $current_value == $manager->get(1, 2) &&
                $current_value == $manager->get(1, 3)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif (
                $current_value == $manager->get(2, 1) &&
                $current_value == $manager->get(2, 2) &&
                $current_value == $manager->get(2, 3)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif (
                $current_value == $manager->get(3, 1) &&
                $current_value == $manager->get(3, 2) &&
                $current_value == $manager->get(3, 3)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            }
            //Sākās kollonas
            elseif (
                $current_value == $manager->get(1, 1) &&
                $current_value == $manager->get(2, 1) &&
                $current_value == $manager->get(3, 1)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif (
                $current_value == $manager->get(1, 2) &&
                $current_value == $manager->get(2, 2) &&
                $current_value == $manager->get(3, 2)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif (
                $current_value == $manager->get(1, 3) &&
                $current_value == $manager->get(2, 3) &&
                $current_value == $manager->get(3, 3)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            }
            //Sākas dioganāle
            elseif (
                $current_value == $manager->get(1, 1) &&
                $current_value == $manager->get(2, 2) &&
                $current_value == $manager->get(3, 3)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif (
                $current_value == $manager->get(1, 3) &&
                $current_value == $manager->get(2, 2) &&
                $current_value == $manager->get(3, 1)
            ) {
                echo "Uzvarējis ir $current_value";
                $winner->save(0, 'winner', $current_value);
            } elseif ($manager->count() === 9) {
                echo "Spēlē ir neišķirts";
                $winner->save(0, 'winner', 'N');
            }

            //END validation
        }
    } ?>

    <div class="tictac">
        <?php
        for ($r = 1; $r <= 3; $r++) {
            for ($c = 1; $c <= 3; $c++) {
                echo "<a href='?r=$r&c=$c'>" . $manager->get($r, $c) . "</a>";
            }
        }
        ?>
    </div>
    <div style="display: flex; justify-content: center;">
        <a href="?restart=1" class="btn btn-warning">Sākt no jauna</a>
    </div>
</div>