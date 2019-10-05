<?php
require_once("_DIR_ . \"/../../app/controller.php");
require_once ("../app/sqlite.php");
$language = new SQLite_core();
$words = $language->Language();
?>
<html>
	<head>
		<meta charset=UTF8>
		<title>BANLIST</title>
        <link href='https://fonts.googleapis.com/css?family=Black+Ops+One|Luckiest+Guy|Sonsie+One|Shojumaru&effect=3d|3d-float|anaglyph|brick-sign|canvas-print|
            crackle|decaying|destruction|distressed|distressed-wood|emboss|fire|fire-animation|fragile|grass|ice|mitosis|neon|outline|putting-green|
            scuffed-steel|shadow-multiple|splintered|static|stonewash|vintage|wallpaper'
              rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
                <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
                <link rel="icon" type="image/png" href="css/favicon.png" />
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/script.js"></script>
	
	
	</head>
	<body>
    <center><br><h1 class="header"><?php echo $words[5]; ?></h1></center>
    <table>
        <tr  class="prvni">
            <th class="header"><?php echo $words[6]; ?></th>
            <th class="header"><?php echo $words[7]; ?></th>
            <th class="header"><?php echo $words[8]; ?></th>
            <th class="header"><?php echo $words[9]; ?></th>
            <th class="header"><?php echo $words[10]; ?></th>
            <th class="header"><?php echo $words[11]; ?></th>
            <th class="header"><?php echo $words[12]; ?></th>
        </tr>
        <?php
        $controller = new TeamSpeak3_Controller();
        $controller->TeamSpeak3_Banlist_Controller();
        ?>
        <div class="footer">
            Graphically Designed by
            <a class="dave" href=https://github.com/DV2013DAWE> DAWE Graphics</a><br>
            Developed by
            <a class="dave" href=https://github.com/ArrayMy>ArrayMy</a><br>
        </div>
    </body>
</html>
