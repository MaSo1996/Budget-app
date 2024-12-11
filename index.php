<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Strona główna</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./style.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
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
            <a class="nav-link active" aria-current="page" href="./index.php">Strona główna</a>
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
            <a class="nav-link" href="./add-expense.php">Dodaj wydatek</a>
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
    <!-- Home-page -->
    <div class="container main-container">
      <div class="col">
        <div class="px-4 pt-5 my-5 text-center border-bottom">
          <h1 class="display-4 fw-bold text-body-emphasis">
            Masz już dość problemów finansowych?
          </h1>
          <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
              Znowu zastał Cię koniec miesiąca i z niepokojem patrzysz na stan
              swojego konta? Możesz łatwo uniknąć takich niespodzianek, jeżeli
              tylko zarejestrujesz się na tej aplikacji! Zacznij ewidencjonować
              swoje wydatki, dbać o swój budżet i oglądaj, jak dzieje się magia!
            </p>
          </div>
          <div class="row">
            <div class="col-sm">
              <a href="./log-in-page.php">
                <button class="btn btn-primary btn-lg px-4 me-sm-3 mb-3">
                  Zaloguj się
                </button></a
              >
              <a href="./sign-up-page.php">
                <button class="btn btn-primary btn-lg px-4 me-sm-3 mb-3">
                  Zarejestruj się
                </button></a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
