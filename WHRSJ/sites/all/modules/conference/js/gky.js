Drupal.behaviors.registerAdminBehavior = function (context) {
	
	
	function txtOnChange(selectName,inputText){
	      if (selectName.selectedIndex!=-1){
	  selectName.options(selectName.selectedIndex).selected = false;
	      }
	 
	      for (i=0;i<selectName.options.length;i++){
	  if (selectName.options(i).text == inputText){
	    selectName.options(i).selected = true;
	    return;
	  }
	      }
	      for (i=0;i<selectName.options.length;i++){
	  if (selectName.options(i).text.indexOf(inputText)!=-1){
	    selectName.options(i).selected = true;
	    return;
	  }
	      }
	    }
	
	 function txtOnfocus(oText){
	      oText.value="";
	  }
	
	$(document).ready(function()
			{
				if ($.browser.msie) {
					$('input:checkbox').click(function () { 
						this.blur();   
						this.focus(); 
					});   
				};
				$("#t_specgrp").change(get_examinee);
				$("#edit-level-1").change(get_examinee);
				$("#edit-level-2").change(get_examinee);
			});
	
	function get_examinee(){
		var specgrp = $("#t_specgrp").val();
		var hl = $("#edit-level-1").attr("checked");
		var ml = $("#edit-level-2").attr("checked");
		var level = hl+ml*2;
		if ((hl||ml)&&specgrp){
			$.ajax({
				type: "POST",
				type: "POST",
				url: "/getinfo.json",
				success: function (data) {
					//alert(data['sql']);
					var e_code = data['code'];
					var e_name = data['name'];
					$("#t_examinee").empty();
					for(var i=0;i<e_code.length;i++){
						$("#t_examinee").append("<option value="+e_code[i]+">"+e_name[i]+"</option>"); 
					}
				},
				dataType: 'json', 
				data: {specgrp:specgrp,level:level}
			});
		}
		else $("#t_examinee").empty();
	}
}
/*
	if(data.status == true){ 
    	  var num = data.num;
    	  if(num > 0){
    		$('h1.title').html('贵单位已经上传'+ num +'名参会人员信息');	  
    	  }
    	  else{
    		$('h1.title').html('贵单位还没有上传参会人员信息');	  
    	  }	
    	  parent.remove();
    	}*/