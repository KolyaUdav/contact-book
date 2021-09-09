<?php

trait DB
{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'contact_book';

    public function sendDataToDB(PDO $conn, string $query, array $bindParams): bool {
        try {
            $stmt = $conn->prepare($query);

            if (count($bindParams) > 0) {
                $stmt = $this->bindValues($stmt, $bindParams);
            }
            $stmt->execute();
        } catch (PDOException $e) {
            printf('<div class="alert alert-danger alert-tip" role="alert">Error: %s</div>', $e->getMessage());
            return false;
        }

        return true;
    }

    public function getDataFromDB(PDO $conn, string $query, array $bindParams): array {
        $data = array();

        try {
            $stmt = $conn->prepare($query);

            if (count($bindParams) > 0) {
                $stmt = $this->bindValues($stmt, $bindParams);
            }
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $data[] = $row;
            }

        } catch (PDOException $e) {
            printf('<div class="alert alert-danger alert-tip" role="alert">Error: %s</div>', $e->getMessage());
        }

        return $data;
    }

    public function checkLoginExisting(PDO $conn, string $login): bool {
        $query = 'SELECT login FROM users WHERE login = :login';

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':login', $login);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($result)) {
                return false;
            }
        } catch (Exception $e) {
            printf('<<div class="alert alert-danger alert-tip" role="alert">Error: %s</div>', $e->getMessage());
            return false;
        }

        return true;
    }

    public function bindValues(PDOStatement $stmt, array $bindParams): PDOStatement {
        while ($param = current($bindParams)) {
            $stmt->bindValue(':'.key($bindParams), $param);
            next($bindParams);
        }

        return $stmt;
    }

    public function connect(): ?PDO {
        $conn = null;

        try {
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">Connection Error: '.$e->getMessage().'</div>';
        }

        return $conn;
    }

}