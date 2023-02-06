<?php

include_once('../include.php');

if (!isset($_GET['id'])) {
    header('Location: forum.php');
    exit;
}

$get_id_forum = (int) $_GET['id'];

if ($get_id_forum <= 0) {
    header('Location: forum.php');
    exit;
}

$req = $DB->prepare('SELECT *
FROM forum 
WHERE id = ? ');

$req->execute([$get_id_forum]);

$req_forum = $req->fetch();


$req = $DB->prepare('SELECT t.* , u.pseudo
FROM topic t
INNER JOIN utilisateur u ON u.id = t.id_utilisateur 
WHERE t.id_forum = ? 
ORDER BY t.date_creation DESC');

$req->execute([$get_id_forum]);

$req_liste_topics = $req->fetchAll();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Forum - <?= $req_forum['titre'] ?></title>
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

            <div class="col-6 , listeTopicTitre">
                <h1>Forum <?= $req_forum['titre'] ?></h1>
                <div class="borderLine"></div>
            </div>
            <div class="col-3"></div>
            <?php
            foreach ($req_liste_topics as $rlt) {

                //recuperation du nombre de commentaire 

                $req = $DB->prepare('SELECT COUNT(id) AS NBcommentaire
                FROM topic_commentaire
                WHERE id_topic = ?');

                $req->execute([$rlt['id']]);

                $req_nb_commentaire = $req->fetch();

                $nb_commentaire = $req_nb_commentaire['NBcommentaire'];
            ?>
                <div class="col-3 "></div>
                <div class="col-6 , bodyListTopicCentre">
                    <h5><?= $rlt['titre'] ?></h5>

                    <p><i class="bi bi-person-fill"></i> <?= $rlt['pseudo'] ?> </p>
                    <p><i class="bi bi-chat"></i> <?= $nb_commentaire ?> commentaire(s) </p>
                    <div>
                        <a class="btn btn-primary" href="_forum/topic.php?id=<?= $rlt['id'] ?>">lire topics</a>
                    </div>
                    <div class="borderLineListeTopic"></div>
                </div>

                <div class="col-3"></div>


            <?php
            }
            ?>
            <div class="col-3"></div>
            <div class="col-6 , bodyListTopicFin"> </div>
            <div class="col-3"> </div>

            <div class="col-3"></div>
        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>