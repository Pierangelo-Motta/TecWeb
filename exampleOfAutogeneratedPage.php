<?php
include_once("include/view/userBanner.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
</head>
<body>
    <?php
        $listItems = "";
        for ($i=0; $i < 10; $i++) { 
            $listItems .= summonHTMLElement("li", array(), "ciao");
        }

        $listWrapper = summonHTMLElement("ul", array("id" => "myList"), $listItems);

        $img = summonHTMLElement("img", array("src" => "images/logoLetturePremiate.png", "alt" => "Una bella foto"), "", true);

        $tog = $listWrapper . $img;

        $main = summonHTMLElement("main", array(), $tog);

        echo $main;
        //function summonHTMLElement($witch, $arrAttributes, $innerHTML, $isSingle = false){

    ?>
    
</body>
</html>