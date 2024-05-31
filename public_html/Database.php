<?php

class Database
{
    protected $dbname = 'przepisy';
    protected $dbhost = 'mysql';
    protected $dbuser = 'root';
    protected $dbpass = 'root';
    
    
    public function connection() : PDO
    {
        return new PDO("mysql:dbname=$this->dbname;host=$this->dbhost", $this->dbuser, $this->dbpass);
    }

    // Funkcja dodająca nowy przepis użytkownika do bazy danych
    public function addRecipe(string $tytul, string $opis, int $user_id, string $csrf_token) : bool
{
        $pdo = $this->connection();
        $stmt = $pdo->prepare("INSERT INTO przepisy_dodane (user_id, tytul, opis, przepis_uzytkownika)
                               VALUES (:user_id, :tytul, :opis, :przepis_uzytkownika)
                               ON DUPLICATE KEY UPDATE
                               tytul = VALUES(tytul), opis = VALUES(opis), przepis_uzytkownika = VALUES(przepis_uzytkownika)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':tytul', $tytul, PDO::PARAM_STR);
        $stmt->bindParam(':opis', $opis, PDO::PARAM_STR);
        $stmt->bindParam(':przepis_uzytkownika', $_SESSION['user'], PDO::PARAM_STR);
        return $stmt->execute();
}

    // Funkcja pobierająca wpis o przepisie z bazy danych na podstawie ID
    public function getEntryById(int $id)
    {
        $pdo = $this->connection();
        $sql = "SELECT * FROM przepisy_dodane WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Funkcja aktualizująca wpis o przepisie w bazie danych
    public function updateEntry(int $id, string $tytul, string $opis) : bool
    {
        $pdo = $this->connection();
        $sql = "UPDATE przepisy_dodane SET tytul = ?, opis = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$tytul, $opis, $id]);
    }

    // Funkcja pobierająca listę wpisów o przepisach z bazy danych
    public function getEntries(int $limit = null) : PDOStatement|false
    {
        $pdo = $this->connection();
        $przepis_uzytkownika = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if ($przepis_uzytkownika !== null) {
            $sql = $limit > 0 ? "SELECT * FROM przepisy_dodane WHERE przepis_uzytkownika = ? ORDER BY id DESC LIMIT $limit" : "SELECT * FROM przepisy_dodane WHERE przepis_uzytkownika = ? ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$przepis_uzytkownika]);

            return $stmt;
        } else {
            return false;
        }
    }

    // Funkcja usuwająca wpis o przepisie z bazy danych na podstawie ID
    public function deleteEntry(int $id) : bool
    {
        $pdo = $this->connection();
        $sql = "DELETE FROM przepisy_dodane WHERE id = ?";
        return $pdo->prepare($sql)->execute([$id]);
    }

    // Funkcje pobierające informacje o autorze, tytule przepisu na podstawie ID
    public function getAuthorById(int $id) : ?string
    {
        $pdo = $this->connection();
        $sql = "SELECT opis FROM przepisy_dodane WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        return $result ? $result : null;
    }

    public function getTitleById(int $id) : ?string
    {
        $pdo = $this->connection();
        $sql = "SELECT tytul FROM przepisy_dodane WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchColumn();
        return $result ? $result : null;
    }

     // Funkcje obsługujące dodawanie, weryfikację użytkowników
     public function addUser(string $login, string $haslo, string $email, $kod_aktywacyjny) : bool
     {
         $pdo = $this->connection();
         $sql = "INSERT INTO uzytkownicy (login, haslo, email, kod_aktywacyjny) VALUES (?, ?, ?, ?)";
         $stmt = $pdo->prepare($sql);
         $kod_aktywacyjny = $kod_aktywacyjny ?? null;
     
         return $stmt->execute([$login, $haslo, $email, $kod_aktywacyjny]);
     }
     

    public function verifyLogin(string $login, string $password) : bool
    {
        $pdo = $this->connection();
        $sql = "SELECT id, haslo FROM uzytkownicy WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && password_verify($password, $userData['haslo'])) {
            $_SESSION['user'] = $login;
            $_SESSION['user_id'] = (int)$userData['id'];
            echo "<div class='container mt-4 alert alert-success'>Cześć $login! <a href='strona-glowna'>kliknij tutaj</a>, aby przejść na stronę główną i dodać przepisy!</div>";
            exit();

            return true; 
        } else {
            return false;
        }
    }
    

    // Funkcje sprawdzające dostępność loginu w bazie danych
    public function isLoginTaken(string $login) : bool
    {
        $pdo = $this->connection();
        $sql = "SELECT COUNT(*) FROM uzytkownicy WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    // Funkcje sprawdzające adresu email w bazie danych
    public function isEmailTaken(string $email) : bool
    {
        $pdo = $this->connection();
        $sql = "SELECT COUNT(*) FROM uzytkownicy WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

   // Funkcje pobierające informacje o użytkowniku na podstawie loginu
    public function getUserInfo(string $login)
    {
        $pdo = $this->connection();
        $sql = "SELECT * FROM uzytkownicy WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Funkcje obsługujące dodawanie przepisu do ulubionych
    public function addToFavorites(int $recipeId) : bool
    {
        $pdo = $this->connection();
        $sql = "UPDATE przepisy_dodane SET ulubione_przepisy = 1 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$recipeId]);
    }

    // Funkcje pobierające listę ulubionych przepisów
    public function getFavoriteEntries(int $limit = null) : PDOStatement|false
    {
        $pdo = $this->connection();
        $przepis_uzytkownika = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if ($przepis_uzytkownika !== null) {
            $sql = $limit > 0 ? "SELECT * FROM przepisy_dodane WHERE przepis_uzytkownika = ? AND ulubione_przepisy = 1 ORDER BY id DESC LIMIT $limit" : "SELECT * FROM przepisy_dodane WHERE przepis_uzytkownika = ? AND ulubione_przepisy = 1 ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$przepis_uzytkownika]);

            return $stmt;
        } else {
            return false;
        }
    }

    // Funkcja usuwająca przepis z ulubionych na podstawie ID
    public function removeFromFavorites(int $id) : bool
    {
        $pdo = $this->connection();
        $sql = "UPDATE przepisy_dodane SET ulubione_przepisy = 0 WHERE id = ?";
        return $pdo->prepare($sql)->execute([$id]);
    }

    public function getUserPasswordById(int $userId) : ?string
    {
        $pdo = $this->connection();
        $sql = "SELECT haslo FROM uzytkownicy WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetchColumn();
        return $result;
    }

    // Funkcja aktualizająca hasło
    public function updateUserPassword(int $userId, string $newPassword, string $currentPassword) : bool
    {
        $pdo = $this->connection();
        $currentPasswordFromDB = $this->getUserPasswordById($userId);
        if (password_verify($currentPassword, $currentPasswordFromDB)) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE uzytkownicy SET haslo = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$hashedNewPassword, $userId]);
        } else {
            return false; 
        }
    }

    // Funkcja pobierająca liczbę aktualnych przepisów dla danego użytkownika
    public function getNumberOfRecipes(string $login) : int
    {
        $pdo = $this->connection();
        $sql = "SELECT COUNT(*) FROM przepisy_dodane WHERE przepis_uzytkownika = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);
        return (int)$stmt->fetchColumn();
    }

    // Funkcja sumująca wszystkie przepisy dodane przes użytkownika
    public function getSumOfFavRecipes(string $login): int
    {
        $pdo = $this->connection();
        $sql = "SELECT SUM(ulubione_przepisy) FROM przepisy_dodane WHERE przepis_uzytkownika = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);
        return (int)$stmt->fetchColumn();
    }

    public function addResetPinToUser($email, $resetPin) {
        $expirationTime = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    
        $sql = "UPDATE users SET reset_pin = :resetPin, reset_pin_expiration = :expirationTime WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':resetPin', $resetPin, PDO::PARAM_STR);
        $stmt->bindParam(':expirationTime', $expirationTime, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    private function generateRandomPin($length = 6) {
        return str_pad(rand(0, pow(10, $length)-1), $length, '0', STR_PAD_LEFT);
    }

    public function generateResetPinAndSave(string $email) : string
    {
        $pin = $this->generateRandomPin();
        $pdo = $this->connection();
        $expirationTime = date('Y-m-d H:i:s', strtotime('+5 minutes'));
        $sql = "UPDATE uzytkownicy SET reset_pin = :resetPin, reset_pin_expiration = :expiration WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':resetPin', $pin, PDO::PARAM_STR);
        $stmt->bindParam(':expiration', $expirationTime, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        return $pin;
    }

    public function getUserEmailByResetPin($resetPin) {
        $sql = "SELECT email FROM uzytkownicy WHERE reset_pin = :resetPin";
        $pdo = $this->connection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':resetPin', $resetPin, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['email'];
        } else {
            return false;
        }
    }

    public function updatePasswordByResetPin($resetPin, $newPassword) {
        $email = $this->getUserEmailByResetPin($resetPin);
    
        if ($email !== false) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $pdo = $this->connection();
            $sql = "UPDATE uzytkownicy SET haslo = :hashedPassword WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            try {
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getEntriesForPage($user_id, $offset, $limit) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("SELECT * FROM przepisy_dodane WHERE user_id = :user_id ORDER BY data_dodania DESC LIMIT :offset, :limit");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalRecipes() {
        $pdo = $this->connection();
        $sql = "SELECT COUNT(id) as total FROM przepisy_dodane";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getEntriesForPageSorted($user_id, $offset, $limit, $sortItems) {
        $pdo = $this->connection();
        $orderBy = '';
        switch ($sortItems) {
            case 'data_dodania_desc':
                $orderBy = 'data_dodania DESC';
                break;
            case 'data_dodania_asc':
                $orderBy = 'data_dodania ASC';
                break;
            case 'tytul_asc':
                $orderBy = 'tytul ASC';
                break;
            case 'tytul_desc':
                $orderBy = 'tytul DESC';
                break;
            default:
                $orderBy = 'data_dodania DESC'; 
        }
        $stmt = $pdo->prepare("SELECT * FROM przepisy_dodane WHERE user_id = :user_id ORDER BY $orderBy LIMIT :offset, :limit");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function saveActivationKey($login, $key) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("UPDATE uzytkownicy SET kod_aktywacyjny = :key WHERE login = :login");
        $stmt->bindParam(':key', $key, PDO::PARAM_STR);
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function isActivationKeyValid($login, $key) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM uzytkownicy WHERE login = :login AND kod_aktywacyjny = :key");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':key', $key, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result > 0;
    }

    public function clearActivationKey($login) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("UPDATE uzytkownicy SET kod_aktywacyjny = NULL WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function checkActivationCode($login, $activationCode) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM uzytkownicy WHERE login = :login AND kod_aktywacyjny = :activationCode AND aktywowane = 0");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':activationCode', $activationCode, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    
    public function activateUser($login) {
        $pdo = $this->connection();
        $stmt = $pdo->prepare("UPDATE uzytkownicy SET aktywowane = 1, kod_aktywacyjny = NULL WHERE login = :login");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
    }
}
