<?php 
//EDIT FILENAMES BELOW IF YOU CHANGE NAME.
$clickf = "clicks.txt";
$viewf = "views.txt";
$urlf = "urls.txt";
$namef = "names.txt";
$passf = "password.txt";
//DO NOT EDIT BELOW
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
$pass = file($passf);
session_start();
if ($action == "logout") { session_destroy(); }
?>
<html>
<head>
<title>bPHP v1.0</title>
<link rel=stylesheet type=text/css href=styles.css>
</head>
<body bgcolor=#FFFFFF>
<table align=center width=750 cellpadding=0 cellspacing=0>
<tr>
<td>
<table align=center width=100% cellpadding=2 cellspacing=0 border=1 bordercolor=#000000>
<tr>
<td>
<table align=center width=100% cellpadding=2 cellspacing=0 bgcolor=#EEEEEE>
<tr>
<td class=title>bPHP v1.0</td>
</tr>
<tr>
<td class=titledesc>DynamixPro Advertisement Tracking.</td>
</tr>
<?php 
if ($password != $pass[0] && $password2 == $pass[0]) { session_register(password); $password = $password2; }
if ($password == $pass[0] && $action != "logout") {
echo "<tr>
<td class=content><a href=?action=home>Home</a> | <a href=?action=statistics>Statistics</a> | <a href=?action=add>Add</a> | <a href=?action=remove>Remove</a> | <a href=?action=edit>Edit</a> | <a href=?action=logout>Logout</a></td>
</tr>";
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr><td height=30></td></tr>
<tr>
<td>
<table align=center width=100% cellpadding=2 cellspacing=0 border=1 bordercolor=#000000>
<tr>
<td>
<table align=center width=100% cellpadding=2 cellspacing=0 bgcolor=#EEEEEE>
<?php
if ($password == $pass[0]) {
if ($action == "add" && $submit == "yes" && $burl && $bname && $upload != 'none') {
	$imagenum = count($namearray);
	$dest = "images/$imagenum.gif";
	if (@copy($upload, $dest)) {
	$action = "statistics";
	}
	$fd = fopen($clickf, "a");
	fwrite($fd, "0\n");
	fclose($fd);
	$fd = fopen($viewf, "a");
	fwrite($fd, "0\n");
	fclose($fd);
	$fd = fopen($urlf, "a");
	fwrite($fd, "$burl\n");
	fclose($fd);
	$fd = fopen($namef, "a");
	fwrite($fd, "$bname\n");
	fclose($fd);
}
if ($action == "" || $action == "home") {
echo "<tr>
<td class=title>Home</td>
</tr>
<tr>
<td class=titledesc>Select an option below.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>
<tr><td width=100><a href=?action=statistics><b>Statistics</b></a></td><td>Check your banner statistics.</td></tr>
<tr><td width=100><a href=?action=add><b>Add</b></a></td><td>Add a banner to the database.</td></tr>
<tr><td><a href=?action=remove><b>Remove</b></a></td><td>Completely remove a banner from the database.</td></tr>
<tr><td><a href=?action=edit><b>Edit</b></a></td><td>Edit current banners.</td></tr>";
}
if ($action == "statistics") {
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
echo "<tr>
<td class=title>Statistics</td>
</tr>
<tr>
<td class=titledesc>Below are statistics on how many clicks and views each banner gets.</td>
</tr>
<tr><td  class=content style=color=#0075BB><img src=statbars/clicks.gif height=13 width=10> <b>Clicks</b></td></tr><tr><td class=content style=color=#BB0000 width=100%><img src=statbars/views.gif height=13 width=10> <b>Views</b></td></tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>";
$total = $clickarray[0];
for ($i = 1; $i <=count($namearray); $i++) {
$total = $total+$clickarray[$i];
}
$totalv = $viewarray[0];
for ($i = 1; $i <=count($namearray); $i++) {
$totalv = $totalv+$viewarray[$i];
}
for ($i = 0; $i <=count($namearray); $i++) {
if ($namearray[$i] != "") {
if ($total != 0) { $caverage = round($clickarray[$i]/$total*100, 2); }
if ($total == 0) { $caverage = 0; }
if ($totalv != 0) { $vaverage = round($viewarray[$i]/$totalv*100, 2); }
if ($totalv == 0) { $vaverage = 0; }
$name = chop($namearray[$i]);
echo "<tr><td><b>$name</b></td><td class=content style=color=#0075BB width=100%><img src=statbars/clicks.gif height=13 width=$caverage> <b>$clickarray[$i]/$caverage%</b></td></tr>
<tr><td></td><td class=content style=color=#BB0000 width=100%><img src=statbars/views.gif height=13 width=$vaverage> <b>$viewarray[$i]/$vaverage%</b></td></tr>";
}
}
if ($namearray[0] == "") { echo "<tr><td valign=top>No banners are in database.</td></tr>"; }
}
if ($action == "add") {
echo "<tr>
<td class=title>Add</td>
</tr>
<tr>
<td class=titledesc>Fill in the fields below to add a banner.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>
<tr><form method=POST  enctype=multipart/form-data action=?action=add&submit=yes><td width=100><b>Name:</b></td><td><input type=text name=bname></td></tr>
<tr><td width=100><b>URL:</b></td><td><input type=text name=burl></td></tr>
<tr><td width=100><b>Picture:</b></td><td><input type=file name=upload></td></tr>
<tr><td width=100><b></b></td><td><input type=submit value=Submit></form></td></tr>";
}
if ($action == "remove") {
if ($id != "") {
	$fd = fopen($viewf, "w");
	for ($i = 0; $i <=count($namearray); $i++) {
		if ($id == $i) { fwrite ($fd, ""); }
		if ($id != $i) { fwrite ($fd, $viewarray[$i]); }
	}
	fclose($fd);
	$fd = fopen($clickf, "w");
	for ($i = 0; $i <=count($namearray); $i++) {
		if ($id == $i) { fwrite ($fd, ""); }
		if ($id != $i) { fwrite ($fd, $clickarray[$i]); }
	}
	fclose($fd);
	$fd = fopen($namef, "w");
	for ($i = 0; $i <=count($namearray); $i++) {
		if ($id == $i) { fwrite ($fd, ""); }
		if ($id != $i) { fwrite ($fd, $namearray[$i]); }
	}
	fclose($fd);
	$fd = fopen($urlf, "w");
	for ($i = 0; $i <=count($namearray); $i++) {
		if ($id == $i) { fwrite ($fd, ""); }
		if ($id != $i) { fwrite ($fd, $urlarray[$i]); }
	}
	fclose($fd);
	$stop = count($namearray)-1;
	for ($i = $id; $i <=$stop; $i++) {
		if ($id == $i) { 
			if (file_exists("images/$id.gif") == true) {
				unlink("images/$id.gif"); 
			}
		}
		$newid = $i-1;
		if ($id != $i) { rename("images/$i.gif", "images/$newid.gif"); }
	}
}
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
echo "<tr>
<td class=title>Remove</td>
</tr>
<tr>
<td class=titledesc>Click on the name to remove from database.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>";
for ($i = 0; $i <=count($namearray); $i++) {
if ($namearray[$i] != "") {
$name = chop($namearray[$i]);
echo "<tr><td valign=top><a href=?action=remove&id=$i><b>$name</b></a></td><td width=100%><a href=?action=remove&id=$i><img src=\"images/$i.gif\" border=0></a></td></tr>";
}
}
if ($namearray[0] == "") { echo "<tr><td valign=top>No banners are in database.</td></tr>"; }
}
if ($action == "edit") {
     if ($submit == "yes" && $id != "") {
	if ($upload != 'none') {
		$dest = "images/$id.gif"; 
		copy($upload, $dest); 
	}
	if ($bname != "") {
		$fd = fopen($namef, "w");
		for ($i = 0; $i <=count($namearray); $i++) {
			if ($id == $i) { fwrite ($fd, "$bname\n"); }
			if ($id != $i) { fwrite ($fd, $namearray[$i]); }
		}
		fclose($fd);
	}
	if ($burl != "") {
		$fd = fopen($urlf, "w");
		for ($i = 0; $i <=count($namearray); $i++) {
			if ($id == $i) { fwrite ($fd, "$burl\n"); }
			if ($id != $i) { fwrite ($fd, $urlarray[$i]); }
		}
		fclose($fd);
	}
     }
$clickarray = file($clickf);
$viewarray = file($viewf);
$urlarray = file($urlf);
$namearray = file($namef);
echo "<tr>
<td class=title>Edit</td>
</tr>
<tr>
<td class=titledesc>Click on a banner below to edit.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>";
if ($id != "") {
echo "<tr><form method=POST  enctype=multipart/form-data action=?action=edit&submit=yes&id=$id><td width=100><b>Name:</b></td><td><input type=text name=bname value='$namearray[$id]'></td></tr>
<tr><td width=100><b>URL:</b></td><td><input type=text name=burl value='$urlarray[$id]'></td></tr>
<tr><td width=100><b>Picture:</b></td><td><input type=file name=upload></td></tr>
<tr><td width=100><b></b></td><td><input type=submit value=Submit></form></td></tr>";
}
else {
for ($i = 0; $i <=count($namearray); $i++) {
if ($namearray[$i] != "") {
$name = chop($namearray[$i]);
echo "<tr><td valign=top><a href=?action=edit&id=$i><b>$name</b></a></td><td width=100%><a href=?action=edit&id=$i><img src=\"images/$i.gif\" border=0></a></td></tr>";
}
}
if ($namearray[0] == "") { echo "<tr><td valign=top>No banners are in database.</td></tr>"; }
}
}
if ($action == "preview") {
echo "<tr>
<td class=title>Preview</td>
</tr>
<tr>
<td class=titledesc>Below is a preview of what your banners will do.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>";
for ($i = 0; $i <=count($namearray); $i++) {
if ($namearray[$i] != "") {
$name = chop($namearray[$i]);
echo "<tr><td valign=top><a href=banner.php?action=click&id=$i><img src=\"images/$i.gif\" border=0></a></td></tr>";
}
}
if ($namearray[0] == "") { echo "<tr><td valign=top>No banners are in database.</td></tr>"; }
}
}
if ($password != $pass[0] || $action == "logout") {
echo "<tr>
<td class=title>Login</td>
</tr>
<tr>
<td class=titledesc>Fill in the authorized password below to login.</td>
</tr>
<tr>
<td class=content>
<table align=center width=100% cellpadding=2 cellspacing=0 class=content style='font-size=13'>
<tr><td width=100><form method=post action=admin.php><b>Password:</b></td><td><input type=password name=password2></td></tr>
<tr><td width=100></td><td><input type=submit value=Submit></form></td></tr>";
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr><td height=10></td></tr>
<tr align=center><td class=content style='color=#0075BB'>&copy; 2001 DynamixPro</td></tr>
<tr align=center><td class=content style='color=#0075BB'>All Rights Reserved</td></tr>
</table>
</body>
</html>