<?php
$clickf = "clicks.txt";
$viewf = "views.txt";
$urlf = "urls.txt";
$namef = "names.txt";
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
if ($action == "click" && $id != "") {
	$fd = fopen ($clickf, "w");
		for ($i = 0; $i <=count($namearray); $i++) {
			$calc = $clickarray[$i]+1;
			if ($id == $i) { fwrite ($fd, "$calc\n"); }
			if ($id != $i) { fwrite ($fd, $clickarray[$i]); }
		}
	fclose($fd);
	$url = chop($urlarray[$id]);
	Header("Location: $url");
}
?>