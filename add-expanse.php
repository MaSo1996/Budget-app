<?php

session_start();

if (!isset($_SESSION['loggedUser'])) {
  header("Location: ./welcome.php");
}

$validationSuccess = true;

if (isset($_POST['amount'])) {

  $amount = str_replace(',','.',$_POST['amount']);
  
  if (!is_numeric($amount)) {
    $_SESSION['eAmount'] = 'Podaj kwotę we właściwym formacie.';
    $validationSuccess = false;
  }

  if (empty($_POST['date'])) {
    $_SESSION['eDate'] = 'Podaj datę wydatku.';
    $validationSuccess = false;
  }

  $loggedUser = $_SESSION['loggedUser'];
  $date = $_POST['date'];
  $comment = $_POST['comment'];
  $paymentMethod = $_POST['paymentMethod'];
  $expandCategory = $_POST['expandCategory'];

  require 'config.php';

  $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

  if ($validationSuccess) {
    try {
      $pdo = new PDO($dsn, $user, $password);

      $pdo->query("CREATE TABLE IF NOT EXISTS expanses
      (
          transactionId int not null AUTO_INCREMENT,
          userId int(255),
          amount float,
          date date,
          comment varchar(255),
          paymentMethod varchar(255),
          expandCategory varchar(255),
          PRIMARY KEY (transactionId)
      )");

      if ($pdo) {
        $query = $pdo->prepare("INSERT INTO expanses VALUES(null,'$loggedUser','$amount','$date','$comment','$paymentMethod','$expandCategory')");
        $query->execute();
        $pdo = null;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dodaj wydatek</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./style.css" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <nav
    class="navbar navbar-expand-sm navbar-dark bg-dark"
    aria-label="Third navbar example">
    <div class="container-fluid">
      <button
        class="navbar-toggler collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarsExample03"
        aria-controls="navbarsExample03"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Strona główna</a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              href="./sign-up-page.php">Rejestracja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./log-in-page.php">Logowanie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./menu.php">Menu główne</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./add-expanse.php">Dodaj wydatek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add-income.php">Dodaj przychód</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <form method="post">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Kwota</label>
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput1"
              placeholder="12.14"
              name="amount" />
            <div class="error">
              <?php

              if (isset($_SESSION['eAmount'])) {
                echo $_SESSION['eAmount'];
                unset($_SESSION['eAmount']);
              }

              ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="dateOfExpanse" class="form-label">Data</label>
            <input
              type="date"
              class="form-control"
              id="dateOfExpanse"
              placeholder="2024.12.12"
              name="date" />
            <div class="error">
              <?php

              if (isset($_SESSION['eDate'])) {
                echo $_SESSION['eDate'];
                unset($_SESSION['eDate']);
              }

              ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Komentarz</label>
            <input
              type="text"
              class="form-control"
              id="comment"
              placeholder="(Opcjonalnie)"
              name="comment" />
          </div>
        </div>
        <div class="row text-center">
          <div class="col">
            <div>
              <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="paymentMethod" id="paymentMethod" required>
                <option value="" disabled selected>Wybierz sposób płatności</option>
                <option value="Gotówka">Gotówka</option>
                <option value="Karta debetowa">Karta debetowa</option>
                <option value="Karta kredytowa">Karta kredytowa</option>
              </select>
            </div>
            <div>
              <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="expandCategory" id="expandCategory" required>
                <option value="" disabled selected>Wybierz kategorię wydatku</option>
                <option value="Jedzenie">Jedzenie</option>
                <option value="Mieszkanie">Mieszkanie</option>
                <option value="Transport">Transport</option>
                <option value="Telekomunikacja">Telekomunikacja</option>
                <option value="Opieka zdrowotna">Opieka zdrowotna</option>
                <option value="Ubranie">Ubranie</option>
                <option value="Higiena">Higiena</option>
                <option value="Dzieci">Dzieci</option>
                <option value="Rozrywka">Rozrywka</option>
                <option value="Wycieczka">Wycieczka</option>
                <option value="Szkolenia">Szkolenia</option>
                <option value="Książki">Książki</option>
                <option value="Na złotą jesień, czyli emeryturę">Na złotą jesień, czyli emeryturę</option>
                <option value="Spłata długów">Spłata długów</option>
                <option value="Darowizna">Darowizna</option>
                <option value="Inne wydatki">Inne wydatki</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-sm">
            <input type="submit" class="yes-button btn btn-primary btn-lg px-4 me-sm-3 mb-3" value="Dodaj wydatek">
            <a href="./menu.php">
              <button type="button" class="no-button btn btn-primary btn-lg px-4 me-sm-3 mb-3">
                Anuluj
              </button>
            </a>
          </div>
        </div>
    </form>
  </div>
</body>

</html>