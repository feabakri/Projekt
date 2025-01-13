<?php
session_start();
$error = "";
$msg = "";
$sikeres = "";
require_once("database/db_connection.php");

$servername = "localhost";
$username = "root"; // pl. root
$password = ""; // pl. üres, ha nincs jelszó
$dbname = "szallas";

// Kapcsolat létrehozása
$dbconn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($dbconn->connect_error) {
    die("Kapcsolódás sikertelen: " . $dbconn->connect_error);
}

// kijelentkeztetés
if ($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["kilepes"])){
  unset($_SESSION["felhasznalo"]); 
}

 //-------- szoba árának lekérdezése + felnőttek, gyerekek beállítása -------
$sql_szobaar = "SELECT nev, felnottek, gyerekek, ar FROM szoba";
$result = $dbconn->query($sql_szobaar);

$szobaarak = [];
if ($result) {
    while ($eredmeny_szoba = $result->fetch_assoc()) {
        $szobaarak[$eredmeny_szoba['nev']] = [
            'ar' => $eredmeny_szoba['ar'],
            'felnottek' => $eredmeny_szoba['felnottek'],
            'gyerekek' => $eredmeny_szoba['gyerekek']
        ];
    }
} else {
    // Hibakezelés, ha a lekérdezés nem sikerült
    echo "Hiba a lekérdezés során: " . $dbconn->error;
}

// --------- szolgáltatások lekérdezése ----------
$sql_szolgaltatas = "SELECT id, nev, ar FROM szolgaltatas";
$result = $dbconn->query($sql_szolgaltatas);

$szolgaltatasok = [];
if ($result) {
    while ($eredmeny_szolg = $result->fetch_assoc()) {
        $szolgaltatasok[$eredmeny_szolg['nev']] = [
            'id' => $eredmeny_szolg['id'],
            'ar' => $eredmeny_szolg['ar']
        ];
    }
} else {
    // Hibakezelés, ha a lekérdezés nem sikerült
    echo "Hiba a lekérdezés során: " . $dbconn->error;
}

// ---- foglalás menete ----- 
// Ellenőrzés, hogy a POST változók léteznek
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["foglalas"])) {
    //sessionnel ellenőrzés hogy be van-e lépve
    if (empty($_SESSION["felhasznalo"])) {
        $error = "A foglalás regisztrációhoz és bejelentkezéshez kötött!";
    } else {
        // Ellenőrizzük, hogy a szükséges POST változók léteznek
        if (!isset($_POST["szoba"])) {
            $error = "Kérem válasszon szobát!";
        } else if (!isset($_POST["checkinDate"]) || !isset($_POST["checkoutDate"])) {
            $error = "Kérem adja meg a check-in és check-out dátumokat!";
        } else if (!isset($_POST['calculated_value'])) {
            $error = "Kérem adja meg a végösszeget!";
        } else {
            if ($_POST["checkinDate"] > $_POST["checkoutDate"]) {
                $error = "Kérem létező időszakot adjon meg!";
            } else {
                // ha egy szoba x időben foglalt, akkor ne lehessen lefoglalni
                $sql_szobafoglalt = "SELECT szoba_id, checkin, checkout FROM foglalas JOIN szoba ON szoba_id = szoba.id WHERE szoba.nev = ?";
                $stmt_szobafoglalt = $dbconn->prepare($sql_szobafoglalt);
                $stmt_szobafoglalt->bind_param("s", $_POST["szoba"]);
                $stmt_szobafoglalt->execute();
                $result_szobafoglalt = $stmt_szobafoglalt->get_result();

                while ($row = $result_szobafoglalt->fetch_assoc()) {
                    $existing_checkin = $row["checkin"];
                    $existing_checkout = $row["checkout"];
                    if ($_POST["checkinDate"] < $existing_checkout && $_POST["checkoutDate"] > $existing_checkin) {
                        $error = "A választott időszakban foglalt ez a szoba!\nVálasszon más időszakot!";
                        break;
                    }
                }
                $stmt_szobafoglalt->close();

                if (!isset($error)) {
                    // Szoba elmentése
                    $checkinDate = $_POST["checkinDate"];
                    $checkoutDate = $_POST["checkoutDate"];
                    $calculated_value = $_POST['calculated_value'];
                    $szobanev = $_POST["szoba"];

                    $sql_foglalas = "INSERT INTO foglalas (checkin, checkout, fizetendo, vendeg_id, szoba_id) VALUES (?, ?, ?, ?, (SELECT id FROM szoba WHERE nev = ?))";
                    $stmt_foglalas = $dbconn->prepare($sql_foglalas);
                    $stmt_foglalas->bind_param("sssis", $checkinDate, $checkoutDate, $calculated_value, $_SESSION["felhasznalo"]["id"], $szobanev);
                    $stmt_foglalas->execute();

                    // ha van szolgáltatás, akkor elmenti
                    if (isset($_POST["szolgaltatasok"]) && is_array($_POST["szolgaltatasok"])) {
                        // foglalás id lekérése
                        $sql_foglalas_id = "SELECT id FROM foglalas WHERE vendeg_id = ? ORDER BY id DESC LIMIT 1";
                        $stmt_foglalas_id = $dbconn->prepare($sql_foglalas_id);
                        $stmt_foglalas_id->bind_param("i", $_SESSION["felhasznalo"]["id"]);
                        $stmt_foglalas_id->execute();
                        $result_foglalas_id = $stmt_foglalas_id->get_result();
                        $row_foglalas_id = $result_foglalas_id->fetch_assoc();
                        $fid = $row_foglalas_id['id'];

                        // szolgáltatás id lekérése és elmentése
                        foreach ($_POST["szolgaltatasok"] as $sz) {
                            $sql_szolg_id = "SELECT id FROM szolgaltatas WHERE nev = ?";
                            $stmt_szolg_id = $dbconn->prepare($sql_szolg_id);
                            $stmt_szolg_id->bind_param("s", $sz);
                            $stmt_szolg_id->execute();
                            $result_szolg_id = $stmt_szolg_id->get_result();
                            $row_szolg_id = $result_szolg_id->fetch_assoc();
                            $szid = $row_szolg_id['id'];

                            // Elmentés a foglalás_szolgaltatas táblába
                            $sql_foglalas_szolg = "INSERT INTO foglalas_szolgaltatas (szolgaltatas_id, foglalas_id) VALUES (?, ?)";
                            $stmt_foglalas_szolg = $dbconn->prepare($sql_foglalas_szolg);
                            $stmt_foglalas_szolg->bind_param("ii", $szid, $fid);
                            $stmt_foglalas_szolg->execute();
                        }
                        $stmt_szolg_id->close();
                        $stmt_foglalas_id->close();
                    }

                    $stmt_foglalas->close();
                    $sikeres = "Sikeres foglalás!";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szállás - Foglalás</title>

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
<!--<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Seapalace Hotel - Foglalás</title>

<link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/superfish@1.7.10/dist/js/superfish.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-ajaxchimp@1.0.0/dist/jquery.ajaxchimp.min.js"></script>

<link rel="icon" href="img/favicon.png" type="image/png">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/themify-icons/0.1.0/css/themify-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/linericons/css/linericons.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel="stylesheet" href="css/style.css">
	
</head>-->

<body>
	<header class="header_area">
	    <?php include 'header.php'; ?>
	</header>

	<section class="contact-banner-area" id="contact">
		<div class="container h-100">
			<div class="contact-banner">
				<div class="text-center">
					<h1>Foglalás</h1>
				</div>
			</div>
    </div>
	</section>

<main class="site-main">
  <section class="hero-section">
  <form class="form-search form-search-position" id="foglalas" action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" onsubmit="veglegesit()">
    <?= !empty($sikeres) ? "<h5 class=\"sikeres-foglalas\">$sikeres</h5>\n" : "" ?>
    <div class="container">
      <?= !empty($error) ? "<p class=\"error\">$error</p>\n" : "" ?>
      <?= !empty($msg) ? "<p class=\"msg\">$msg</p>\n" : "" ?>
        <div class="row">
          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">

                <div class="keresoOpciok">
                <h3>Szobatípus:</h3><br>
                <input type="radio" class="radio" name="szoba" value="Klasszikus szoba" required> Prémium királyi szoba<br>
                <input type="radio" class="radio" name="szoba" value="Családi szoba" required> Deluxe szoba<br>
                <input type="radio" class="radio" name="szoba" value="Prémium szoba" required> Kétágyas szoba<br>
                <input type="radio" class="radio" name="szoba" value="Egyágyas szoba" required> Luxus szoba<br>
                <input type="radio" class="radio" name="szoba" value="Kétágyas szoba" required> Szoba kilátással<br>
                <input type="radio" class="radio" name="szoba" value="Üzleti szoba" required> Kis kilátású szoba<br><br>
                <p>Szoba alapára: <span id="szobaar">0</span> Ft</p>
              </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 gutters-19">
            <div class="form-group">
              <div class="keresoOpciok">
                <h3>Szolgáltatásaink</h3><br>
                <input type="checkbox" name="szolgaltatasok[]" id="wellness" value="Wellness" onclick="szolgaltatas_ar()"> Útiterv<br>
                <input type="checkbox" name="szolgaltatasok[]" id="csomagmegorzo" value="Csomagmegőrző" onclick="szolgaltatas_ar()"> Étkeztetés<br>
                <input type="checkbox" name="szolgaltatasok[]" id="konferencia" value="Konferenciaterem" onclick="szolgaltatas_ar()"> Bébiszitterkedés<br>
                <input type="checkbox" name="szolgaltatasok[]" id="zart_parkolo" value="Zárt parkoló" onclick="szolgaltatas_ar()"> Mosodai szolgáltatás<br>
                <input type="checkbox" name="szolgaltatasok[]" id="sportjegy" value="Sportklub" onclick="szolgaltatas_ar()"> Sofőr bérlése<br><br><br>

                <p>Kiegészítő szolgáltatások: <span id="szolgaltatasar">0</span> Ft</p>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Kérem adja meg a felnőttek számát!</h4><br>
                <label>Felnőttek száma:</label>
                <input type="number" id="felnott" name="felnott" min="1" required>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Kérem adja meg a gyerekek számát!</h4><br>
                <label>Gyermekek száma:</label>
                <input type="number" id="gyerek" name="gyerek" min="0" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Mikor érkezik?</h4><br>
                <label>Érkezés napja:</label>
                <input type="date" id="checkinDate" name="checkinDate" required><br>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Mikor távozik?</h4><br>
                <label>Távozás napja:</label>
                <input type="date" id="checkoutDate" name="checkoutDate" required><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Végső összeg: </h4><br>
                <p>Végső összeg: <span id="vegso">0</span> Ft</p>
                <input type="hidden" name="calculated_value" id="calculated_value" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm gutters-19">
            <div class="form-group">
              <div class="form-select-custom">
                <div class="keresoOpciok">
                <h4>Emlékeztető:</h4><br>
                <p>Az összeg kifizetésére csak a helyszínen van lehetőség!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
          <div class="col-lg-6 gutters-19">
            <div class="form-group">
              <button class="button button-form btn-warning" type="submit" name="foglalas">Foglalás</button>
            </div>
          </div>
          
          <div class="col-lg-6 gutters-19">
            <div class="form-group">
              <button class="button button-form" id="resetButton" type="reset" onclick="window.resetFields()">Visszaállítás</button>
            </div>
          </div>
        </div>
    </form>
  </section>
</main>
<?php include 'footer.php'; ?>
<script>

  var vegosszeg = 0;
  var vegosszeg2 = 0;
  var napok = 0;
  // --- szoba árának kiírása + felnőttek és gyerekek ---
  const szobaarak = <?php echo json_encode($szobaarak); ?>;
  function szobaar() {
      const szobak = document.querySelector('input[name="szoba"]:checked');
      const szobaar = document.getElementById('szobaar');
      const felnott = document.getElementById('felnott');
      const gyerek = document.getElementById('gyerek');
      if (szobak) {
          const szobanev = szobak.value;
          const szoba = szobaarak[szobanev];
          if (szoba) {
          const ar = szoba.ar || "Nincs elérhető ár";
          const felnottek = szoba.felnottek;
          const gyerekek = szoba.gyerekek;
          szobaar.textContent = parseInt(ar);
          felnott.max = felnottek;
          gyerek.max = gyerekek;
          if (felnott.value > felnottek) {
              felnott.value = felnottek;
          }
          if (gyerek.value > gyerekek) {
              gyerek.value = gyerekek;
          }
          vegosszeg = parseInt(ar);
          }
      } else {
          szobaar.textContent = "Nincs elérhető ár";
      }
      updateVegosszeg();
  }
  const radioButtons = document.querySelectorAll('input[name="szoba"]');
  radioButtons.forEach(radio => {
      radio.addEventListener('change', szobaar);
  });

  // -------- szolgáltatások árának kiírása ---------
  const szolgaltatasok = <?php echo json_encode($szolgaltatasok); ?>;
  function szolgaltatas_ar() {
      const szolgaltatas = document.querySelectorAll('input[name="szolgaltatasok[]"]:checked');
      const szolgaltatasar = document.getElementById('szolgaltatasar');
      let osszeg = 0;
      szolgaltatas.forEach(checkbox => {
          const szolgaltatas_nev = checkbox.value;
          const szolg_ar = szolgaltatasok[szolgaltatas_nev].ar;
          osszeg += parseInt(szolg_ar);
      });
      
      szolgaltatasar.textContent = osszeg;
      vegosszeg2 = parseInt(osszeg);
      updateVegosszeg();
  }

  // ---- checkin és checkout túl bagy idő megakadályozás ----
  window.onload = function() {
      const jelenlegi_datum = new Date();
      const ev = jelenlegi_datum.getFullYear();
      let honap = jelenlegi_datum.getMonth() + 1;
      let nap = jelenlegi_datum.getDate();
      if (honap < 10) honap = '0' + honap;
      if (nap < 10) nap = '0' + nap;
      const jelenlegi = ev + '-' + honap + '-' + nap;

      const maximum_datum = new Date();
      maximum_datum.setFullYear(jelenlegi_datum.getFullYear() + 2);
      const maxev = maximum_datum.getFullYear();
      let maxhonap = maximum_datum.getMonth() + 1;
      let maxnap = maximum_datum.getDate();
      if (maxhonap < 10) maxhonap = '0' + maxhonap;
      if (maxnap < 10) maxnap = '0' + maxnap;
      const maximum = maxev + '-' + maxhonap + '-' + maxnap; 

      document.getElementById('checkinDate').setAttribute('min', jelenlegi);
      document.getElementById('checkoutDate').setAttribute('min', jelenlegi);
      document.getElementById('checkinDate').setAttribute('max', maximum);
      document.getElementById('checkoutDate').setAttribute('max', maximum);

      document.getElementById('checkinDate').addEventListener('input', updateNapok);
      document.getElementById('checkoutDate').addEventListener('input', updateNapok);
      updateNapok();
      updateVegosszeg();
  }
  // ---- lefoglalt napok száma --------
  function updateNapok() {
      const checkin = document.getElementById('checkinDate').value;
      const checkout = document.getElementById('checkoutDate').value;

      if (checkin && checkout) {
          const checkinDate = new Date(checkin);
          const checkoutDate = new Date(checkout);
          if (checkoutDate >= checkinDate) {
              const diffTime = Math.abs(checkoutDate - checkinDate);
              napok = parseInt(Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
          } else {
              napok = 0;
          }
      } else {
          napok = 0;
      }
      napok += 1;
      updateVegosszeg();
  }

  // ---- végső összeg meghatározása ----
  function updateVegosszeg() {
      let vegso = document.getElementById('vegso');
      vegso.textContent = parseInt((vegosszeg + vegosszeg2)*napok);
      document.getElementById('calculated_value').value = vegso.textContent;
      //console.log(document.getElementById('calculated_value').value);
  }
</script>
</body>
</html>





   
  
  
  