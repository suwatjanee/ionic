<?php 
	
	date_default_timezone_set("Asia/Bangkok"); /*เซ็ตเวลา */
	
	/*6-9 ให้มีการเข้าถึงข้อมูลได้ */
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	/*11-12 เรียกไฟล์อื่นมาใช้ include=>ชื่อพาร์ท*/
	include "../config/DbConnect.php";
	include "../config/HCExec.php";
	
	$db = new DatabaseConnection(); /*สร้างobject classใหม่ ชื่อdb*/
	$strConn = $db->getConnection(); /*strConnเก็บค่าที่เรียกเมดธอท getConnection */
	$strExe = new HCExec($strConn); /*สร้างobject classใหม่ ชื่อstrExe*/
	
	
	$content = file_get_contents('php://input');
    // parse JSON
	$data = json_decode($content, true);

	//รับค่าไปเก็บที่ตัวแปล //ionic
	$action = $data['cmd'];
	$his_id = $data['his_id'];
	$his_name = $data['his_name'];
	$his_pirce = $data['his_pirce'];

	
	//TestAPI
	/*$action = $_GET['cmd'];
	$his_id = $_GET['id'];
	$his_name = $_GET['name'];
	$his_pirce = $_GET['pirce'];*/


	switch($action){//รับค่า้พื่อเลือกฟังชันการทำงาน
	case 'select' :
	$sql = " SELECT * FROM profile "; //
	$stmt = $strExe->process($sql);      //ส่งค่า sql ไปให้ฟังชัน process
	$rowCount = $stmt->rowCount();
	
	if ($rowCount > 0) {//เช็คว่ามีข้อมูลหรือป่าว
		$data_arr['rs'] = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			array_push($data_arr["rs"], $row);//ถ้ามีข้อมูลดึงข้อมูลมาแสดง
		}
		echo json_encode($data_arr);
		
		} else {
		echo json_encode(array("message" => "No data found","row"=> $rowCount));//ถ้าไม่ข้อมูลให้แสดง message
	}
	break;
	case 'selectone' :
	$sql = " SELECT * FROM profile WHERE his_id = '".$his_id."' "; //
	$stmt = $strExe->process($sql);      //ส่งค่า sql ไปให้ฟังชัน process //Editรายคน
	$rowCount = $stmt->rowCount();
	
	if ($rowCount > 0) {//เช็คว่ามีข้อมูลหรือป่าว
		$data_arr['rs'] = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			array_push($data_arr["rs"], $row);//ถ้ามีข้อมูลดึงข้อมูลมาแสดง
		}
		echo json_encode($data_arr);
		
		} else {
		echo json_encode(array("message" => "No data found","row"=> $rowCount));//ถ้าไม่ข้อมูลให้แสดง message
	}
	break;
	case 'insert' :
	$sql = " INSERT INTO profile(his_name,his_pirce) VALUE ('".$his_name."','".$his_pirce."') ";
    $stmt = $strExe->process($sql);//54-55 ส่งค่าในตัวแปร sql ไปที่ฟังชัน process
    if($stmt){
        echo json_encode(array('msg'=>'บันทึกข้อมูลเรียบร้อยแล้ว')); 
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถบันทึกข้อมูลได้'));
    }

	break;
	case 'edit' :
	$sql = " UPDATE profile SET his_name = '".$his_name."', his_pirce = '".$his_pirce."' WHERE his_id ='".$his_id."' ";

    $stmt = $strExe->process($sql);
    if($stmt){
        echo json_encode(array('msg'=>'แก้ไขข้อมูลเรียบร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถแก้ไขข้อมูลได้'));
    }

	break;

	case 'delete' :
	$sql = " DELETE FROM profile  WHERE his_id ='".$his_id."' ";

    $stmt = $strExe->process($sql);
    if($stmt){
        echo json_encode(array('msg'=>'ลบข้อมูลเรียบร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถลบข้อมูลได้'));
    }

	break;
}
?>	