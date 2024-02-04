<?php

class Libri {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function aggiungiLibro($titolo, $autoreId) {
        $sql = "INSERT INTO libro (titolo) VALUES (?)";
        $stmt = $this->prepareAndExecute($sql, "s", $titolo);

        if ($stmt) {
            $libroId = mysqli_insert_id($this->conn);
            mysqli_stmt_close($stmt);

            if ($libroId != 0) {
                $this->associaLibroAutore($libroId, $autoreId);
            } else {
                echo "Errore nel recupero dell'ID del libro.";
            }
        } else {
            echo "Errore: " . mysqli_error($this->conn);
        }
    }

    private function associaLibroAutore($libroId, $autoreId) {
        if ($autoreId == "altro") {
            $nuovoAutore = mysqli_real_escape_string($this->conn, $_POST['nuovoAutore']);
            $sqlNuovoAutore = "INSERT INTO autore (nome) VALUES (?)";
            $stmtNuovoAutore = $this->prepareAndExecute($sqlNuovoAutore, "s", $nuovoAutore);

            if ($stmtNuovoAutore) {
                mysqli_stmt_close($stmtNuovoAutore);
                $autoreId = mysqli_insert_id($this->conn);
            } else {
                echo "Errore: " . mysqli_error($this->conn);
            }
        }

        $sqlAssocia = "INSERT INTO scrittoda (libroId, autoreId) VALUES (?, ?)";
        $stmtAssocia = $this->prepareAndExecute($sqlAssocia, "ii", $libroId, $autoreId);

        if (!$stmtAssocia) {
            echo "Errore: " . mysqli_error($this->conn);
        }
    }

    public function getLibri() {
    $sql = "SELECT l.id, l.titolo, a.id as autoreId, a.nome FROM libro l, autore a, scrittoda s WHERE l.id = s.libroId AND a.id = s.autoreId ORDER BY a.nome";
    return mysqli_query($this->conn, $sql);
}


      public function getAutori() {
          $sql = "SELECT DISTINCT  * FROM autore a ORDER BY a.nome ASC";
          return mysqli_query($this->conn, $sql);
      }

      public function modificaLibro($id, $titolo, $autoreId) {
      $sql = "UPDATE libro SET titolo = ? WHERE id = ?";
      $stmt = mysqli_prepare($this->conn, $sql);

      if ($stmt) {
          mysqli_stmt_bind_param($stmt, "si", $titolo, $id);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);

          $this->aggiornaAutoreLibro($id, $autoreId);
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
      }
    }

    private function aggiornaAutoreLibro($libroId, $autoreId) {
      $sql = "UPDATE scrittoda SET autoreId = ? WHERE libroId = ?";
      $stmt = mysqli_prepare($this->conn, $sql);

      if ($stmt) {
          mysqli_stmt_bind_param($stmt, "ii", $autoreId, $libroId);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
      }
    }


    public function eliminaLibro($id) {
        $autoreId = $this->getAutoreIdByLibroId($id);
        $sqlLibro = "DELETE FROM libro WHERE id = ?";
        $stmtLibro = $this->prepareAndExecute($sqlLibro, "i", $id);

        if ($stmtLibro) {
            mysqli_stmt_close($stmtLibro);
            $this->eliminaCollegamentoScrittoda($id, $autoreId);
        } else {
            echo "Errore durante l'eliminazione del libro: " . mysqli_error($this->conn);
        }
    }

    private function getAutoreIdByLibroId($libroId) {
        $sql = "SELECT autoreId FROM scrittoda WHERE libroId = ?";
        $stmt = $this->prepareAndExecute($sql, "i", $libroId);

        if ($stmt) {
            mysqli_stmt_bind_result($stmt, $autoreId);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            return $autoreId;
        } else {
            echo "Errore: " . mysqli_error($this->conn);
            return null;
        }
    }

    private function eliminaCollegamentoScrittoda($libroId, $autoreId) {
        $sql = "DELETE FROM scrittoda WHERE libroId = ? AND autoreId = ?";
        $stmt = $this->prepareAndExecute($sql, "ii", $libroId, $autoreId);

        if (!$stmt) {
            echo "Errore: " . mysqli_error($this->conn);
        }
    }

    private function prepareAndExecute($sql, $types, ...$params) {
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
        }

        return $stmt;
    }
}

$libri = new Libri($conn);

if (isset($_POST['aggiungi_libro'])) {
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $autoreId = mysqli_real_escape_string($conn, $_POST['autore']);
    $libri->aggiungiLibro($titolo, $autoreId);
}

if (isset($_POST['modifica_libro'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $autoreId = mysqli_real_escape_string($conn, $_POST['autore']);
    $libri->modificaLibro($id, $titolo, $autoreId);
}

if (isset($_POST['elimina_libro'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $libri->eliminaLibro($id);
}

?>
