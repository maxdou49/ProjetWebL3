<h2>Afficher par type</h2>
<script src="public/listeType.js"></script>
<select id="type" onchange="lister();">
    <?php
        echo "<option value=\"-1\">---</option>";
        foreach($liste as $t)
        {
            echo "<option value=\"".$t["id"]."\">".$t["nom"]."</option>";
        }
    ?>
</select>
<table id="liste">
</table>