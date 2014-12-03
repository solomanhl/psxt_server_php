<?php


class AsyncOperation extends Thread {
	public function __construct($arg1,$arg2,$arg3){
		$this->arg1 = $arg1;
		$this->arg2 = $arg2;
		$this->arg3 = $arg3;
	}
// 	public function __construct($arg1){
// 		$this->arg1 = $arg1;
// 	}

	public function run(){
		print ("123132");
// 			$sql = "SELECT COUNT(*) AS num FROM {conference_expert_vote}";
// 			$result = mysql_db_query("whrsj", "SELECT COUNT(*) AS num FROM conference_expert_vote");
// 			$result2 = mysql_fetch_array($result);
			//echo "count=>".$result2['num'] ."<br>";
// 		chdir('D:\workspace\WHRSJ');
		
// 		$_SERVER['SCRIPT_NAME'] = '/';
// 		$_SERVER['HTTP_HOST'] = '192.168.2.111';
		
// 		include_once './includes/bootstrap.inc';
// 		include_once './includes/common.inc';
// 		include_once './includes/module.inc';
// 		include_once './includes/theme.inc';
// 		include_once './includes/file.inc';
// 		include_once './includes/form.inc';
// 		include_once './includes/session.inc';
		
		
// 		drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);		
 	$db_connect=mysql_connect("localhost","root","root") or die("Unable to connect to the MySQL!");

// 	//选择一个需要操作的数据库
 	mysql_select_db("whrsj",$db_connect);

 	$specgrp =  $this->arg2;
 	$conference_id =  $this->arg3;
		
	foreach($this->arg1 as $i=>$val2){
		$aid = $val2['id'];
		
 		
		
		//$count = db_result(db_query($sql));
		//echo "count=>".$count ."<br>";
		//$num_a = db_fetch_array(db_query($sql));
		//$num = $num_a['num'];
//		if($this->arg1){
		$vote = array('yes'=>0,'no'=>0,'give_up'=>0);
		$sql = "SELECT c.expert_number FROM {conference_baseinfo} c WHERE c.status = '1'";
		$result = mysql_db_query("whrsj", "SELECT c.expert_number FROM conference_baseinfo c WHERE c.status = '1'");
		$expert_number = 0;
		while($expert = mysql_fetch_array($result)){
		
			$expert_number =$expert_number+$expert['expert_number'];
		}
		$sql = "SELECT * FROM conference_expert_vote c WHERE c.aid = $aid AND c.conference_id = $conference_id";
		
		$result = mysql_db_query("whrsj",$sql);
		
		while($tpresult = mysql_fetch_object($result)){
			switch ($tpresult->vote){
				case '赞成' :$vote['yes']++;break;
				case '反对' :$vote['no']++;;break;
				case '弃权' :$vote['give_up']++;;break;
				default:$data->type = '';break;
			}
		}
		$vote_num = $vote['yes']+$vote['no']+$vote['give_up'];
		if($vote_num == $expert_number){
		
			$sql_p = "SELECT c.pgresult,c.dbresult FROM conference_applicant c WHERE c.code = ".$aid." AND c.specgrp IN ($specgrp)";
			$person = mysql_fetch_array(mysql_db_query("whrsj",$sql_p));
			$condition = $expert_number*2/3;
			if(($vote['yes'] >= $condition)&&($person['dbresult']!='F')&&($person['pgresult']!='不同意')) $sql = "UPDATE conference_applicant c SET c.passno = ".$vote['yes'].", c.failno = ".$vote['no'].", c.noneno = ".$vote['give_up'].", c.tpresult = '1' WHERE c.code = ".$aid." AND c.specgrp IN ($specgrp)";
			else $sql = "UPDATE conference_applicant c SET c.passno = ".$vote['yes'].", c.failno = ".$vote['no'].", c.noneno = ".$vote['give_up'].", c.tpresult = '2' WHERE c.code = ".$aid." AND c.specgrp IN ($specgrp)";
			$setsql = mysql_db_query("whrsj",$sql);
		}
//			conference_expert_tpresult($aid,$this->arg2,$this->arg3);
//		}
// 		else{
// 			break;
// 		}
	}
	mysql_close($db_connect);


	}
	
}