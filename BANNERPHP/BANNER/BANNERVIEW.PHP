<?php
$clickf = "http://www.dynamixpro.com/php-bin/bphp/banner/clicks.txt";
$viewf = "http://www.dynamixpro.com/php-bin/bphp/banner/views.txt";
$urlf = "http://www.dynamixpro.com/php-bin/bphp/banner/urls.txt";
$namef = "http://www.dynamixpro.com/php-bin/bphp/banner/names.txt";
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
if ($action == "" && $id == "") {
	mt_srand ((double) microtime() * 1000000);
	$amount = count($namearray)-1;
	if ($amount <= 0) { $id = 0; }
	if ($amount > 0) { $id = mt_rand(0, $amount); }
	$fd = fopen ($viewf, "w");
		for ($i = 0; $i <=count($namearray); $i++) {
			$calc = $viewarray[$i]+1;
			if ($id == $i) { fwrite ($fd, "$calc\n"); }
			if ($id != $i) { fwrite ($fd, $viewarray[$i]); }
		}
	fclose($fd);
	echo "<a href=http://www.dynamixpro.com/php-bin/bphp/banner/banner.php?action=click&id=$id><img src=\"http://www.dynamixpro.com/php-bin/bphp/banner/images/$id.gif\" border=0></a>";
}
?>