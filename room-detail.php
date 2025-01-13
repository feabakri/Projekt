<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sona</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Szobáink</h2>
                        <div class="bt-option">
                            <a href="./index.php">Kezdőlap</a>
                            <span>Szobák</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="img/room/room-details.jpg" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>Prémium királyi szoba</h3>
                                <div class="rdt-right">
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    <?php if(isset($_SESSION['user'])): ?>
                                        <a href="book.php">Foglalás most</a>
                                    <?php else: ?> 
                                        <a href="login.php" class="bk-btn">Bejelentkezés</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h2>25,000 - 50,000 Ft<span>/Éjszaka</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                    <td class="r-o">Méret:</td>
                                        <td>30-40 m²</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapacitás:</td>
                                        <td>Max. 3 fő</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Ágy:</td>
                                        <td>200 x 200 cm</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Szolgáltatások:</td>
                                        <td>Wifi, TV, fürdőszoba,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para">A Prémium Királyi Szoba tökéletes választás azok számára, akik stílusos és kényelmes szállásra
                            vágynak. A 30-40 m²-es alapterületű szoba tágas teret kínál, ideális legfeljebb 3 fő számára. A szoba
                            központi eleme a kényelmes, 200 x 200 cm méretű franciaágy, amely garantálja a pihentető alvást. A
                            modern berendezés és a letisztult dekoráció harmonikus hangulatot teremt. A vendégek számára
                            elérhető szolgáltatások közé tartozik a gyors Wifi, síkképernyős TV és egy jól felszerelt fürdőszoba.
                            </p>
                            <p>Az ablakok sok természetes fényt engednek be, és a növények barátságos légkört teremtenek. A
                            szoba különlegessége a kreatív fali dekoráció, amely inspiráló üzenetet közvetít. Egyedi bútorok és
                            stílusos kiegészítők gondoskodnak a prémium érzetről. A szoba ideális mind rövid, mind hosszabb
                            tartózkodásokhoz. A vendégek maximális kényelmét a praktikus elrendezés és a kiváló tisztaság
                            biztosítja. Foglalj most, és élvezd a luxus kényelmét!
                            </p>
                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Vélemények</h4>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>2024. augusztus 29.</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Nagyon tetszett a szoba berendezése és a kényelmes ágy. A természetes fény és a modern dekoráció
                                igazán otthonos hangulatot teremtett. Minden szolgáltatás hibátlanul működött, biztosan
                                visszatérünk!</p>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-2.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>2024. szeptember 17.</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Elena Silverman</h5>
                                <p>A szoba egyszerűen gyönyörű és nagyon tiszta volt. Az ágy hatalmas és kényelmes, a Wifi gyors, és a
                                fürdőszoba modern. Tökéletes hely a pihenésre, csak ajánlani tudom!</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-add">
                        <h4>Vélemény hozzáadása</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Név">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="E-mail">
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>Ön értékelése:</h5>
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                    </div>
                                    <textarea placeholder="Írd le a véleményedet rólunk!"></textarea>
                                    <button type="submit">Beküldés</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->

    <?php include 'footer.php'; ?>

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>