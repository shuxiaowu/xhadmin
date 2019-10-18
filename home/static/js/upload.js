/*
picker 按钮ID
thumb input输入框ID
num 上传图片的数量
multiple false 单图上传 true多图上传
srcs  初始化已经上传的多图
filetype   image 图片上传 file 文件上传
*/

function uploader(picker,thumb,filetype,multiple,srcs,uploadUrl){

	var uploader,
	UploaderList = {
		init: function () {
			this.queue = $('<ul class="filelist"></ul>').appendTo($('.pic_list'));
			if(srcs){
				var album = eval('(' + srcs + ')');
				var length;
				for(var i in album) {
					length++;
					UploaderList.createList({
						name: '',
						dir: album[i],
						dom: null
					});
				}
				this.fileCounts = length;
			}
		},
		queue: null,
		files: [], // 上传文件操作数据数组
		// 设置第一张图片为封面
		
		createList: function (data) {
			
			if(multiple == true){
				this.files.push(data);
				var index = this.files.length - 1;
				var classname = this.files[index].dir.match(/\d{12}/).toString();
				var li_html = '<li class='+classname+'>' + 
						'<p class="imgWrap"><img width="100" style="margin:2px 2px 0 0" height="100" src="' + this.files[index].dir +'"/></p>' + 
						'<p class="cancel" style="margin-top: 0px;"><a onclick=delfile(\'' + picker + '\',\''+this.files[index].dir+'\') href="javascript:void(0)">删除</a></p>' + 
						'</li>',
					$li = $(li_html),
					$wrap = $li.find('p.imgWrap'),
					$del = $li.find('p.cancel');
				this.files[index].dom = $li
				$li.appendTo( this.queue );
				
			}else{
				$("#"+thumb).val(data.dir);
			}
			
		}
	};

	UploaderList.init();
	
	var label,title,extensions,mimeType;
	if(filetype == 'image'){
		label = '图片上传';
		title = 'images';
		extensions = 'gif,jpg,jpeg,bmp,png';
		mimeType = 'image/*';
	}else if(filetype == 'file'){
		label = '文件上传';
		title = 'files';
		extensions = '*';
		mimeType = '*';
	};

	// 初始化Web Uploader
	uploader = WebUploader.create({
		// 选完文件后，是否自动上传。
		auto: true,
		runtimeOrder: 'html5',

		// 文件接收服务端。
		server: uploadUrl,

		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: {
			id: '#'+picker,
			multiple: multiple, // 多文件上传
			label: label, // 按钮文字
		},

		// 只允许选择图片文件。
		/*上传文件类型
		extensions: 'pdf,doc,docx,txt,xls,xlsx,ppt,pptx,zip,mp3,mp4,text,csv',
		mimeTypes: 'text/*'
		+',application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		+',application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		+',application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation'
		+',application/pdf'
		+',application/zip'
		+',application/csv'
		*/
		accept: {
			title: title,
			extensions: extensions,
			mimeTypes: mimeType
		}
	});


	// 上传成功后触发
	uploader.onUploadSuccess = function( file, response ) {
		if(response.code == '1') {
			UploaderList.createList({
				name: file.name,
				dir: response.data,
				dom: null,
				fileId: file.id,
			});
			if(multiple == true){
				$("#"+thumb).val(response.data + "|" + $("#"+thumb).val());	//输出文件地址
			}
			
		} else {
			alert("图片" + file.name + "上传失败！");
		}
		return true;
	};


	// 上传失败后触发
	uploader.onUploadError = function( file, reason ) {
		alert('上传失败！');
		return false;
	};

	uploader.onError = function( code ) {
		var tx = '';
		if(code === 'F_EXCEED_SIZE') {
			tx = '请上传文件小于1M的图片';
		} else if(code === 'Q_EXCEED_SIZE_LIMIT') {
			tx = '添加的图片总大小超过10M';
		} else if(code === 'Q_TYPE_DENIED') {
			tx = '请上传gif,jpg,jpeg,bmp,png格式图片';
		} else if(code === 'Q_EXCEED_NUM_LIMIT') {
			tx = '最多添加10张图片';
		} else if(code === 'F_DUPLICATE') {
			tx = '请选择不同的图片';
		} else {
			tx = code;
		}
		alert( '错误: ' + tx );
	};
}

function delfile(echoid,src)
{
   echoid = echoid.split('_');
   var classname = src.match(/\d{12}/).toString();
   var srcs = $("#"+echoid).val();
   var laststr = srcs.charAt(srcs.length - 1);
   
   if(laststr == '|')
   {
      $("#"+echoid).val(srcs.replace(src + "|",''));
   }else{
      srcs += '|';
      $("#"+echoid).val(srcs.replace(src + "|",''));
   }
   
   $("."+classname).remove();
  
}



