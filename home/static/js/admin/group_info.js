/**
 * 角色详情对话框（可用于添加和修改对话框）
 */
var GroupInfoDlg = {
    groupInfoData: {},
    deptZtree: null,
    pNameZtree: null,
    validateFields: {
    	groupname: {
            validators: {
                notEmpty: {
                    message: '分组名不能为空'
                }
            }
        }
    }
};

/**
 * 清除数据
 */
GroupInfoDlg.clearData = function () {
    this.groupInfoData = {};
};

/**
 * 设置对话框中的数据
 *
 * @param key 数据的名称
 * @param val 数据的具体值
 */
GroupInfoDlg.set = function (key, val) {
    this.groupInfoData[key] = (typeof value == "undefined") ? $("#" + key).val() : value;
    return this;
};

/**
 * 设置对话框中的数据
 *
 * @param key 数据的名称
 * @param val 数据的具体值
 */
GroupInfoDlg.get = function (key) {
    return $("#" + key).val();
};

/**
 * 关闭此对话框
 */
GroupInfoDlg.close = function () {
	var index = parent.layer.getFrameIndex(window.name);
//	var index = window.parent.CodeGroup.layerIndex;
    parent.layer.close(index);
};


/**
 * 收集数据
 */
GroupInfoDlg.collectData = function () {
    this.set('id').set('groupname');
};

/**
 * 验证数据是否为空
 */
GroupInfoDlg.validate = function () {
    $('#groupInfoForm').data("bootstrapValidator").resetForm();
    $('#groupInfoForm').bootstrapValidator('validate');
    return $("#groupInfoForm").data('bootstrapValidator').isValid();
};



/**
 * 提交添加
 */
GroupInfoDlg.addAuth = function () {
    
    var tip = '设置';
	var str = '';
	$("input[name='authorize']").each(function(){  
		if($(this).is(":checked"))  
		{  
			str += "," + $(this).val();  
		}  
	});  
	str = str.substr(1);
    var ajax = new $ax(Feng.ctxPath + "/Base/auth", function (data) {
    	if (1 === parseInt(data.code)) {
			Feng.success(tip + "成功！" );
	        GroupInfoDlg.close();
		} else {
			Feng.error(tip + "失败！" + data.msg + "！");
		}
    }, function (data) {
        Feng.error("修改失败!" + data.responseJSON.message + "!");
    });
    ajax.set('purviewval',str);
	ajax.set('id',$("#id").val());
    ajax.start();
    
};


$(function () {
    Feng.initValidator("groupInfoForm", GroupInfoDlg.validateFields);
	
});
