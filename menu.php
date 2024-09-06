<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <nav
      class="navbar navbar-expand-sm navbar-dark bg-dark"
      aria-label="Third navbar example"
    >
      <div class="container-fluid">
        <button
          class="navbar-toggler collapsed"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarsExample03"
          aria-controls="navbarsExample03"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
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
              <a class="nav-link" href="./log-in-page.php">Logowanie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./menu.php"
                >Menu główne</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./add-expanse.php">Dodaj wydatek</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./balance-page.php"
                >Przeglądaj bilans</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main-menu -->
    <div class="container main-container">
      <div class="col">
        <div class="px-4 pt-5 my-5 text-center border-bottom">
          <h1 class="display-4 fw-bold text-body-emphasis">Menu główne</h1>
          <div class="col mx-auto">
            <div class="row">
              <div class="col-sm">
                <a href="">
                  <button
                    type="button"
                    class="btn btn-primary btn-lg px-4 me-sm-3 mb-3"
                  >
                    Dodaj przychód
                  </button>
                </a>
                <a href="./add-expanse.php">
                  <button
                    type="button"
                    class="btn btn-primary btn-lg px-4 me-sm-3 mb-3"
                  >
                    Dodaj wydatek
                  </button>
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm">
                <a href="./balance-page.php">
                  <button
                    type="button"
                    class="btn btn-primary btn-lg px-4 me-sm-3 mb-3"
                  >
                    Przeglądaj bilans
                  </button>
                </a>
                <a href="">
                  <button
                    type="button"
                    class="btn btn-primary btn-lg px-4 me-sm-3 mb-3"
                  >
                    Ustawienia
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
