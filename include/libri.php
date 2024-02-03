<?php

class Libri {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function aggiungiLibro($titolo, $autoreId) {
        $sql = "INSERT INTO libro (titolo) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $titolo);
            mysqli_stmt_execute($stmt);

            $libroId = mysqli_insert_id($this->conn);
            mysqli_stmt_close($stmt);

            if ($libroId != 0) {
                $this->associaLibroAutore($libroId, $autoreId);
            } else {
                echo "Errore nel recupero dell'ID del libro.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }



   public function getLibri() {
     $sql = "SELECT * from libro l, autore a, scrittoda s WHERE l.id = s.libroId AND a.id = s.autoreId";
       $result = mysqli_query($this->conn, $sql);
       return $result;
   }



    public function modificaLibro($id, $titolo, $autoreId) {
        $sql = "UPDATE libro SET titolo = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $titolo, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $this->associaLibroAutore($id, $autoreId);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }

    private function associaLibroAutore($libroId, $autoreId) {
      if ($autoreId == "altro") {
          $nuovoAutore = mysqli_real_escape_string($this->conn, $_POST['nuovoAutore']);

          $sqlNuovoAutore = "INSERT INTO autore (nome) VALUES (?)";
          $stmtNuovoAutore = mysqli_prepare($this->conn, $sqlNuovoAutore);

          if ($stmtNuovoAutore) {
              mysqli_stmt_bind_param($stmtNuovoAutore, "s", $nuovoAutore);
              mysqli_stmt_execute($stmtNuovoAutore);
              mysqli_stmt_close($stmtNuovoAutore);

              $autoreId = mysqli_insert_id($this->conn);
          } else {
              echo "Error: " . $sqlNuovoAutore . "<br>" . mysqli_error($this->conn);
          }
      }

      $sqlAssocia = "INSERT INTO scrittoda (libroId, autoreId) VALUES (?, ?)";
      $stmtAssocia = mysqli_prepare($this->conn, $sqlAssocia);

      if ($stmtAssocia) {
          mysqli_stmt_bind_param($stmtAssocia, "ii", $libroId, $autoreId);
          mysqli_stmt_execute($stmtAssocia);
          mysqli_stmt_close($stmtAssocia);
      } else {
          echo "Error: " . $sqlAssocia . "<br>" . mysqli_error($this->conn);
      }
    }


    public function eliminaLibro($id) {
        $sql = "DELETE FROM libro WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
}

$libri = new Libri($conn);

if(isset($_POST['aggiungi_libro'])){
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $autoreId = mysqli_real_escape_string($conn, $_POST['autore']);
    $libri->aggiungiLibro($titolo, $autoreId);
}

if(isset($_POST['modifica_libro'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $autoreId = mysqli_real_escape_string($conn, $_POST['autore']);
    $libri->modificaLibro($id, $titolo, $autoreId);
}

if(isset($_POST['elimina_libro'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $libri->eliminaLibro($id);
}

?>
