
<?php // require_once("mysql.php");
ini_set("display_errors", "On");
include_once("Smarty.class.php");

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->config_dir = 'configs';
$smarty->cache_dir = 'cache';
$smarty->caching = false;

$smarty->left_delimiter = "<{";
$smarty->right_delimiter = "}>";

//==============mysqli建立連線=================
//連接db
$conn = mysqli_connect("127.0.0.1","root","66007079","fruit");
// mysqli_query($conn, "SET NAMES uft8");--	

mysqli_query($conn, "SET character_set_client = utf8;");
mysqli_query($conn, "SET character_set_results = utf8;");
mysqli_query($conn, "SET character_set_connection = utf8;");
//$dbname = "fruit";
//判斷連線


if (!$conn){
	exit('error('.mysqli_connect_errno().'):'.mysqli_connect_error());
}
//判斷資料庫
if(!mysqli_select_db($conn, 'fruit')){
	echo 'error('.mysqli_errno($conn).'):'.mysqli_error($conn);
}

//連接table
$fruit = "SELECT * FROM test";
//$fruit = $conn->query_all("SELECT * FROM test");
//$smarty->assign('fruit', $fruit);
$result = mysqli_query($conn, $fruit);
$result3 = mysqli_query($conn, $fruit);//給下方顯示使用

$row = mysqli_fetch_assoc($result);
$total_records = mysqli_num_rows($result);

if(mysqli_connect_errno()){
echo "connect fail!, mysqli_connect_error()";
exit();
}else{
echo "連線ok！";
}
//=====search=====
		@$ser_en = $_POST['ser_en'];
		$fruit2 = "SELECT * FROM test where f_en = '$ser_en'";
		$result2 = mysqli_query($conn, $fruit2);
		$row2 = mysqli_fetch_assoc($result2);//不用再寫判斷式 因為這裡已經針對在文字欄位輸入英文时 存成變數$ser_en 然後搜尋對應的f_en = '$ser_en' 將對應到的結果存到$row2 因此輸入英文就可以找到對應的中文
//=====search=====
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
		//foreach ($_POST['seq'] as $i=>$_POST['seq']){}
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
	$add = mysqli_query($conn, $insert);	
	header("location:admin.php");
}
//======新增=======


//======foreach=====


//======foreach=====

//===========smarty===========
$row_seq = $row['f_seq'];
$row_en = $row['f_en'];
$row_ch = $row['f_ch'];
$row2_en = $row2['f_en'];
$row2_ch = $row2['f_ch'];//英文搜尋顯示中文
$smarty->assign('word',
	array('search_en' => '請輸入欲查詢英文：',
		  'result_ch' => '中文查詢結果：',
		  'insert_en' => '請輸入欲新增之英文：',
		  'insert_ch' => '請輸入欲新增之中文：',
		  'f_seq' => '序號',
		  'f_en' => '英文',
		  'f_ch' => '中文',
		  'del' => '刪除',
));
$list = array();

 while($row = mysqli_fetch_assoc($result3)){
 	$list[]= $row;
 }

$smarty->assign('row', $row);
$smarty->assign('row_seq', $row_seq);
$smarty->assign('row_en', $row_en);
$smarty->assign('row_ch', $row_ch);
$smarty->assign('row2_en', $row2_en);
$smarty->assign('row2_ch', $row2_ch);
$smarty->assign('list', $list);

$smarty->display("admin.tpl");

//===========smarty===========
?>

<!--
<form name="f1" method="post" action="admin.php" enctype="multipart/form-data">
<table border=1 align=center >
	
	<tr>
		<td>請輸入欲查詢英文：</td>
		<td><input name="ser_en" type="text"></td>
		<td><input type="submit" name="search"></td>
		<td>&nbsp;<input type="hidden" name="hid"></td>
		<td></td>
	</tr>
	<tr>
		<td>中文查詢結果：</td>
		<td><?php ?></td>
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
/*
	$ind = 0;
	while($row = mysqli_fetch_assoc($result3)){//將陣列以欄位名索引	
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
	}//while結尾
*/
	?>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="update" value="修改" ></td>
		<td><input type="reset" name="reset" value="清除"  ></td>
		<td>&nbsp;</td>
		<td></td>
	</tr>


</table>
</form>
-->

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
