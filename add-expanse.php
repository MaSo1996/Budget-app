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
            <a class="nav-link" href="./balance-page.php">Przeglądaj bilans</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <form action="">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <div class="mb-3 mt-3">
            <label for="exampleFormControlInput1" class="form-label">Kwota</label>
            <input
              type="number"
              class="form-control"
              id="exampleFormControlInput1"
              placeholder="12.14"
              name="amount" />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data</label>
            <input
              type="date"
              class="form-control"
              id="exampleFormControlInput2"
              placeholder="2024.12.12"
              name="date" />
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Komentarz</label>
            <input
              type="text"
              class="form-control"
              id="exampleFormControlInput2"
              placeholder="(Opcjonalnie)"
              name="comment" />
          </div>
        </div>
        <div class="row text-center">
          <div class="col">
            <div>
              <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="paymentMethod" id="paymentMethod">
                <option value="" disabled selected>Wybierz sposób płatności</option>
                <option value="Gotówka">Gotówka</option>
                <option value="Karta debetowa">Karta debetowa</option>
                <option value="Karta kredytowa">Karta kredytowa</option>
              </select>
            </div>
            <div>
              <select class="btn btn-primary btn-lg px-4 me-sm-3 mb-3" name="expandCategory" id="paymentMethod">
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
            <button class="yes-button btn btn-primary btn-lg px-4 me-sm-3 mb-3">
              Dodaj wydatek</button><button class="no-button btn btn-primary btn-lg px-4 me-sm-3 mb-3">
              Anuluj
            </button>
          </div>
        </div>
    </form>
  </div>
</body>

</html>