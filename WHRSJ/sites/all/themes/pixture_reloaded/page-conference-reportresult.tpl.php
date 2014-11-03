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
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">
<head>
</head>
<body style="width:650px;"> 
   <div style="margin-top:50px;">
    <?php if ($title): ?><h2 style="text-align:center"><?php print $title; ?></h2><?php endif; ?>
      <h2 style="text-align:center"> <?php $year = date('Y'); echo $year.'年会议表决情况备案表' ?></h2>
      <!-- 时间 -->
      <div style="margin-top:30px;">
      <h3>
      <?php 
      $year = date('Y'); 
      $month = date('m'); 
      $day = date('d');  
      echo '评审时间：'. $year.'年'.$month.'月'.$day.'日'
       ?>
      </h3>
      <!-- 地点 -->
      <h3>               
               <?php 
                 $sql = "SELECT c.* FROM {conference_baseinfo} c where status=1";
	             $result = db_query($sql);
	             $data = db_fetch_object($result);
	             echo '评审地点：'.$data->location;
               ?>
       </h3>  
       <!-- 工作人员 -->
       <h3>               
               <?php 
                 $sql = "SELECT c.* FROM {conference_baseinfo} c where status=1";
	             $result = db_query($sql);
	             $data = db_fetch_object($result);
	             echo '工作人员：'.$data->staff_number;
               ?>
       </h3>  
       <!-- 到会评委 -->
       <div style="height:320px">
       <div style="width:125px;height:320px;"><h3>到会评委：</h3></div>
       <div style="width:508px;height:320px;margin-left:100px;margin-top:-320px;">
       <div ><strong>             
               <?php
                 $sql ="SELECT c.* FROM {conference_expert} c WHERE c.specgrp IN ( SELECT specgrp FROM {conference_baseinfo} WHERE status=1) and position='主任委员'";
                 $result = db_query($sql);
                 $director = db_fetch_object($result);
                 echo $director->name.'('.$director->position.')';
               ?>
               </strong>
               </div>
             <div style="line-height:40px;">
             <strong>
              <?php 
                 $sql ="SELECT c.* FROM {conference_expert} c WHERE c.specgrp IN ( SELECT specgrp FROM {conference_baseinfo} WHERE status=1) and position='委员'";
	             $export_result = db_query($sql);
	             $experts =array();
	             $i =0;
	            while ($expert = db_fetch_object($export_result)) {
		            $i++;
	            	$experts[$i] = $expert->name; 
	            	if ($i%5==0){echo $experts[$i]."</br>";}
	            	else {echo $experts[$i]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;}   
	            }
               ?> 
               </strong>       
       </div>
       </div>
       </div> 
       
       <!-- 高级 -->
       <h3>               
               <?php 
                 $sql1 = "SELECT COUNT(*) AS num1 FROM {conference_applicant} WHERE specgrp IN (select specgrp FROM {conference_baseinfo} where status=1) AND `level`='01'";
                 $r4 = db_query($sql1); 
                 $data4 = db_fetch_array($r4);
                 $d4 = $data4[num1];
                 $sql = "SELECT COUNT(*) AS num FROM {conference_applicant} WHERE specgrp IN (select specgrp FROM {conference_baseinfo} where status=1) AND `level`='01' AND tpresult='通过'";
                 $r5 = db_query($sql); 
                 $data5 = db_fetch_array($r5);
                 $d5 = $data5[num] ;
                 $val = $d5/$d4*100 ;
                 $d6 = round($val,1);
                 echo "&nbsp;高&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级：评审人数&nbsp;".$d4."&nbsp;名"."&nbsp;&nbsp;&nbsp;&nbsp;"."通过人数&nbsp;".$d5."&nbsp;名"."&nbsp;&nbsp;&nbsp;&nbsp;"."通过率&nbsp;".$d6."%";
               ?>
       </h3>  
       <div style="margin-top:30px;"></div>
       <!-- 中级 -->
        <h3>               
               <?php 
                     $sql = "SELECT COUNT(*) AS num1 FROM {conference_applicant} WHERE specgrp IN (select specgrp FROM {conference_baseinfo} where status=1) AND `level`='02'";
                     $r7 = db_query($sql); 
                     $data7 = db_fetch_array($r7);
                     $d7 = $data7[num1];
                     $sql = "SELECT COUNT(*) AS num FROM {conference_applicant} WHERE specgrp IN (select specgrp FROM {conference_baseinfo} where status=1) AND `level`='02' AND tpresult='通过'";
                     $r8 = db_query($sql); 
                     $data8 = db_fetch_array($r8);
                     $d8 = $data8[num] ;
                     $val = $d8/$d7*100 ;
                     $d9 = round($val,1);
                     echo "&nbsp;中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级：评审人数&nbsp;".$d7."&nbsp;名"."&nbsp;&nbsp;&nbsp;&nbsp;"."通过人数&nbsp;".$d8."&nbsp;名"."&nbsp;&nbsp;&nbsp;&nbsp;"."通过率&nbsp;".$d9."%";
               ?>
       </h3>
    <div style="margin-top:80px">
       <h3 style="margin-left:320px">武汉市专业技术资格评审中心</h3>  
       <h3 style="margin-left:340px">审核人：</h3>  
       <h3 style="margin-left:380px">年&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;日报送</h3>
     </div>
     </div>
  </div>   
</body>
</html>