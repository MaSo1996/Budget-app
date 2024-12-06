<?php

session_start();

if (isset($_POST['email'])) {
  $validationSuccess = true;

  $nick = $_POST['nick'];

  if (strlen($nick) < 3 || strlen($nick) > 20) {
    $validationSuccess = false;
    $_SESSION['eNick'] = "Nick musi posiadać od 3 do 20 znaków.";
  }

  if (ctype_alnum($nick) == false) {
    $validationSuccess = false;
    $_SESSION['eNick'] = "Nick może się składać tylko z liter i cyfr (bez polskich znaków).";
  }

  $email = $_POST['email'];
  $emailFiltered = filter_var($email, FILTER_SANITIZE_EMAIL);

  if (filter_var($emailFiltered, FILTER_VALIDATE_EMAIL) == false || $emailFiltered !== $email) {
    $validationSuccess = false;
    $_SESSION['eEmail'] = "Podaj poprawny adres email.";
  }

  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if (strlen($password1) < 8 || strlen($password1) > 20) {
    $validationSuccess = false;
    $_SESSION['ePassword'] = "Hasło musi posiadać od 8 do 20 znaków.";
  }

  if ($password1 !== $password2) {
    $validationSuccess = false;
    $_SESSION['ePassword'] = "Podane hasła nie są identyczne.";
  }

  $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

  $_SESSION['frNick'] = $nick;
  $_SESSION['frEmail'] = $email;
  $_SESSION['frPassword1'] = $password1;
  $_SESSION['frPassword2'] = $password2;

  require 'config.php';

  $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

  try {
    $pdo = new PDO($dsn, $user, $password);

    if ($pdo) {

      $whatToLookFor = $pdo->prepare("SELECT users.email from users where users.email = ?");
      $whatToLookFor->execute([$email]);

      $howManyEmails = $whatToLookFor->rowCount();

      if ($howManyEmails !== 0) {
        $validationSuccess = false;
        $_SESSION['eEmail'] = "Istnieje już konto przypisane do tego adresu e-mail.";
      }

      $whatToLookFor = $pdo->prepare("SELECT users.username from users where users.username = ?");
      $whatToLookFor->execute([$nick]);

      $howManyNicks = $whatToLookFor->rowCount();

      if ($howManyNicks !== 0) {
        $validationSuccess = false;
        $_SESSION['eNick'] = "Istnieje już konto z takim nickiem.";
      }

      if ($validationSuccess) {
        $query = $pdo->prepare("INSERT INTO users VALUES(?, ?, ?, ?)");
        $query->execute([null, $nick, $passwordHash, $email]);
        $_SESSION['registrationSuccessfull'] = true;

        $query = $pdo->prepare("SELECT users.id FROM users WHERE users.username = ?");
        $query->execute([$nick]);

        $result = $query->fetch();
        $userId = $result[0];

        $query = $pdo->prepare("INSERT INTO expenses_category_assigned_to_users (expenses_category_assigned_to_users.id, expenses_category_assigned_to_users.user_id, expenses_category_assigned_to_users.name)
                                SELECT expenses_category_default.id, ?, expenses_category_default.name
                                FROM expenses_category_default");

        $query->execute([$userId]);

        $pdo = null;

        header('Location: ./welcome.php');
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
  <title>Rejestracja</title>
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
  <!-- Navigation-bar -->
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
              class="nav-link active"
              aria-current="page"
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
            <a class="nav-link" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Sign up page -->
  <div class="container main-container align-items-center">
    <div class="col-sm-9 m-auto">
      <div class="sign-up col text-center mt-3 mb-3">
        <h1>Rejestracja</h1>
      </div>
      <div class="col">
        <form method="post">
          <div class="col mb-3">
            <label for="exampleInputEmail1" class="form-label">Adres email</label>
            <input
              type="email"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              name="email"
              value="<?php
                      if (isset($_SESSION['frEmail'])) {
                        echo ($_SESSION['frEmail']);
                        unset($_SESSION['frEmail']);
                      } ?>" />
            <div class="error">
              <?php
              if (isset($_SESSION['eEmail'])) {
                echo $_SESSION['eEmail'];
                unset($_SESSION['eEmail']);
              }
              ?>
            </div>

          </div>
          <div class="col mb-3">
            <label for="exampleInputName" class="form-label">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="exampleInputName" name="nick"
              value="<?php
                      if (isset($_SESSION['frNick'])) {
                        echo ($_SESSION['frNick']);
                        unset($_SESSION['frNick']);
                      } ?>" />
            <div class="error">
              <?php
              if (isset($_SESSION['eNick'])) {
                echo $_SESSION['eNick'];
                unset($_SESSION['eNick']);
              }
              ?>
            </div>
          </div>
          <div class="col mb-3">
            <label for="exampleInputPassword1" class="form-label">Hasło</label>
            <input
              type="password"
              class="form-control"
              id="exampleInputPassword1"
              name="password1"
              value="<?php
                      if (isset($_SESSION['frPassword1'])) {
                        echo ($_SESSION['frPassword1']);
                        unset($_SESSION['frPassword1']);
                      } ?>" />
            <div class="error">
              <?php
              if (isset($_SESSION['ePassword'])) {
                echo $_SESSION['ePassword'];
                unset($_SESSION['ePassword']);
              }
              ?>
            </div>

          </div>
          <div class="col mb-3">
            <label for="exampleInputPassword2" class="form-label">Powtórz hasło</label>
            <input
              type="password"
              class="form-control"
              id="exampleInputPassword2"
              name="password2"
              value="<?php
                      if (isset($_SESSION['frPassword2'])) {
                        echo ($_SESSION['frPassword2']);
                        unset($_SESSION['frPassword2']);
                      } ?>" />
            <div class="error">
              <?php
              if (isset($_SESSION['ePassword'])) {
                echo $_SESSION['ePassword'];
                unset($_SESSION['ePassword']);
              }
              ?>
            </div>

          </div>
          <input type="submit" class="btn btn-primary" value="Zarejestruj się">
          <div class="information">
            <p>
              Masz już konto?
              <a href="./log-in-page.php">Zaloguj się!</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>