<?php
include_once('../include.php');

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: forum.php');
    exit;
}

//si l'id du topic est inferieur ou egal a 0

$get_id_topic_commentaire = (int) $_GET['id'];


if ($get_id_topic_commentaire <= 0) {
    header('Location: forum.php');
    exit;
}

$req = $DB->prepare('SELECT *
FROM topic_commentaire 
WHERE id = ?');

$req->execute([$get_id_topic_commentaire]);

$reg_topic_commentaire = $req->fetch();


//si le commentaire n'existe pas ou a etais supprimer par lutilisateur

if (!isset($reg_topic_commentaire['id'])) {
    header('Location: forum.php');
    exit;
}
// si je en suis pas le createur du commentaire ne peut pas le modifier meme si forsage avec l'url

if ($reg_topic_commentaire['id_utilisateur'] != $_SESSION['id']) {
    header('Location: topic.php?id=' . $reg_topic_commentaire['id_topic']);

    exit;
}

if (!empty($_POST)) {
    extract($_POST);

    $valid =  (bool) true;

    if (isset($_POST['modification'])) {


        $commentaire = (string) trim($commentaire);

        //verification du commentaire

        if (empty($commentaire)) {
            $valid = false;
            $err_commentaire = "Le champ contenu ne peut pas etre vide";
        } elseif (strlen($commentaire) < 4) {
            $valid = false;
            $err_commentaire = "Le contenu doit titre plus de 4 caractére";
        }

        if ($valid) {

            $date_modification = date('Y-m-d H:i:s');

            $req = $DB->prepare('UPDATE  topic_commentaire SET  contenu = ?, date_modification = ? WHERE id =  ?');

            $req->execute([$commentaire, $date_modification, $reg_topic_commentaire['id']]);

            $UID = (int) $DB->lastInsertId();

            header('Location: topic.php?id=' . $reg_topic_commentaire['id_topic']);

            exit;
        }
    }
}

?>
<!-- formulaire -->
<!doctype html>
<html lang="en">

<head>
    <title>Editer mon Commentaire</title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');
    ?>
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>


    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h1>Editer mon Commentaire</h1>
            <div class="container">
                <form action="" method="POST">


                    <div class="mb-3 "> </div>
                    <div class="mb-3 ">
                        <?php if (isset($err_cat)) {
                            echo "<div>" . $err_cat . "<div>";
                        } ?>
                    </div>
                    <div class="mb-3 ">
                        <?php if (isset($err_commentaire)) {
                            echo "<div>" . $err_commentaire . "<div>";
                        } ?>
                        <label class="form-label">Commentaire </label>
                        <textarea class="form-control" type="text" name="commentaire" placeholder="Votre commentaire ..."><?php if (isset($commentaire)) {
                                                                                                                                echo $commentaire;
                                                                                                                            } else {
                                                                                                                                echo $reg_topic_commentaire['contenu'];
                                                                                                                            }

                                                                                                                            ?>
                                                                                                                       
                                                                                                                        </textarea>

                    </div>
                    <button class="btn btn-warning" type="submit" name="modification">Modifier mon commentaire </button>
            </div>

            </form>
        </div>
    </div>
    <div class="col-3"></div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>