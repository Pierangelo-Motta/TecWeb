<?php

require("include/bookSummoner.php");

///////////////////////////
// Put in profilePage

// $userId = $_GET["id"];

// $allMeds = getAllMedOfUserId($userId);
// $completeMeds = getMedCompletatiByUserId($userId);
// $notCompleteMeds = array_diff($allMeds, $completeMeds);

// $medIndex = array_merge($completeMeds,$notCompleteMeds);
// $amountComplete = sizeof($completeMeds);

//////////////////////////////////

// echo "<br>";
// print_r($allMeds);
// echo "<br>";
// print_r($completeMeds);
// echo "<br>";
// print_r($notCompleteMeds);

// foreach ($allMeds as $m) {
//     echo "<br> AAA:";
//     print_r(getLibroEAutoreByMedagliereId($m));
//     echo "<br>";
// }
// echo "BBB: ";
// print_r(array_merge($completeMeds,$notCompleteMeds));

?>


<section id="userGoal">
    <!-- <div class="col-1">  </div> -->

    <div class="col-12 book">
        <?php echo createBook($medIndex, $amountComplete); ?>
    </div>

    <!-- <div class="col-1">  </div> -->
</section>

<script src="javascript/bookanimation.js"></script>