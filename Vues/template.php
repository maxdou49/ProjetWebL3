<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <base href="<?=$base?>" />
        <link rel="stylesheet" href="public/menu.css">
    </head>
    <body>
        <nav>
            <div class="logo">
                <p><a href="">Pokédex</a></p>
            </div>
            <ul class="nav">
                <li><a href="">Accueil</a></li>
                <li><a href="test">Test</a></li>
                <li><a href="liste">Liste</a></li>
                <li><a href="modifier">Modifier</a></li>
                <li><a href="historique">Historique</a></li>
                <li><a href="type">Afficher par type</a></li>
            </ul>
        </nav>
        <div class="contenu">
            <?=$contenu?>
        </div>
        <nav class="footer">
            <ul>
                <li>Site par Maxence Doucet pour un cours de développement web</li>
            </ul>
        </nav>
    </body>
</html>