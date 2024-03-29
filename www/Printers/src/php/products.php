<?php

/**
 * @author Kévin Mury
 * @email kevin.mury@eduvaud.ch
 * @create date 2019-12-03 10:17:02
 * @modify date 2019-12-17 09:28:47
 * @desc [description]
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produits</title>
</head>

<body>
    <?php
    include_once("util.php");
    include_once("database.php");
    $db = new database();
    $data = array();

    switch ($_POST["sorting"]) {
        case "brand":
            $data = $db->printersByBrand();
            break;
        case "size":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            $data = $db->printersBySize($order);
            break;
        case "weight":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            $data = $db->printersByWeight($order);
            break;
        case "manufacturer":

            break;
        case "top5Sell":

            break;
        case "printSpeedBW":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            $data = $db->printersByBWSpeed($order);
            break;
        case "printSpeedCol":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            echo 'Vitesse impression Couleur';
            $data = $db->printersByColSpeed($order);
            break;
        case "scanResolution":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            break;
        case "topPrice":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            break;
        case "priceAndManufacturer":
            $order;
            if (exists($_POST["order"])) {
                $order = $_POST["order"];
                $order = (($order == 'ASC') or ($order == 'DESC')) ? $order : 'ASC';
            } else {
                $order = 'ASC';
            }
            break;
        default;
            echo 'Valeur inconnue';
    }

    if (exists($data)) {
        $_SESSION["data"] = $data;
        ?>

            <ul style="list-style: none;">
                <?php foreach ($data as $product) { ?>
                    <li>
                        <article>
                            <h1><?= $product["braName"] . ' ' . $product["proName"] ?></h1>
                            <p><?= $product["manName"] ?></p>
                            <?php
                                    switch ($_POST["sorting"]) {
                                        case "size":
                                            echo '<p> Dimensions: ' . $product["proWidth"] . 'x' . $product["proLength"] . 'x' . $product["proHeight"] . '</p>';
                                            break;
                                        case "weight":
                                            echo '<p>Poids: ' . $product["proWeight"] . '</p>';
                                            break;
                                        case "printSpeedBW":
                                            echo '<p>Vitesse d\'impression (NB): ' . $product["proPrintSpeedBW"] . '</p>';
                                            break;
                                        case "printSpeedCol":
                                            echo '<p>Vitesse d\'impression: ' . $product["proPrintSpeedCol"] . '</p>';
                                            break;
                                        case "scanResolution":
                                            echo '<p> Résolution de scan:' . $product["proScanResX"] . 'x' . $product["proScanResY"] . '</p>';
                                            break;
                                        default;
                                            echo '';
                                    }
                                    ?>
                                <p><?= $product["proPrice"] . ' CHF' ?></p>
                                <p></p>
                                    <a href="details.php?idProduct=<?= $product["idProduct"] ?>">Détails</a>
                                    <!-- <a href="consumables.php?idConsumable=<?= $product["idConsumable"] ?>">Consommables</a> -->
                                </p>
                        </article>
                    </li>
                <?php } ?>
            </ul>
        <?php } else {
            echo 'Aucune donnée trouvée';
        }
        ?>
</body>

</html>