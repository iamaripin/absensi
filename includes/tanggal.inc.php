<?php
class Tanggal{
	
	private $conn;
	private $table_name = "tanggal";
	
	public $tgl;
	public $ket;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->tgl);
		$stmt->bindParam(2, $this->ket);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function read1(){

		$query = "SELECT a.* from ".$this->table_name." a where a.nis not in (select nis from bobot_alternatif where id_periode=?)";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->idp);
		$stmt->execute();
		
		return $stmt;
	}

	function readAll(){

		$query = "SELECT * FROM ".$this->table_name."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}

	function count(){

		$query = "SELECT * FROM ".$this->table_name." where tanggal=?";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->tgl);
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE tanggal=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->tgl);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->tgl = $row['tanggal'];
		$this->ket = $row['keterangan'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					keterangan = :ket
				WHERE
					tanggal = :tgl";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':tgl', $this->tgl);
		$stmt->bindParam(':ket', $this->ket);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE tanggal = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->tgl);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	function hapusell($ax){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE nis in $ax";
		
		$stmt = $this->conn->prepare($query);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>