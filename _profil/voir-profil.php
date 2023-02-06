<?php

include_once('../include.php');

//recupere l'id

$get_id = (int) $_GET['id'];

// verification si le id ne correspond a rien il renvoie sur la page membre
if ($get_id <= 0) {
    header('Location: membres.php');
}

if (isset($_SESSION['id']) &&  $get_id == $_SESSION['id']) {
    header('Location: profil.php');
    exit;
}

$req = $DB->prepare('SELECT * 
FROM utilisateur 
WHERE id = ?');

// et on execute l'id recuperer dans l'URL
$req->execute([$get_id]);

$req_user = $req->fetch();

$date = date_create($req_user['date_creation']);
$date_inscription = date_format($date, 'd/m/Y H:m:s');

$date = date_create($req_user['date_connexion']);
$date_connexion = date_format($date, 'd/m/Y  H:m:s');

//change le role des membres

switch ($req_user['role']) {
    case 0:
        $role = 'Utilisateur';
        break;
    case 1:
        $role = 'Super admin';
        break;
    case 2:
        $role = 'admin';
        break;
    case 3:
        $role = 'Moderateur';
        break;
    default:
        # code...
        break;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Profil de <?= $req_user['pseudo']  ?> </title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');
    ?>
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>
    <div class="container">
        <div class="row ">
            <div class="col-4 , bodyMembres">
                <h1>Profil de <?= $req_user['pseudo']  ?></h1>
                <div class="borderLine"></div>
                <div class="cobtainerInfoVoirProfil">
                    <p>
                        <i class="bi bi-calendar-check"></i> Inscription le : <?= $date_inscription  ?>
                    </p>
                    <p>
                        <i class="bi bi-alarm"></i> Derniere connexion le : <?= $date_connexion   ?>
                    </p>
                    <p>
                        <i class="bi bi-people"></i> Role : <?= $role;   ?>
                    </p>
                </div>
            </div>
            <?php

            ?>
            <div class="col-8"></div>


        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>