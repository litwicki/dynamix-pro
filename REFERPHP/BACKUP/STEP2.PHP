<?
session_start();
$tit = $title . " - Step 2";
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
if(!$name) { 
echo <<<END
<form name="form1" method="post" action="step2.php">
  Name: 
  <input type="text" name="name">
  <br>
  <input type="submit" name="Submit" value="Next &gt;&gt;">
</form>
END;
}
else {
session_register("name");
if(1): ?>
Hello, <? echo $name; ?>, What is your email address?<br>
<form action="finish.php" method=post>
Email: <input type=text name=email><br>
<input type=submit value="Finish!">
</form>
<? endif; 
}
?>
</body>
</html>
