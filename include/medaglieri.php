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

        $titolo = stripslashes($titolo);
        $descrizione = stripslashes($descrizione);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $titolo,$descrizione);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }   

    public function getLibriMedaglieri($medagliereId) {
        $sql = "SELECT libro.id, libro.titolo 
                FROM libro, compone, medagliere
                WHERE libro.id = compone.libroId 
                AND compone.medagliereId = medagliere.id 
                AND medagliere.id = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Check if the preparation was successful
        if (!$stmt) {
            die("Error in SQL query preparation: " . $this->conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $medagliereId);
            // Execute the statement
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();

        // Fetch the results as an associative array
        // $data = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();

        // Return the result
        // return $data;
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
    // gestire refresh pagina (F5) ?-> doppia registrazione medagliere
}


?>