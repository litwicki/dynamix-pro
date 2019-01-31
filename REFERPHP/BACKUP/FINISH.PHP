<?
session_start();
$tit = $title . " - Finish It!";
?>
<html>
<head>
<title><? echo $tit; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?
if($refid && $refname && $refemail) {
echo <<<END
<table width="300" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" align="center">
  <tr>
    <td bordercolor="#000000" bgcolor="#999999"> 
      <div align="center"><font color="#FFFFFF">Referral Information</font></div>
    </td>
  </tr>
  <tr>
    <td><b>Name:</b> $refname<br>
      <b>Email:</b> <a href="$refemail">$refemail</a><br>
      <b>ID:</b> $refid</td>
  </tr>
</table>
END;
}
?>
<?
if(!$email) {
echo <<<END
Please enter your email address!<br>
<form action="finish.php" method=post>
Email: <input type=text name=email><br>
<input type=submit value="Finish!">
</form>
END;
}
else {
session_register("email");
include("sql.php");
$q=mysql_query("select * from referrers where name=\"$name\" and email=\"$email\"");
if(!mysql_fetch_array($q)) {
mysql_query("insert into referrers values (0,\"$name\",\"$email\",0)");
$q = mysql_fetch_array(mysql_query("select * from referrers where name=\"$name\" and email=\"$email\""));
if(1): ?>
Welcome to the Referrers Program, <? echo $name; ?>!<br>
Your new Referrer ID is <? echo $q[id]; ?><br>
Use this url to refer other people: <a href="http://www.girotek.com/~viperzpit/jake/?refid=<? echo $q[id]; ?>">http://www.girotek.com/~viperzpit/jake/?refid=<? echo $q[id]; ?></a><br>
Thanks!
<? endif; }
else {
echo <<<END
You already exist in the database, please return to the main page and try again.<br>
<a href="index.php?refid=$refid">Return to the main page</a>
END;
}
 } 
session_destroy();
?>
</body>
</html>
