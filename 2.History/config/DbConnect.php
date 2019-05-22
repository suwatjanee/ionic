<?php
class DatabaseConnection /*สร้างคลาส ไม่การสืบทอด*/{ 
	private $host = "localhost"; /*4ตัวแปร */
	private $db_name = "history";
	private $username = "root";
	private $password = "06032541";
	public $conn;/*สามารถเอาไปใช้ที่คลาสอื่นได้ --เชื่อมต่อ-- */

	public function getConnection()/*เมทธอต เชื่อมฐานข้อมูล*/{
		$this->conn = null;/*thisชี้ไปที่conn=เก็บค่า ที่มีค่าเริ่มต้น=null */
		/*try=พยายามทำอะไร,catch=ดักจับerror */
		try/*เชื่อมต่อฐานข้อมูล */ {
			$this->conn = new PDO/*PDO = classของphp */("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
			$this->username, $this->password);
			$this->conn->exec("set names utf8");
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage(); /*echo=โชว์ข้อความที่เราพิมพ์  .(จุด)=การเชื่อม */
		}

		return $this->conn; /*่สงค่าไปยังconn */
	}
}
?>
