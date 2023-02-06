<?php

include_once('../include.php');

if (!isset($_GET['id'])) {
    header('Location: forum.php');
    exit;
}

$get_id_topic = (int) $_GET['id'];

if ($get_id_topic <= 0) {
    header('Location: forum.php');
    exit;
}

//Récupération des topics avec son créateur et nom de la catégorie

$req = $DB->prepare('SELECT t.*, u.pseudo, f.titre as titre_topic
FROM topic t
INNER JOIN utilisateur u ON u.id = t.id_utilisateur
INNER JOIN forum f ON f.id = t.id_forum
WHERE t.id = ? 
ORDER BY t.date_creation DESC');

$req->execute([$get_id_topic]);

$req_topic = $req->fetch();

if (!isset($req_topic['id'])) {
    header('Location: forum.php');
}

//recuperation des commentaires 

$req = $DB->prepare('SELECT tc.*, u.pseudo
FROM topic_commentaire tc
INNER JOIN utilisateur u  ON u.id = tc.id_utilisateur 
WHERE tc.id_topic = ?
ORDER BY tc.date_creation DESC ');

$req->execute([$req_topic['id']]);

$req_topic_commentaires = $req->fetchAll();

if (!empty($_POST)) {
    extract($_POST);

    $valid =  (bool) true;

    //verification du champ commentaire

    if (isset($_POST['poster'])) {

        $commentaire = (string) trim($commentaire);

        if (empty($commentaire)) {
            $valid = false;
            $err_commentaire = "Le champ commentaire ne peut pas etre vide";
        } elseif (strlen($commentaire) < 4) {
            $valid = false;
            $err_commentaire = "Le commentaire doit contenir plus de 4 caractéres";
        }

        //Insertion du commentaire dans la bdd

        if ($valid && $_SESSION['id']) {
            $date_creation = date('Y-m-d H:i:s');

            $req = $DB->prepare('INSERT INTO topic_commentaire (id_topic, id_utilisateur, contenu, date_creation, date_modification) VALUES (?,?,?,?,?)');

            $req->execute([$req_topic['id'], $_SESSION['id'], $commentaire, $date_creation, $date_creation]);

            header('Location: topic.php?id=' . $req_topic['id']);

            exit;
        } elseif (!$_SESSION['id']) {
            header('Location: topic.php?id=' . $req_topic['id']);
            exit;
        }
    } elseif (isset($_POST['supp-com'])) {

        $id_com =  (int) $id_com;

        if ($id_com <= 0) {
            $valid = false;
            $err_commentaire = "Impossible de supprimer ce commentaire";
        } else {

            //Securiter en cas de forçage de suppression 
            //via la console avec l'id des commentaire d'un autre utilisateur
            //Pour éviter de supprimer le commentaire des autres 

            $req = $DB->prepare(' SELECT id 
            FROM topic_commentaire
            WHERE id = ? AND id_utilisateur = ? ');

            $req->execute([$id_com, $_SESSION['id']]);

            $req_verification_commentaire = $req->fetch();

            if (!isset($req_verification_commentaire['id'])) {
                $valid = false;
                $err_commentaire = "Impossible de supprimer ce commentaire";
            }
        }

        if ($valid && $_SESSION['id']) {
            $req = $DB->prepare(' DELETE 
            FROM topic_commentaire
            WHERE id = ?');

            $req->execute([$req_verification_commentaire['id']]);

            header('Location: topic.php?id=' . $req_topic['id']);
            exit;
        }
    }




    //Suppression du topic

    elseif (isset($_POST['supp-topic'])) {

        //Si le topic ne correspond pas au compte 
        if (isset($_SESSION['id']) != $req_topic['id_utilisateur']) {

            $valid = false;
            $err_topic = 'impossible de supprimmer ce topic';
        }

        //Suppression des topics et leur commentaire 
        if ($valid && $_SESSION['id']) {

            $req = $DB->prepare(' DELETE 
            FROM topic_commentaire
            WHERE id_topic = ?');

            $req->execute([$req_topic['id']]);

            $req = $DB->prepare(' DELETE 
            FROM topic
            WHERE id = ?');

            $req->execute([$req_topic['id']]);

            header('Location: forum.php');
            exit;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Topic - <?= $req_topic['titre'] ?></title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');

    ?>
    <!-- <link rel="stylesheet" href="./_css/style.css"> -->
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>
    <div class="container">

        <div class="row">

            <div class="col-2"></div>
            <div class="col-8 , bodyTopicTitre">
                <h1> <?= $req_topic['titre'] ?></h1>
                <div class="borderLine"></div>
            </div>

            <div class="col-2"></div>

            <div class="col-2"></div>
            <div class="col-8 , bodyTopic">


                <!-- nl2br Prends en compte les sauts à la ligne. -->
                <p class="topicContenu"><?= nl2br($req_topic['contenu']) ?></p>
                <div class="borderLine"></div>

                <div class="basPageTopic">
                    <p><i class="bi bi-person"></i> De <?= $req_topic['pseudo'] ?></p>
                    <p><i class="bi bi-bookmark"></i> Categorie : <?= $req_topic['titre_topic'] ?></p>
                    <p><i class="bi bi-calendar-event"></i> Le <?= date_format(date_create($req_topic['date_creation']), 'd/m/Y  H:m:s'); ?></p>
                    <?php if ($req_topic['date_creation'] < $req_topic['date_modification']) {
                    ?>
                        <p><i class="bi bi-pencil-square"></i> modifier Le <?= date_format(date_create($req_topic['date_modification']), 'd/m/Y  H:m:s'); ?></p>
                    <?php
                    }  ?>
                </div>

                <?php if (isset($err_topic)) {
                    echo "<div>" . $err_topic . "<div>";
                } ?>
                <?php

                //Si les topics corresponde au compte connecter alors on peut supprimer et modifier 

                if (isset($_SESSION['id']) && $_SESSION['id'] == $req_topic['id_utilisateur']) {
                ?>
                    <div>
                        <a class="btn btn-warning" href="_forum/editer-topic.php?id=<?= $req_topic['id'] ?>"><i class="bi bi-pencil"></i> Modifier mon topic</a>
                    </div>

                    <form method="POST">
                        <button class="btn btn-danger" type="submit" name="supp-topic"> <i class="bi bi-trash"></i> Supprimer topic</button>
                    </form>
                    <br>
                <?php } ?>
            </div>
            <div class="col-2"></div>

            <div class="col-3"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1 class="textBlack"> Commentaires</h1>

            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST">
                    <div class="mb-3 ">
                        <?php if (isset($err_commentaire)) {
                            echo "<div" . $err_commentaire . "<div>";
                        } ?>
                        <label class="form-label , textBlack ">Votre commentaire </label>
                        <textarea class="form-control" type="text" name="commentaire" placeholder="Votre commentaire ..." value="<?php if (isset($commentaire)) {
                                                                                                                                        echo $commentaire;
                                                                                                                                    } ?>">
                    </textarea>



                    </div>
                    <button class="btn btn-primary" type="submit" name="poster"> <i class="bi bi-send"></i> Poster </button>

                </form>
            </div>
            <div class="col-3"></div>
            <?php
            foreach ($req_topic_commentaires as $rtc) {
            ?>
                <div class="col-3"></div>
                <div class="col-6 , borderBlack">
                    <br>

                    <p class="textBlack"><?= nl2br($rtc['contenu']) ?></p>
                    <div class="basPageComm">
                        <p class="textBlack"><i class="bi bi-person-fill"></i> De <?= $rtc['pseudo'] ?></p>
                        <p class="textBlack"><i class="bi bi-calendar-event"></i> Le <?= date_format(date_create($rtc['date_creation']), 'd/m/Y  H:m:s'); ?></p>

                        <?php if ($rtc['date_creation'] < $rtc['date_modification']) {
                        ?>
                            <p class="textBlack"><i class="bi bi-pencil-square"></i> modifier Le <?= date_format(date_create($rtc['date_modification']), 'd/m/Y  H:m:s'); ?></p>
                        <?php
                        }  ?>
                    </div>

                    <?php
                    //Si les commentaires correspondent au compte connecter alors on peut supprimer et modifier
                    if (isset($_SESSION['id']) && $_SESSION['id'] == $rtc['id_utilisateur']) {
                    ?>
                        <div>
                            <a class="btn btn-outline-success" href="_forum/editer-commentaire.php?id=<?= $rtc['id'] ?> "> <i class="bi bi-pencil"></i> Editer mon commentaire</a>
                        </div>
                        <form method="POST">
                            <button class=" btn btn-outline-danger" type="submit" name="supp-com"><i class="bi bi-trash"></i> Supprimer commentaire</button>

                            <!-- Récupération de l'id du commentaire avec un bouton hidden pour la suppression -->
                            <input type="hidden" name="id_com" value="<?= $rtc['id'] ?>">
                        </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-3"></div>
            <?php
            }  ?>

        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>