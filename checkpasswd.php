<head>
<title>레알 김치</title>
<link rel="shortcut icon" type="image?x-icon" href="/db/shopping/logo.png">
</head>
<script>
function clearText(thefield){
if (thefield.defaultValue==thefield.value)
        thefield.value = ""
		thefield.type = "password"
} 
function clearText1(thefield){
if (thefield.defaultValue==thefield.value)
        thefield.value = ""
} 

</script>
<?
include("top.html");
echo("	<table width=1000 height=600 border=1 align=center cellspacing=0 bordercolor=#E0E0E0>
			<tr>
				<td>
					<form method=post action=checkpasswd_process.php>
					<table border=0 align=center width=1000 cellspacing=0>
						<tr>
							<td align=center colspan=3>
								<br>
								<img src='/db/shopping/logo/checkpasswd.png'>
							</td>
						</tr>
						<tr height=50 bgcolor=#F3F1F1>
							<td width=350></td>
							<td  width=100><small><font color=gray>아이디</font></small>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td width=550><small><b>$UserID</b></small></td>
						</tr>
						<tr height=50 bgcolor=#F3F1F1>
							<td></td>
							<td><small><font color=gray>비밀번호</font></small>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input autocomplete=off type=text size=20 value=\"비밀번호 입력\" name=upass style=\"font-size:10pt; color:#BDBDBD; font-family:Tahom a;\" onFocus=\"clearText(this)\"></td>
						</tr>
						<tr>
							<td colspan=3>
								<br>
								<table align=center border=0 width=400>
									<tr >
										<td align=center><input type='image' src='/db/shopping/logo/okay.gif'></td>
										<td align=center><a href=index.html><img src='/db/shopping/logo/cancel.gif'></a></td>
									</tr>
								</table>
								<br><br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	");
include("bottom.html");
?>