<?php

	session_start();
	
	if (!isset($_SESSION['registrationSuccessfull']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationSuccessfull']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['frEmail'])) unset($_SESSION['frEmail']);
	if (isset($_SESSION['frNick'])) unset($_SESSION['frNick']);
	if (isset($_SESSION['frPassword1'])) unset($_SESSION['frPassword1']);
	if (isset($_SESSION['frPassword2'])) unset($_SESSION['frPassword2']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['eEmail'])) unset($_SESSION['eEmail']);
	if (isset($_SESSION['eNick'])) unset($_SESSION['eNick']);
	if (isset($_SESSION['ePassword'])) unset($_SESSION['ePassword']);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Strona powitalna</title>
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
            <a class="nav-link" href="./sign-up-page.php">Rejestracja</a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link active"
              aria-current="page"
              href="./log-in-page.php">Logowanie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./menu.php">Menu główne</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add-expanse.php">Dodaj wydatek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Welcome page -->
  <div class="container main-container align-items-center">
    <div class="col px-4 pt-5 my-5 text-center border-bottom">
      <div class="display-4 fw-bold text-body-emphasis">
        <h1>Gratulacje!</h1>
      </div>
      <p>Twoje konto zostało założone - zrobiłeś właśnie pierwszy krok, aby polepszyć swoje finanse! Możesz się już zalogować na swoje konto.</p>
      <a href="./log-in-page.php">
        <button class="btn btn-primary btn-lg px-4 me-sm-3 mb-3">
          Zaloguj się
        </button></a>
    </div>
  </div>
</body>

</html>