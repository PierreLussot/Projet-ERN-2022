<?php
include_once('./include.php');
if (isset($_SESSION['id'])) {
    $var = "Bonjour " . $_SESSION['pseudo'];
} else {
    $var = "Bonjour a tous";
}

?>

<!doctype html>
<html lang="en">

<head>

    <?php
    require_once('./_head/meta.php');
    require_once('./_head/link.php');
    require_once('./_head/script.php');
    ?>
    <title>Accueil</title>
</head>

<body>
    <?php require_once('./_menu/menu.php'); ?>

    <!--  <div class="slideshow-container">

        <div class="mySlides ">
            <div class="numbertext">1 / 3</div>
            <img src="https://cdn.pixabay.com/photo/2016/03/27/18/54/technology-1283624__340.jpg" style="width:100%">

        </div>

        <div class="mySlides ">
            <div class="numbertext">2 / 3</div>
            <img src="https://cdn.pixabay.com/photo/2016/11/19/22/52/coding-1841550__340.jpg" style="width:100%">

        </div>

        <div class="mySlides ">
            <div class="numbertext">3 / 3</div>
            <img src="https://cdn.pixabay.com/photo/2015/09/17/17/25/code-944499__340.jpg" style="width:100%">

        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <br>


    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"> </span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div> -->
    <div class="containerCarousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.pexels.com/photos/693859/pexels-photo-693859.jpeg?auto=compress&cs=tinysrgb&w=1600" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/3861958/pexels-photo-3861958.jpeg?auto=compress&cs=tinysrgb&w=1600" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1181676/pexels-photo-1181676.jpeg?auto=compress&cs=tinysrgb&w=1600" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!--   carrousel -->

    <h1 class="textBlack">Accueil </h1>
    <div class="borderLine"></div>
    <h2 class="textBlack"><?= $var ?></h2>

    <?php require_once('./_footer/footer.php'); ?>
</body>

</html>