<?php

include_once('../include.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}

$req = $DB->prepare('SELECT * 
FROM utilisateur 
WHERE id = ?');


$req->execute([$_SESSION['id']]);

$req_user = $req->fetch();

if (!empty($_POST)) {
    extract($_POST);

    $valid = (bool) true;

    if (isset($_POST['form1'])) {
        $mail = (string) trim($mail);
        //si il n'y a rien dans le champ de email
        if ($mail == $_SESSION['mail']) {
            $valid = false;
        } elseif (!isset($mail)) {
            $valid = false;
            $err_mail = 'Ce champ ne peut pas etre vide';
        }
        //verification du format du email
        elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $err_mail = "Format invalide pour ce mail";
        } else {
            $req = $DB->prepare("SELECT id 
            FROM utilisateur 
            WHERE  mail = ? ");

            $req->execute([$mail]);

            $req = $req->fetch();

            if (isset($req['id'])) {
                $valid = false;
                $err_mail = 'Ce mail n\'est pas disponible';
            }
        }

        //si tout se passe bien  
        if ($valid) {

            $req = $DB->prepare('UPDATE utilisateur SET mail = ? WHERE id = ?');
            $req->execute([$mail, $_SESSION['id']]);

            //mais a jour le mail sur la session
            $_SESSION['mail'] = $mail;

            header('Location: modifier-profil.php');
            exit;
        }
    } elseif (isset($_POST['form2'])) {

        $oldpsd = (string) trim($oldpsd);
        $psd = (string) trim($psd);
        $confpsd = (string) trim($confpsd);
        //si le champ est vide 
        if (!isset($oldpsd)) {
            $valid = false;
            $err_password = 'Ce champ ne peut pas etre vide';
        }

        //verification si l'ancien  mdp est correct 
        else {
            $req = $DB->prepare('SELECT mdp 
            FROM utilisateur 
            WHERE id = ?');

            $req->execute([$_SESSION['id']]);

            $req = $req->fetch();

            //si c'est pas bon 
            if (isset($req['mdp'])) {
                if (!password_verify($oldpsd, $req['mdp'])) {
                    $valid = false;
                    $err_password = 'L\'ancien mot de passe est incorrecte  ';
                }
            } else {
                $valid = false;
                $err_password = 'L\'ancien mot de passe est incorrecte  ';
            }
        }

        if ($valid) {
            if (empty($psd)) {
                $valid = false;
                $err_password = "Le champ mot de passe ne peut pas etre vide";
            }
            //si le nouveau mdp et different du mdp de confirmation
            elseif ($psd !== $confpsd) {
                $valid = false;
                $err_password = "Le mot de passe est différent de la confirmation";
            }
            //si l'ancien mdp et rentrer a nouveau il neut pas etre valide 
            elseif ($psd == $oldpsd) {
                $valid = false;
                $err_password = "Le mot de passe soit différent de l'ancien";
            }
        }


        //si tout se passe bien  
        if ($valid) {
            //hashe avec une cle aleatoire pour securiser le code 
            $crypt_password = password_hash($psd, PASSWORD_DEFAULT);
            //modification du mdp dans la db
            $req = $DB->prepare('UPDATE utilisateur SET mdp = ? WHERE id = ?');
            $req->execute([$crypt_password, $_SESSION['id']]);

            header('Location: modifier-profil.php');
        }
    }
}

if (!isset($mail)) {
    $mail =  $req_user['mail'];
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Modifier mon compte </title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');
    ?>
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 , bodyModifierProfile">
                <h1>Modifer mes informations </h1>
                <form method="POST" action="">
                    <div class="mb-3 "> <?php if (isset($err_mail)) {
                                            echo "<div>" . $err_mail . "<div>";
                                        } ?>
                        <input class="form-control" type="email" name="mail" value="<?= $mail ?>" placeholder="Mail">
                    </div>
                    <div class="mb-3 ">
                        <input class="btn btn-outline-primary" type="submit" name="form1" value="Modifier">
                    </div>
                </form>
                <br>
                <form method="POST" action="">
                    <div class="mb-3 "><?php if (isset($err_password)) {
                                            echo "<div>" . $err_password . "<div>";
                                        } ?>
                        <input class="form-control" type="password" name="oldpsd" value="" placeholder="Mot de passe actuel">
                    </div>
                    <div class="mb-3 ">
                        <input class="form-control" type="password" name="psd" value="" placeholder="Nouveau mot de passe ">
                    </div>
                    <div class="mb-3 ">
                        <input class="form-control" type="password" name="confpsd" value="" placeholder="Confirmation du mot de passe">
                    </div>
                    <input class="btn btn-outline-primary" type="submit" name="form2" value="Modifier">
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>