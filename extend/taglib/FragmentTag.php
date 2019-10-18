<?php
namespace taglib;

use \think\template\TagLib;

class FragmentTag extends TagLib
{

    protected $tags = array(
		'sql'    	 => ['attr' => 'query', 'alias' => 'iterate'],
		'relate'    	 => ['attr' => 'sqlstr','level'=>3],
		'newslist'=>['attr'=>'classid,field,order,num,sqlstr,flag,group,result,empty','level'=>3],
		'list'=>['attr'=>'table,classid,field,num,order,sqlstr','level'=>3],
		'query'=>['attr'=>'table,field,num,order,sqlstr','level'=>3],
		'class'=>['attr'=>'field,num,order,sqlstr','level'=>3],
		'page'=>['attr'=>'table,field,num,order,sqlstr','level'=>1],
		'sig'  => ['attr'=>'id,field','close'=>0],
    );

	public function tagSql($tag, $content)
    {   
        $result= !empty($tag['result'])?$tag['result']: 'sql';
		preg_match_all('/select(.*)from/iUs',$tag['query'],$all);
		if(!empty($all[1][0])){
			$sqlvalue = explode(',',trim($all[1][0]));
		}
		$tag['query'] = str_replace('pre_',config('database.prefix'),$tag['query']);
        $data ="db()->query('{$tag['query']}')";
		
        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$data.';';
		$parsestr .= 'if($_result)';
		if(!empty($sqlvalue[2])){
			$fieldConfig = $sqlvalue[0].','.$sqlvalue[2].','.$sqlvalue[1].','.$sqlvalue[1];
			$parsestr .= '$_result = formartList(explode(",","'.$fieldConfig.'"),$_result);';
		}
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach?>';
        return  $parsestr;
    }
	
	public function tagRelate($tag, $content)
    {   
        $result= !empty($tag['result'])?$tag['result']: 'relate';
        $data ="db()->query('{$tag['sqlstr']}')";
		
        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$data.';';
		$parsestr .= 'if($_result)';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach?>';
        return  $parsestr;
    }
	
	//数据查询标签
	public function tagQuery($tag,$content) {       
        $result= !empty($tag['result'])?$tag['result']: 'query';
		$map.=($tag['sqlstr'])?"{$tag['sqlstr']} ":"";
        $sql ="db('{$tag['table']}')->";
		$sql.=($tag['field'])?"field('{$tag['field']}')->":"";
		$sql.="where(\"{$map}\")->";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
		$sql.=($tag['group'])?"group('{$tag['group']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";
		$empty =    isset($tag['empty'])?$tag['empty']:'';

        //下面拼接输出语句

        $parsestr  = '<?php $_result='.$sql.';';
		$parsestr .= 'if($_result)';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;else?>';
		$parsestr .='<?php echo "'.$empty.'";?>';
        return  $parsestr;
   }
   
   //栏目查询标签
	public function tagClass($tag,$content) {       
        $result= !empty($tag['result'])?$tag['result']: 'class';
		$map.=($tag['sqlstr'])?" {$tag['sqlstr']} ":"1=1";
        $sql ="db('catagory')->";
		$sql.=($tag['field'])?"field('class_id,filepath,filename,class_name,jumpurl,{$tag['field']}')->":"field('class_id,class_name,jumpurl,filepath,filename')->";
		$sql.="where(\"{$map}\")->";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"order('sortid asc')->";
		$sql.=($tag['group'])?"group('{$tag['group']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";
		$empty =    isset($tag['empty'])?$tag['empty']:'';

        //下面拼接输出语句

        $parsestr  = '<?php $_result='.$sql.';';
		$parsestr .= 'if($_result)';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
		$url = "getClassUrl(\$class)";
		$parsestr .= '<?php $'.$result.'["url"]='.$url.'; ?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;else?>';
		$parsestr .='<?php echo "'.$empty.'";?>';
        return  $parsestr;
   }
	
	//内容列表查询标签
	public function tagNewslist($tag,$content) {       
        $result= !empty($tag['result'])?$tag['result']: 'newslist';
		$ids = model("index/Catagory")->getSubClassId($tag['classid']);
		$ids = empty($ids) ? $tag['classid'] : $tag['classid'].','.$ids;
		$map.=($tag['classid'])?" class_id in (".$ids.") and status = 10":"1=1";
		$map.=($tag['sqlstr'])?" and {$tag['sqlstr']} ":"";
        $sql ="db('content')->";
		$sql.=($tag['field'])?"field('content_id,title,pic,jumpurl,create_time,{$tag['field']}')->":"field('content_id,title,pic,jumpurl,create_time')->";
		$sql.="where(\"{$map}\")->";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"order('sortid desc,content_id desc')->";
		$sql.=($tag['group'])?"group('{$tag['group']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";
		$empty =    isset($tag['empty'])?$tag['empty']:'';

        //下面拼接输出语句

        $parsestr  = '<?php $_result='.$sql.';';
		$parsestr .= 'if($_result)';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
		$url = "getListUrl(\$newslist)";
		$spic = "getSpic(\$newslist)";
		$parsestr .= '<?php $'.$result.'["url"]='.$url.'; $'.$result.'["spic"]='.$spic.'; ?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;else?>';
		$parsestr .='<?php echo "'.$empty.'";?>';
        return  $parsestr;
   }
   
   
   //带分页的内容查询标签
   public function tagList($tag,$content) {
        $result= !empty($tag['result'])?$tag['result']: 'list';
		$map = " class_id in(\".model(\"index/Catagory\")->getSubClassId(\$classid).\") and status =10 ";
        $map.=($tag['sqlstr'])?" and {$tag['sqlstr']} ":"";
        $sql ="db('content')->";
		$sql.=($tag['field'])?"field('content_id,title,pic,jumpurl,create_time,{$tag['field']}')->":"field('content_id,title,pic,jumpurl,create_time')->";
		$sql.="where(\"{$map}\")->";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"order('sortid desc,content_id desc')->";
		if(empty($tag['num'])){
			$tag['num'] = 20;
		}
        $sql.=($tag['num'])?'limit(($p-1)*'.$tag['num'].','.$tag['num'].')->':"";
        $sql.="select()";
        $parsestr  = '<?php $_result='.$sql.';';
		$parsestr .= "\$count=db('content')->where(\"{$map}\")->count();";
		if(config('url_type') == 2){
			//此处的参数p很有技巧 传入当前的页码 静态化的时候获取不到当前页码 必须从这里传入
			$parsestr .=  '$Page=new \app\common\org\PageHtml($count,'.$tag['num'].',$info["filepath"],$p);';
		}else{
			$parsestr .=  '$Page=new \app\common\org\Page($count,'.$tag['num'].',["class_id"=>$classid]);';
		}
		
		$parsestr .=  '$showpage=$Page->show();';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
		$url = "getListUrl(\$list)";
		$spic = "getSpic(\$list)";
		$parsestr .= '<?php $'.$result.'["url"]='.$url.'; $'.$result.'["spic"]='.$spic.'; ?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach?>';
        return  $parsestr;
   }
   
    //带分页的万能查询标签
   public function tagPage($tag,$content) {
        $result= !empty($tag['result'])?$tag['result']: 'page';
        $map.=($tag['sqlstr'])?" {$tag['sqlstr']} ":"";
        $sql ="db('{$tag['table']}')->";
		$sql.="where(\"{$map}\")->";
        $sql.=($tag['field'])?"field('{$tag['field']}')->":"";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
		if(empty($tag['num'])){
			$tag['num'] = 20;
		}
        $sql.=($tag['num'])?"limit((input('param.p',1,'intval')-1)*{$tag['num']},{$tag['num']})->":"";
        $sql.="select()";
        $parsestr  = '<?php $_result='.$sql.';';
		$parsestr .= "\$count=db('{$tag['table']}')->where(\"{$map}\")->count();";
		$parsestr .=  '$Page=new \app\common\org\Page($count,'.$tag['num'].',["class_id"=>input("param.class_id")]);';
		$parsestr .=  '$showpage=$Page->show();';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach?>';
        return  $parsestr;
   }
   
   //定义查询数据库标签
   public function tagSig($tag,$content) {
        $result= !empty($tag['result'])?$tag['result']: 'sig';
		$map.="frament_id = {$tag['id']}";
        $sql="db('frament')->";
		$sql.="field('content,pic')->";
		$sql.="where(\"{$map}\")->";
        $sql.="find()";
        $parsestr  = '<?php $'.$result.'=$_result='.$sql.'; echo $'.$result.'[\'content\'];?>';
        return  $parsestr;
   }
   
  
    
	
}
?>