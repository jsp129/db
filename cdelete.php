<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("class",$con);
if($UserID != $id){
	echo ("<script>
		window.alert('���� ���丸 ���� �����մϴ�!')
		history.go(-1)
		</script>");
    exit;
}


mysql_query("delete from memojang where id='$id' and wdate='$date' and code='$code'",$con);

mysql_close($con);	

echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
?>