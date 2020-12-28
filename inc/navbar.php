<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Xmon.cf - CookBook 🥘</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Strona Główna</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="search.php">Przepisy</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Inne
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Kalkulator kalorii</a></li>
                  <li><a class="dropdown-item" href="#">Kalkulator BMI</a></li>
                </ul>
              </li>
              <?php 
                if($logged) {
                  echo('              <li class="nav-item">
                  <a class="nav-link" href="edit.php" style="color: green;">Dodaj nowy przepis&nbsp;<i class="fas fa-plus" style="color: green;"></i></a>
                </li>');
                }
              ?>
            </ul>
            <form class="d-flex" action="search.php" method="POST">
              <input class="form-control me-2" type="search" placeholder="Szukaj przepisu.." aria-label="Search" id="search" name="search">
              <button class="btn btn-outline-success" type="submit">Szukaj</button>
            </form>
            <?php 
              if($logged) {
                echo('&nbsp;<i class="fas fa-user" style="color: black"></i>&nbsp;<a href="#" style="color: green;" data-bs-toggle="tooltip" title="Email: '.$_SESSION['email'].'">Zalogowany</a>&nbsp;&nbsp;<a href="index.php?logout=1" style="color: red">Wyloguj!</a>');
              }else{
                echo('&nbsp;<i class="fas fa-user" style="color: black"></i>&nbsp;<a href="login.php" style="color: red">Zaloguj</a>&nbsp;<a href="register.php" style="color: green">Zarejestruj</a>');
              }
              ?>
          </div>
        </div>
      </nav>