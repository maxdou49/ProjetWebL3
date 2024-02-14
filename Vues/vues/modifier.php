<form method="POST" action="modifier">
    <label for="poke">Pokemon : </label>
    <select name="poke">
        <?php
            foreach($liste as $p)
            {
                echo "<option value=\"".$p["id"]."\">".$p["id"]." - ".$p["nom"]."</option>";
            }
        ?>
    </select><br/>
    <label for="taille">Taille : </label>
    <input name="taille" type="number" min=0 max=9999 required/> dm<br/>
    <label for="poids">Poids : </label>
    <input name="poids" type="number" min=0 max=9999 required/> hg<br/>
    <input type="submit" value="valider">
</form>