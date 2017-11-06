<meta charset="utf8"/>
<?php // require_once("mysql.php");
//==============mysqli建立連線=================
//連接db
$conn = mysqli_connect("127.0.0.1","root","66007079","fruit");
// mysqli_query($conn, "SET NAMES uft8");--	

mysqli_query($conn, "SET character_set_client = utf8;");
mysqli_query($conn, "SET character_set_results = utf8;");
mysqli_query($conn, "SET character_set_connection = utf8;");
//$dbname = "fruit";
//判斷連線
if(!$conn){
	exit('error('.mysqli_connect_errno().'):'.mysqli_connect_error());
}
//判斷資料庫
if(!mysqli_select_db($conn, 'fruit')){
	echo 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
}
//連接table
$fruit = "SELECT * FROM test";
$result = mysqli_query($conn, $fruit);
//$row = mysqli_fetch_assoc($result);
/*{
//	print_r($row);
//	echo '測試用1：'.$row['f_en']."-".$row['f_ch'].'<br>';
	print_r($row['f_en']);
	}
	
$f_en = print_r($row['f_en']);

$f_ch = print_r($row['f_ch']);
*/

$total_records = mysqli_num_rows($result);
//echo "test";exit;
if(mysqli_connect_errno()){
echo "connect fail!, mysqli_connect_error()";
exit();
}else{
echo "連線ok！";
}
//==============mysqli建立連線=================

//==========修改＆刪除===========
if(isset($_POST['update'])){
	//修改
	for($i=1;$i<=count($_POST['seq']);$i++){
		$enname = $_POST["enname"][$i];
		$chname = $_POST["chname"][$i];
		$seq = $_POST["seq"][$i];
		$update = "update test set f_en = '$enname', f_ch = '$chname' where f_seq = $seq";
		$update_query = mysqli_query($conn, $update);
	}
	//刪除
	for($i=1;$i<=count($_POST['seq']);$i++){
		if(isset($_POST['del'][$i])){
			$seq = $_POST['seq'][$i];
			$del = "select * from test where f_seq = $seq";
			$del_query = mysqli_query($conn, $del);
			$delete ="delete from test where f_seq = $seq";
			$delete_query = mysqli_query($conn, $delete);
		}

	}
	header("location:admin.php");
}
//==========修改＆刪除===========


//======新增=======
if(isset($_POST["add"])){
	$en_name = $_POST["en"];
	$ch_name = $_POST["ch"];
	$insert = "insert into test(f_en, f_ch)values('$en_name', '$ch_name')";
	/* 此寫法也可以
	if (mysqli_query($conn, $insert)) {
    echo "New record created successfully";
	} else {
    echo "Error: " . $insert . "<br>" . mysqli_error($conn);
	}
	*/
	$add = mysqli_query($conn, $insert);
	
	header("location:admin.php");
}
//======新增=======

?>

<form name="f1" method="post" action="admin.php" enctype="multipart/form-data">
<table border=1 align=center >
	<tr>
		<?php
		@$ser_en = $_POST['ser_en'];
		$fruit2 = "SELECT * FROM test where f_en = '$ser_en'";
		$result2 = mysqli_query($conn, $fruit2);
		$row2 = mysqli_fetch_assoc($result2);
		?>
		<td>請輸入欲查詢英文：</td>
		<td><input name="ser_en" type="text"></td>
		<td><input type="submit" name="search"></td>
		<td>&nbsp;<input type="hidden" name="hid"></td>
		<td></td>
	</tr>
	<tr>
		<td>中文查詢結果：</td>
		<td><?php if($row2['f_en']==$ser_en){echo $row2['f_ch'];}?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td></td>
	</tr>
	<tr>
		<td>請輸入欲新增之英文：</td>
		<td><input name="en"></td>
		<td>請輸入欲新增之中文：</td>
		<td><input name="ch"></td>
		<td><input type="submit" name="add" value="新增"></td>		
	</tr>
	<tr align="center">
		<td>序號</td>
		<td>英文</td>
		<td>中文</td>
		<td>刪除</td>
		<td></td>
	</tr>

	<?php
	$ind = 0;
	for($j=0;$j<$total_records;$j++){$row = mysqli_fetch_assoc($result);//將陣列以欄位名索引	
	$ind++;//計算序號
	?>
	<tr>
		<td align="center"><?php echo $ind; ?></td>
		<td><input type="text" name="enname[<?php echo $ind; ?>]" value="<?php echo $row['f_en']; ?>"></td>
		<td><input type="text" name="chname[<?php echo $ind; ?>]" value="<?php echo $row['f_ch']; ?>"></td>
		<td><input type="checkbox" name="del[<?php echo $ind; ?>]"></td>
		<td><input type="hidden" name="seq[<?php echo $ind; ?>]" value="<?php echo $row['f_seq']; ?>"></td>
	</tr>
	<?php 
	}//for結尾?>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="update" value="修改" ></td>
		<td><input type="reset" name="reset" value="清除"  ></td>
		<td>&nbsp;</td>
		<td></td>
	</tr>


</table>
</form>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
