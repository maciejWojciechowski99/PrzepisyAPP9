<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="strona-glowna">Strona Główna</a>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <a class="nav-link" href="zaloguj-sie">Zaloguj się</a>
                    <a class="nav-link" href="zarejestruj-sie">Zarejestruj się</a>
                <?php else : ?>
                    <span class="nav-link">Witaj <?= htmlspecialchars($_SESSION['user']); ?></span>
                    <a class="nav-link" href="logout.php">Wyloguj się</a>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="nav-link" href="ulubione-przepisy">Ulubione</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="nav-link" href="wylosuj-przepis">Wylosuj</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="nav-link" href="lista-zakupow">Lista zakupów</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a class="nav-link" href="konto-uzytkownika">Konto użytkownika</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
