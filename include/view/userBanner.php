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
    if ($imFollowU){
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
            $portalImg = $portalImg . "DA_FARE.png";
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

    if (strcmp($typeView, 'search') == 0) { //caso del ridirezione al profilo utente
        $buttAttr = array(
            "class" => "btn btn-primary linkToUserProfile",
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
            "class" => "btn btn-primary",
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
            "class" => $imFollowU ? "btn btn-secondary" : "btn btn-primary",
            "value" => $imFollowU ? 1 : 0
        );
    
        $formAttr = array(
            "action" => "#",
            "method" => "post"
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
    $counterFollower = sizeof(ottieniFollower($userId)); //numero follow1
    $counterSeguo = sizeof(ottieniSegue($userId)); //numero follow2
    $amountComplete = sizeof(getMedCompletatiByUserId($userId)); //amountMedaglieriCompletati

    $classMainContainer = "d-md-inline-flex align-items-center";

    $initMainContainter = "<div id=\"mainInfosUserBannerN" . $userId . "\" 
                                class=\"" . $classMainContainer . "\">";

    
    $classForImg = "rounded float-left";
    $first =  "<div id=\"divContainerImgUserBannerN" . $userId . "\" class=\"\">" .
                    "<img id=\"propicN" . $userId . "\" " .
                    "src=\"" . $pathUserImage . "\" " .
                    "alt=\"Immagine Profilo\" "  .
                    "class=\"" . $classForImg . "\"> " .
                    "</div>";

    $classForInfos = "card-text";
    $second = "<div id=\"textInfoUserBannerN" . $userId . "\" class=\"\"> " .
                    "<h1 id=\"usernameInProfilePageUserBannerN" . $userId . "\">" . $nameInterestedUser . "</h1>" . 
                    "<p class=\"" .$classForInfos . "\" id=\"counterFollowerUserBannerN" . $userId . "\">" . "Follower: " . $counterFollower . "</p>" . 
                    "<p class=\"" .$classForInfos . "\" id=\"counterSegueUserBannerN" . $userId . "\">" . "Segue: " . $counterSeguo . "</p>" .
                    "<p class=\"" .$classForInfos . "\" id=\"counterMedaglieriUserBannerN" . $userId . "\">" . "Medaglieri completati: " . $amountComplete . "</p>" .
                    "</div>";


    $finMainContainer = "</div>";

    return $initMainContainter . $first . $second . $finMainContainer;

}

function obtainPortalsUserBanner($userId, $typeView){

    $nameInterestedUser = tmpGetUsernameById($userId); //nome

    $classMainContainer = "d-md-inline-flex align-items-center";
    $initMainContainter = "<div id=\"portalsUserBannerN" . $userId . "\" class=\"" . $classMainContainer . "\">";

    $portalImg = getPictureOfPortalImage($typeView);

    //$textButton = getButtonOfPortal($userId, $typeView);


    $classFirstContainer = "order-md-1";
    //per ora un utente gli metto solo il buttone "vedi di più" : non personalizzo l'ID al portale
    //UserBannerN . $userId
    $classImgAbbr = "AbbrImgPortal";
    $first = "<div id=\"portalDiv" . "" . "\" class=\"" . $classFirstContainer . "\">" . 
                "<abbr id=\"portalAbbr" . $userId . "\" lang=\"it\" title=\"" . $nameInterestedUser . "\" class=\"" . $classImgAbbr . "\">" .
                                    "<img " . 
                                        "id=\"portal\" " . 
                                        "class=\"flex-wrap align-items-center\" " . 
                                        "alt=\"" . $nameInterestedUser . "\" " .
                                        "src=\"" .  $portalImg . "\" /> " .
                                "</abbr>" .
                            "</div>";

    $classSecondContainer = "order-md-0";
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

function getUserBannerById($userId, $typeView){

    //$userIdvisited = $_GET["id"]; // è il parametro della funzioen

    $classMainContainer = "card"; //bootstrap flags
    $classSubContainer = "d-inline-flex align-items-md-center align-items-end"; //bootstrap flags

    $init = "<div id=\"userBannerN" . $userId . "\" class=\"" .$classMainContainer . "\">" . 
            "<div class=\"card-body\">" . 
            "<div class=\"" . $classSubContainer . "\">";
    
    $between = "";

    $fin = " </div> </div> </div>";

    $visitPost = false;

    return $init . obtainMainInfosUserBanner($userId) . $between . obtainPortalsUserBanner($userId, $typeView) . $fin;
    
}

?>