<?php
session_start();

// Adatbázis-kapcsolat létrehozása
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "szallas";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
} else {
    echo "<p>Az aktuális felhasználó azonosítója nincs beállítva.</p>";
    exit;
}
include 'header.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foglalás Részletei</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

<div class="container mt-5">
  <h1 class="mb-4">Foglalás Részletei</h1>

  <?php
  // Ellenőrizzük az aktuális felhasználó ID-ját
  if (!isset($user_id) || empty($user_id)) {
      echo "<div class='alert alert-danger'>Az aktuális felhasználó azonosítója nincs beállítva.</div>";
      exit;
  }

  $sql = "SELECT f.id, s.nev AS szoba_nev, s.felnottek, s.gyerekek, f.checkin, f.checkout,
                 GROUP_CONCAT(DISTINCT sl.nev ORDER BY sl.nev SEPARATOR ', ') AS szolgaltatasok,
                 GROUP_CONCAT(DISTINCT sl.ar ORDER BY sl.nev SEPARATOR ', ') AS arak
          FROM foglalas AS f
          JOIN szoba AS s ON f.szoba_id = s.id
          LEFT JOIN foglalas_szolgaltatas AS fs ON f.id = fs.foglalas_id
          LEFT JOIN szolgaltatas AS sl ON fs.szolgaltatas_id = sl.id
          WHERE f.vendeg_id = ? 
          GROUP BY f.id, s.nev, s.felnottek, s.gyerekek, f.checkin, f.checkout";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $user_id); // Az aktuális felhasználó ID-ja
  $stmt->execute();
  $result = $stmt->get_result();

  // Ellenőrizzük, hogy van-e találat
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<div class='reservation-block card mb-4'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>Szoba típusa: " . htmlspecialchars($row['szoba_nev']) . "</h5>";
          echo "<p class='card-text'><strong>Felnőttek száma:</strong> " . htmlspecialchars($row['felnottek']) . "</p>";
          echo "<p class='card-text'><strong>Gyerekek száma:</strong> " . htmlspecialchars($row['gyerekek']) . "</p>";
          echo "<p class='card-text'><strong>Bejelentkezés:</strong> " . htmlspecialchars($row['checkin']) . "</p>";
          echo "<p class='card-text'><strong>Kijelentkezés:</strong> " . htmlspecialchars($row['checkout']) . "</p>";

          if ($row['szolgaltatasok']) {
              echo "<p class='card-text'><strong>Szolgáltatások:</strong> " . htmlspecialchars($row['szolgaltatasok']) . "</p>";
              echo "<p class='card-text'><strong>Árak:</strong> " . htmlspecialchars($row['arak']) . " Ft</p>";
          } else {
              echo "<p class='card-text'>Szolgáltatások: Nincsenek.</p>";
          }
          echo "</div>";
          echo "</div>";
      }
  } else {
      echo "<div class='alert alert-info'>Nincsenek foglalásaid.</div>";
  }
  $stmt->close();
  $conn->close();
  ?>
</div>

<footer>
  <?php include 'footer.php'; ?>
</footer>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>