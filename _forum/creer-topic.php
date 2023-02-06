<?php
include_once('../include.php');

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}


$req = $DB->prepare('SELECT id, titre 
FROM forum ');

$req->execute();

$req_forum = $req->fetchAll();

if (!empty($_POST)) {

    extract($_POST);

    $valid =  (bool) true;

    if (isset($_POST['creation'])) {

        $titre = (string) ucfirst(trim($titre));
        $categorie = (int) $categorie;
        $contenu = (string) trim($contenu);

        if (empty($titre)) {
            $valid = false;
            $err_titre = "Le champ titre ne peut pas etre vide";
        } elseif (strlen($titre) < 4) {
            $valid = false;
            $err_titre = "Le titre doit contenir plus de 4 caractéres";
        } elseif (strlen($titre) >=  25) {
            $valid = false;
            $err_titre = "Le titre doit faire mois de 26 caractére (" . strlen($titre) . "/25)";
        }

        //verification si la categorie existe
        $req = $DB->prepare('SELECT id, titre 
                             FROM forum 
                             WHERE id = ? ');

        $req->execute([$categorie]);

        $req_forum_verification = $req->fetch();


        if (!isset($req_forum_verification['id'])) {
            $valid = false;
            $categorie = null;
            $err_cat = 'Cette categorie n\'existe pas ';
        }

        //verification du contenu
        if (empty($contenu)) {
            $valid = false;
            $err_contenu = "Le champ contenu ne peut pas etre vide";
        } elseif (strlen($contenu) < 4) {
            $valid = false;
            $err_contenu = "Le contenu doit titre plus de 4 caractére";
        }

        if ($valid) {

            $date_creation = date('Y-m-d H:i:s');

            $req = $DB->prepare('INSERT INTO topic (id_forum, titre, contenu, date_creation, date_modification, id_utilisateur) VALUES (?,?,?,?,?,?)');

            $req->execute([$req_forum_verification['id'], $titre, $contenu, $date_creation, $date_creation, $_SESSION['id']]);

            $UID = (int) $DB->lastInsertId();

            if ($UID >= 0) {
                header('Location: topic.php?id=' . $UID);
            } else {
                header('Location: forum.php');
            }
            exit;
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Creer un topic</title>
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
            <h1>Creer un topic</h1>
            <div class="container">
                <form action="" method="POST">
                    <div class="mb-3 ">
                        <?php if (isset($err_titre)) {
                        ?> <div class="textRed">  <?= $err_titre ?> <div>
                                <?php
                            } ?>
                                <label class="form-label">Titre</label>
                                <input class="form-control" type="text" name="titre" value="<?php if (isset($titre)) {
                                                                                                echo $titre;
                                                                                            } ?>" placeholder="titre">
                                </div>
                                <div class="mb-3 ">
                                    <?php if (isset($err_cat)) {
                                        echo "<div>" . $err_cat . "<div>";
                                    } ?>
                                    <label class="form-label">categorie</label>
                                    <select class="form-control" name="categorie">
                                        <?php
                                        //pour conserver la donnee en cas d'echec d'envoie 
                                        if (isset($categorie)) {
                                        ?>
                                            <option value="<?= $req_forum_verification['id'] ?>"><?= $req_forum_verification['titre'] ?></option>

                                        <?php
                                        } else {
                                        ?>
                                            <option value="" hidden>Choisisez votre catégorie</option>
                                        <?php
                                        }
                                        ?>

                                        <option value="" hidden>Choisisez votre catégorie</option>
                                        <?php foreach ($req_forum as $rf) {
                                        ?>
                                            <option value="<?= $rf['id'] ?>"> <?= $rf['titre'] ?> </option>
                                        <?php  } ?>

                                    </select>
                                </div>
                                <div class="mb-3 ">
                                    <?php if (isset($err_contenu)) {
                                        echo "<div>" . $err_contenu . "<div>";
                                    } ?>
                                    <label class="form-label">Contenu </label>
                                    <textarea class="form-control" type="text" name="contenu" placeholder="Votre topic ..." value="<?php if (isset($contenu)) {
                                                                                                                                        echo $contenu;
                                                                                                                                    } ?>"></textarea>

                                </div>
                                <button class="btn btn-primary" type="submit" name="creation">Creer mon topic </button>
                            </div>

                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    <?php require_once('../_footer/footer.php'); ?>
</body>

</html>