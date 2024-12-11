<?php

session_start();

if (isset($_POST['nick'])) {

  require 'config.php';

  $dsn = "mysql:host=$host;charset=UTF8";

  try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {
      $pdo->query("create database if not exists $db");
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  $nick = $_POST['nick'];
  $accountPassword = $_POST['accountPassword'];

  $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

  try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {

      $query = $pdo->prepare("SELECT * from users where users.username = ?");

      $query->execute([$nick]);

      $row = $query->rowCount();

      if ($row > 0) {

        $fetch = $query->fetch();

        if (password_verify($accountPassword, $fetch['password'])) {
          $_SESSION['loggedUser'] = $fetch['id'];
          $loggedUser = $_SESSION['loggedUser'];

          // Ładowane kategorii przychodu danego użytkownika

          $_SESSION['arrayWithIncomeCategories'] = array();

          $query = $pdo->prepare("SELECT *
                                  FROM incomes_category_assigned_to_users
                                  WHERE incomes_category_assigned_to_users.user_id = ?");
          $query->execute([$loggedUser]);

          $result = $query->fetchAll();

          foreach ($result as $row) {
            array_push($_SESSION['arrayWithIncomeCategories'], array("user_id" => $row['id'], "name" => $row['name']));
          }

          // Ładowane kategorii wydatków danego użytkownika

          $_SESSION['arrayWithExpenseCategories'] = array();

          $query = $pdo->prepare("SELECT *
                                  FROM expenses_category_assigned_to_users
                                  WHERE expenses_category_assigned_to_users.user_id = ?");
          $query->execute([$loggedUser]);

          $result = $query->fetchAll();

          foreach ($result as $row) {
            array_push($_SESSION['arrayWithExpenseCategories'], array("user_id" => $row['id'], "name" => $row['name']));
          }

          // Ładowane sposobów płatności danego użytkownika

          $_SESSION['arrayWithPaymentMethods'] = array();

          $query = $pdo->prepare("SELECT *
                                  FROM payment_methods_assigned_to_users
                                  WHERE payment_methods_assigned_to_users.user_id = ?");
          $query->execute([$loggedUser]);

          $result = $query->fetchAll();

          foreach ($result as $row) {
            array_push($_SESSION['arrayWithPaymentMethods'], array("user_id" => $row['id'], "name" => $row['name']));
          }

          $pdo = null;
          echo "<script>
          alert('Udało Ci się zalogować!');
          window.location.href='./menu.php';
          </script>";
        } else {
          $_SESSION['error'] = 'Nieprawidłowy login lub hasło.';
        }
      } else {
        $_SESSION['error'] = 'Nieprawidłowy login lub hasło.';
      }
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logowanie</title>
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
  <!-- Sign up page -->
  <div class="container main-container align-items-center">
    <div class="col-sm-9 m-auto">
      <div class="sign-up col text-center mt-3 mb-3">
        <h1>Logowanie</h1>
      </div>
      <div class="col">
        <form method="post">
          <div class="col mb-3">
            <label for="exampleInputName" class="form-label">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="exampleInputName" name="nick" />
          </div>
          <div class="col mb-3">
            <label for="exampleInputPassword1" class="form-label">Hasło</label>
            <input
              type="password"
              class="form-control"
              id="exampleInputPassword1"
              name="accountPassword" />
            <div class="error">
              <?php
              if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
              }
              ?>
            </div>
          </div>
          <input type="submit" class="btn btn-primary" value="Zaloguj się">
          <div class="information">
            <p>
              Nie masz jeszcze konta?
              <a href="./sign-up-page.php">Zarejestruj się!</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>