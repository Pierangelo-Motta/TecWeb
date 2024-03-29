<?php

function obtainList($libriInMedagliere, $who){
    $res = "";
    foreach ($libriInMedagliere as $a) {
        $tmpRes = "";
        if (checkIfUserReadBook($who, getLibroIdFromLibroWhereTitle($a["titolo"]))){
            $tmpRes = "<li> <p class='libroLetto'>";
        } else {
            $tmpRes = "<li> <p class='libroNonLetto'>";
        }
        $nomeLibroS = str_replace(" ", "+", $a["titolo"]);
        $virgola = ",";
        $nomeAutoreS = str_replace(" ", "+", $a["nome"]);
        
        $totalLink = "https://www.google.com/search?q=" . $nomeLibroS . $virgola . "+" . $nomeAutoreS;

        $tmpRes .= "\"<a href=\"" . $totalLink . "\">" . $a["titolo"] . "</a>\" di " . $a["nome"];
        $tmpRes .= "</p></li>";

        $res .= $tmpRes;
    }
    return $res;
}

function summonHTMLElement($witch, $arrAttributes, $innerHTML, $isSingle = false){
    $init = "<" . $witch . "";
    $args = "";
    foreach(array_keys($arrAttributes) as $k){
        $args .= " " . $k . "=\"" . $arrAttributes[$k] . "\" ";
    }
    $fininit = $isSingle ? "" : ">";

    $middle = $isSingle ? "" : $innerHTML;

    $end = $isSingle ? " />" : "</" . $witch . ">";

    return $init . $args . $fininit . $middle . $end;
}

?>