<?php
class Guru{
	
	private $conn;
	private $table_name = "guru";
	
	public $nip;
	public $nm;
	public $te;
	public $ta;
	public $jk;
	public $al;
	public $pa;
	public $go;
	public $st;
	public $ft;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nip);
		$stmt->bindParam(2, $this->nm);
		$stmt->bindParam(3, $this->te);
		$stmt->bindParam(4, $this->ta);
		$stmt->bindParam(5, $this->jk);
		$stmt->bindParam(6, $this->al);
		$stmt->bindParam(7, $this->pa);
		$stmt->bindParam(8, $this->go);
		$stmt->bindParam(9, $this->st);
		$stmt->bindParam(10, $this->ft);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}

	function read(){

		$query = "SELECT * FROM ".$this->table_name."";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
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

	function countOne(){

		$query = "SELECT * FROM ".$this->table_name." where nip=?";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE nip=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->nip);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->nip = $row['nip'];
		$this->nm = $row['nama_guru'];
		$this->te = $row['tempat_lahir'];
		$this->ta = $row['tanggal_lahir'];
		$this->jk = $row['jenis_kelamin'];
		$this->al = $row['alamat'];
		$this->pa = $row['pangkat'];
		$this->go = $row['golongan'];
		$this->st = $row['status'];
		$this->ft = $row['foto'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_guru = :nm,
					tempat_lahir = :te,
					tanggal_lahir = :ta,
					jenis_kelamin = :jk,
					alamat = :al,
					pangkat = :pa,
					golongan = :go,
					status = :st
				WHERE
					nip = :nip";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nip', $this->nip);
		$stmt->bindParam(':nm', $this->nm);
		$stmt->bindParam(':te', $this->te);
		$stmt->bindParam(':ta', $this->ta);
		$stmt->bindParam(':jk', $this->jk);
		$stmt->bindParam(':al', $this->al);
		$stmt->bindParam(':pa', $this->pa);
		$stmt->bindParam(':go', $this->go);
		$stmt->bindParam(':st', $this->st);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE nip = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nip);

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