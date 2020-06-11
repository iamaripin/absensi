<?php
class User
{

	private $conn;
	private $table_name = "pengguna";

	public $id;
	public $np;
	public $un;
	public $pw;
	public $dm;
	public $tgl;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function insert()
	{

		$query = "insert into " . $this->table_name . " values('',?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->np);
		$stmt->bindParam(2, $this->un);
		$stmt->bindParam(3, $this->pw);
		$stmt->bindParam(4, $this->dm);
		$stmt->bindParam(5, $this->tgl);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll()
	{

		$query = "SELECT * FROM " . $this->table_name . " WHERE domain='user' ORDER BY id_pengguna ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readAlll()
	{

		$query = "SELECT * FROM " . $this->table_name . " WHERE domain='user' ORDER BY id_pengguna ASC";
		$stmtt = $this->conn->prepare($query);
		$stmtt->execute();

		return $stmtt;
	}

	// used when filling up the update product form
	function readOne()
	{

		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pengguna=? LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id_pengguna'];
		$this->np = $row['nama_pengguna'];
		$this->un = $row['username'];
		$this->pw = $row['password'];
	}

	// update the product
	function update()
	{

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_pengguna = :nm, 
					username = :un
				WHERE
					id_pengguna = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nm', $this->np);
		$stmt->bindParam(':un', $this->un);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function updatepass()
	{

		$query = "UPDATE 
					" . $this->table_name . " 
				SET  
					password = :pw
				WHERE
					id_pengguna = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':pw', $this->pw);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// delete the product
	function delete()
	{

		$query = "DELETE FROM " . $this->table_name . " WHERE id_pengguna = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	function countAll()
	{

		$query = "SELECT * FROM " . $this->table_name . " ORDER BY id_pengguna ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}
	function hapusell($ax)
	{

		$query = "DELETE FROM " . $this->table_name . " WHERE id_pengguna in $ax";

		$stmt = $this->conn->prepare($query);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
 