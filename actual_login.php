<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szállás - Bejelentkezés</title>

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
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Sona</h1>
                        <p>Szállás foglalásához fiók szükséges.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Bejelentkezés</h3>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"]=="POST"){
                            if(isset($_POST["submitBej"])){
                                //Megnézi, hogy van-e már session, ha nincs, akkor létrehozza
                                if (session_status() == PHP_SESSION_NONE) {
                                    session_start(); //elinicializálja a session változót
                                }
                                $email = $_POST["email"];
                                $password = $_POST["password"];
                                require_once 'Database/db_connection.php';
                                $sql = "SELECT * FROM vendeg WHERE email = ?";
                                $stmt = mysqli_stmt_init($conn);
                                if(mysqli_stmt_prepare($stmt, $sql)){
                                    mysqli_stmt_bind_param($stmt, "s", $email);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    $user = mysqli_fetch_assoc($result);
                                    if($user){
                                        if(password_verify($password, $user["password"])){
                                            $_SESSION["user"] = $user['id']; 
                                            $_SESSION["full_name"] = $user['full_name']; 
                                         
											
											header("Location: book.php");
                                            exit();
											
                                            echo "<div class='alert alert-success'>Sikeres bejelentkezés!</div>";
                                        }else{
                                            echo "<div class='alert alert-danger'>Hibás jelszó!</div>";
                                        }   
                                    }else{
                                        echo "<div class='alert alert-danger'>Az E-mail nem egyezik!</div>";
                                    }
                                }
                            }
                        }
                        ?>
                        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" class="contact-form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="email" name="email" placeholder="E-mail cím">
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="password" name="password" placeholder="Jelszó">
                                    </div>
                                    <input type="submit" name="submitBej" class="btn-warning" style="color:black"value="Bejelentkezés">
                                    <nav>Még nincs fiókja? <a href="login.php" class="link-reg">Regisztráció</a></nav>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/video-bg.jpg"></div>
        </div>
    </section>
    
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