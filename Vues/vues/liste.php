<p>Liste des Pokémon et leurs types.</p>
<table>
    <?php
        require_once "Modeles/Type.php";
        
        function afficherType($type)
        {
            if(!$type)
            {
                return;
            }
            echo "<td>";
            if($type->getImage() != "")
            {
                echo "<img src=\"{$type->getImage()}\" />";
            }
            else
            {
                echo $type->getNom();
            }
            echo "</td>";
        }

        echo "<tr><th>Num</th><th>Nom anglais</th><th>Type 1</th><th>Type 2</td></tr>".PHP_EOL;

        foreach($liste as $p)
        {
            echo "<tr>";
            echo "<td>".$p->getID()."</td><td><a href='detail/".$p->getID()."'>".$p->getNom()."</a></td>";
            afficherType($p->getType1());
            if($p->getType2())
            {
                afficherType($p->getType2());
            }
            else
            {
                echo "<td></td>";
            }
            echo "</tr>";
        }
    ?>
</table>