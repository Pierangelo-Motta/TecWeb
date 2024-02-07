<?php

require("include/login.controller.php");
require("include/login.model.php");
require_once("include/model/selectors.php");

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

function createImage($userIdCommentor, $dataComment, $isMyPost){

    $userImg = getUserImage(tmpGetUsernameById($userIdCommentor));

    $propicClass = "userCommentedImg" . (($isMyPost) ? " myComment" : "");

    $imgDef = array(
        "alt" => "Immagine Profilo",
        "class" => $propicClass,
        "src" => $userImg
    );
    if($isMyPost){
       $imgDef["data-thisdate"] = $dataComment;
    }

    $abbrDef = array(
        "title" => "Clicca per eliminare il commento!",
    );
    
    $res = summonHTMLElement("img", $imgDef, "", true);
    if($isMyPost){
        $res = summonHTMLElement("abbr", $abbrDef, $res, false);
    } 

    return $res;
}

function summonComment($userIdCommentor, $dataComment, $comment){
    $username = tmpGetUsernameById($userIdCommentor);

    $isMyPost = ($userIdCommentor == $_SESSION["id"]) ? true : false;

    $divContainerClass = "comment";

    $complete = "<div class=\"" . $divContainerClass . "\">" . 
                    createImage($userIdCommentor, $dataComment, $isMyPost) .
                    "<p class=\"titleOfComment\"> <a href=\"profilePage.php?id=" . $userIdCommentor . "\">" . $username . " </a></p>" . 
                    "<p class=\"commentText\">" . $comment . "</p>" .
                "</div>";
    return $complete;
}


function collectAllComments($userIdPost, $dataPost){
    $allRes = getCommentInfoByPost($userIdPost, $dataPost);
    
    $final = "";
    foreach ($allRes as $singleRow) {
        
        $final .= summonComment($singleRow["utenteIdComm"], $singleRow["dataOraComm"], $singleRow["commento"]);
    }
    return $final;
}






?>