<?php
ob_start(); 
//Megnézzük hogy a session el van-e indítva és ha nincs akkor elindítjuk.
if (session_status() == PHP_SESSION_NONE && isset($_COOKIE[session_name()])) {
    session_start();
}
?>
<?php
/*
if (isset($_SESSION['user'])) {
    echo "<div class='alert alert-success'>Be vagy jelentkezve, felhasználó ID: " . $_SESSION['user'] . "</div>";
} else {
    echo "<div class='alert alert-danger'>Nem vagy bejelentkezve.</div>";
}
*/
?> 
<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <div class="search-icon  search-switch">
        <i class="icon_search"></i>
    </div>
    <div class="header-configure-area">
        <?php if(isset($_SESSION['user'])): ?>
            <a href="room_reservation.php" class="bk-btn">Foglalás</a>
            <a href="logout.php" class="bk-btn">Kijelentkezés</a>
        <?php else: ?> 
            <a href="login.php" class="bk-btn">Bejelentkezés</a>
        <?php endif; ?>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li><a href="./index.php">Menü</a></li>
            <li><a href="./rooms.php">Szobák</a></li>
            <li><a href="./about-us.php">Rólunk</a></li>
            <li><a href="./blog.php">Hírek</a></li>
            <li><a href="./contact.php">Kapcsolat</a></li>
			
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">
        <a href="contact.php"><i class="fa fa-facebook"></i></a>
        <a href="contact.php"><i class="fa fa-twitter"></i></a>
        <a href="contact.php"><i class="fa fa-tripadvisor"></i></a>
        <a href="contact.php"><i class="fa fa-instagram"></i></a>
    </div>
    <ul class="top-widget">
        <li><i class="fa fa-phone"></i> (12) 345 67890</li>
        <li><i class="fa fa-envelope"></i> info.szallas@gmail.com</li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                        <li><i class="fa fa-envelope"></i> info.szallas@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="contact.php"><i class="fa fa-facebook"></i></a>
                            <a href="contact.php"><i class="fa fa-twitter"></i></a>
                            <a href="contact.php"><i class="fa fa-tripadvisor"></i></a>
                            <a href="contact.php"><i class="fa fa-instagram"></i></a>
                        </div>
                        <?php if(isset($_SESSION['user'])): ?>
                            <a href="book.php" class="bk-btn">Foglalás</a>
                            <a href="logout.php" class="bk-btn ">Kijelentkezés</a>
                        <?php else: ?> 
                            <a href="actual_login.php" class="bk-btn">Bejelentkezés</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="index.php">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li><a href="./index.php">Kezdőlap</a></li>
                                <li><a href="./rooms.php">Szobák</a></li>
                                <li><a href="./about-us.php">Rólunk</a></li>
                                <li><a href="./blog.php">Hírek</a></li>
                                <li><a href="./contact.php">Kapcsolat</a></li>
								<li><a href="my_reservations.php">Foglalásaim</a></li>
                            </ul>
                        </nav>
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->