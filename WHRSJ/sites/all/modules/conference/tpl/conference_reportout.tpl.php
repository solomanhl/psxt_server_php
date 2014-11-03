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
<link type="text/css" rel="stylesheet" media="all"
	href="/sites/all/modules/conference/css/tables.css" />
</head>
<body>
	<?php
	$pwnum=$baseinfo['expert_number'];
	$sql ="select a.* from {conference_baseinfo} a where id=%d";
	$result = db_query($sql, $baseinfo['id']);
	while($cnfname = db_fetch_object($result)){
		$level = $cnfname->level;
		$specgrp = $cnfname->specgrp;
		$heightdata = null;
		$middata = null;

		$specgrp_array = split ('[,]', $specgrp);
		$midspecgrp = "0,";
		switch ($level){
			case 1:
				$specgrp .= ",";
				break;
			case 2:
				$specgrp = "0,";
				foreach ($specgrp_array as $key=>$value){
					if($value&&$value<200) $midspecgrp .= ($value+100).",";
				}
				break;
			case 3:
				$specgrp .= ",";
				foreach ($specgrp_array as $key=>$value){
					if($value&&$value<200) $midspecgrp .= ($value+100).",";
				}
				break;
		}
		$midspecgrp = substr($midspecgrp, 0, -1);
		$specgrp = substr($specgrp, 0, -1);
		





		if ($level==1){
			$sql = "SELECT c.* FROM {conference_applicant} c where c.specgrp IN ($specgrp) ORDER BY c.id ASC";
			$result = db_query($sql);
			$heightdata = $result;
		}
		if ($level==2){
			$sql = "SELECT c.* FROM {conference_applicant} c where c.specgrp IN ($midspecgrp) ORDER BY c.id ASC";
			$result = db_query($sql);
			$middata = $result;

		}
		if ($level==3){
				$sql = "SELECT c.* FROM {conference_applicant} c where c.specgrp IN ($midspecgrp) ORDER BY c.id ASC";
					
				$result = db_query($sql);
				$middata = $result;
				$sql = "SELECT c.* FROM {conference_applicant} c where c.specgrp IN ($specgrp) ORDER BY c.id ASC";
				$result = db_query($sql);
				$heightdata = $result;
		}


			if ($middata!=null){
	                $i = 0;
	                while ($data = db_fetch_object($middata)) {
		                  $i++;
		                  if($i%20==1){
				?>
	<div style="margin: 0 10px 0 10px;">
		<h2 style="text-align: center; margin-top: 60px;">
			<?php echo '武汉市职称评审投票结果表';?>
		</h2>
		<table style="margin-top: 20px; margin-left: 20px;">
			<tr>
				<td style="width: 260px;"><?php echo '<strong>评委会：</strong>'.'<font size=-1>'.$cnfname->conference_name.'</font>'; ?>
				</td>
				<td style="width: 200px;"><?php echo '<strong>级别：</strong>'.'<font size=2>'."中级".'</font>'; ?>
				</td>
				<td style="width: 200px;"><?php echo '<strong>评委人数：</strong>'.'<font size=2>'.$pwnum.'</font>'; ?>
				</td>
			</tr>
		</table>
		<div style="height: 720px; margin-left: 20px; width: 600px;">
			<table style="text-align: center;" class="tabl">
				<tr>
					<td style="width: 55px;" rowspan="2"><strong>序号</strong></td>
					<td style="width: 90px;" rowspan="2"><strong>袋&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</strong>
					</td>
					<td style="width: 75px;" rowspan="2"><strong>姓&nbsp;&nbsp;&nbsp;&nbsp;名</strong>
					</td>
					<td style="width: 70px; line-height: 28px;" rowspan="2"><strong>破&nbsp;&nbsp;&nbsp;格<br />结&nbsp;&nbsp;&nbsp;论
					</strong></td>
					<td style="width: 70px; line-height: 28px;" rowspan="2"><strong>测&nbsp;&nbsp;&nbsp;试<br />结&nbsp;&nbsp;&nbsp;果
					</strong></td>
					<td colspan="3" style="height: 20px;"><strong>投票结果</strong></td>
					<td style="width: 70px; text-indent: 0.1em;" rowspan="2"><strong>结&nbsp;&nbsp;&nbsp;&nbsp;论</strong>
					</td>
				</tr>
				<tr>
					<td style="width: 60px; text-align: center; height: 30px;"><strong>赞成</strong>
					</td>
					<td style="width: 50px; text-align: center;"><strong>反对</strong></td>
					<td style="width: 50px; text-align: center;"><strong>弃权</strong></td>
				</tr>
				<?php
				}
				$dbresult = null;
				if($data->dbresult=='F'){
					$dbresult = '不合格';
				}
				elseif($data->dbresult==''){
					$dbresult = '';
				}
				else{
					$dbresult = $data->dbresult.'年合格';
				};
				$tpresult = null;
				if ($data->tpresult=='1'){
					$tpresult = '通过';
				};
				if ($data->tpresult=='2'){
					$tpresult = '不通过';
				};
				?>
				<tr>
					<td style="width: 55px; line-height: 30px;height: 31px;"><?php echo $i; ?></td>
					<td style="width: 90px; line-height: 30px;"><?php echo $data->code; ?>
					</td>
					<td style="width: 75px; line-height: 30px; text-align: left; text-indent: 0.6em;"><?php echo $data->name; ?>
					</td>
					<td style="width: 70px; line-height: 30px;"><?php echo $data->pgresult; ?>
					</td>
					<td style="width: 70px; line-height: 30px; font-size: 12px"><?php echo $dbresult; ?></font>
					</td>
					<td style="width: 60px; line-height: 30px;"><?php echo $data->passno; ?>
					</td>
					<td style="width: 50px; line-height: 30px;"><?php echo $data->failno; ?>
					</td>
					<td style="width: 50px; line-height: 30px;"><?php echo $data->noneno; ?>
					</td>
					<td style="width: 70px; line-height: 30px;"><?php echo $tpresult; ?>
					</td>
				</tr>
				<?php if($i%20==0){ ?>
			</table>
			<div style="margin-top: 20px;page-break-after:always">
				<span style="margin-left: 320px;"><strong>主任委员（副主任委员）：</strong> </span>
			</div>
		</div>
		<div style="page-break-after:always"></div>
		<?php 
				}
	                }
	                if($i%20!=0) { ?>
		</table>
	</div>
	<div style="margin-top: 30px; page-break-after:always">
		<span style="margin-left: 320px;"> <strong>主任委员（副主任委员）：</strong> </sapn>
	
	</div>
	<?php 
	                }
	}
	if ($heightdata!=null){
	                 $i = 0;
	                 while ($data = db_fetch_object($heightdata)) {
		                    $i++;
		                    if($i%20==1){?>
	<div style="margin: 0 10px 0 10px;" >
		<h2 style="text-align: center; margin-top: 60px;">
			<?php echo '武汉市职称评审投票结果表';?>
		</h2>
		<table style="margin-top: 20px; margin-left: 20px;">
			<tr>
				<td style="width: 260px;"><?php echo '<strong>评委会：</strong>'.'<font size=-1>'.$cnfname->conference_name.'</font>'; ?>
				</td>
				<td style="width: 200px;"><?php echo '<strong>级别：</strong>'.'<font size=2>'."高级".'</font>'; ?>
				</td>
				<td style="width: 200px;"><?php echo '<strong>评委人数：</strong>'.'<font size=2>'.$pwnum.'</font>'; ?>
				</td>
			</tr>
		</table>
		<div style="height: 720px; margin-left: 20px; width: 600px;">
			<table style="text-align: center;" class="tabl">
				<tr>
					<td style="width: 55px;" rowspan="2"><strong>序号</strong></td>
					<td style="width: 90px;" rowspan="2"><strong>袋&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</strong>
					</td>
					<td style="width: 75px;" rowspan="2"><strong>姓&nbsp;&nbsp;&nbsp;&nbsp;名</strong>
					</td>
					<td style="width: 70px; line-height: 28px;" rowspan="2"><strong>破&nbsp;&nbsp;&nbsp;格<br />结&nbsp;&nbsp;&nbsp;论
					</strong></td>
					<td style="width: 70px; line-height: 28px;" rowspan="2"><strong>测&nbsp;&nbsp;&nbsp;试<br />结&nbsp;&nbsp;&nbsp;果
					</strong></td>
					<td colspan="3" style="height: 20px;"><strong>投票结果</strong></td>
					<td style="width: 70px; text-indent: 0.1em;" rowspan="2"><strong>结&nbsp;&nbsp;&nbsp;&nbsp;论</strong>
					</td>
				</tr>
				<tr>
					<td style="width: 60px; text-align: center; height: 30px;"><strong>赞成</strong>
					</td>
					<td style="width: 50px; text-align: center;"><strong>反对</strong></td>
					<td style="width: 50px; text-align: center;"><strong>弃权</strong></td>
				</tr>
				<?php 
		                    }
		                    $dbresult = null;
		                    if($data->dbresult=='F'){
$dbresult = '不合格';
}
elseif($data->dbresult==''){
$dbresult = '';
}
else{$dbresult = $data->dbresult.'年合格';
};
$tpresult = null;
if ($data->tpresult=='1'){
$tpresult = '通过';
};
if ($data->tpresult=='2'){
$tpresult = '不通过';
};
?>
			<tr>
					<td style="width: 55px; line-height: 30px;height: 31px;"><?php echo $i; ?></td>
					<td style="width: 90px; line-height: 30px;"><?php echo $data->code; ?>
					</td>
					<td
						style="width: 75px; line-height: 30px; text-align: left; text-indent: 0.6em;"><?php echo $data->name; ?>
					</td>
					<td style="width: 70px; line-height: 30px;"><?php echo $data->pgresult; ?>
					</td>
					<td style="width: 70px; line-height: 30px; font-size: 12px"><?php echo $dbresult; ?></font>
					</td>
					<td style="width: 60px; line-height: 30px;"><?php echo $data->passno; ?>
					</td>
					<td style="width: 50px; line-height: 30px;"><?php echo $data->failno; ?>
					</td>
					<td style="width: 50px; line-height: 30px;"><?php echo $data->noneno; ?>
					</td>
					<td style="width: 70px; line-height: 30px;"><?php echo $tpresult; ?>
					</td>
				</tr>
				<?php if($i%20==0){ ?>
			</table>
			<div style="margin-top: 20px;page-break-after:always">
				<span style="margin-left: 320px;"><strong>主任委员（副主任委员）：</strong> </span>
			</div>
		</div>
		
		<?php 
}

	                 }
	      if($i%20!=0) { ?>
		</table>
	</div>
	<div style="margin-top: 30px;">
		<span style="margin-left: 320px;"><strong>主任委员（副主任委员）：</strong> </sapn>
	</div>
	<?php 
	      }

	          }
    }?>


</body>
</html>
