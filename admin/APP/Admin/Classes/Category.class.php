<?php
namespace Admin\Classes;
	Class Category{
		static function read($filename,$encode='utf-8'){
			Vendor('PHPExcel');

			$objReader = \PHPExcel_IOFactory::createReader(Excel5); 
		    $objReader->setReadDataOnly(true); 
		    $objPHPExcel = $objReader->load($filename); 
		    $objWorksheet = $objPHPExcel->getActiveSheet(); 
		    $highestRow = $objWorksheet->getHighestRow(); 
		    $highestColumn = $objWorksheet->getHighestColumn(); 
		    $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); 
		    $excelData = array(); 
		    for($row = 1; $row <= $highestRow; $row++)
		    { 
		        for($col=0; $col<$highestColumnIndex; $col++) { 
		                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		        } 
		    } 
		    return $excelData; 
		}
		//获取表格的表头数据
		static function getExcelTop($excelData){
			foreach($excelData as $k=>$v){
				$data[$v]=$k;
			}
			return $data;
		}
		//获取表格的有用的数据
		static function getExcelBody($excelData){
			foreach($excelData as $k=>$v){
				if($k>2)
					$data[$k]=$v;
			}
			return $data;
		}
	}
?>


        
      