<?php

require("include/view/bookSummoner.php");

?>


<section id="userGoal">
    <?php if ($_GET["id"] != 7) : ?>
    <div class="book">
        <?php echo createBook($medIndex, $amountComplete); ?>
    </div>
    <?php else : ?>
        <div id="userGoalPageAdmin">
        <h3>Utente admin: non possiede librone! 😉</h3>
        </div>
    <?php endif; ?>

</section>

<?php if(!isset($GLOBALS["includedPHPGetLib"])) {
        $GLOBALS["includedPHPGetLib"] = 1;
        echo "<script src=\"javascript/personalLibs/PHPGet.js\"> </script>";
} ?>

<script src="javascript/personalLibs/ReloaderPage.js"> </script>
<script src="javascript/bookanimation.js"></script>