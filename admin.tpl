<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$title}</title>
</head>
<body>
<{$content}>


<form name="f1" method="post" action="admin.php" enctype="multipart/form-data">
<table border=1 align=center >
	<tr><td align="center">smarty</td></tr>
	<tr>
	
		<td><{$word.search_en}></td>
		<td><input name="ser_en" type="text"></td>
		<td><input type="submit" name="search"></td>
		<td>&nbsp;<input type="hidden" name="hid"></td>
		<td>

</td>
	</tr>
	<tr>
		<td><{$word.result_ch}></td>
		<td><{$row2_ch}></td>
		<td><{$fruit}></td>
		<td>&nbsp;</td>
		<td></td>
	</tr>
	<tr>
		<td><{$word.insert_en}></td>
		<td><input name="en"></td>
		<td><{$word.insert_ch}></td>
		<td><input name="ch"></td>
		<td><input type="submit" name="add" value="新增"></td>		
	</tr>
	<tr align="center">
		<td><{$word.f_seq}></td>
		<td><{$word.f_en}></td>
		<td><{$word.f_ch}></td>
		<td><{$word.del}></td>
		<td></td>
	</tr>
$ind=0;
while
$ind++
	<{foreach from=$list item=name key=k}>

	<tr>
		<td align="center"><{$ind}><{$k}></td>
		<td><input type="text" name="enname[<{$k+1}>]" value="<{$name.f_en}>"></td>
		<td><input type="text" name="chname[<{$k+1}>]" value="<{$name.f_ch}>"></td>
		<td><input type="checkbox" name="del[<{$k+1}>]"></td>
		<td><input type="hidden" name="seq[<{$k+1}>]" value="<{$name.f_seq}>"></td></td>
	</tr>
	<{/foreach}>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="update" value="修改" ></td>
		<td><input type="reset" name="reset" value="清除"  ></td>
		<td>&nbsp;</td>
		<td></td>
	</tr>


</table>
</form>
</body>
</html>