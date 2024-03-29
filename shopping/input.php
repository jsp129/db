

<style type="text/css">

	#cont{
	position : fixed;
	left: 15%;
	top: 200;
	}
	#float_layer{
	top: 100px;
	margin-right: 10px;
	text-align: center;
	}
</style>

<?
if(!$UserID){
	echo("
		<script>
		window.alert('로그인 사용자만 상품 문의 작성이 가능합니다.')
		history.go(-1)
		</script>
	");
	exit;
}
include("top.html");
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("class",$con);

	$result=mysql_query("select * from member where uid='$UserID'",$con);
	$total=mysql_num_rows($result);
	$name=mysql_result($result,0,"uname");
	
echo("
	
	<form method=post action=process.php?writer=$name enctype='multipart/form-data'>
	<table width=800 border=0 align=center>
	<tr>
		<td align=center width=100 ><font size=2><b>이름</b></font> </td>
		<td width=150><small>$name</small></td>
		<td align=center width=100 ><font size=2><b>암호</b></font> </td>
		<td width=450><input type=password name=passwd size=23></td>
	</tr>
	<tr>
		<td colspan=4>
			<hr>
		</td>
	</tr>
	<tr>
		<td align=center ><font size=2><b>제목</b></font> </td>
		<td colspan=3><input type=text name=topic size=60></td>
	</tr>
	<tr>
		<td colspan=4>
			<hr>
		</td>
	</tr>
	<tr>
		<td align=center ><font size=2><b>내용</b></font> </td>
		<td colspan=3>
		<textarea name=content rows=12 cols=62></textarea></td>
	</tr>
	<tr>
		<td colspan=4>
			<hr>
		</td>
	</tr>
	<tr>
		<td align=center ><font size=2><b>첨부</b></font></td>
		<td colspan=3><input type=file name='userfile' size=45 maxlength=80></td>
    </tr>
	<tr>
		<td colspan=4>
			<hr>
		</td>
	</tr>
	<tr>
		<td  colspan=4 align=right>
		<input type=image src=/db/shopping/logo/board_btn_write.gif>
		<a href=munui.php><img src=/db/shopping/logo/board_btn_list.gif></a></td>
	</tr>
	</table>
	</form>
");
echo("
<div id=cont>
<div id=float_layer>
<img src=/db/shopping/logo/qna.gif>
</div>
</div>
");
include("bottom.html");
?>
