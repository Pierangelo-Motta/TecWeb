<?php

public createStrangeFront(){
    $begin = "<div class='front'>";
    $middle = "<h3> Aggiungi nuovi medaglieri al tuo libro!</h1>"; //TODO : ancorare la pagina di sottomissione a un nuovo medagliere?
    $end = "</div>";
    return $begin . $middle . $end;
}

public createFacciataAnteriore(){ 
    // <!-- <h3>2023.<br>Second edition</h3> -->
    // </div>
    $begin = "<div id='copertinaAvanti' class='front'>";
    $middle = "<h1>Il medagliere di " . echo $_SESSION["username"] . "</h1>";
    $end = "</div>";
    return $begin . $middle . $end;
}

public createFacciataPosteriore(){
    $begin = "<div id='copertinaIndietro' class='back'>";
    $middle = " ";
    $end = "</div>";
    return $begin . $middle . $end;
}

public createFacciata($faceType, $medIndex, $exactIndex, $isComplete){
    $begin = "<div class=" . $faceType . ">";
    $middle = "<p> Ciao! </p>";
    $end = "</div>";
    return $begin . $middle . $end;
}

public createBack($medIndex, $exactIndex, $isComplete){
    return createFacciata("back", $medIndex, $exactIndex, $isComplete);
}

public createFront($medIndex, $exactIndex, $isComplete){
    return createFacciata("front", $medIndex, $exactIndex, $isComplete);
}


public createPage($medIndex, $amountComplete, $actIndex){
    $begin = "<div class='page'>"
    $middle1 = createBack($medIndex, ($actIndex*2)-1, ($actIndex*2)-1 < $amountComplete);
    $middle2 = createFront($medIndex, ($actIndex*2), ($actIndex*2) < $amountComplete);
    $end = "</div>";
}

public createBook($medIndex, $amountComplete){
    for ($i=0; $i <= ((sizeof($medIndex)+1)/2); $i++) { 
        switch ($i) {
            case 0:
                # code...
                break;
            
            case (sizeof($medIndex)/2):
                
                break;
            
            default:
                createPage($medIndex, $amountComplete, $actIndex)
                break;
        }
    }
}



?>