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
<body style="width: 810px; margin-left: 50px;">
	<?php 
	$sql ="select a.* from {conference_baseinfo} a where id=%d";
	$result2 = db_query($sql, $baseinfo['id']);
	$info = db_fetch_array($result2);
	$nyr = $info['timestamp'];
	$nyr = str_replace("-0",",",$nyr);
	$nyr = str_replace("-",",",$nyr);
	$nyr = split ('[,]', $nyr);
	$nian = $nyr[0];
	$yue = $nyr[1];
	$ri = $nyr[2];
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
		if($cnfname->dy_name != ''){
			$cnfname->conference_name = $cnfname->dy_name;
		}
		if($cnfname->dy_specgrp != ''){
			$cnfname->specgrp = $cnfname->dy_specgrp;
		}
		switch ($cnfname->level){
			case 1 :$level = '高级'; break;
			case 2 :$level = '中级'; break;
			case 3 :$level = '高、中级'; break;
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
	<div style="margin-top: 160px;">
		<div
			style="text-align: center; font-family: 黑体; font-weight:1500; font-size: 22pt; line-height: 70px;">
			<B><?php echo "<strong>"."武汉市"."&nbsp;&nbsp;".$cnfname->conference_name."&nbsp;&nbsp;"."专业"."&nbsp;".$level."&nbsp;"."评委会"."</strong>";?> </B></font>
		</div>
		<div
			style="text-align: center; font-family: 黑体;font-weight:900; font-size: 22pt; line-height:70px;">
			<?php echo "<B>".$year."&nbsp;"."年会议表决情况备案表"."</B>"; ?> 
		</div>
		<div
			style="margin-left: 30px; font-family: 宋体; font-size: 21pt; line-height: 70px; margin-top: 40px;">
			<?php echo "<b style=\"font-family: 黑体;\">"."评审时间："."</b>"."&nbsp;&nbsp;&nbsp;"."<B>".$nian."&nbsp;"."年"."&nbsp;&nbsp;".$yue."&nbsp;&nbsp;"."月"."&nbsp;".$ri."&nbsp;"."日"."</B>";?>
		</div>
		<div
			style="margin-left: 30px; font-family: 宋体; font-size: 21pt; line-height: 70px;">
			<?php echo "<b style=\"font-family: 黑体;\">"."评审地点："."</b>"."&nbsp;&nbsp;&nbsp;"."<B>".$cnfname->location."</B>"; ?>
		</div>
		<div
			style="margin-left: 30px; font-family: 宋体; font-size: 21pt; line-height: 70px;">
			<?php global $user; echo "<b style=\"font-family: 黑体;\">"."工作人员："."</b>"."&nbsp;&nbsp;&nbsp;"."<B>".$user->r_name."</B>"; ?>
			
		</div>
		<div style="height: 410px;width:770px">
			<div
				style="margin-left: 30px; font-family: 宋体; font-size: 21pt; line-height: 70px;">
				<?php  echo "<b style=\"font-family: 黑体;\">"."到会评委:"."</b>" ?>
				
			</div>
			<div style="margin-left: 30px;font-weight:700; font-family: 宋体; font-size: 20pt; line-height: 50px;">
				<?php 
				$expert = "0,";
				$sql = "SELECT * FROM {conference_baseinfo_group} WHERE bid=%d";
				$result = db_query($sql, $baseinfo['id']);
				while($data = db_fetch_array($result)){
					$expert .= $data['expert'].",";
				}
				$expert = substr($expert, 0, -1);
				
				$sql ="SELECT c.* FROM {conference_expert} c WHERE c.id IN (%s) order by field (id,$expert)";
				$export_result = db_query($sql, $expert);
				$experts =array();
				$i =0;
				$flag = 0;
				$j =0;
				$len = 0;
				$len_one = 0;
				$aaa = 0;
				$experts = array();
				echo "<table width=\"753px\">";
				while ($data = db_fetch_object($export_result)) {
					$i++;
					if($data->position =="副主任委员" || $data->position =="主任委员"){
						$experts[$i] = $data->name."(".$data->position.")";
					}
					else{
						$experts[$i] = $data->name;
					}
				
				}
				
				for($k=1;$k<=sizeof($experts);$k++){
					$len_one = strlen($experts[$k]);
					$flag++;
					if($len_one<12){
						$len_one = 15;
					}
					if($len_one==12){
						$len_one = 15;
					}
					if($len_one == 20){
						$len_one = 30;
					}
					if($len_one == 23){
						$len_one = 30;
					}
					if($len_one == 26){
						$len_one = 30;
					}
					if($len_one == 29){
						$len_one = 30;
					}
					$len += $len_one+$aaa;
					$aaa = 0;
					if($len == 90){
						$len = 0;
						if(strlen($experts[$k]) > 23){
							echo "<td colspan=\"2\" width=\"246px\"  align=\"left\"><B>".$experts[$k]."</B></td>";
							//echo "<td colspan=\"3\" width=\"348px\" align=\"left\"><B>".$experts[$k]."</B></td>";
						}
							
						else{
							if(strlen($experts[$k]) >= 20&&strlen($experts[$k])<= 23){
								echo "<td colspan=\"2\" width=\"246px\"  align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							else{
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
						}
							
						echo "<tr>";
						$flag = 0;
					}
					elseif($len < 90){
						if($flag == 1){
							if(strlen($experts[$k]) == 6){
								echo "<tr>";
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) == 9){
								echo "<tr>";
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) == 12){
								echo "<tr>";
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) >= 20 && strlen($experts[$k])<=23){
								echo "<tr>";
								echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) > 23){
								echo "<tr>";
								echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
// 								echo "<tr>";
// 								echo "<td colspan=\"3\" width=\"348px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
						}
						else{
							if(strlen($experts[$k]) == 6){
								echo "<td width=\"123px\"  align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) == 9){
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) == 12){
								echo "<td width=\"123px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k]) >= 20 && strlen($experts[$k])<=23){

								echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
							if(strlen($experts[$k])>23){
								echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
		//						echo "<td colspan=\"3\" width=\"348px\" align=\"left\"><B>".$experts[$k]."</B></td>";
							}
						}
							
					}
					if($len > 90){
						if(strlen($experts[$k]) >= 20&&strlen($experts[$k])<= 23){
							echo "<tr>";
							echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
						}
						if(strlen($experts[$k]) > 23){
							echo "<tr>";
							echo "<td colspan=\"2\" width=\"246px\" align=\"left\"><B>".$experts[$k]."</B></td>";
// 							echo "<tr>";
// 							echo "<td colspan=\"3\" width=\"348px\" align=\"left\"><B>".$experts[$k]."</B></td>";
						}
						$len = 0;
						$aaa = $len_one;
						$flag = 1;
					}
				}
				$sql2 ="SELECT c.* FROM {conference_expert} c WHERE c.id IN (%s)";
				$export_result2 = db_query($sql, $expert);
				$experts =array();
				$i =0;
				$n =0;
// 				while ($data2 = db_fetch_object($export_result2)) {
// //					if(($data2->name != $zrpw)&&($data2->position !="副主任委员" && $data2->position !="主任委员")){
// 						$i++;
// 						if($i>5){
// 							$n++;
// 							$experts[$i] = $data2->name;
// 							if ($n%4==0){
// 								echo $experts[$i]."</br>";
// 							}
// 							else {
// 								if ($n%4==1){
// 									if(strlen($experts[$i])==6){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
// 									}
// 									if(strlen($experts[$i])==9){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
// 									}
// 									if(strlen($experts[$i])==12){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;" ;
// 									}
// 								}
// 								else{
// 									if(strlen($experts[$i])==6){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
// 									}
// 									if(strlen($experts[$i])==9){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
// 									}
// 									if(strlen($experts[$i])==12){
// 										echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;" ;
// 									}
// 								}
								
// 							}
// 						}
					
// //					}
// 				}
echo "</table>";
				?>
			</div>
		</div>
		<div
			style="margin-left: -10px; font-family: 宋 体; font-size: 21pt; line-height: 70px;">
			<B> <?php 
			$level = $cnfname->level;
			$specgrp = $cnfname->specgrp;
			$specgrp_array = split ('[,]', $specgrp);
			$specgrp_fitter = '201';
			$midspecgrp = "0,";
			switch ($level){
				case 1:
					$specgrp .= ",";
					break;
				case 2:
					$specgrp = "0,";
					foreach ($specgrp_array as $key=>$value){
						if($value&&$value<200) $midspecgrp .= ($value+100).",";
						elseif ($value) $midspecgrp .= $value.",";
					}
					break;
				case 3:
					$specgrp .= ",";
					foreach ($specgrp_array as $key=>$value){
						if($value&&$value<200) $midspecgrp .= ($value+100).",";
						elseif ($value) $midspecgrp .= $value.",";
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
					echo "高级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
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
					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
				}
				if ($level==3){
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp) AND level = '01'";
                                 $result = db_query($sql);
                                 $data1 = db_fetch_array($result);
                                 $numheight = $data1['num'];
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($specgrp) and tpresult='1' AND level = '01'";
                                 $result = db_query($sql);
                                 $data2 = db_fetch_array($result);
                                 $passheight = $data2['num'];
                                 $val = $passheight/$numheight*100;
                                 $height =  number_format($val, 1, '.', '');
                  //              (float)$height =  round($val,1);
                                 if($numheight>=10 && $passheight<10){
                                 	echo "高级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                 }
                                 if($numheight < 10){
                                 	echo "高级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                 }
                                 if($numheight>=10 && $passheight>=10 && $numheight<100 && $passheight<100){
                                 	echo "高级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                 }
                                 if($numheight>=100 && $passheight<100 && $passheight>=10){
                                 	echo "高级："."&nbsp;评审人数&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                 }
                                 if($numheight>=100 && $passheight>=100){
                                 	echo "高级："."&nbsp;评审人数&nbsp;&nbsp;".$numheight."名&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passheight."名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                 }
                                 

                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp) AND level = '02'";
                                 $result = db_query($sql);
                                 $data3 = db_fetch_array($result);
                                 $nummid = $data3['num'];
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp IN ($midspecgrp) and tpresult='1' AND level = '02'";
                                 $result = db_query($sql);
                                 $data4 = db_fetch_array($result);
                                 $passmid = $data4['num'];
                                 $val = $passmid/$nummid*100;
                                 $mid =  number_format($val, 1, '.', '');
                  //               (double)$mid =  round($val,1);
                  				if($nummid>=10 && $passmid<10){
                  					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                  				}
                  				if($nummid < 10){
                  					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                  				}
                  				if($nummid>=10 && $passmid>=10 && $nummid<100 && $passmid<100){
                  					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                  				}
                  				if($nummid>=100 && $passmid<100 && $passmid>=10){
                  					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                  				}
                  				if($nummid>=100 && $passmid>=100){
                  					echo "中级："."&nbsp;评审人数&nbsp;&nbsp;".$nummid."名&nbsp;&nbsp;&nbsp;通过人数&nbsp;&nbsp;".$passmid."名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                  				}
                                
                                }
                                ?>
			</B>
		</div>
		<div style="margin-top: 50px;">
			<div
				style="margin-left: 430px; font-family: 宋体; font-size: 21pt; line-height: 50px;">
				<B>武汉市专业技术资格评审中心</B>
			</div>
			<div
				style="margin-left: 470px; font-family: 宋体; font-size: 21pt; line-height: 50px;">
				<B>审核人：</B>
			</div>
			<div
				style="margin-left: 540px; font-family: 宋体; font-size: 21pt; line-height: 50px;">
				<B>年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日报送</B>
			</div>
		</div>
	</div>
	<?php }?>

</body>
</html>
