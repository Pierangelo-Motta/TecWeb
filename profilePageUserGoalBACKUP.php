<?php

$allMeds = getAllMedOfUserId($_SESSION["id"]);
$completeMeds = getMedCompletatiByUserId($_SESSION["id"]);
$notCompleteMeds = array_diff($allMeds, $completeMeds);

echo "<br>";
print_r($allMeds);
echo "<br>";
print_r($completeMeds);
echo "<br>";
print_r($notCompleteMeds);

foreach ($allMeds as $m) {
    getLibroEAutoreByMedagliereId($m);
    echo "<br>";
}
echo "BBB: ";
print_r(array_merge($completeMeds,$notCompleteMeds));

?>


<section id="userGoal">
    <!-- <div class="col-1">  </div> -->

    <div class="col-10 book">

        <div class="page">
            <div id="copertinaAvanti" class="front">
            <h1>Il medagliere di <?php echo $_SESSION["username"]?></h1>
            <!-- <h3>2023.<br>Second edition</h3> -->
            </div>
            
            <div class="back">
            <h2>Lorem Ipsum</h2>
            1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, modi, perspiciatis molestias cum neque delectus eum eveniet repellat iusto totam magnam cupiditate quaerat quis.
            </div>
        </div>

        <div class="page">
            
            <div class="front">
            2. Dolor Molestias aspernatur repudiandae sed quos debitis recusandae consectetur ab facilis voluptates sint vero eos, consequuntur delectus?
            </div>

            <div id="copertinaIndietro" class="back">
            <img src="https://picsum.photos/500/400" alt="Img 1">
            </div>
        
        </div>
    </div>

    <!-- <div class="col-1">  </div> -->
</section>

<script src="javascript/bookanimation.js"></script>