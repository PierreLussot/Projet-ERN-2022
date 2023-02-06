<?php

include_once('../include.php');

$req = $DB->prepare('SELECT * 
FROM forum
ORDER BY ordre');

$req_forum = $req->execute();



$req_membres = $req->fetchAll();
?>

<!doctype html>
<html lang="en">

<head>
    <title>forum</title>
    <?php
    require_once('../_head/meta.php');
    require_once('../_head/link.php');
    require_once('../_head/script.php');
    ?>
</head>

<body>
    <?php require_once('../_menu/menu.php'); ?>
    <div class="container">
        <div class="row , bodyForum">
            <div class="col-12">
                <h1>Forum</h1>
                <div class="borderLine"></div>
            </div>


            <?php
            foreach ($req_membres as $rf) {

                //recuperation du nombre de topic

                $req = $DB->prepare('SELECT COUNT(id) AS NBcommentaire
                FROM topic
                WHERE id_forum = ?');

                $req->execute([$rf['id']]);

                $req_nb_topic = $req->fetch();

                $nb_topic =   $req_nb_topic['NBcommentaire'];
            ?>


                <div class="col-3  ">
                    <div class="vignetteForum">
                        <h5><?= $rf['titre'] ?></h5>
                        <p><i class="bi bi-chat-square-text"></i> <?= $nb_topic ?> Topic(s) </p>
                        <div>
                            <a class="btn btn-primary" href="_forum/liste-topics.php?id=<?= $rf['id'] ?>">voir topics</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
            <div>
                <a class="btn btn-success" href="_forum/creer-topic.php">creer topic</a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>