
<?php
function nombreJoursOuvres($mois, $annee) {
    // Nombre de jours dans le mois
    $nombreJours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);   
    // Compteur pour les jours ouvrés
    $joursOuvres = 0;   
    // Parcourir tous les jours du mois
    for ($jour = 1; $jour <= $nombreJours; $jour++) {
        // Récupérer le timestamp UNIX pour le jour
        $timestamp = mktime(0, 0, 0, $mois, $jour, $annee);       
        // Vérifier si le jour est un weekend (samedi ou dimanche)
        $jourSemaine = date('N', $timestamp);
        if ($jourSemaine <= 5) { // 1 (lundi) à 5 (vendredi)
            $joursOuvres++;
        }
    }   
    return $joursOuvres;
}

$heureString = date('H:i:s', $heurePrevuesJours);
$heurePrevuesJours2 = strtotime($heureString);


$heuresPrevuesMois = $heurePrevuesJours2*nombreJoursOuvres($mois, $annee);



//compte le nombre de congé restant (dans le cas d'un type de congé précis (congé concerné))
function nombreCongesRestant($conges, $congedroit){
    $nbcongesconcerne = $congedroit['nbJours'];  
    foreach ($conges as $conge) {       
        if ($conge['titreConge']==$congedroit['titreConge']){
            $nbcongesconcerne=$nbcongesconcerne-1; 
        }
    }
    return $nbcongesconcerne;
}


    // if (is_array($reponse)) {
    //     // $value = $result[0]; // Accès sécurisé au premier élément du tableau
    //     echo "banane reussi";
    // } else {
    //     echo "banane";
    // }



            //Execution de la requête
            $sql = "UPDATE heuresprevues SET mois='$mois', annee='$annee', heuresPrevues='$heuresPrevues', nbJoursAnnualisation='$nbJours' WHERE idHeure=$id";
            $answer = $BDD->query($sql);

    
                


?>