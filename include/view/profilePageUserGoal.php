<?php

require("include/view/bookSummoner.php");

// print_r($GLOBALS);
?>


<section id="userGoal">
    <!-- <div class="col-1">  </div> -->
    <?php if ($_GET["id"] != 7) : ?>
    <div class="book">
        <?php echo createBook($medIndex, $amountComplete); ?>
    </div>
    <?php else : ?>
        <div id="userGoalPageAdmin">
        <h3>Utente admin: non possiede librone! 😉</h3>
        </div>
    <?php endif; ?>

    <!-- <div class="col-1">  </div> -->
</section>

<script src="javascript/personalLibs/PHPGet.js"> </script>
<script src="javascript/personalLibs/ReloaderPage.js"> </script>
<script src="javascript/bookanimation.js"></script>

    
</script>