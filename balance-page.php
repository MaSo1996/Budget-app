<?php

session_start();

if (!isset($_SESSION['loggedUser'])) {
  header("Location: ./welcome.php");
}

$validationSuccess = false;

if (isset($_POST['timePeriod'])) {
  $timePeriod = $_POST['timePeriod'];
  $currentDate = getdate();

  if ($timePeriod == "currentMonth") {
    $beginDateYear = $currentDate['year'];
    $beginDateMonth = $currentDate['mon'];

    if ($beginDateMonth == 12) {
      $endDateYear = $beginDateYear + 1;
      $endDateMonth = 1;
    } else {
      $endDateYear = $beginDateYear;
      $endDateMonth = $beginDateMonth + 1;
    }

    $beginOfTimePeriod = $beginDateYear . "-" . $beginDateMonth . "-" . "01";
    $endOfTimePeriod = $endDateYear . "-" . $endDateMonth . "-" . "01";
  } else if ($timePeriod == 'previousMonth') {
    if ($currentDate['mon'] == 1) {
      $beginDateMonth = 12;
      $beginDateYear = $currentDate['year'] - 1;
    } else {
      $beginDateMonth = $currentDate['mon'] - 1;
      $beginDateYear = $currentDate['year'];
    }

    $endDateMonth = $currentDate['mon'];
    $endDateYear = $currentDate['year'];

    $beginOfTimePeriod = $beginDateYear . "-" . $beginDateMonth . "-" . "01";
    $endOfTimePeriod = $endDateYear . "-" . $endDateMonth . "-" . "01";
  } else if ($timePeriod == 'currentYear') {
    $endDateYear = $currentDate['year'] + 1;

    $beginOfTimePeriod = $currentDate['year'] . "-" . "01" . "-" . "01";
    $endOfTimePeriod = $endDateYear . "-" . "01" . "-" . "01";
  } else if ($timePeriod == 'custom') {
    $beginOfTimePeriod = $_POST['beginOfTimePeriod'];
    if (empty($beginOfTimePeriod)) {
      $_SESSION['eBeginOfTimePeriod'] = "Podaj poprawną datę";
      $validationSuccess = false;
    } else {
      $_SESSION['frBeginOfTimePeriod'] = $beginOfTimePeriod;
    }

    $endOfTimePeriod = $_POST['endOfTimePeriod'];
    if (empty($endOfTimePeriod)) {
      $_SESSION['eEndOfTimePeriod'] = "Podaj poprawną datę";
      $validationSuccess = false;
    } else {
      $_SESSION['frEndOfTimePeriod'] = $endOfTimePeriod;
      $endOfTimePeriodAsTimestamp = strtotime($endOfTimePeriod) + 86400;
      $endOfTimePeriod = date("Y-m-d", $endOfTimePeriodAsTimestamp);
    }
  }

  $validationSuccess = true;

  $_SESSION['frTimePeriod'] = $timePeriod;
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
  <script type="text/javascript" src="./canvasjs/canvasjs-chart-3.10.16/canvasjs.min.js"></script>
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
            <a class="nav-link" href="./menu.php">Menu główne</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add-expense.php">Dodaj wydatek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add-income.php">Dodaj przychód</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./log-out.php">Wyloguj się</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="col text-end mt-3">
      <form method="post">
        <div>
          <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="timePeriod" id="timePeriod" required onchange="showAnotherDiv()">
            <?php

            $arrayWithTimePeriods = array(
              array('key' => 'Bieżący miesiąc', 'value' => 'currentMonth'),
              array('key' => 'Poprzedni miesiąc', 'value' => 'previousMonth'),
              array('key' => 'Bieżący rok', 'value' => 'currentYear'),
              array('key' => 'Niestandardowy', 'value' => 'custom')
            );

            if (isset($_SESSION['frTimePeriod'])) {
              echo '<option value="" disabled>Wybierz okres czasu</option>';
              foreach ($arrayWithTimePeriods as $row) {
                if ($_SESSION['frTimePeriod'] == $row['value']) {
                  echo '<option value="' . $row['value'] . '" selected>' . $row['key'] . '</option>';
                } else {
                  echo '<option value="' . $row['value'] . '" >' . $row['key'] . '</option>';
                }
              }
              unset($_SESSION['frTimePeriod']);
            } else {
              echo '<option value="" selected disabled >Wybierz okres czasu</option>';
              foreach ($arrayWithTimePeriods as $row) {
                echo '<option value="' . $row['value'] . '" >' . $row['key'] . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <?php if (isset($timePeriod) && $timePeriod == 'custom') {
          echo '<div id="divToDisplay">';
        } else {
          echo '<div id="divToDisplay" hidden>';
        }
        ?>
        <div class="col">
          <div class="row mb-3 justify-content-end text-center">
            <div class="col-3">
              <label for="beginOfTimePeriod" class="form-label">Data początkowa</label>
              <input value="<?php if (isset($_SESSION['frBeginOfTimePeriod'])) {
                              echo $_SESSION['frBeginOfTimePeriod'];
                              unset($_SESSION['frBeginOfTimePeriod']);
                            } ?>"
                type="date"
                class="form-control"
                id="beginOfTimePeriod"
                name="beginOfTimePeriod" />
              <p class="error">
                <?php
                if (isset($_SESSION['eBeginOfTimePeriod'])) {
                  echo ($_SESSION['eBeginOfTimePeriod']);
                  unset($_SESSION['eBeginOfTimePeriod']);
                }
                ?>
              </p>
            </div>
            <div class="col-3">
              <label for="endOfTimePeriod" class="form-label">Data końcowa</label>
              <input value="<?php if (isset($_SESSION['frEndOfTimePeriod'])) {
                              echo $_SESSION['frEndOfTimePeriod'];
                              unset($_SESSION['frEndOfTimePeriod']);
                            } ?>"
                type="date"
                class="form-control"
                id="endOfTimePeriod"
                name="endOfTimePeriod" />
              <p class="error">
                <?php
                if (isset($_SESSION['eEndOfTimePeriod'])) {
                  echo ($_SESSION['eEndOfTimePeriod']);
                  unset($_SESSION['eEndOfTimePeriod']);
                }
                ?>
              </p>
            </div>
          </div>
        </div>
    </div>
    <div>
      <input type="submit" class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" value="Wyświetl bilans">
    </div>
    </form>
  </div>
  <div class="row">
    <div class="col-sm-6 text-center">
      <?php
      if ($validationSuccess) {
        require_once 'config.php';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
          $pdo = new PDO($dsn, $user, $password);

          if ($pdo) {

            $query = $pdo->prepare("SELECT incomes.income_category_assigned_to_user_id, incomes.user_id, incomes_category_assigned_to_users.name as 'Income Category', SUM(incomes.amount) as 'Sum of Incomes'
                                    FROM incomes
                                    LEFT JOIN incomes_category_assigned_to_users
                                    ON incomes_category_assigned_to_users.id = incomes.id
                                    WHERE incomes.user_id = ? and incomes.date_of_income >= ? and incomes.date_of_income < ?
                                    GROUP BY incomes_category_assigned_to_users.name
                                    ORDER BY 'Sum of Incomes' DESC");
            $query->execute([$_SESSION['loggedUser'], $beginOfTimePeriod, $endOfTimePeriod]);

            $arrayWithIncomes = array();
            $dataPointsWithIncomes = array();

            $result = $query->fetchAll();

            foreach ($result as $row) {
              array_push($arrayWithIncomes, array("Income Category" => $row['Income Category'], "Sum of Incomes" => $row['Sum of Incomes']));
              array_push($dataPointsWithIncomes, array("label" => $row['Income Category'], "y" => $row['Sum of Incomes']));
            }
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
            foreach ($result as $row) {
            ?>
              <tr>
                <td><?php echo $row['Income Category']; ?></td>
                <td><?php echo $row['Sum of Incomes']; ?></td>
              </tr>
            <?php
            } ?>
          </tbody>
        </table>
    </div>
    <div class="col-sm-6 text-center">
      <?php

        require_once 'config.php';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
          $pdo = new PDO($dsn, $user, $password);

          if ($pdo) {

            $query = $pdo->prepare("SELECT expenses.expense_category_assigned_to_user_id, expenses.user_id, expenses_category_assigned_to_users.name as 'Expense Category', SUM(expenses.amount) as 'Sum of Expenses'
                                    FROM expenses
                                    LEFT JOIN expenses_category_assigned_to_users
                                    ON expenses_category_assigned_to_users.id = expenses.id
                                    WHERE expenses.user_id = ? and expenses.date_of_expense >= ? and expenses.date_of_expense < ?
                                    GROUP BY expenses_category_assigned_to_users.name
                                    ORDER BY 'Sum of Expenses' DESC");
            $query->execute([$_SESSION['loggedUser'], $beginOfTimePeriod, $endOfTimePeriod]);

            $arrayWithExpanses = array();
            $dataPointsWithExpanses = array();

            $result = $query->fetchAll();

            foreach ($result as $row) {
              array_push($arrayWithExpanses, array("Expense Category" => $row['Expense Category'], "Sum of Expenses" => $row['Sum of Expenses']));
              array_push($dataPointsWithExpanses, array("label" => $row['Expense Category'], "y" => $row['Sum of Expenses']));
            }
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
          foreach ($result as $row) {
          ?>
            <tr>
              <td><?php echo $row['Expense Category']; ?></td>
              <td><?php echo $row['Sum of Expenses']; ?></td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php

        require_once 'config.php';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
          $pdo = new PDO($dsn, $user, $password);

          if ($pdo) {
            $query = $pdo->prepare("SELECT incomes.user_id, sum(incomes.amount) as 'Amount of incomes'
                                      FROM incomes
                                      WHERE incomes.user_id = ? and incomes.date_of_income >= ? and incomes.date_of_income < ?
                                      GROUP BY incomes.user_id");
            $query->execute([$_SESSION['loggedUser'], $beginOfTimePeriod, $endOfTimePeriod]);
            $rows = $query->fetch();
            if ($rows) {
              $sumOfIncomes = $rows['Amount of incomes'];
            } else {
              $sumOfIncomes = 0;
            }

            $query = $pdo->prepare("SELECT expenses.user_id, sum(expenses.amount) as 'Amount of expenses'
                                      FROM expenses
                                      WHERE expenses.user_id = ? and expenses.date_of_expense >= ? and expenses.date_of_expense < ?
                                      GROUP BY expenses.user_id");
            $query->execute([$_SESSION['loggedUser'], $beginOfTimePeriod, $endOfTimePeriod]);
            $rows = $query->fetch();
            if ($rows) {
              $sumOfExpanses = $rows['Amount of expenses'];
            } else {
              $sumOfExpanses = 0;
            }

            $balance = $sumOfIncomes - $sumOfExpanses;
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }

  ?>
  <div class="row text-center">
    <p>Bilans z wybranego okresu: </p>
    <p class="difference">
      <?php
        echo $balance;
      ?>
    </p>
    <?php
        if ($balance > 0) { ?>
      <p class="positive-message">Gratulacje! Świetnie zarządzasz swoim budżetem!</p>
    <?php } else if ($balance < 0) { ?>
      <p class="negative-message">Uważaj! Twoje wydatki są większe niż wpływy!</p>'
    <?php } else if ($balance == 0) { ?>
      <p class="neutral-message">Twoje wpływy i wydatki się blilansują.</p>'
  <?php }
      }
  ?>
  </div>
  <div class="row">
    <?php if (!empty($dataPointsWithIncomes)) { ?>
      <div class="col-sm-6">
        <div id="chartWithIncomes" style="width: 100%; min-height: 450px"></div>
      </div>
    <?php } ?>
    <?php if (!empty($dataPointsWithExpanses)) { ?>
      <div class="col-sm-6">
        <div id="chartWithExpanses" style="width: 100%; min-height: 450px"></div>
      </div>
    <?php } ?>
  </div>
  </div>
  <script src="./script.js"></script>

  <script>
    window.onload = function() {
      var chart = new CanvasJS.Chart("chartWithExpanses", {
        theme: "light2",
        animationEnabled: true,
        title: {
          text: "Wydatki w podziale na kategorie dla wybranego okresu"
        },
        data: [{
          type: "pie",
          indexLabel: "{y}",
          yValueFormatString: "#,##0.00 PLN",
          indexLabelPlacement: "inside",
          indexLabelFontColor: "#36454F",
          indexLabelFontSize: 18,
          indexLabelFontWeight: "bolder",
          showInLegend: true,
          legendText: "{label}",
          dataPoints: <?php echo json_encode($dataPointsWithExpanses, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();

      var chart = new CanvasJS.Chart("chartWithIncomes", {
        theme: "light2",
        animationEnabled: true,
        title: {
          text: "Przychody w podziale na kategorie dla wybranego okresu"
        },
        data: [{
          type: "pie",
          indexLabel: "{y}",
          yValueFormatString: "#,##0.00 PLN",
          indexLabelPlacement: "inside",
          indexLabelFontColor: "#36454F",
          indexLabelFontSize: 18,
          indexLabelFontWeight: "bolder",
          showInLegend: true,
          legendText: "{label}",
          dataPoints: <?php echo json_encode($dataPointsWithIncomes, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
    }
  </script>
</body>

</html>