<?php
require_once('elements/config.php');
require_once('elements/header.php');
require_once('elements/nav.php');

echo '<section class="container">';
echo '
<form name="choixinput" method="GET" action="tops.php">
<div class="form-group row">
  <label class="col-3" for="exampleFormControlSelect1">Type de classement</label>

  <select onchange="soumettre()" class="col-5 form-control" id="exampleFormControlSelect1" name="tops">
    

    <option onchange="soumettre()" value="alphabetique" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "alphabetique"){ echo 'selected';} 
    echo '>Alphabétique</option>

    <option onchange="soumettre()" value="cases" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "cases"){ echo 'selected';} 
    echo '>Cas totaux</option>

    <option onchange="soumettre()" value="active" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "active"){ echo 'selected';} 
    echo '>Cas actifs</option>

    <option onchange="soumettre()" value="deaths" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "deaths"){ echo 'selected';} 
    echo '>Morts</option>

    <option onchange="soumettre()" value="recovered" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "recovered"){ echo 'selected';} 
    echo '>Guéris</option>

    <option onchange="soumettre()" value="critical" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "critical"){ echo 'selected';} 
    echo '>Cas critiques</option>

    <option onchange="soumettre()" value="todayCases" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "todayCases"){ echo 'selected';} 
    echo '>Nouveaux cas</option>

    <option onchange="soumettre()" value="todayDeaths" ';
    if(isset($_GET['tops']) AND $_GET['tops'] == "todayDeaths"){ echo 'selected';} 
    echo '>Nouveaux morts</option>
  </select>

</div>
</form>
</section>';

if(isset($_GET['tops']) AND $_GET['tops'] == "alphabetique"){
  $data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/countries');
} else if(isset($_GET['tops'])){
  $data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/countries?sort='.$_GET['tops']);
} else {
  $data = file_get_contents('https://corona.lmao.ninja/v3/covid-19/countries');
}
    $obj = json_decode($data);

    echo '
    <form method="GET" name="checks" action="pays.php">
    <table class="table table-striped table-tops">
    <thead>
      <tr>
        <th rowspan="2"></th>
        <th class="td-right" scope="col" rowspan="2">Pays</th>
        <th class="td-right" scope="col" rowspan="2">Cas totaux</th>
        <th class="td-right th-center" colspan="3" scope="col">Actifs</th>
        <th class="td-right" scope="col" rowspan="2">Cas critiques</th>
        <th class="th-center" colspan="2" scope="col">Nouveaux</th>
      </tr>
      <tr>
        <th scope="col">Cas</th>
        <th scope="col">Morts</th>
        <th class="td-right" scope="col">Guéris</th>
        <th scope="col">Cas</th>
        <th scope="col">Morts</th>
      </tr>
    </thead>
    <tbody>';
    $id = 0;
    foreach($obj as $donnee => $valeur){
        $number = number_format($valeur->cases,0,","," ");
        // Création d'un tableau

        echo '
        <tr>
            <th scope="row">' . $id  . '</th>
            <td class="td-right display-flex">
              <img class="img-drapeau" src="' . $valeur->countryInfo->flag . '">
              <input class="td-btn" name="pays" value="' . $valeur->country  . '" type="submit">
            </td>
            <td class="td-cases td-right">' . number_format($valeur->cases,0,","," ") . '</td>
            <td class="td-active">' . number_format($valeur->active,0,","," ") . '</td>
            <td class="td-deaths">' . number_format($valeur->deaths,0,","," ") . '</td>
            <td class="td-recovered td-right">' . number_format($valeur->recovered,0,","," ") . '</td>
            <td class="td-right">' . number_format($valeur->critical,0,","," ") . '</td>
            <td>' . number_format($valeur->todayCases,0,","," ") . '</td>
            <td>' . number_format($valeur->todayDeaths,0,","," ") . '</td>
        </tr>';
        $id = $id + 1;
    }

    echo '</tbody>
    </table>
    </form>';
 /*   
    echo '<pre>';
    print_r($tableauPays);
    echo '</pre>';
 */   

require('elements/footer.php');
?>