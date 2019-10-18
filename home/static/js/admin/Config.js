var CodeInfoDlg = {
	CodeInfoData: {},
	deptZtree: null,
	pNameZtree: null,
	validateFields: {
		site_title: {
			validators: {
				notEmpty: {
					message: '站点名称不能为空'
	 			},
	 		}
	 	},
		email_user: {
			validators: {
				regexp: {
					regexp: /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/,
					message: '邮箱格式错误'
	 			},
	 		}
	 	},
		port: {
			validators: {
				regexp: {
					regexp: /^[0-9]*$/,
					message: ''
	 			},
	 		}
	 	},
		filepath: {
			validators: {
				regexp: {
					regexp: /^[\/a-zA-Z_]*$/,
					message: '格式错误'
	 			},
	 		}
	 	},
		default_themes: {
			validators: {
				notEmpty: {
					message: '默认主题模板不能为空'
	 			},
	 		}
	 	}
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
	this.set('filetype').set('site_title').set('site_logo').set('keyword').set('description').set('copyright').set('file_size').set('water_logo').set('water_position').set('email_user').set('email_pwd').set('smtp').set('port').set('bad_str').set('cnzz').set('sub_title').set('file_type').set('default_themes').set('filepath').set('off_msg').set('index_name').set('mobil_domain').set('mobil_themes');
};


CodeInfoDlg.index = function () {
	 this.clearData();
	 this.collectData();
	 if (!this.validate()) {
	 	return;
	 }
	 var water_status = $("input[name = 'water_status']:checked").val();
	 var site_status = $("input[name = 'site_status']:checked").val();
	 var mobil_status = $("input[name = 'mobil_status']:checked").val();
	 var url_type = $("input[name = 'url_type']:checked").val();
	 var tip = '修改';
	 var ajax = new $ax(Feng.ctxPath + "/Config/index", function (data) {
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
	 ajax.set('water_status',water_status);
	 ajax.set('site_status',site_status);
	 ajax.set('mobil_status',mobil_status);
	 ajax.set('url_type',url_type);
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


