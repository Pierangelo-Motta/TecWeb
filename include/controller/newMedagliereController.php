<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}


function returnActUser() {
    echo "--------->>>>>>>>>>>>>>>" . $_SESSION["id"];
    $tmp = array("id" => $_SESSION["id"])
    return json_encode();
}

function returnAllMissMeds(){
    return json_encode(getMedThatUserNotChallenge($userIdToConsider, $searchingMedStr));
}


$command = $_GET["codeQ"];
switch($command){
    case '0':
        echo "HIRNIFRIENKFN";
        return returnActUser();
        break;
    case '10':
        return returnAllMissMeds();
        break;
    default:
        header("Location: index.html");
        break;
}


?>