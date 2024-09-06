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
            <a
              class="nav-link"
              href="./sign-up-page.php"
              >Rejestracja</a
            >
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
            <a class="nav-link" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Kwota</label
            >
            <input
              type="number"
              class="form-control"
              id="exampleFormControlInput1"
              placeholder="12.14"
            />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Data</label
            >
            <input
              type="date"
              class="form-control"
              id="exampleFormControlInput2"
              placeholder="2024.12.12"
            />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"
              >Komentarz</label
            >
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput2"
              placeholder="(Opcjonalnie)"
            />
          </div>
        </div>
        <div class="px-4 pt-3 pb-3 text-center">
          <div class="dropdown">
            <button
              class="btn btn-primary btn-lg px-4 me-sm-3 mb-3 dropdown-toggle"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Wybierz sposób płatności
            </button>
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item" type="button">Gotówka</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Karta debetowa
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Karta kredytowa
                </button>
              </li>
            </ul>
          </div>
          <div class="dropdown">
            <button
              class="btn btn-primary btn-lg px-4 me-sm-3 dropdown-toggle"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Wybierz rodzaj wydatku
            </button>
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item" type="button">Jedzenie</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Mieszkanie</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Transport</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Telekomunikacja
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Opieka zdrowotna
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Ubranie</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Higienia</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Dzieci</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Rozrywka</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Wycieczka</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Szkolenia</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Książki</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Oszczędności
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Na złotą jesień, czyli emeryturę
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Spłata długów
                </button>
              </li>
              <li>
                <button class="dropdown-item" type="button">Darowizna</button>
              </li>
              <li>
                <button class="dropdown-item" type="button">
                  Inne wydatki
                </button>
              </li>
            </ul>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-sm">
            <button class="yes-button btn btn-primary btn-lg px-4 me-sm-3 mb-3">
              Dodaj wydatek</button
            ><button class="no-button btn btn-primary btn-lg px-4 me-sm-3 mb-3">
              Anuluj
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
