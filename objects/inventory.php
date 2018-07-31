<?php
class Inventory{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
	public $price;
	public $quantity;
	public $color;
	public $manufacturing_year;
	public $registration_number;
    public $description;
    public $manufacturer_id;
	public $image_1;
	public $image_2;
    public $timestamp;
	public $file;
	public $extension;
	public $new_name;
	public $destination;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name,
					description=:description,
					price=:price,
					quantity=:quantity,
					color=:color,
					manufacturing_year=:manufacturing_year,
					registration_number=:registration_number,
					image_1=:image_1,
					image_2=:image_2,
					manufacturer_id=:manufacturer_id,
					created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
		$this->quantity=htmlspecialchars(strip_tags($this->quantity));
		$this->color=htmlspecialchars(strip_tags($this->color));
		$this->manufacturing_year=htmlspecialchars(strip_tags($this->manufacturing_year));
		$this->registration_number=htmlspecialchars(strip_tags($this->registration_number));
		$this->image_1=htmlspecialchars(strip_tags($this->image_1));
		$this->image_2=htmlspecialchars(strip_tags($this->image_2));
		$this->manufacturer_id=htmlspecialchars(strip_tags($this->manufacturer_id));
    
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":price", $this->price);
		$stmt->bindParam(":quantity", $this->quantity);
		$stmt->bindParam(":color", $this->color);
		$stmt->bindParam(":manufacturing_year", $this->manufacturing_year);
		$stmt->bindParam(":registration_number", $this->registration_number);
		$stmt->bindParam(":image_1", $this->image_1);
		$stmt->bindParam(":image_2", $this->image_2);
        $stmt->bindParam(":manufacturer_id", $this->manufacturer_id);
        $stmt->bindParam(":created", $this->timestamp);
	
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
	
	function upload_file($file)  
	{  
		if(isset($file))  
         {  
			$extension = explode('.', $file["name"]);  
			$new_name = rand()."-".time() . '.' . $extension[1];  
			$destination = './upload/' . $new_name;  
			move_uploaded_file($file['tmp_name'], $destination);  
			return $new_name;  
         }  
	}  
	
	function readAll(){
 
		$query = "SELECT
					id, name, quantity, color, manufacturer_id
				FROM
					" . $this->table_name . "
				ORDER BY
					name ASC";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		return $stmt;
	}
	
	function sold(){
		
		$query = "UPDATE
                " . $this->table_name . "
            SET
                quantity = :quantity
            WHERE
                id = :id";
 
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':quantity', $this->quantity);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	function readone(){

		$query = "SELECT
					name,
					description,
					price,
					quantity,
					color,
					manufacturing_year,
					registration_number,
					image_1,
					image_2,
					manufacturer_id
				FROM
					" . $this->table_name . "
				WHERE
					id =:id
				LIMIT
					0,1";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();
	 
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->color = $row['color'];
		$this->quantity = $row['quantity'];
		$this->manufacturing_year = $row['manufacturing_year'];
		$this->registration_number = $row['registration_number'];
		$this->image_1 = $row['image_1'];
		$this->image_2 = $row['image_2'];
		$this->manufacturer_id = $row['manufacturer_id'];	
	}
}
?>