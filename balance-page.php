<?php

session_start();

if (!isset($_SESSION['loggedUser'])) {
  header("Location: ./welcome.php");
}

if (isset($_POST['timePeriod'])) {
  $timePeriod = $_POST['timePeriod'];
  $currentDate = getdate();
  if ($timePeriod === "currentMonth") {
    $yearToDisplay = $currentDate['year'];
    $monthToDisplay = $currentDate['mon'];
  } else if ($timePeriod === 'previousMonth') {
    $yearToDisplay = $currentDate['year'];
    if ($currentDate['mon'] === 1) {
      $monthToDisplay = 12;
    } else {
      $monthToDisplay = $currentDate['mon'] - 1;
    }
  } else if ($timePeriod === 'currentYear') {
    $yearToDisplay = $currentDate['year'];
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Przeglądaj bilans</title>
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
  <script
    type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://www.google.com/jsapi"></script>
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
            <a class="nav-link" href="./add-expanse.php">Dodaj wydatek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add-income.php">Dodaj przychód</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="col text-end mt-3">
      <div>
        <form method="post">
          <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="timePeriod" id="timePeriod" onchange="showAnotherDiv()" required>
            <option value="" disabled selected>Wybierz okres czasu</option>
            <option value="currentMonth">Bieżący miesiąc</option>
            <option value="previousMonth">Poprzedni miesiąc</option>
            <option value="currentYear">Bieżący rok</option>
            <option value="custom">Niestandardowy</option>
          </select>
        </form>
      </div>
      <div id="divToDisplay">
        <div class="col">
          <div class="row mb-3 justify-content-end text-center">
            <div class="col-3">
              <label for="beginOfTimePeriod" class="form-label">Data początkowa</label>
              <input
                type="date"
                class="form-control"
                id="beginOfTimePeriod"
                name="beginOfTimePeriod" />
            </div>
            <div class="col-3">
              <label for="endOfTimePeriod" class="form-label">Data końcowa</label>
              <input
                type="date"
                class="form-control"
                id="endOfTimePeriod"
                name="endOfTimePeriod" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 text-center">
        <?php

        require 'config.php';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
          $pdo = new PDO($dsn, $user, $password);

          if ($pdo) {

            $pdo->query("CREATE TABLE IF NOT EXISTS incomes
            (
                transactionId int not null AUTO_INCREMENT,
                userId int(255),
                amount float,
                date date,
                comment varchar(255),
                incomeCategory varchar(255),
                PRIMARY KEY (transactionId)
            )");

            $query = $pdo->prepare("SELECT incomes.incomeCategory, round(sum(incomes.amount),2) FROM incomes WHERE incomes.userId like {$_SESSION['loggedUser']} GROUP by incomes.incomeCategory;");
            $query->execute();
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }

        ?>
        <table class="table">
          <thead>
            <tr>
              <th>Kategoria przychodu</th>
              <th>Suma przychodów</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($rows = $query->fetch()) {
            ?>
              <tr>
                <td><?php echo $rows['incomeCategory']; ?></td>
                <td><?php echo $rows['round(sum(incomes.amount),2)']; ?></td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
      </div>
      <div class="col-sm-6 text-center">
        <?php

        require 'config.php';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
          $pdo = new PDO($dsn, $user, $password);

          if ($pdo) {

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

            $query = $pdo->prepare("SELECT expanses.expandCategory, round(sum(expanses.amount),2) FROM expanses WHERE expanses.userId like {$_SESSION['loggedUser']} GROUP by expanses.expandCategory;");
            $query->execute();
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }

        ?>
        <table class="table">
          <thead>
            <tr>
              <th>Kategoria wydatku</th>
              <th>Suma wydatków</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($rows = $query->fetch()) {
            ?>
              <tr>
                <td><?php echo $rows['expandCategory']; ?></td>
                <td><?php echo $rows['round(sum(expanses.amount),2)']; ?></td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row text-center">
      <p>Bilans z wybranego okresu: </p>
      <p class="difference">2628,5</p>
      <p class="positive-message">Gratulacje! Świetnie zarządzasz swoim budżetem!</p>
    </div>
    <div class="row">
      <div class="col">
        <div id="piechart_3d" style="width: 100%; min-height: 450px"></div>
      </div>
    </div>
  </div>
  <script src="./script.js"></script>
</body>

</html>