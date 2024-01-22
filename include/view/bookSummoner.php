<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
include_once("include/view/formattators.php");
$nomeUtente = tmpGetUsernameById($_GET["id"]);

function createStrangeFront(){
    $begin = "<div class='front facciata'>";
    $middle = "<h3> Aggiungi nuovi medaglieri al tuo libro! </h3>"; //TODO : ancorare la pagina di sottomissione a un nuovo medagliere?
    $end = "</div>";
    return $begin . $middle . $end;
}

function createFacciataAnteriore(){ 
    $nomeUtente = tmpGetUsernameById($_GET["id"]);
    // <!-- <h3>2023.<br>Second edition</h3> -->
    // </div>
    $begin = "<div id='copertinaAvanti' class='front facciata'>";
    $middle = "<h2>Il medagliere di \"" . $nomeUtente . "\"</h2>"; //TODO c'è modo di risalire al nome dell'utente conoscendo l'id?
    $end = "</div>";
    return $begin . $middle . $end;
}

function createFacciataPosteriore(){
    $begin = "<div id='copertinaIndietro' class='back facciata'>";
    $middle = "<div id='copriCopertina'> </div> ";
    $end = "</div>";
    return $begin . $middle . $end;
}

function createFacciata($faceType, $medIndex, $exactIndex, $isComplete){

    $nomeUtente = tmpGetUsernameById($_GET["id"]);

    $begin = "<div class=\"" . $faceType . "\">";

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

    $medTitleClass = "medTitle";

    $middle1 = "<article class='titoloMedagliere'>" 
                .
                "<h2 class=\"" . $medTitleClass . "\">" . $medInfos["titolo"] . "</h2>"
                .
                $imgToConsider
                .
                "</article>";

    $medDescClass = "descrizioneMedagliere";
    $middle2 = "<article class=\"" . $medDescClass . "\"> <p>" . $medInfos["descrizione"] . "</p> </article>"; //$medInfos["descrizione"]

    $listBooks = obtainList($libriInMedagliere, $_GET["id"]);


    $preamboloElencoLibriClass = "preambleElencoLibri";
    $textToConsider = "<p class=\"" . $preamboloElencoLibriClass . "\"> <h3>";
    
    if ($isComplete){
        $textToConsider .= "Hai completato il medagliere! Significa che hai letto:</h3></p>";
    } else {
        $textToConsider .= "Per completare questo medagliere serve:</h3></p>";
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


function createFacciata1($faceType, $medIndex, $exactIndex, $isComplete){

    $nomeUtente = tmpGetUsernameById($_GET["id"]);

    $begin = "<div class=\"" . $faceType . "\">";

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

    $medTitleClass = "medTitle";

    $middle1 = "<article class='titoloMedagliere'> " 
                .
                "<h2 class=\"" . $medTitleClass . "\">" . $medInfos["titolo"] . "</h2>"
                .
                $imgToConsider
                ;
                // .
                // "</article>";

    $medDescClass = "descrizioneMedagliere";
    $middle2 = "<p class=\"" . $medDescClass . "\"> " . $medInfos["descrizione"] . "</p> </article>"; //$medInfos["descrizione"]

    $listBooks = obtainList($libriInMedagliere, $_GET["id"]);


    $preamboloElencoLibriClass = "preambleElencoLibri";
    $textToConsider = "<h3 class=\"" . $preamboloElencoLibriClass . "\">";
    
    if ($isComplete){
        $textToConsider .= "Hai completato il medagliere! Significa che hai letto: </h3>";
    } else {
        $textToConsider .= "Per completare questo medagliere serve: </h3>";
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
    return createFacciata1("back facciata", $medIndex, $exactIndex, $isComplete);
}

function createFront($medIndex, $exactIndex, $isComplete){
    return createFacciata1("front facciata", $medIndex, $exactIndex, $isComplete);
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
                $middle2 = createFacciata1("back facciata", $medIndex, 0, (0 < $amountComplete));
                break;
            
            case ($amountPages):
                // echo "index-- " . $i;
                if((sizeof($medIndex) % 2) === 0){
                    $middle1 = createFacciata1("front facciata", $medIndex, (($i*2)-1), (($i*2)-1 < $amountComplete));
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