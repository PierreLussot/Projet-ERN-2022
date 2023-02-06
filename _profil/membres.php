<?php

include_once('../include.php');

$req = $DB->prepare('SELECT id, pseudo FROM utilisateur ');

//Supprime le pseudo de l'utilisateur connecté dans la liste des membres.

if (isset($_SESSION['id'])) {
    $req = $DB->prepare('SELECT * FROM utilisateur  WHERE id != ?');
    $req->execute([$_SESSION['id']]);
} else {
    $req->execute();
}



$req_membres = $req->fetchAll();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Membres</title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');
    ?>
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>
    <div class="container">
        <div class="row , bodyMembres">
            <div class="col-12  ">
                <h1>Membres</h1>
                <div class="borderLine"></div>
            </div>
            <?php
            foreach ($req_membres as $rm) {
            ?>
                <h5 class="col-2"><i class="bi bi-person-fill"></i> <?= $rm['pseudo'] ?>
                    <div>
                        <a class="btn btn-primary" href="_profil/voir-profil.php?id=<?= $rm['id'] ?>">voir profil</a>
                    </div>
                </h5>

            <?php
            }
            ?>
            <div class="col-3"></div>
        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>