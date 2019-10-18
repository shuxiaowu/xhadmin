var CodeInfoDlg = {
	CodeInfoData: {},
	deptZtree: null,
	pNameZtree: null,
	validateFields: {
		
	 }
}


CodeInfoDlg.clearData = function () {
	 this.CodeInfoData = {};
};


CodeInfoDlg.set = function (key, val) {
	 this.CodeInfoData[key] = (typeof value == "undefined") ? $("#" + key).val() : value;
	 return this;
};


CodeInfoDlg.get = function (key) {
	 return $("#" + key).val();
};


CodeInfoDlg.close = function () {
	 var index = parent.layer.getFrameIndex(window.name);
	 parent.layer.close(index);
};


CodeInfoDlg.collectData = function () {
	this.set('data_id').set('extend_id');
};


CodeInfoDlg.add = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var tip = '添加';
	 var ajax = new $ax(Feng.ctxPath + "/FormData/add", function (data) {
	 	if ('00' === data.status) {
	 		Feng.success(tip + "成功" );
	 		window.parent.CodeGoods.table.refresh();
	 		CodeInfoDlg.close();
	 	} else {
	 		Feng.error(tip + "失败！" + data.msg + "！");
		 }
	 }, function (data) {
	 	Feng.error("操作失败!" + data.responseJSON.message + "!");
	 });
	 
	 ajax.set(this.CodeInfoData);
	 
	 var entend = new $ax(Feng.ctxPath + "/FormData/getExtends", function (data) {
		var fieldList = data;
		for(var p in fieldList){
			var type = fieldList[p]['type'];
			if(type == 3){
				ajax.set(fieldList[p]['field'],$("input[name = '"+fieldList[p]['field']+"']:checked").val());
			}else if(type == 4){
				
				var checkData = '';
				$('input[name="'+fieldList[p]['field']+'"]:checked').each(function(){ 
					checkData += ',' + $(this).val(); 
				});
				checkData = checkData.substr(1);
				
				ajax.set(fieldList[p]['field'],checkData);
			}else if(type == 16){
				ajax.set(fieldList[p]['field'],UE.getEditor(''+fieldList[p]['field']+'').getContent());
			}else{
				ajax.set(fieldList[p]['field'],$("#"+fieldList[p]['field']).val());
			}
		}
		
	 });
	entend.set('extend_id', $("#extend_id").val());
	entend.start();
	 
	ajax.start();
};




CodeInfoDlg.update = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	
	 var tip = '修改';
	 var ajax = new $ax(Feng.ctxPath + "/FormData/update", function (data) {
	 	if ('00' === data.status) {
	 		Feng.success(tip + "成功" );
	 		window.parent.CodeGoods.table.refresh();
	 		CodeInfoDlg.close();
	 	} else {
	 		Feng.error(tip + "失败！" + data.msg + "！");
		 }
	 }, function (data) {
	 	Feng.error("操作失败!" + data.responseJSON.message + "!");
	 });
	 
	 
	 ajax.set(this.CodeInfoData);
	 
	 var entend = new $ax(Feng.ctxPath + "/FormData/getExtends", function (data) {
		var fieldList = data;
		for(var p in fieldList){
			var type = fieldList[p]['type'];
			
			if(type == 3){
				ajax.set(fieldList[p]['field'],$("input[name = '"+fieldList[p]['field']+"']:checked").val());
			}else if(type == 4){	
				var checkData = '';
				$('input[name="'+fieldList[p]['field']+'"]:checked').each(function(){ 
					checkData += ',' + $(this).val(); 
				});
				checkData = checkData.substr(1);
				
				ajax.set(fieldList[p]['field'],checkData);
			}else if(type == 16){
				ajax.set(fieldList[p]['field'],UE.getEditor(''+fieldList[p]['field']+'').getContent());
			}else if(type == 17){
				var areaaddress = fieldList[p]['field'].split('|');
				for (var i = 0; i < areaaddress.length; i++){
					ajax.set(areaaddress[i],$("#"+areaaddress[i]).val());
				}
			}else{
				ajax.set(fieldList[p]['field'],$("#"+fieldList[p]['field']).val());
			}
		}
		
	 });
	 
	entend.set('extend_id', $("#extend_id").val());
	entend.start();
	 
	 ajax.start();
};


CodeInfoDlg.validate = function () {
	  $('#CodeInfoForm').data("bootstrapValidator").resetForm();
	  $('#CodeInfoForm').bootstrapValidator('validate');
	  return $("#CodeInfoForm").data('bootstrapValidator').isValid();
};


$(function () {
	   Feng.initValidator("CodeInfoForm", CodeInfoDlg.validateFields);
});


