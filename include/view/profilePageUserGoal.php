<?php

require("include/view/bookSummoner.php");

?>


<section id="userGoal">
    <!-- <div class="col-1">  </div> -->

    <div class="col-12 book">
        <?php echo createBook($medIndex, $amountComplete); ?>
    </div>

    <!-- <div class="col-1">  </div> -->
</section>

<script src="javascript/bookanimation.js"></script>