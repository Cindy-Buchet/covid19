<section class="infos-pays">
    <div class="container">

        <div class="row">
            <div class="col-1">
                <img class="img-pays" src="<?php echo $sourceImg; ?>" alt="pays: <?php echo $pays; ?>"/>
        
            </div>
            <div class="col-11">
                <h1><?php echo $pays; ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <p class='text-bold'><?php if(isset($casTotaux)){ echo $casTotaux; } ?></p>
                        <p>Cas totaux</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <p class='text-blue'><?php if(isset($casActif)){ echo $casActif; } ?></p>
                        <p>Cas</p> 
                        <p class="text-small">(+ <?php if(isset($casAjd)){ echo $casAjd; } ?> nouveaux)</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <p class='text-red'><?php if(isset($mortsActif)){ echo $mortsActif; } ?></p>
                        <p>Morts</p>
                        <p class="text-small">(+ <?php if(isset($mortsAjd)){ echo $mortsAjd; } ?> nouveaux)</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <p class='text-green'><?php if(isset($guerrisActif)){ echo $guerrisActif; } ?></p>
                        <p>Guéris</p>
                        <p class="text-small">(+ <?php if(isset($guerisAjd)){ echo $guerisAjd; } ?> nouveaux)</p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h2>Autres données:</h2>
                        <p>Cas critiques: <?php if(isset($casCritique)){ echo $casCritique; } ?></p>
                        <p>Tests effectuées: <?php if(isset($testEffectues)){ echo $testEffectues; } ?></p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <?php 
                            $pourcentage = $pourcCas; 
                            require("svg.php");
                        ?>
                        <p>Taux de cas sur la population</p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <?php 
                            $pourcentage = $pourcMorts; 
                            require("svg.php");
                        ?>
                        <p>Taux de mortalité</p>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card card-center">
                    <div class="card-body">
                        <?php 
                            $pourcentage = $pourcGueris; 
                            require("svg.php");
                        ?>
                        <p>Taux de guérisons</p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card">
            <div class="card-body">
                <h2>Totaux par jour:</h2>
                <div id="chartdiv"></div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body">
                <h2>Nouveaux par jour:</h2>
                <div id="chartdiv2"></div>
            </div>
        </div>
    </div>
</section>