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
                        <h3>Regisztráció</h3>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                if(isset($_POST["submitReg"])){
                                    $fullName = $_POST["full_name"];
                                    $email = $_POST["email"];
                                    $password = $_POST["password"];
                                    $passwordRepeat = $_POST["repeat_password"];

                                    //Jelszó hashelése
                                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                                    $errors = array();
                                    //Hibaüzenetek
                                    if(empty($fullName) AND empty($email) AND empty($password) AND empty($passwordRepeat)){
                                    array_push($errors,"Az összes mező kitöltése kötelező!");
                                    }
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
                                        array_push($errors,"Az e-mail cím formátuma nem megfelelő!");
                                    }
                                    if(strlen($password) < 8){
                                        array_push($errors,"A jelszónak legalább 8 karakter hosszúnak kell lennie!");
                                    }
                                    if($password !== $passwordRepeat){
                                        array_push($errors,"A jelszavak nem egyeznek!");
                                    }

                                    require_once 'Database/db_connection.php';
                                    //Ellenőrzi, hogy van-e már ilyen e-mail cím az adatbázisban
                                    $sql = "SELECT * FROM vendeg WHERE email = '$email'";
                                    $result = mysqli_query($conn, $sql);
                                    $rowCount = mysqli_num_rows($result);
                                    if($rowCount > 0){
                                        array_push($errors,"Ez az e-mail cím már foglalt!");                   
                                    }

                                    if(count($errors) > 0){
                                        foreach($errors as $error){
                                            echo "<div class='alert alert-danger'>" .$error. "</div>";
                                        }  
                                    }else{
                                        //Ha nincs hiba, akkor regisztrálja az adatokat
                                        $sql = "INSERT INTO vendeg (full_name, email, password) VALUES (?, ?, ?)";
                                        $stmt = mysqli_stmt_init($conn);
                                        $prepareSmt = mysqli_stmt_prepare($stmt, $sql);
                                        if($prepareSmt){
                                            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                                            mysqli_stmt_execute($stmt);
                                            echo "<div class='alert alert-success'>Sikeres regisztráció!</div>";
                                        }else{
                                            die("Valami hiba történt: ".mysqli_error($conn));
                                        }
                                    }
                                }
                            }
                            ?>
                        <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" class="contact-form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input name="full_name" type="text" placeholder="Név">
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="email" type="email" placeholder="E-mail cím">
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="password" type="password" placeholder="Jelszó">
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="repeat_password" type="password" placeholder="Jelszó újra">
                                    </div>
                                    <input type="submit" name="submitReg" class="btn-warning" style="color:black"value="Regisztráció">
                                    <div class="nav">Van már fiókja? <a href="actual_login.php" class="link-reg" >Bejelentkezés</a></div>
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