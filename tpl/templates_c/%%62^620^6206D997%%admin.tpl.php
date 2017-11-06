<?php /* Smarty version 2.6.30, created on 2017-11-06 13:38:30
         compiled from admin.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$title}</title>
</head>
<body>
<?php echo $this->_tpl_vars['content']; ?>



<form name="f1" method="post" action="admin.php" enctype="multipart/form-data">
<table border=1 align=center >
	<tr><td align="center">smarty</td></tr>
	<tr>
	
		<td><?php echo $this->_tpl_vars['word']['search_en']; ?>
</td>
		<td><input name="ser_en" type="text"></td>
		<td><input type="submit" name="search"></td>
		<td>&nbsp;<input type="hidden" name="hid"></td>
		<td>

</td>
	</tr>
	<tr>
		<td><?php echo $this->_tpl_vars['word']['result_ch']; ?>
</td>
		<td><?php echo $this->_tpl_vars['row2_ch']; ?>
</td>
		<td><?php echo $this->_tpl_vars['fruit']; ?>
</td>
		<td>&nbsp;</td>
		<td></td>
	</tr>
	<tr>
		<td><?php echo $this->_tpl_vars['word']['insert_en']; ?>
</td>
		<td><input name="en"></td>
		<td><?php echo $this->_tpl_vars['word']['insert_ch']; ?>
</td>
		<td><input name="ch"></td>
		<td><input type="submit" name="add" value="新增"></td>		
	</tr>
	<tr align="center">
		<td><?php echo $this->_tpl_vars['word']['f_seq']; ?>
</td>
		<td><?php echo $this->_tpl_vars['word']['f_en']; ?>
</td>
		<td><?php echo $this->_tpl_vars['word']['f_ch']; ?>
</td>
		<td><?php echo $this->_tpl_vars['word']['del']; ?>
</td>
		<td></td>
	</tr>
	<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['name']):
?>

	<tr>
		<td align="center"><?php echo $this->_tpl_vars['ind']; ?>
<?php echo $this->_tpl_vars['k']; ?>
</td>
		<td><input type="text" name="enname[<?php echo $this->_tpl_vars['k']+1; ?>
]" value="<?php echo $this->_tpl_vars['name']['f_en']; ?>
"></td>
		<td><input type="text" name="chname[<?php echo $this->_tpl_vars['k']+1; ?>
]" value="<?php echo $this->_tpl_vars['name']['f_ch']; ?>
"></td>
		<td><input type="checkbox" name="del[<?php echo $this->_tpl_vars['k']+1; ?>
]"></td>
		<td><input type="hidden" name="seq[<?php echo $this->_tpl_vars['k']+1; ?>
]" value="<?php echo $this->_tpl_vars['name']['f_seq']; ?>
"></td></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>

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