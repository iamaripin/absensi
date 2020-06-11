<?php
class Absen{
	
	private $conn;
	private $table_name = "absen";
	
	public $nip;
	public $nm;
	public $tgl;
	public $bln;
	public $thn;
	public $ab;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nip);
		$stmt->bindParam(2, $this->tgl);
		$stmt->bindParam(3, $this->ab);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function read1(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and a.tanggal=?";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->tgl);
		$stmt->execute();
		
		return $stmt;
	}

	function read2(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=?";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->execute();
		
		return $stmt;
	}

	function hadir(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=? and a.nip=? and absensi='Hadir'";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->bindParam(3, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
	}

	function tidak_hadir(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=? and a.nip=? and absensi='Tidak Hadir'";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->bindParam(3, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
	}

	function sakit(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=? and a.nip=? and absensi='Sakit'";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->bindParam(3, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
	}

	function izin(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=? and a.nip=? and absensi='Izin'";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->bindParam(3, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
	}

	function total(){

		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and month(tanggal)=? and year(tanggal)=? and a.nip=?";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->bln);
		$stmt->bindParam(2, $this->thn);
		$stmt->bindParam(3, $this->nip);
		$stmt->execute();
		
		return $stmt->rowCount();
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

		$query = "SELECT * FROM ".$this->table_name."";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT a.*, b.* from ".$this->table_name." a, guru b where a.nip=b.nip and a.tanggal=? and a.nip=?";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->tgl);
		$stmt->bindParam(2, $this->nip);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->ab = $row['absensi'];
		$this->tgl = $row['tanggal'];
		$this->nm = $row['nama_guru'];
		$this->nip = $row['nip'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					absensi = :ab
				WHERE
					tanggal = :tgl
				AND
					nip = :nip";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':tgl', $this->tgl);
		$stmt->bindParam(':nip', $this->nip);
		$stmt->bindParam(':ab', $this->ab);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function absen(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					absensi = :ab
				WHERE
					tanggal = :tgl
				AND
					nip = :nip";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':tgl', $this->tgl);
		$stmt->bindParam(':nip', $this->nip);
		$stmt->bindParam(':ab', $this->ab);
		
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