<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
$nomeUtente = tmpGetUsernameById($_GET["id"]);
// echo $nomeUtente;
// print_r($_GET);

function createStrangeFront(){
    $begin = "<div class='front'>";
    $middle = "<h3> Aggiungi nuovi medaglieri al tuo libro!</h1>"; //TODO : ancorare la pagina di sottomissione a un nuovo medagliere?
    $end = "</div>";
    return $begin . $middle . $end;
}

function createFacciataAnteriore(){ 
    $nomeUtente = tmpGetUsernameById($_GET["id"]);
    // <!-- <h3>2023.<br>Second edition</h3> -->
    // </div>
    $begin = "<div id='copertinaAvanti' class='front'>";
    $middle = "<h1>Il medagliere di " . $nomeUtente . "</h1>"; //TODO c'è modo di risalire al nome dell'utente conoscendo l'id?
    $end = "</div>";
    return $begin . $middle . $end;
}

function createFacciataPosteriore(){
    $begin = "<div id='copertinaIndietro' class='back'>";
    $middle = "<div id='copriCopertina'> </div> ";
    $end = "</div>";
    return $begin . $middle . $end;
}

function obtainList($libriInMedagliere){
    $res = "";
    foreach ($libriInMedagliere as $a) {
        $tmpRes = "";
        if (checkIfUserReadBook($_GET["id"], getLibroIdFromLibroWhereTitle($a["titolo"]))){
            $tmpRes = "<li> <p class='libroLetto'>";
        } else {
            $tmpRes = "<li> <p class='libroNonLetto'>";
        }
        $nomeLibroS = str_replace(" ", "+", $a["titolo"]);
        $virgola = ",";
        $nomeAutoreS = str_replace(" ", "+", $a["nome"]);
        $totalLink = "https://www.google.com/search?q=" . $nomeLibroS . $virgola . "+" . $nomeAutoreS;
        // echo $totalLink;
        $tmpRes .= "\"<a href=\"" . $totalLink . "\">" . $a["titolo"] . "</a>\" di " . $a["nome"];
        $tmpRes .= "</p></li>";

        $res .= $tmpRes;
        // print_r($a);
    }
    return $res;//"<li class='libroLetto'>libro di autore</li>";
        // <ul class="libroNonLetto">libro di autore</ul>
}

function createFacciata($faceType, $medIndex, $exactIndex, $isComplete){

    $nomeUtente = tmpGetUsernameById($_GET["id"]);

    $begin = "<div class=" . $faceType . ">";

    $medInfos = getMedagliereInfo($medIndex[$exactIndex])[0];
    
    $libriInMedagliere = getLibroEAutoreByMedagliereId($medIndex[$exactIndex]);
    // print_r($libriInMedagliere);

    $imgToConsider = "";
    if ($isComplete){
        $imgToConsider = "<img class='imgObtainedMed' src='images/medagliaOttenuta.png' alt='" . $nomeUtente ." ha ottenuto questa medaglia!' />" ;
    } else {
        $imgToConsider = "<img class='imgObtainedMed' src='images/medagliaNonOttenuta.png' alt='" . $nomeUtente . " sta leggendo ancora per questa medaglia!' />";
    }

    // print_r($medInfos);

    $middle1 = "<article class='titoloMedagliere'>" 
                .
                $imgToConsider
                .
                "<h2>" . $medInfos["titolo"] . "</h2>"
                .
                "</article>";

    $middle2 = "<article class='descrizioneMedagliere'> <p>" . $medInfos["descrizione"] . "</p> </article>"; //$medInfos["descrizione"]

    $listBooks = obtainList($libriInMedagliere);


    $textToConsider = "";
    if ($isComplete){
        $textToConsider = "<p>Hai completato questo medagliere! Significa che hai letto:</p>";
    } else {
        $textToConsider = "<p>Per completare questo medagliere serve:</p>";
    }
    $middle3 = "<article class='libriNecessari'>"
                .
                $textToConsider
                .
                "<ol>"
                .
                $listBooks
                .
                "</ol> </article>";
    
    
    $end = "</div>";

    $middle = $middle1 . $middle2 . $middle3;

    return $begin . $middle . $end;
}

function createBack($medIndex, $exactIndex, $isComplete){
    return createFacciata("back facciata", $medIndex, $exactIndex, $isComplete);
}

function createFront($medIndex, $exactIndex, $isComplete){
    return createFacciata("front facciata", $medIndex, $exactIndex, $isComplete);
}


// public createPage($medIndex, $amountComplete, $actIndex){
    
// }

function createPage($frontHTML, $backHTML){
    $begin = "<div class='page'>";
    $end = "</div>";
    return $begin . $frontHTML . $backHTML . $end;
}

function createBook($medIndex, $amountComplete){
    $pages = "";
    $amountPages = (intdiv((sizeof($medIndex)+1),2));

    for ($i=0; $i <= $amountPages; $i++) { 
        $tmpPages = "";
        // echo (intdiv((sizeof($medIndex)+1),2));
        switch ($i) {
            
            case 0:
                $middle1 = createFacciataAnteriore();
                $middle2 = createFacciata("back", $medIndex, 0, (0 < $amountComplete));
                break;
            
            case ($amountPages):
                // echo "index-- " . $i;
                if((sizeof($medIndex) % 2) === 0){
                    $middle1 = createFacciata("front", $medIndex, (($i*2)-1), (($i*2)-1 < $amountComplete));
                } else {
                    $middle1 = createStrangeFront();
                }
                $middle2 = createFacciataPosteriore();
                break;
            
            default:
                $middle1 = createFront($medIndex, ($i*2)-1, (($i*2)-1 < $amountComplete));
                $middle2 = createBack($medIndex, ($i*2), (($i*2) < $amountComplete));
                break;
        }
        $tmpPages = createPage($middle1, $middle2);
        $pages = $pages . $tmpPages;
    }
    return $pages;
}



?>