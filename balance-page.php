<?php

session_start();

if (!isset($_SESSION['loggedUser'])) {
  header("Location: ./welcome.php");
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
        <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="expandCategory" id="expandCategory" required>
          <option value="" disabled selected>Wybierz okres czasu</option>
          <option value="Jedzenie">Bieżący miesiąc</option>
          <option value="Mieszkanie">Poprzedni miesiąc</option>
          <option value="Transport">Bieżący rok</option>
          <option value="Telekomunikacja">Niestandardowy</option>
        </select>
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
            $query = $pdo->prepare("SELECT incomes.incomeCategory, sum(incomes.amount) FROM incomes WHERE incomes.userId like {$_SESSION['loggedUser']} GROUP by incomes.incomeCategory;");
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
                <td><?php echo $rows['sum(incomes.amount)']; ?></td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
        <!-- <table class="table caption-top expanses">
          <caption>
            Przychody
          </caption>
          <thead>
            <tr>
              <th scope="col">Kategoria przychodu</th>
              <th scope="col">Suma z wybranego okresu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Wynagrodzenie</th>
              <td>6500.00</td>
            </tr>
            <tr>
              <th scope="row">Odsetki bankowe</th>
              <td>123.50</td>
            </tr>
            <tr>
              <th scope="row">Sprzedaż na allegro</th>
              <td>100.00</td>
            </tr>
            <tr>
              <th scope="row">Inne</th>
              <td>50.00</td>
            </tr>
            <tr>
              <th scope="row">Przychody łącznie</th>
              <td>6823,50</td>
            </tr>
          </tbody>
        </table> -->
      </div>
      <div class="col-sm-6 text-center">
        <!-- <table class="table caption-top expanses">
          <caption>
            Wydatki
          </caption>
          <thead>
            <tr>
              <th scope="col">Kategoria wydatku</th>
              <th scope="col">Suma z wybranego okresu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Jedzenie</th>
              <td>400.00</td>
            </tr>
            <tr>
              <th scope="row">Mieszkanie</th>
              <td>1450.00</td>
            </tr>
            <tr>
              <th scope="row">Transport</th>
              <td>300.00</td>
            </tr>
            <tr>
              <th scope="row">Telekomunikacja</th>
              <td>100.00</td>
            </tr>
            <tr>
              <th scope="row">Opieka zdrowotna</th>
              <td>150.00</td>
            </tr>
            <tr>
              <th scope="row">Ubranie</th>
              <td>150.00</td>
            </tr>
            <tr>
              <th scope="row">Higienia</th>
              <td>50.00</td>
            </tr>
            <tr>
              <th scope="row">Dzieci</th>
              <td>0.00</td>
            </tr>
            <tr>
              <th scope="row">Rozrywka</th>
              <td>150.00</td>
            </tr>
            <tr>
              <th scope="row">Wycieczka</th>
              <td>70.00</td>
            </tr>
            <tr>
              <th scope="row">Szkolenia</th>
              <td>1000.00</td>
            </tr>
            <tr>
              <th scope="row">Książki</th>
              <td>25.00</td>
            </tr>
            <tr>
              <th scope="row">Oszczędności</th>
              <td>100.00</td>
            </tr>
            <tr>
              <th scope="row">Na złotą jesień, czyli emeryturę</th>
              <td>100.00</td>
            </tr>
            <tr>
              <th scope="row">Spłata długów</th>
              <td>0.00</td>
            </tr>
            <tr>
              <th scope="row">Darowizna</th>
              <td>0.00</td>
            </tr>
            <tr>
              <th scope="row">Inne wydatki</th>
              <td>150.00</td>
            </tr>
            <tr>
              <th scope="row">Wydatki łącznie</th>
              <td>4195,00</td>
            </tr>
          </tbody>
        </table> -->
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