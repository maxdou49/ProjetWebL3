<h2>Modifier</h2>
<table>
<?php
    $liste = $xml->xpath("//operation[type='modifier']");
    foreach($liste as $elt)
    {
        echo "<tr><td>".$elt->horodate."</td><td>".$elt->desc."</td></tr>";
    }
?>
</table>
<h2>Voir</h2>
<table>
<?php
    $liste = $xml->xpath("//operation[type='voir']");
    foreach($liste as $elt)
    {
        echo "<tr><td>".$elt->horodate."</td><td>".$elt->desc."</td></tr>";
    }
?>
</table>
<h2>Autre</h2>
<table>
<?php
    $liste = $xml->xpath("//operation[type='other']");
    foreach($liste as $elt)
    {
        echo "<tr><td>".$elt->horodate."</td><td>".$elt->desc."</td></tr>";
    }
?>
</table>