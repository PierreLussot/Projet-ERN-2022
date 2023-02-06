<?php

include_once('./include.php');

if (isset($_SESSION['id'])) {
    header('Location: index.php');
    //session_destroy();
    exit;
}

if (!empty($_POST)) {
    extract($_POST);

    if (isset($_POST['connexion'])) {

        [$err_pseudo, $err_password] = $_Connexion->verification_connexion($pseudo, $password);
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Connexion</title>
    <?php
    require_once('./_head/meta.php');
    require_once('./_head/link.php');
    require_once('./_head/script.php');
    ?>
</head>

<body>
    <?php require_once('./_menu/menu.php'); ?>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h1>Connexion</h1>
            <div class="container">
                <form action="" method="POST">
                    <div class="mb-3 ">
                        <?php if (isset($err_pseudo)) {
                        ?>
                            <div class="textRed"> <?= $err_pseudo ?><div>
                                <?php
                            } ?>


                                <label class="form-label">pseudo</label>
                                <input class="form-control" type="text" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                    echo $pseudo;
                                                                                                } ?>" placeholder="pseudo">
                                </div>

                                <div class="mb-3 ">
                                    <?php if (isset($err_password)) {
                                        echo "<div>" . $err_password . "<div>";
                                    } ?>
                                    <label class="form-label">mot de passe</label>
                                    <input class="form-control" type="password" name="password" value="<?php if (isset($password)) {
                                                                                                            echo $password;
                                                                                                        } ?>" placeholder="mot de passe">
                                </div>
                                <button class="btn btn-primary" type="submit" name="connexion">Se connecter</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <?php require_once('./_footer/footer.php'); ?>
</body>

</html>