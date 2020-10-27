<?php
session_start();
require_once('elements/config.php');
require_once('elements/header.php');
require_once('elements/nav.php');

if(isset($_GET['pays'])){
    $_SESSION['pays'] = $_GET['pays'];
}


    $data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/countries/'.strtolower($_SESSION['pays']));
    $obj = json_decode($data);

    /*
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    */

        $sourceImg = $obj->countryInfo->flag;
        $pays = $obj->country;

        $casTotaux = number_format($obj->cases,0,","," ");

        $casActif = number_format($obj->active,0,","," ");
        $mortsActif = number_format($obj->deaths,0,","," ");
        $guerrisActif = number_format($obj->recovered,0,","," ");
        $casCritique = number_format($obj->critical,0,","," ");

        $casAjd = number_format($obj->todayCases,0,","," ");
        $mortsAjd = number_format($obj->todayDeaths,0,","," ");
        $guerisAjd = number_format($obj->todayRecovered,0,","," ");

        $casMillion = number_format($obj->casesPerOneMillion,0,","," ");
        $mortsMillion = number_format($obj->deathsPerOneMillion,0,","," ");

        $testEffectues = number_format($obj->tests,0,","," ");

        $pourcentageCas = (100 * $obj->cases ) / $obj->population;
        $pourcCas = number_format($pourcentageCas,0,","," ");

        $pourcentageMorts = (100 * $obj->deaths ) / $obj->cases;
        $pourcMorts = number_format($pourcentageMorts,0,","," ");

        $pourcentageGueris = (100 * $obj->recovered ) / $obj->cases;
        $pourcGueris = number_format($pourcentageGueris,0,","," ");



        /* INFOS PAR JOUR */
        $dataJour = file_get_contents('https://corona.lmao.ninja/V2/historical/'.strtolower($_SESSION['pays']));
        $objJour = json_decode($dataJour);
        
        $tableauDate = array();
        foreach($objJour->timeline->cases as $donnee => $valeur){
            array_push($tableauDate, $donnee);
        }

        $nombre = count($tableauDate);

        $tableau = array();

        for($i = 0; $i < $nombre; $i++){
            $jour = $tableauDate[$i];
            // Vérifier si c'est le 1e jour
            if($i == 0){
                 $veille = $tableauDate[$i];
            } else {
                $veille = $tableauDate[$i - 1];
            }
            
            // Convertir la date en français
            $mois = date("F", strtotime($jour));
            switch($mois) {
                case 'January': $mois = 'janvier'; break;
                case 'February': $mois = 'février'; break;
                case 'March': $mois = 'mars'; break;
                case 'April': $mois = 'avril'; break;
                case 'May': $mois = 'mai'; break;
                case 'June': $mois = 'juin'; break;
                case 'July': $mois = 'juillet'; break;
                case 'August': $mois = 'août'; break;
                case 'September': $mois = 'septembre'; break;
                case 'October': $mois = 'octobre'; break;
                case 'November': $mois = 'novembre'; break;
                case 'December': $mois = 'décembre'; break;
                default: $mois =''; break;
            }
            $dateJour = date("d", strtotime($jour)) . ' ' . $mois;

            if($jour == "3/20/20" AND $pays == "Belgium"){
                $objJour->timeline->recovered->$jour = $objJour->timeline->recovered->$veille;
            }
            
            // Création d'un tableau
            $tab = array(
                'date' => $tableauDate[$i],
                'dateNormal' => $dateJour,
                'time' => mktime(0, 0, 0, date('d', strtotime($tableauDate[$i])), date('m', strtotime($tableauDate[$i])), date('y', strtotime($tableauDate[$i]))),
                'cas' => $objJour->timeline->cases->$jour,
                'morts' => $objJour->timeline->deaths->$jour,
                'guerris' => $objJour->timeline->recovered->$jour,
                'casNouveau' => $objJour->timeline->cases->$jour - $objJour->timeline->cases->$veille,
                'mortsNouveau' => $objJour->timeline->deaths->$jour - $objJour->timeline->deaths->$veille,
                'guerrisNouveau' => $objJour->timeline->recovered->$jour - $objJour->timeline->recovered->$veille,
            );
            // Ajouter le tableau dans le tableau principal
            array_push($tableau, $tab); 
        }
/*
        echo '<pre>';
        print_r($tableau);
        echo '</pre>';
*/
    require_once("graphiques/paysTotauxJour.php");
    require_once("graphiques/paysNouveauxJour.php");
    require_once("composants/infosPays.php");

    require_once('elements/footer.php');

?>