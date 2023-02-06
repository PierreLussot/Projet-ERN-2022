<?php
include_once('./include.php');

if (isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

if (!empty($_POST)) {
    extract($_POST);

    if (isset($_POST['inscription'])) {

        [$err_pseudo, $err_mail, $err_password] =  $_Inscription->verifivation_inscription($pseudo, $mail, $confmail, $password, $confpassword);
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Inscription</title>
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
            <h1 class="textBlack">inscription</h1>
            <div class="container">
                <form action="" method="POST">
                    <div class="mb-3 ">
                        <?php if (isset($err_pseudo)) {
                        ?>
                            <div class="textRed"> <?= $err_pseudo  ?> <div>
                                <?php
                            } ?>
                                <label class="form-label">pseudo</label>
                                <input class="form-control" type="text" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                    echo $pseudo;
                                                                                                } ?>" placeholder="pseudo">
                                </div>
                                <div class="mb-3 ">
                                    <?php if (isset($err_mail)) { ?>
                                        <div class="texteRed"> <?= $err_mail ?> <div>
                                            <?php
                                        } ?>
                                            <label class="form-label">email</label>
                                            <input class="form-control" type="email" name="mail" value="<?php if (isset($mail)) {
                                                                                                            echo $mail;
                                                                                                        } ?>" placeholder="email">
                                            </div>
                                            <div class="mb-3 ">
                                                <label class="form-label">confirmation email</label>
                                                <input class="form-control" type="email" name="confmail" value="<?php if (isset($confmail)) {
                                                                                                                    echo $confmail;
                                                                                                                } ?>" placeholder="confirmation email">
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
                                            <div class="mb-3 ">
                                                <label class="form-label">confirmation du mot de passe</label>
                                                <input class="form-control" type="password" name="confpassword" value="<?php if (isset($confpassword)) {
                                                                                                                            echo $confpassword;
                                                                                                                        } ?>" placeholder="mot de passe">
                                            </div>
                                            <button class="btn btn-primary" type="submit" name="inscription">Inscription</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <?php require_once('./_footer/footer.php'); ?>
</body>

</html>