var CodeInfoDlg = {
	CodeInfoData: {},
	deptZtree: null,
	pNameZtree: null,
	validateFields: {
		index_tpl: {
			validators: {
				notEmpty: {
					message: '首页模板不能为空'
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
	this.set('index_tpl').set('list_class_id').set('view_class_id').set('startId').set('endId').set('pagesize');
};


CodeInfoDlg.doIndex = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var ajax = new $ax(Feng.ctxPath + "/DoHtml/doIndex", function (data) {
	 	if ('00' === data.status) {
	 		Feng.success(data.msg);
	 		window.parent.CodeGoods.table.refresh();
	 		CodeInfoDlg.close();
	 	} else {
	 		Feng.error(data.msg + "！");
		 }
	 }, function (data) {
	 	Feng.error("操作失败!" + data.responseJSON.message + "!");
	 });
	 ajax.set(this.CodeInfoData);
	 ajax.start();
};

CodeInfoDlg.doList = function () {
	var list_class_id = $("#list_class_id option:selected").val();
	var index = layer.open({type: 2,title: '开始生成',area: ['500px', '300px'],fix: false, maxmin: true,content: Feng.ctxPath + '/doHtml/doList/classId/'+list_class_id});
	this.layerIndex = index;
}


CodeInfoDlg.doView = function () {
	var view_class_id = $("#view_class_id option:selected").val();
	var pagesize = $("#pagesize").val();
	var startId = $("#startId").val();
	var endId = $("#startId").val();
	var index = layer.open({type: 2,title: '开始生成',area: ['500px', '300px'],fix: false, maxmin: true,content: Feng.ctxPath + '/doHtml/doView?classId='+view_class_id+'&pagesize='+pagesize+'&startId='+startId+'&endId='+endId});
	this.layerIndex = index;
}




CodeInfoDlg.validate = function () {
	  $('#CodeInfoForm').data("bootstrapValidator").resetForm();
	  $('#CodeInfoForm').bootstrapValidator('validate');
	  return $("#CodeInfoForm").data('bootstrapValidator').isValid();
};


$(function () {
	   Feng.initValidator("CodeInfoForm", CodeInfoDlg.validateFields);
});


