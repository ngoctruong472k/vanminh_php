<?php
	session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh'); //Set múi giờ mặc định
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
    $id_l = (isset($_REQUEST['id_list'])) ? addslashes($_REQUEST['id_list']) : "";
	$login_name = 'NINACO';
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	
	$d = new database($config['database']);
	
	#Thông tin công ty
	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	
	/*--- bao cao----*/
	$where = " table_product";
	//=== tim kiem chi tiet -=====
	$where.=" where id<>0 and type='sanpham'"; 
	if($_POST["ngaybd_1"]!=''){
	$ngaybatdau = $_POST["ngaybd_1"];		 $ngay_bd=$_POST["ngaybd_1"];
	$Ngay_arr = explode("/",$ngaybatdau); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày <br>";} else $ngaybatdau=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao>=".strtotime($ngaybatdau)." ";
	}

	if($_POST["ngaykt_1"]!=''){
	$ngayketthuc = $_POST["ngaykt_1"];	 $ngay_kt=$_POST["ngaykt_1"];
	$Ngay_arr = explode("/",$ngayketthuc); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày <br>";} else  $ngayketthuc=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao<=".strtotime($ngayketthuc)." ";
		
	}

	
	if($_POST["keyword_1"]!=''){
		$where.=" and (ten like '%".$_POST["keyword_1"]."%')  ";
	}
	//sotien_1
	if($_POST["sotien_1"]!='' && $_POST["sotien_1"]>0){
		$sql="select giatu,giaden from table_giasearch where id='".$_POST["sotien_1"]."'";
		$d->query($sql);
		$giatim=$d->fetch_array();
		if($giatim!=null){
			$where.=" and gia>=".$giatim['giatu']." and gia<=".$giatim['giaden']." ";		
		}
	}
	//======end tim kiem chi tiet=====

	$sql = "select * from $where order by stt asc";
	$d->query($sql);
	$result_baocao = $d->result_array();
	/*--- end bao bao---*/
	
	

	
// Bat dau export excel
	/** PHPExcel */
include 'PHPExcel.php';
/** PHPExcel_Writer_Excel */
include 'PHPExcel/Writer/Excel5.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A1:F1' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A2:F2' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A3:C3' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'D3:F3' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A4:C4' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A5:F5' );


$objPHPExcel->getActiveSheet()->getRowDimension( '5' )->setRowHeight( 42 );

$objPHPExcel->getActiveSheet()->getStyle( 'A5' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ),'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 16 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getColumnDimension( 'A' )->setWidth( 5 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'B' )->setWidth( 30 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'C' )->setWidth( 10 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'D' )->setWidth( 17 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'E' )->setWidth( 17 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'F' )->setWidth( 23 );

$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A1','Doanh nghiệp: '.$company['ten']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A2','Địa chỉ: '.$company['diachi']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A3','Từ ngày: '.$ngay_bd);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D3','Đến ngày: '.$ngay_kt);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A4','Ngày báo cáo: '.date('d/m/Y'));
   
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A5','BÁO CÁO BIẾN ĐỘNG HÀNG TỒN KHO' );




$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A7','STT' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'B7','Tên sản phẩm' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'C7','Số lượng' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D7','số lượng bán ra' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E7','Số lượng tồn kho' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'F7','Đơn giá' );

$objPHPExcel->getActiveSheet()->getStyle('A7:F7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getStyle( 'A7:F7' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true )));

$objPHPExcel->getActiveSheet()->getStyle( 'B7' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true )));


$vitri=8;
for($i=0,$count=count($result_baocao);$i<$count;$i++) { 

$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A'.$vitri, $i+1 )->setCellValue( 'B'.$vitri,$result_baocao[$i]['ten'] )->setCellValue( 'C'.$vitri, $result_baocao[$i]['soluong'])->setCellValue( 'D'.$vitri, $result_baocao[$i]['banra'])->setCellValue( 'E'.$vitri, $result_baocao[$i]['tonkho'])->setCellValue( 'F'.$vitri, number_format($result_baocao[$i]['gia'],0,",",".").'VNĐ');

$objPHPExcel->getActiveSheet()->getStyle( 'A'.$vitri.':F'.$vitri )->applyFromArray( array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getStyle( 'B'.$vitri )->applyFromArray( array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getStyle('A'.$vitri.':F'.$vitri)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$vitri++;	
}

	// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Thông tin đơn hàng');

		
// Save Excel 2007 file
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

//Redirect output to a client's web browser (Excel5)
      header( 'Content-Type: application/vnd.ms-excel' );
      header( 'Content-Disposition: attachment;filename="bao-ca-'.date('dmY').'.xls"' );
      header( 'Cache-Control: max-age=0' );

      $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
      $objWriter->save( 'php://output' );	
?>