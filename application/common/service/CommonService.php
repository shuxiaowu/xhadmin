<?php

namespace app\common\service;

use PHPExcel;
use PHPExcel_Cell;
use PHPExcel_IOFactory;

class CommonService
{
	
	//时间区间筛选组合
	public function getTimeWhere($startTime,$endTime){
		
		$where = [];
		if(!empty($startTime) && !empty($endTime)){
			$where = [['gt',strtotime($startTime)],['lt',strtotime($endTime)]];
		}
		if(!empty($startTime) && empty($endTime)){
			$where = ['gt',strtotime($startTime)];
		}
		if(empty($startTime) && !empty($endTime)){
			$where = ['lt',strtotime($endTime)];
		}
		return $where;
	}
	
	//导出excel表头设置
	public function getTag($key){
	   $data = [
			'1' => 'A',
			'2' => 'B',
			'3' => 'C',
			'4' => 'D',
			'5' => 'E',
			'6' => 'F',
			'7' => 'G',
			'8' => 'H',
			'9' => 'I',
			'10'=>'J',
			'11'=>'K',
			'12'=>'L',
			'13'=>'M',
			'14'=>'N',
			'15'=>'O',
			'16'=>'P',
			'17'=>'Q',
			'18'=>'R',
		];
		return $data[$key];
   }
	
   //读取excel数据
   function importExecl($file)
	{
		//初始化变量
		$PHPExcel = '';
		$array    = [];
		if (!file_exists($file)) {
			return array("error" => 1, 'message' => 'file not found!');
		}

		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		try {
			$PHPReader = $objReader->load($file);
		} catch (Exception $e) {

		}
		if (!isset($PHPReader)) {
			return array("error" => 1, 'message' => 'read error!');
		}

		$allWorksheets = $PHPReader->getAllSheets();
		$i             = 0;
		foreach ($allWorksheets as $objWorksheet) {
			$sheetname          = $objWorksheet->getTitle();
			$allRow             = $objWorksheet->getHighestRow(); //how many rows
			$highestColumn      = $objWorksheet->getHighestColumn(); //how many columns
			$allColumn          = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$array[$i]["Title"] = $sheetname;
			$array[$i]["Cols"]  = $allColumn;
			$array[$i]["Rows"]  = $allRow;
			$arr                = [];
			$isMergeCell        = []; //merge cells
			foreach ($objWorksheet->getMergeCells() as $cells) {
				foreach (PHPExcel_Cell::extractAllCellReferencesInRange($cells) as $cellReference) {
					$isMergeCell[$cellReference] = true;
				}
			}
			for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
				$row = [];
				for ($currentColumn = 0; $currentColumn < $allColumn; $currentColumn++) {
					$cell    = $objWorksheet->getCellByColumnAndRow($currentColumn, $currentRow);
					$afCol   = PHPExcel_Cell::stringFromColumnIndex($currentColumn + 1);
					$bfCol   = PHPExcel_Cell::stringFromColumnIndex($currentColumn - 1);
					$col     = PHPExcel_Cell::stringFromColumnIndex($currentColumn);
					$address = $col . $currentRow;
					$value   = $objWorksheet->getCell($address)->getValue();
					if (substr($value, 0, 1) == '=') {
						return array("error" => 0, 'message' => 'can not use the formula!');
						exit;
					}

					if ($isMergeCell[$col . $currentRow] && $isMergeCell[$afCol . $currentRow] && !empty($value)) {
						$temp = $value;
					} elseif ($isMergeCell[$col . $currentRow] && $isMergeCell[$col . ($currentRow - 1)] && empty($value)) {
						$value = $arr[$currentRow - 1][$currentColumn];
					} elseif ($isMergeCell[$col . $currentRow] && $isMergeCell[$bfCol . $currentRow] && empty($value)) {
						$value = $temp;
					}
					$row[$currentColumn] = $value;
				}
				$arr[$currentRow] = $row;
			}
			$array[$i]["Content"] = $arr;
			$i++;
		}
		
		unset($objWorksheet);
		unset($PHPReader);
		unset($PHPExcel);
		unlink($file);
		return array("error" => 0, "data" => $array);
	}
	
	//删除文件夹及其文件
	public static function deldir($dir) {
   //先删除目录下的文件：
	   $dh=opendir($dir);
	   while ($file=readdir($dh)) {
		  if($file!="." && $file!="..") {
			 $fullpath=$dir."/".$file;
			 if(!is_dir($fullpath)) {
				unlink($fullpath);
			 } else {
				self::deldir($fullpath);
			 }
		  }
	   }
	 
	   closedir($dh);
	   //删除当前文件夹：
	   if(rmdir($dir)) {
		  return true;
	   } else {
		  return false;
	   }
	}
	
	
}
