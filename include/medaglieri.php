<?php

class Medaglieri{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMedaglieri() {
        $sql = "SELECT * FROM medagliere";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function aggiungiMedagliere($titolo, $descrizione) {
        $sql = "INSERT INTO medagliere (titolo,descrizione) VALUES (?,?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $titolo,$descrizione);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }   

    public function getLibriMedaglieri($medagliereId) {
        $sql = "SELECT libro.id, libro.titolo FROM libro, compone , medagliere
                    WHERE libro.id = compone.libroId AND compone.medagliereId = medagliere.id and medagliere.id = ?";
        $result = mysqli_query($this->conn, $sql);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $medagliereId);

        $stmt->execute();

        $result = $stmt->get_result();
        //return $result->fetch_all(MYSQLI_ASSOC);
        return $result;
        
    }

}


$medaglieri = new Medaglieri($conn);

if(isset($_POST['aggiungiMedagliere'])){
    $titolo        = mysqli_real_escape_string($conn, $_POST['titolo']);
    $descrizione   = mysqli_real_escape_string($conn, $_POST['descrizione']);
        if (strlen($descrizione) == 0 ) {
            $descrizione = "Un nuovo medagliere ti aspetta!";
        }
    $medaglieri->aggiungiMedagliere($titolo,$descrizione);
    //FIXME: ? se ritrasmetto la pagina registra il libro/medagliere nuovamente
}


?>