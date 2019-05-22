<?php
/* author : prae */
class HCExec /*สร้างคลาส*/{

	private $conn; /*ตัวแปร */

	public function __construct($db)/*เมดธอท constructorของคลาสจะถูกเรียกใช้งานเป็นอันแรก*/{
		$this->conn = $db;
	}
	
	public function dataTransection( $query )/*เมดธอท มีพารามิเตอร์($query) */{
		try {/*ประมวลผลคำสั่งsql เช่น คำสั่งinsert,edit*/
			$stmt = $this->conn->prepare( $query );  
			if($stmt->execute())/*execute=เมดธอดที่ทำการประมวล */{
				return 1;
			} else { 
				return 0; 
			}
		} catch (PDOException $e) {
			return false;
		}
	}
	
	/*public function read( $query )/*เมดธอท  สำหรับแสดงผลข้อมูล{
		try {
			$stmt = $this->conn->prepare( $query );/*prepare=เตรียม 
			if($stmt->execute()){
				 return $stmt;
			}
		} catch (PDOException $e) {
			return false;
		}
	}*/
	

	public function process($query){
			try {
				$stmt = $this->conn->prepare( $query );
				if($stmt->execute()){
					 return $stmt;
				}
			} catch (PDOException $e) {
				return false;
			}
			}
}
?>
