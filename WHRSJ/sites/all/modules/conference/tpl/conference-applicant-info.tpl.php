<?php
?>
<people
	name="<?php print $applicant->name; ?>"
	id="<?php print $applicant->code; ?>" 
	shenfenzhen="<?php print $applicant->card_id; ?>" 
	sex="<?php print $applicant->sex; ?>" 
	birth="<?php print $applicant->birthdate; ?>" 
	company="<?php print $applicant->company; ?>" 
	xueli="<?php print $applicant->educ1; ?>" 
	xinzhenzhiwu="<?php print $applicant->post; ?>" 
	zhenzhi="<?php print $applicant->political; ?>" 
	jishuzhiwu="<?php print $applicant->oproff1; ?>" 
	shoupinshijian="<?php print $applicant->total1; ?>" 
	xuexiao="<?php print $applicant->college1; ?>" 
	suoxuezhuanye="<?php print $applicant->sspec1; ?>" 
	biyeshijian="<?php print $applicant->graddate1; ?>" 
	xueli2="<?php print $applicant->educ2; ?>"
	xuexiao2="<?php print $applicant->college2; ?>"
	suoxuezhuanye2="<?php print $applicant->sspec2; ?>"
	biyeshijian2="<?php print $applicant->graddate2; ?>"
	xuelifujian="<?php print $applicant->xl_filepath; ?>"
	congshizhuanye="<?php print $applicant->dspec; ?>"
	zhuanjigongzuo="<?php print $applicant->resume; ?>"
	waiyu="<?php print $applicant->english; ?>"
	waiyufujian="..........................................pdf"
	jisuanji="<?php print $applicant->computer; ?>"
	jisuanjifujian="..........................................pdf"
	jixujinxiu="<?php print $applicant->reeduc; ?>"
	jixujinxiufujian="..........................................pdf"
	shenbaoleixin="<?php print $applicant->class; ?>"
	shenbaojibie="<?php print $applicant->level; ?>"
	shenbaopinweihui="<?php print $applicant->specgrp; ?>"
	ceshijieguo="<?php print $applicant->dbresult; ?>"
	youxiu="<?php print $applicant->excellent; ?>"
	chengzhi="<?php print $applicant->good; ?>"
	jibenchengzhi="<?php print $applicant->pass; ?>"
	expert_name="<?php print $applicant->expert_name; ?>"
	lianghua="<?php print $applicant->lianghua; ?>"
	gerenyijian="<?php print $applicant->gerenyijian; ?>"
	>
	<chengguo name ="<?php print $applicant->cg_name ?>" benrenzuoyong="<?php print $applicant->cg_author_order ?>" shijian="<?php print $applicant->cg_timestamp ?>" neirong="<?php print $applicant->cg_description ?>" fujian="<?php print $applicant->cg_filepath ?>" />
	<lunwen name ="<?php print $applicant->lw_name ?>" shijian="<?php print $applicant->lw_timestamp ?>" zuozhe="<?php print $applicant->lw_author_order ?>" fujian="<?php print $applicant->lw_filepath ?>" />
	<huojiang name ="<?php print $applicant->hj_name ?>" shijian="<?php print $applicant->hj_timestamp ?>" fujian="<?php print $applicant->hj_filepath ?>" />
<ext
	pogejielun="<?php print $applicant->pgresult; ?>"
	opinion="<?php print $applicant->opinion; ?>"
	group_score="<?php print $applicant->group_score; ?>"
	pinjunfen="<?php print $applicant->bjtype; ?>"
	noeduc="<?php print $applicant->noeduc; ?>"
	dbresult="<?php print $applicant->dbresult; ?>"
/>
</people>