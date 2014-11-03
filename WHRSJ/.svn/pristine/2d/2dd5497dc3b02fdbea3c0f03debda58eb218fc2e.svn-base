<?php // $Id: page.tpl.php,v 1.17 2009/05/07 17:00:40 jmburnz Exp $
/**
 * @file
 *  page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" media="all" href="/sites/all/modules/conference/css/tables.css" />
</head>
<body >
<?php
    
    ;
    ?> 
    <div style="margin-top:0px;"><h1 style="text-align:center"><?php echo '武汉市'.$cnfname->conference_name.'评审会主任寄语';?></h1></div>
		<table class="tabl"> 
		<tr>
		<td style="width:40px;height:33px;text-align:center;">序号</td>
		<td style="width:100px;height:33px;text-align:center;">姓名</td>
		<td style="width:500px;height:33px;text-align:center;">主任寄语</td>
		</tr>
    <?php
    $sql ="select a.* from {conference_baseinfo} a where status=1";
    $result1 = db_query($sql);
    while($cnfname = db_fetch_object($result1)){
    $sql = "SELECT c.* FROM {conference_comment} c where c.specgrp=$cnfname->id";	
	$result = db_query($sql);   
	$i = 0;
	while ($data = db_fetch_object($result)) { 
		$i++;
		$rows[] = array('data' =>
				array(
						$i,
						$data->name,
						$data->comment,
				)
		);?>
		<tr>
		<td style="width:40px;height:33px;text-align:center;"><?php echo $i; ?></td>
		<td style="width:100px;height:33px;text-align:center;"><?php echo $data->name; ?></td>
		<td style="width:500px;height:33px;"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$data->comment; ?></td>
		</tr>
		<?php }}?>
	     </table> 
	       
	</body>
	</html>