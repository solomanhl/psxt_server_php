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

</head>
<body style="width: 650px; margin-left: 30px;">
	<?php  
	$year = date('Y');
	$month = date('m');
	$day = date('d');

	$specid='';
	$sql ="select a.* from {conference_baseinfo} a where status='1'";
	$result1 = db_query($sql);
	while($data = db_fetch_object($result1)){
		if($specid=='') $specid.=$data->id;
		else $specid.=' OR specgrp='.$data->id;
	}
	$sql ="select a.* from {conference_baseinfo} a where id=%d";
	$result1 = db_query($sql, $baseinfo['id']);
	while($cnfname = db_fetch_object($result1)){
		if($cnfname->dy_level == '3'){
			$cnfname->level = '3';
		}
		switch ($cnfname->level){
			case 1 :$level = '高级'; break;
			case 2 :$level = '中级'; break;
			case 3 :$level = '高中级'; break;
		}
		$sql = "SELECT r_name FROM {users} WHERE uid = $cnfname->staff";
		$result = db_query($sql);
		$staff = db_fetch_object($result);//工作人员
		$zrpw=$baseinfo['senior_expert'];
		// 		while($director = db_fetch_object($result)){
		//                     	if($zrpw=='') $zrpw.=$director->name;
		//                     	else $zrpw.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$director->name;
		//                     }
		?>
	<div style="margin-top: 100px;">
		<div
			style="text-align: center; font-family: 黑体; font-size: 15pt; line-height: 40px;">
			<B><?php echo "武汉市".$cnfname->conference_name."专业".$level."评委会";?> </B></font>
		</div>
		<div
			style="text-align: center; font-family: 黑体; font-size: 15pt; line-height: 40px;">
			<B><?php echo $year."年会议表决情况备案表"; ?> </B>
		</div>
		<div
			style="margin-left: 30px; font-family: 黑体; font-size: 14pt; line-height: 40px; margin-top: 30px;">
			<?php echo "评审时间：".$year."年".$month."月".$day."日";?>
		</div>
		<div
			style="margin-left: 30px; font-family: 黑体; font-size: 14pt; line-height: 40px;">
			<?php echo "评审地点：".$cnfname->location; ?>
		</div>
		<div
			style="margin-left: 30px; font-family: 黑体; font-size: 14pt; line-height: 40px;">
			<?php global $user; echo "工作人员：".$user->r_name; ?>
		</div>
		<div style="height: 300px;">
			<div
				style="margin-left: 30px; font-family: 黑体; font-size: 14pt; line-height: 40px;">
				<?php 
				$expert = "0,";
				$sql = "SELECT * FROM {conference_baseinfo_group} WHERE bid=%d";
				$result = db_query($sql, $baseinfo['id']);
				while($data = db_fetch_array($result)){
					$expert .= $data['expert'].",";
				}
				$expert = substr($expert, 0, -1);
				
				$sql ="SELECT c.* FROM {conference_expert} c WHERE c.id IN (%s)";
				$export_result = db_query($sql, $expert);
				$experts =array();
				$i =0;
				$flag = 0;
				$j =0;
				while ($data = db_fetch_object($export_result)) {
				
					if(($data->position !="委员")&&($data->position =="副主任委员" ||$data->position =="主任委员")){
						$i++;
						$experts[$i] = $data->name."(".$data->position.")";
						if($i == 1){
							echo "到会评委：".$experts[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
						}
						else{
							if ($i%2==0){
								echo $experts[$i]."</br>";
							}
// 							else {
// 								echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;" ;
// 							}
						}
					}
					if($i>2&&($data->position =="副主任委员" ||$data->position =="主任委员" ||$data->position =="委员")){
						if(strlen($experts[$i])>18){
							$flag++;
						}
						
						$experts[$i] = $data->name."(".$data->position.")";
						if($data->position == '委员'){
							$experts[$i] = $data->name;
						}
						$j++;
						
						if($flag == 1){
							if ($j%3==0){
								echo $experts[$i]."</br>";
								break;
								
							}
							else {
								if ($j%3==1){
									if(strlen($experts[$i])==6){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
									if(strlen($experts[$i])==9){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
									if(strlen($experts[$i])>18){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
								}
								else{
									if(strlen($experts[$i])==6){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
									if(strlen($experts[$i])==9){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
									if(strlen($experts[$i])>18){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
								}
								
							}
						}
						$i++;
					}
					
				}
				
				$sql2 ="SELECT c.* FROM {conference_expert} c WHERE c.id IN (%s)";
				$export_result2 = db_query($sql, $expert);
				$experts =array();
				$i =0;
				$n =0;
				while ($data2 = db_fetch_object($export_result2)) {
//					if(($data2->name != $zrpw)&&($data2->position !="副主任委员" && $data2->position !="主任委员")){
						$i++;
						if($i>5){
							$n++;
							$experts[$i] = $data2->name;
							if ($n%4==0){
								echo $experts[$i]."</br>";
							}
							else {
								if ($n%4==1){
									if(strlen($experts[$i])==6){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
									if(strlen($experts[$i])==9){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
									if(strlen($experts[$i])==12){
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
								}
								else{
									if(strlen($experts[$i])==6){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
									if(strlen($experts[$i])==9){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									}
									if(strlen($experts[$i])==12){
										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;" ;
									}
								}
								
							}
						}
					
//					}
				}
				?>
			</div>
			<div style="margin-left: 130px; font-family: 黑体; font-size: 14pt; line-height: 40px;">
				<?php
				
	                 ?>
			</div>
		</div>
		<div
			style="margin-left: 30px; font-family: 宋 体; font-size: 14pt; line-height: 40px;">
			<B> <?php 
			$level = $cnfname->level;
			$specgrp = $cnfname->specgrp;
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
					$sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp)";
					$result = db_query($sql);
					$data1 = db_fetch_array($result);
					$numheight = $data1['num'];
					$sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp) and tpresult='1'";
					$result = db_query($sql);
					$data2 = db_fetch_array($result);
					$passheight = $data2['num'];
					$val = $passheight/$numheight*100;
					$height =  round($val,1);
					$sql_check = "select * from {conference_baseinfo} where specgrp IN ($specgrp) and level='1'";
					$result_check = db_query($sql_check);
					echo "高&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$numheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
				}
				if ($level==2){
					$sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp)";
					$result = db_query($sql);
					$data3 = db_fetch_array($result);
					$nummid = $data3['num'];
					$sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp) and tpresult='1'";
					$result = db_query($sql);
					$data4 = db_fetch_array($result);
					$passmid = $data4['num'];
					$val = $passmid/$nummid*100;
					$mid =  round($val,1);
					$sql_check = "select * from {conference_baseinfo} where specgrp IN ($specgrp) and level='2'";
					$result_check = db_query($sql_check);
					echo "中&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$nummid."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passmid."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
				}
				if ($level==3){
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp)";
                                 $result = db_query($sql);
                                 $data1 = db_fetch_array($result);
                                 $numheight = $data1['num'];
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp) and tpresult='1'";
                                 $result = db_query($sql);
                                 $data2 = db_fetch_array($result);
                                 $passheight = $data2['num'];
                                 $val = $passheight/$numheight*100;
                                 $height =  round($val,1);
                                 echo "高&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$numheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";

                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp)";
                                 $result = db_query($sql);
                                 $data3 = db_fetch_array($result);
                                 $nummid = $data3['num'];
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp) and tpresult='1'";
                                 $result = db_query($sql);
                                 $data4 = db_fetch_array($result);
                                 $passmid = $data4['num'];
                                 $val = $passmid/$nummid*100;
                                 $mid =  round($val,1);
                                 echo "中&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$nummid."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passmid."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                                }
                                ?>
			</B>
		</div>
		<div style="margin-top: 60px;">
			<div
				style="margin-left: 350px; font-family: 宋体; font-size: 14pt; line-height: 40px;">
				<B>武汉市专业技术资格评审中心</B>
			</div>
			<div
				style="margin-left: 360px; font-family: 宋体; font-size: 14pt; line-height: 40px;">
				<B>审核人：</B>
			</div>
			<div
				style="margin-left: 370px; font-family: 宋体; font-size: 14pt; line-height: 40px;">
				<B>年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日报送</B>
			</div>
		</div>
	</div>
	<?php }?>

</body>
</html>
