<?php

require("include/view/bookSummoner.php");

?>


<section id="userGoal">
    <!-- <div class="col-1">  </div> -->
    <?php if ($_GET["id"] != 7) : ?>
    <div class="book">
        <?php echo createBook($medIndex, $amountComplete); ?>
    </div>
    <?php else : ?>
        <h3>Utente admin: non possiede librone! 😉</h3>
    <?php endif; ?>

    <!-- <div class="col-1">  </div> -->
</section>

<script src="javascript/bookanimation.js">
    
</script>