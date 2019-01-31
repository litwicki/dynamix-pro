<?
session_start();
if($refid) {
 include("sql.php");
 $q=mysql_query("select * from referrers where id=$refid");
 if($q) {
$q = mysql_fetch_array($q);
  session_register("refid");
  session_register($refname);
  session_register($refemail);
  $refname=$q[name];
  $refemail=$q[email];
 }
}
session_register($title);
$title = "Example";
if($refname) { $title .= " - " . $refname; }
?>
<html>
<head>
<title><? echo $title; ?></title>
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
<form name="form1" method="post" action="step2.php">
  Name: 
  <input type="text" name="name">
  <br>
  <input type="submit" name="Submit" value="Next &gt;&gt;">
</form>
</body>
</html>
