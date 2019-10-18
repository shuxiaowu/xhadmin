var CodeInfoDlg = {
	CodeInfoData: {},
	deptZtree: null,
	pNameZtree: null,
	validateFields: {
		title: {
			validators: {
				notEmpty: {
					message: '名称不能为空'
	 			},
	 		}
	 	},
		table_name: {
			validators: {
				notEmpty: {
					message: '表名不能为空'
	 			},
	 		}
	 	},
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
	this.set('extend_id').set('title').set('table_name').set('sortid').set('orderby');
};


CodeInfoDlg.add = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var type = $("input[name = 'type']:checked").val();
	 var status = $("input[name = 'status']:checked").val();
	 
	 var action = '';
	 $('input[name="action"]:checked').each(function(){ 
	 	action += ',' + $(this).val(); 
	 }); 
	 action = action.substr(1); 
	 var tip = '添加';
	 var ajax = new $ax(Feng.ctxPath + "/Extend/add", function (data) {
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
	 ajax.set('type',type);
	 ajax.set('status',status);
	 ajax.set('action',action);
	 ajax.set(this.CodeInfoData);
	 ajax.start();
};


CodeInfoDlg.update = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var type = $("input[name = 'type']:checked").val();
	 var status = $("input[name = 'status']:checked").val();
	 var action = '';
	 $('input[name="action"]:checked').each(function(){ 
	 	action += ',' + $(this).val(); 
	 }); 
	 action = action.substr(1); 
	 var tip = '修改';
	 var ajax = new $ax(Feng.ctxPath + "/Extend/update", function (data) {
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
	 ajax.set('type',type);
	 ajax.set('status',status);
	 ajax.set('action',action);
	 ajax.set(this.CodeInfoData);
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


