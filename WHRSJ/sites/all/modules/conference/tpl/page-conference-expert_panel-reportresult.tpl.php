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
<body style="width:650px;margin-left:30px;"> 
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
             $sql ="select a.* from {conference_baseinfo} a where status='1'";
             $result1 = db_query($sql);
             while($cnfname = db_fetch_object($result1)){
                    switch ($cnfname->level){
		            case 1 :$level = '高级'; break;
		            case 2 :$level = '中级'; break;
		            case 3 :$level = '高中级'; break;
	                }
                    $sql = "SELECT r_name FROM {users} WHERE uid =$cnfname->staff";
	                $result = db_query($sql);
	                $staff = db_fetch_object($result);//工作人员
	                
	                $sql ="SELECT c.* FROM {conference_expert} c WHERE (c.specgrp=$specid) and position='主任委员'";
                    $result = db_query($sql);
                    $zrpw='';
                    while($director = db_fetch_object($result)){
                    	if($zrpw=='') $zrpw.=$director->name;
                    	else $zrpw.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$director->name;
                    }
                    ?>
                    <div style="margin-top:100px;">
                    <div style="text-align:center;font-family:黑体;font-size:15pt;line-height:40px;" ><B><?php echo "武汉市".$cnfname->conference_name."专业".$level."评委会";?></B></font></div>
	                <div style="text-align:center;font-family:黑体;font-size:15pt;line-height:40px;" ><B><?php echo $year."年会议表决情况备案表"; ?></B></div>
	                <div style="margin-left:30px;font-family:黑体;font-size:14pt;line-height:40px;margin-top:30px;"><?php echo "评审时间：".$year."年".$month."月".$day."日";?></div>
	                <div style="margin-left:30px;font-family:黑体;font-size:14pt;line-height:40px;"><?php echo "评审地点：".$cnfname->location; ?></div>
	                <div style="margin-left:30px;font-family:黑体;font-size:14pt;line-height:40px;"><?php echo "工作人员：".$staff->r_name; ?></div>
	                <div style="height:300px;">
	                <div style="margin-left:30px;font-family:黑体;font-size:14pt;line-height:40px;"><?php echo "到会评委：".$zrpw."(主任委员)";?></div>
	                <div style="margin-left:130px;font-family:黑体;font-size:14pt;line-height:40px;">
                    <?php
	                $sql ="SELECT c.* FROM {conference_expert} c WHERE (c.specgrp=$specid) and position='委员'";
	                $export_result = db_query($sql);
                    $experts =array();
	                $i =0;
	                while ($expert = db_fetch_object($export_result)) {
		            $i++;
	            	$experts[$i] = $expert->name; 
	            	if ($i%4==0){echo $experts[$i]."</br>";}
	            	else {echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;}   
	                 }
	                ?></div>
	                </div>
	              <div style="margin-left:30px;font-family:宋 体;font-size:14pt;line-height:40px;"><B>
	                <?php 
                       $level = $cnfname->level;
                       $specgrp = $cnfname->specgrp;
                      if($specgrp<200){
                          $midspecgrp = $specgrp+100;
                            if ($level==1){
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp";
                	             $result = db_query($sql);
                	             $data1 = db_fetch_array($result);
                	             $numheight = $data1['num'];
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp and tpresult='1'";
                	             $result = db_query($sql);
                	             $data2 = db_fetch_array($result);
                	             $passheight = $data2['num'];
                	             $val = $passheight/$numheight*100;
                	             $height =  round($val,1);
                	             echo "高&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$numheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";
                                }
                            if ($level==2){
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$midspecgrp";
                	             $result = db_query($sql);
                	             $data3 = db_fetch_array($result);
                	             $nummid = $data3['num'];
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$midspecgrp and tpresult='1'";
                	             $result = db_query($sql);
                	             $data4 = db_fetch_array($result);
                	             $passmid = $data4['num'];
                	             $val = $passmid/$nummid*100;
                	             $mid =  round($val,1);
                	             echo "中&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$nummid."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passmid."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                                }
                           if ($level==3){ 
                                 $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp";
                	             $result = db_query($sql);
                	             $data1 = db_fetch_array($result);
                	             $numheight = $data1['num'];
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp and tpresult='1'";
                	             $result = db_query($sql);
                	             $data2 = db_fetch_array($result);
                	             $passheight = $data2['num'];
                	             $val = $passheight/$numheight*100;
                	             $height =  round($val,1);
                	             echo "高&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$numheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passheight."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$height."%<br/>";          
                   
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$midspecgrp";
                	             $result = db_query($sql);
                	             $data3 = db_fetch_array($result);
                	             $nummid = $data3['num'];
                	             $sql = "select count(*) as num from {conference_applicant} where specgrp=$midspecgrp and tpresult='1'";
                	             $result = db_query($sql);
                	             $data4 = db_fetch_array($result);
                	             $passmid = $data4['num'];
                	             $val = $passmid/$nummid*100;
                	             $mid =  round($val,1);
                	             echo "中&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$nummid."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passmid."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                                }
                          }
                       else{
                	           $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp";
                	           $result = db_query($sql);
                	           $data5 = db_fetch_array($result);
                	           $nummid = $data5['num'];
                	           $sql = "select count(*) as num from {conference_applicant} where specgrp=$specgrp and tpresult='1'";
                	           $result = db_query($sql);
                	           $data6 = db_fetch_array($result);
                	           $passmid = $data6['num'];
                	           $val = $passmid/$nummid*100;
                	           $mid =  round($val,1);
                	           echo "中&nbsp;&nbsp;&nbsp;&nbsp;级："."评审人数&nbsp;".$nummid."&nbsp;名&nbsp;&nbsp;&nbsp;通过人数".$passmid."&nbsp;名&nbsp;&nbsp;&nbsp;通过率：".$mid."%<br/>";
                           }
	              ?></B></div>
	              <div style="margin-top:60px;">
	              <div style="margin-left:350px;font-family:宋体;font-size:14pt;line-height:40px;"><B>武汉市专业技术资格评审中心</B></div>
	              <div style="margin-left:360px;font-family:宋体;font-size:14pt;line-height:40px;"><B>审核人：</B></div>
	              <div style="margin-left:370px;font-family:宋体;font-size:14pt;line-height:40px;"><B>年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日报送</B></div>
              </div>
              </div>           
             <?php }?>
             
</body>
</html>