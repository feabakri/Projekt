<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szállás</title>

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

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Sona</h1>
                        <p>Íme, a legjobb szállásfoglaló oldal, köztük ajánlások nemzetközi 
                            utazásokhoz és olcsó szállodai szobák kereséséhez.</p>
                        <a href="login.php" class="primary-btn">Fedezze fel most</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Szállásfoglalás</h3>
                        <form action="book.php">
                            <div class="check-date">
                                <label for="date-in">Bejelentkezés:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Kijelentkezés:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="guest">Vendégek:</label>
                                <select id="guest">
                                    <option value="">2 felnőtt</option>
                                    <option value="">3 felnőtt</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Szoba:</label>
                                <select id="room">
                                    <option value="">1 szoba</option>
                                    <option value="">2 szoba</option>
                                </select>
                            </div>
                            <button type="submit">Elérhetőségek keresése</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>Rólunk</span>
                            <h2>Interkontinentális<br />elérhetőség</h2>
                        </div>
                        <p class="f-para">A Sona.com egy piacvezető online szálláskereső oldal. Az utazás
                            a szenvedélyünk. Nap mint nap utazók millióit inspiráljuk és érjük el több nyelven és
                            helyi weboldalakon keresztül.</p>
                        <p class="s-para">Tehát ha a tökéletes szálloda, nyaralóház, üdülőhely, apartman, 
                            vendégház vagy faház foglalásáról van szó, mi mindent tudunk.</p>
                        <a href="rooms.php" class="primary-btn about-btn">Bővebben</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Ajánlataink</span>
                        <h2>Ismerje meg szolgáltatásainkat</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Útiterv</h4>
                        <p>Tervezze meg nyaralását könnyedén: egyedi útitervvel segítjük Önt!
                            Javaslatokat kínálunk helyi látnivalókhoz és programokhoz is.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Étkeztetés</h4>
                        <p>Élvezze a változatos étkezési lehetőségeket reggelitől vacsoráig!
                            Foglaljon étkezést előre, vagy válasszon az érkezéskor.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Bébiszitterkedés</h4>
                        <p>Professzionális bébiszitter-szolgáltatás gyermeke biztonságáért.
                            Nyugodtan élvezheti idejét, míg gyermekei jól szórakoznak.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-024-towel"></i>
                        <h4>Mosodai szolgáltatás</h4>
                        <p>Kényelmes mosodai szolgáltatás, hogy mindig friss ruhákban járhasson.
                            Egyszerűen adja le a mosnivalót, és élvezze a tiszta ruhákat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Sofőr bérlése</h4>
                        <p>Béreljen sofőrt, hogy kényelmesen és biztonságban utazhasson.
                            Ideális városnézéshez, üzleti utakhoz vagy esti programokhoz.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Bár és ital</h4>
                        <p>Pihenjen és élvezze italainkat a bárban vagy a szobaszervizben!
                            Prémium italok széles választékával várjuk Önt.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-b1.jpg">
                            <div class="hr-text">
                            <h3>Prémium királyi szoba</h3>
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
                                <a href="rooms.php" class="primary-btn">További információk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-b2.jpg">
                            <div class="hr-text">
                            <h3>Deluxe szoba</h3>
                                <h2>20,000 - 40,000 Ft<span>/Éjszaka</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Méret:</td>
                                            <td>25-35 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Kapacitás:</td>
                                            <td>Max. 5 fő</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Ágy:</td>
                                            <td>160 x 200 cm vagy 200 x 200 cm</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Szolgáltatások:</td>
                                            <td>Wifi, TV, fürdőszoba,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="rooms.php" class="primary-btn">További információk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-b3.jpg">
                            <div class="hr-text">
                            <h3>Kétágyas szoba</h3>
                                <h2>15,000 - 30,000 Ft<span>/Éjszaka</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Méret:</td>
                                            <td>20-30 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Kapacitás:</td>
                                            <td>Max. 2 fő</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Ágy:</td>
                                            <td>2x 90 x 200 cm vagy 160 x 200 cm</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Szolgáltatások:</td>
                                            <td>Wifi, TV, fürdőszoba,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="rooms.php" class="primary-btn">További információk</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-b4.jpg">
                            <div class="hr-text">
                                <h3>Szoba kilátással</h3>
                                <h2>20,000 - 45,000 Ft<span>/Éjszaka</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Méret:</td>
                                            <td>20-40 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Kapacitás:</td>
                                            <td>Max. 2 fő</td>
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
                                <a href="rooms.php" class="primary-btn">További információk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Ajánlások</span>
                        <h2>Mit mondanak a vevők?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>Miután egy építkezés a vártnál tovább tartott, a férjemnek, a lányomnak és nekem szükségünk volt egy helyre,
                            ahol néhány éjszakát tölthetünk. Chicagói lakosként sokat tudunk a városunkról,
                            a környékről és a rendelkezésre álló lakhatási lehetőségek típusairól, 
                            és abszolút szeretjük a Sona Hotelben töltött nyaralásunkat.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                        <div class="ts-item">
                            <p>Egy rövid chicagói pihenés során a Sona Hotelben szálltunk meg, és imádtuk!
                            A szobák tágasak és kényelmesek, a személyzet pedig hihetetlenül figyelmes.
                            A hotel elhelyezkedése is kiváló, minden könnyen megközelíthető.
                            Biztosan visszatérünk!</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Daniel White</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Szállás hírek</span>
                        <h2>Eseményeink:</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-1.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Utazás</span>
                            <h4><a href="contact.php">Tremblant Kanadában.</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 2025. január 7.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-2.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Kemping</span>
                            <h4><a href="contact.php">Statikus lakóautó kiválasztása</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 2025. március 13.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/blog-3.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Rendezvény</span>
                            <h4><a href="contact.php">Copper Canyon</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 2025. április 8.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/blog-wide.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Rendezvény</span>
                            <h4><a href="contact.php">Utazás Iqaluitba Nunavutba egy kanadai sarkvidéki városba</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 2025. április 13.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/blog-10.jpg">
                        <div class="bi-text">
                            <span class="b-tag">Utazás</span>
                            <h4><a href="contact.php">Utazás Barcelonába</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 2025. április 21.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
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