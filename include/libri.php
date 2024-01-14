<?php

class Libri {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function aggiungiLibro($titolo) {
        $sql = "INSERT INTO libro (titolo) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $titolo);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }

    public function getLibri() {
        $sql = "SELECT * FROM libro";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function modificaLibro($id, $titolo) {
        $sql = "UPDATE libro SET titolo = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $titolo, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
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
    $libri->aggiungiLibro($titolo);
}

if(isset($_POST['modifica_libro'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $libri->modificaLibro($id, $titolo);
}

if(isset($_POST['elimina_libro'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $libri->eliminaLibro($id);
}

?>
