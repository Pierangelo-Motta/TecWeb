<?php

require_once("include/login.controller.php");
require_once("include/login.model.php");

require_once("include/model/selectors.php");
require_once("include/model/insertOnDB.php");

//TODO : sarebbe da pulire sta porcata...
$userIdLogged = $_SESSION["id"];
$userIdvisited = isset($_GET["id"]) ? $_GET["id"] : -1;
$imFollowU = checkIfUserFollowUser($userIdLogged, $userIdvisited);
$nameFollowingButton = "followButton";
if (isset($_POST[$nameFollowingButton])) {
    // echo $_SESSION["id"] . " " . $userIdvisited;
    if ($imFollowU) {
        destroyFollow($_SESSION["id"], $userIdvisited);
    } else {
        createFollow($_SESSION["id"], $userIdvisited);
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
}



function getPictureOfPortalImage($typeOfView){
    $portalImg="images/";

    switch ($typeOfView) {
        case 'post':
            $portalImg = $portalImg . "libroMedaglieri.png";
            break;
        
        case 'goal':
            $portalImg = $portalImg . "logoLetturePremiate.png";
            break;
        
        default:
            $portalImg = $portalImg . "ERR.png";
            break;
    }

    return $portalImg;
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

function getButtonOfPortal($userId, $typeView){
    $userIdLogged = $_SESSION["id"];
    $isMyProfilePage = ($userId == $userIdLogged);
    $visitPost = strcmp($typeView, "post") == 0 ? true : false;

    $nuovoPost = "Aggiungi post";
    $nuovoMedagliere = "Aggiungi medagliere";
    $toFollow = "Segui";
    $followed = "Seguito";
    $moreInfo = "Vedi di più";

    $res = "";

    $classButtonDefault = " justify-content-center align-items-center mx-auto";

    if (strcmp($typeView, 'search') == 0) { //caso del ridirezione al profilo utente
        $buttAttr = array(
            "class" => "btn btn-primary linkToUserProfile" . $classButtonDefault,
            "type" => "button",
            "value" => $userId
        );
        $innerHTML = $moreInfo;
        $res = summonHTMLElement("button", $buttAttr, $innerHTML);
        return $res;
    }
    
    if($isMyProfilePage) {
        //casi nuovo qualcosa 
        $buttAttr = array(
            "class" => "btn btn-primary" . $classButtonDefault,
            "type" => "button",
            "id" => "addSomethingToMyAccount");
        $innerHTML = $visitPost ? $nuovoPost : $nuovoMedagliere;

        $res = summonHTMLElement("button", $buttAttr, $innerHTML);
    
    } else {
        $imFollowU = checkIfUserFollowUser($userIdLogged, $userId);

        $nameButton = "followButton";

        $buttAttr = array(
            "type" => "submit",
            "id" => "followButtonId",
            "name" => $nameButton,
            "class" => ($imFollowU ? "btn btn-secondary" : "btn btn-primary") . $classButtonDefault,
            "value" => $imFollowU ? 1 : 0
        );
    
        $formAttr = array(
            "action" => "#",
            "method" => "post",
            "class" => "portalForm d-flex justify-content-center align-items-center mx-auto"
        );
    
        $buttonText = $imFollowU ? $followed : $toFollow;
    

        $res = summonHTMLElement("form", $formAttr, 
            summonHTMLElement("button", $buttAttr, $buttonText)
        );
        
    }

    return $res;

}

function obtainMainInfosUserBanner($userId){

    $nameInterestedUser = tmpGetUsernameById($userId); //nome

    $pathUserImage = getUserImage($nameInterestedUser); //immagine utente
    $listaFollower = ottieniFollower($userId);
    //var_dump($listaFollower);
    // print_r($listaFollower);
    $counterFollower = sizeof(ottieniFollower($userId)); //numero follow1
    $counterSeguo = sizeof(ottieniSegue($userId)); //numero follow2
    $listaSegue = ottieniSegue($userId);
    // print_r("<br/>");
    // print_r($listaSegue);
    
    // echo "<!-- INIZIO: per la valorizzazione del modal-->" . "\n";
    // foreach($listaFollower as $f){
    //     echo "<div class=\"modalFollower\" id=\"modalFollowerId" . $f['seguenteId'] . "\" hidden>";
    //     echo $f['seguenteId'];
    //     echo "</div>\n";
    // }

    // foreach($listaSegue as $s){
    //     echo "<div class=\"modalSeguiti\" id=\"modalSeguitoId" . $s['seguitoId'] . "\" hidden>";
    //     echo $s['seguitoId'];
    //     echo "</div>\n";
    // }
    // foreach($listaSegue as $s){
    //     echo 'seguo: ' . $s['seguitoId'] ;
    // }
    // echo "<!-- FINE per la valorizzazione del modal-->" . "\n";
 
    
    $amountComplete = sizeof(getMedCompletatiByUserId($userId)); //amountMedaglieriCompletati

    $classMainContainer = "d-sm-inline-flex align-items-center p-2  mainInfos"; //w-25 flex-fill
    
    $initMainContainter = "<div id=\"mainInfosUserBannerN" . $userId . "\" 
    class=\"" . $classMainContainer . "\">";
    
    $classForDivImg = "d-flex mx-auto imgPropicCont";
    $classForImg = "rounded float-left";
    $first =  "<div id=\"divContainerImgUserBannerN" . $userId . "\" class=\"" . $classForDivImg . "\">" .
    "<img id=\"propicN" . $userId . "\" " .
    "src=\"" . $pathUserImage . "\" " .
    "alt=\"Immagine Profilo\" "  .
    "class=\"" . $classForImg . "\"> " .
    "</div>";
    
    //$classForMed = "";
    // $med =  "<div" . 
    //         //" id=\"divContainerImgUserBannerN" . $userId . "\"" . 
    //         " class=\"" . $classForMed . "\">" .
    //     "</div>";
    
    $classForContainerInfos = "containerUserInfos";
    $classForInfos = "card-text";
    $second = "<div id=\"textInfoUserBannerN" . $userId . "\" class=\"" . $classForContainerInfos . "\"> " .
    "<h1 id=\"usernameInProfilePageUserBannerN" . $userId . "\">" . $nameInterestedUser . "</h1>" . 
    "<p class=\"" .$classForInfos . "\" id=\"counterFollowerUserBannerN" . $userId . "\">" . "Follower: " . $counterFollower . "</p>" . 
    "<p class=\"" .$classForInfos . "\" id=\"counterSegueUserBannerN" . $userId . "\">" . "Segue: " . $counterSeguo . "</p>" .
    "<p class=\"" .$classForInfos . "\" id=\"counterMedaglieriUserBannerN" . $userId . "\">" . "Medaglieri completati: " . $amountComplete . "</p>" .
    "</div>";
    
    
    $finMainContainer = "</div>";
    

    // INIZIO PARTE POPUP
        $popupContent = "
    <div id=\"myPopupFollowers" . $userId . "\" class=\"popup\">
        <div class=\"popup-content\">
        <div class=\"closeMyPopup\" data-closePopup=\"myPopupFollowers" . $userId . "\">&times;</div>
        <div class=\"titoloPopUp\">Followers</div>";

    foreach($listaFollower as $f) {
        $popupContent .= "<div class=\"rigaUtente\"><img src=\"" . getUserImage(tmpGetUsernameById($f['seguenteId'])) . "\" alt=\"Immagine Profilo\" class=\"immagineProfilo\"><a   href=\"profilePage.php?mode=post&id=" . $f['seguenteId'] . "\">" . tmpGetUsernameById($f['seguenteId']) . "</a></div>\n";
    }

    $popupContent .= "
            </div>
        </div>";

    $popupContent .= "
        <div id=\"myPopupSeguiti" . $userId . "\" class=\"popup\">
            <div class=\"popup-content\">
            <div class=\"closeMyPopup\" data-closePopup=\"myPopupSeguiti" . $userId . "\">&times;</div>
            <div class=\"titoloPopUp\">Utenti seguiti</div>";

    foreach($listaSegue as $s) {
        $popupContent .= "<div class=\"rigaUtente\"><img src=\"" . getUserImage(tmpGetUsernameById($s['seguitoId'])) . "\" alt=\"Immagine Profilo\" class=\"immagineProfilo\"><a    href=\"profilePage.php?mode=post&id=" . $s['seguitoId'] . "\">" . tmpGetUsernameById($s['seguitoId']) . "</a></div>\n";
    }

    $popupContent .= "
            </div>
        </div>";
// FINE PARTE POPUP
        
// echo "<button onclick=\"openPopup()\">Open Popup</button>";

    return $initMainContainter . $first . $second . $finMainContainer . $popupContent;

}

function obtainPortalsUserBanner($userId, $typeView){

    $nameInterestedUser = tmpGetUsernameById($userId); //nome

    $classMainContainer = "d-md-inline-flex justify-content-center align-items-center p-2  w-auto"; //w-25 flex-fill
    $initMainContainter = "<div id=\"portalsUserBannerN" . $userId . "\" class=\"" . $classMainContainer . "\">";

    $portalImg = getPictureOfPortalImage($typeView);

    //$textButton = getButtonOfPortal($userId, $typeView);


    $classFirstContainer = "order-md-1 w-auto justify-content-center align-items-center mx-auto";
    //per ora un utente gli metto solo il buttone "vedi di più" : non personalizzo l'ID al portale
    //UserBannerN . $userId
    $classImgAbbr = "AbbrImgPortal";
    $first = "<div id=\"portalDiv" . "" . "\" class=\"" . $classFirstContainer . "\">" . 
                "<abbr id=\"portalAbbr" . $userId . "\" lang=\"it\" title=\"" . $nameInterestedUser . "\" class=\"" . $classImgAbbr . "\">" .
                                    "<img " . 
                                        "id=\"portal\" " . 
                                        "class=\"flex-wrap justify-content-center align-items-center mx-auto\" " . //w-100
                                        "alt=\"" . $nameInterestedUser . "\" " . 
                                        "src=\"" .  $portalImg . "\" /> " .
                                "</abbr>" .
                            "</div>";

    $classSecondContainer = "d-flex order-md-0 w-auto justify-content-center align-items-center";
    $second = "<div id=\"addInfosUserBannerN" . $userId . "\" class=\"" . $classSecondContainer . "\">" . 
                getButtonOfPortal($userId, $typeView) . 
                "</div>";

    $finMainContainer = "</div>";

    $isSearching = strcmp($typeView, "search") == 0;
    if ($isSearching){
        return $initMainContainter . $second . $finMainContainer;
    } else {
        return $initMainContainter . $first . $second . $finMainContainer;
    }
    
}

//typeView deve essere una di queste 3 stringhe:
//search --> solo il bottone "vedi di più"
//goal --> bottone "nuovoMedagliere"/"Segui" + libro per post
//post --> bottone "nuovoPost"/"Segui" + libro per medaglieri
function getUserBannerById($userId, $typeView){

    //$userIdvisited = $_GET["id"]; // è il parametro della funzioen

    $classMainContainer = "card singleBannerUnit"; //bootstrap flags
    $classSubContainer = "d-sm-inline-flex align-items-md-between align-items-center w-100"; //bootstrap flags

    $init = "<div id=\"userBannerN" . $userId . "\" class=\"" .$classMainContainer . "\">" . 
            "<div class=\"card-body w-100\">" . 
            "<div class=\"" . $classSubContainer . "\">";
    
    $classForMet = "w-1 flex-fill";  
    $between = "<div " . 
                " class=\"" . $classForMet . "\"" . 
                "> </div> ";
    // $between = "";

    $fin = " </div> </div> </div>";

    $visitPost = false;

    return $init . obtainMainInfosUserBanner($userId) . $between . obtainPortalsUserBanner($userId, $typeView) . $fin;
    
}

?>