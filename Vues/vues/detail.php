<h2>#<?=$poke->getID()?> : <?=$poke->getNom()?></h2>
<?php
    require_once "Modeles/Type.php";
    function afficherType($type)
        {
            if(!$type)
            {
                return;
            }
            if($type->getImage() != "")
            {
                echo "<img src=\"{$type->getImage()}\" />";
            }
            else
            {
                echo $type->getNom();
            }
        }
    echo "<p>Types : ";
    afficherType($poke->getType1());
    if($poke->getType2())
    {
        echo " ";
        afficherType($poke->getType2());
    }
    echo "</p>";

    echo "<p>Taille : {$poke->getTaille()} dm</p>";
    echo "<p>Poids : {$poke->getPoids()} hg</p>";

    $aff = $poke->getAffinites();
    $tab = array();
    foreach($aff as $k => $v)
    {
        $v = (string)$v;
        if(isset($tab[$v]))
        {
            $tab[$v][] = $k;
        }
        else
        {
            $tab[$v] = array($k);
        }
    }
    /*echo "<pre>";
    var_dump($tab);
    echo "</pre>";*/
    echo "<p>Sensibilités : </p>";
    echo "<table>";
    foreach($tab as $k => $v)
    {
        if($k == 1) {continue;}
        echo "<tr><th>x".$k."</th></tr><td>";
        foreach($v as $t)
        {
            afficherType(Type::obtenirType($t));
        }
        echo "</td></tr>";
    }
    echo "</table>";
?>