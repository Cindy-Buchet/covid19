<?php
require_once('elements/config.php');
require_once('elements/header.php');
require_once('elements/nav.php');

echo '<section class="index"><div class="container-index">';

$data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/all');
$obj = json_decode($data);

?>
<div class="titre">
    <h1>COVID-19</h1>
    <p>Données sur les chiffres.</p>
</div>

<div class="row">
    <div class="col-3">

        <div class="card">
            <div class="card-body">
                <p class="titre-petit">Cas totaux</p>
                <p class="card-text chiffres-1"><?php 
                    echo number_format($obj->cases, 0, ',', ' ');
                ?></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="titre-petit">Morts totaux</p>
                        <p class="card-text chiffres-2"><?php 
                            echo number_format($obj->deaths, 0, ',', ' ');
                        ?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="titre-petit">Guéris totaux</p>
                        <p class="card-text chiffres-2"><?php 
                                echo number_format($obj->recovered, 0, ',', ' ');
                            ?></p>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="card">
            <div class="card-body">
                <p class="titre-petit">Nouveaux cas</p>
                <p class="card-text chiffres-1"><?php 
                    echo number_format($obj->todayCases, 0, ',', ' ');
                ?></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="titre-petit">Nouveau morts</p>
                        <p class="card-text chiffres-2"><?php 
                            echo number_format($obj->todayDeaths, 0, ',', ' ');
                        ?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="titre-petit">Nouveaux guéris</p>
                        <p class="card-text chiffres-2"><?php 
                                echo number_format($obj->todayRecovered, 0, ',', ' ');
                            ?></p>
                    </div>
                </div>
            </div>

        </div>
        

        <div class="card">
            <div class="card-body">
                <p>Autres données</p>
                <ul class="texte-petit">
                    <li>Cas actives:<span class="texte-gras"> <?php 
                        echo number_format($obj->active, 0, ',', ' ');
                    ?></span></li>
                    <li>Cas critiques:<span class="texte-gras"> <?php 
                        echo number_format($obj->critical, 0, ',', ' ');
                    ?></span></li>
                    <li>Tests effectuées:<span class="texte-gras"> <?php 
                        echo number_format($obj->tests, 0, ',', ' ');
                    ?></span></li>
                    <li>Pays touchés:<span class="texte-gras"> <?php 
                        echo number_format($obj->affectedCountries, 0, ',', ' ');
                    ?></span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p>Données sur un million de personnes</p>
                <ul class="texte-petit">
                    <li>Cas:<span class="texte-gras"> <?php 
                        echo number_format($obj->casesPerOneMillion, 0, ',', ' ');
                    ?></span></li>
                    <li>Morts:<span class="texte-gras"> <?php 
                        echo number_format($obj->deathsPerOneMillion, 0, ',', ' ');
                    ?></span></li>
                    <li>Cas actives:<span class="texte-gras"> <?php 
                        echo number_format($obj->activePerOneMillion, 0, ',', ' ');
                    ?></span></span></li>
                    <li>Cas critiques:<span class="texte-gras"> <?php 
                        echo number_format($obj->criticalPerOneMillion, 0, ',', ' ');
                    ?></span></li>
                    <li>Tests effectuées:<span class="texte-gras"> <?php 
                        echo number_format($obj->testsPerOneMillion, 0, ',', ' ');
                    ?></span></li>
                    <li>Guéris:<span class="texte-gras"> <?php 
                        echo number_format($obj->recoveredPerOneMillion, 0, ',', ' ');
                    ?></span></li>
                </ul>
            </div>
        </div>
    
    </div>


    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <?php
                    $data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/historical/all');
                    $obj = json_decode($data);
                    $tableau = array();
                    

                    $tableauDate = array();
                    foreach($obj->cases as $donnee => $valeur){
                        array_push($tableauDate, $donnee);
                    }

                    $nombre = count($tableauDate);
                    
                    $tableau = array();
            
                    for($i = 0; $i < $nombre; $i++){
                        
                        $jour = $tableauDate[$i];
                        $tab = array(
                            'date' => $jour,
                            'cas' => $obj->cases->$jour,
                            'morts' => $obj->deaths->$jour,
                            'guerris' => $obj->recovered->$jour,
                        );
                        // Ajouter le tableau dans le tableau principal
                        array_push($tableau, $tab); 
                        
                        $i++;
                    }

                        echo '<h2 class="card-title">Totaux par jour depuis un mois:</h2><div id="chartdiv"></div>';
                        require_once('graphiques/paysCasTotaux.php');
                    ?>    
            </div> 
        </div>
        
        <div class="card">
            <div class="card-body">
                <?php
                    $dataTop = file_get_contents('https://corona.lmao.ninja/v3/covid-19/countries?sort=casesPerOneMillion');
                    $objTop = json_decode($dataTop);
                    $tableauTop = array();

                    for($i = 0; $i < 15; $i++){
                        $tabTop = array(
                            'country' => $objTop[$i]->country,
                            'cases' => $objTop[$i]->casesPerOneMillion
                        );
                        // Ajouter le tableau dans le tableau principal
                        array_push($tableauTop, $tabTop); 
                    
                    }

                    echo "<h2 class='card-title'>Top pays cas par million d'habitants:</h2><div id='chartdiv2'></div>";
                    require_once('graphiques/topPaysCas.php');
                ?>    
            </div>
        </div>
        
    </div>
    
<!--
    <div class="col-12">
        <div class="card">
           
                $dataContinent = file_get_contents('https://corona.lmao.ninja/v3/covid-19/continents');
                $objContinent = json_decode($dataTop);
                $tableauContinent = array();

                for($i = 0; $i < 15; $i++){
                    $tabContinent = array(
                        'continent' => $objContinent[$i]->continent,
                        'cases' => $objContinent[$i]->cases,
                        'deaths' => $objContinent[$i]->deaths,
                        'recovered' => $objContinent[$i]->recovered
                    );
                    // Ajouter le tableau dans le tableau principal
                    array_push($tableauContinent, $tabContinent); 
                
                }

                echo "<h2>Données de chaque continents:</h2><div id='chartdiv3'></div>";
                require_once('graphiques/continents.php');
               
        </div>
        
    </div>
-->
</div>



<?php
echo '</div></section>';
require('elements/footer.php');
?>