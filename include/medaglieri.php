<?php

class Medaglieri {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function aggiungiMedagliere($titolo) {
        $sql = "INSERT INTO medagliere (titolo) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $titolo);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }

    public function getMedagliere() {
        $sql = "SELECT * FROM medagliere";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function modificaMedagliere($id, $titolo) {
        $sql = "UPDATE medagliere SET titolo = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $titolo, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }

    public function eliminaMedagliere($id) {
        $sql = "DELETE FROM medagliere WHERE id = ?";
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

$medaglieri = new Medagliere($conn);

if(isset($_POST['aggiungi_medagliere'])){
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $libri->aggiungiMedagliere($titolo);
}

if(isset($_POST['modifica_medagliere'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $libri->modificaLibro($id, $titolo);
}

if(isset($_POST['elimina_medagliere'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $libri->eliminaLibro($id);
}

?>