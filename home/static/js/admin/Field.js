var CodeInfoDlg = {
	CodeInfoData: {},
	deptZtree: null,
	pNameZtree: null,
	validateFields: {
		name: {
			validators: {
				notEmpty: {
					message: '字段名不能为空'
	 			}
	 		}
	 	},
		field: {
			validators: {
				notEmpty: {
					message: '字段不能为空'
	 			},
				regexp: {
					regexp: /^[a-zA-Z_|]+$/,
					message: '大小写字母组合'
	 			},
	 		}
	 	},
		type: {
			validators: {
				notEmpty: {
					message: '字段类型不能为空'
	 			}
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
	this.set('id').set('extend_id').set('name').set('field').set('type').set('config').set('default_value').set('note').set('validate').set('message').set('sortid').set('sql').set('rule').set('align');
};


CodeInfoDlg.add = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 
	 var list_show = $("input[name = 'list_show']:checked").val();
	 var status = $("input[name = 'status']:checked").val();
	 var is_search = $("input[name = 'is_search']:checked").val();
	 var tip = '添加';
	 var ajax = new $ax(Feng.ctxPath + "/Field/add", function (data) {
	 	if ('00' === data.error) {
	 		Feng.success(tip + "成功" );
	 		window.parent.CodeGoods.table.refresh();
	 		CodeInfoDlg.close();
	 	} else {
	 		Feng.error(tip + "失败！" + data.msg + "！");
		 }
	 }, function (data) {
	 	Feng.error("操作失败!" + data.responseJSON.message + "!");
	 });
	 ajax.set('list_show',list_show);
	 ajax.set('status',status);
	 ajax.set('is_search',is_search);
	 ajax.set(this.CodeInfoData);
	 ajax.start();
};


CodeInfoDlg.update = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var list_show = $("input[name = 'list_show']:checked").val();
	 var status = $("input[name = 'status']:checked").val();
	 var is_search = $("input[name = 'is_search']:checked").val();
	 
	 var tip = '修改';
	 var ajax = new $ax(Feng.ctxPath + "/Field/update", function (data) {
	 	if ('00' === data.error) {
	 		Feng.success(tip + "成功" );
	 		window.parent.CodeGoods.table.refresh();
	 		CodeInfoDlg.close();
	 	} else {
	 		Feng.error(tip + "失败！" + data.msg + "！");
		 }
	 }, function (data) {
	 	Feng.error("操作失败!" + data.responseJSON.message + "!");
	 });
	 ajax.set('list_show',list_show);
	 ajax.set('status',status);
	 ajax.set('is_search',is_search);
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


