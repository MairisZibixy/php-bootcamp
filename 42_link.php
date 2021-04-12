<?php
include "head.php";
$page = '42_link';

include "DataManager.php";
$manager = new DataManager('42_data.json');

?>

<style>
    a.btn {
        margin: 5px;
    }
</style>

<div class="container">
    <?php include "navigation.php"; ?>

    <form action="">
        <div class="mb-3">
            <label for="link-amount" class="form-label">Amount of links</label>
            <input id="link-amount" name="amount" type="number" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-info">submit</button>
        </div>
    </form>



    <?php

    // Pārbauda vai adrešu joslā ir submitots skaitlis (integers)
    if (array_key_exists('amount', $_GET)) {
        $amount = (int) $_GET['amount'];
        //Nolasa adrešu joslai submitoto skaitli
    } else {
        $amount = $manager->get('amount', 0);
    }

    if ($amount == '') {
        $amount = 42;
    }

    if (array_key_exists('next', $_GET)) {
        $amount++;
    }
    //Saglabā submitoto skaitli linku izvades daudzumam
    $manager->save('amount', 0, $amount);

    //Pēc 1:20h cīņas izdevās izveidot alertu katram trešajam linkam :)
    if (
        //Pārbauda adrešu joslā ievadīto id, vai tas dalās ar 3  
        array_key_exists('id', $_GET) &&
        ($_GET['id'] % 3 === 0) &&
        $r = $_GET['id']
    ) {
        //Izvada $r kad piepildās IF nosacījumi
        echo '<div class="alert alert-danger">';
        echo 'Šis ir ' . $r . '.' . ' links';
        echo '</div>';
        //Start
        //Ņem vērtību no manager datubāzes
        $id_value = $manager->get('id', $r);
        if ($id_value === '') {
            $id_value = $r;
        }
        //Saglabā 'id' lai varētu to palielināt ar katru klikšķi uz linka
        $manager->save('id', $r, ++$id_value);
    }



    //Katrs sestais izvadītais links izvadīs btn-danger, pārējie btn-dark
    for ($i = 1; $i <= $amount; $i++) {
        $value = $manager->get('id', $i);
        if ($value === '') {
            $value = $i;
        }
        $class_name = ($i % 6 === 0) ? 'btn-danger' : 'btn-dark';
        echo "<a href='?id=$i' class='btn $class_name'>$value</a>";
    }
    ?>
    <a href="?next" class="btn btn-info">+</a>
</div>