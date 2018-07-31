<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/inventory.php';
include_once 'objects/manufacturer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$inventory = new Inventory($db);
$manufacturer = new Manufacturer($db);

$readallinventory = $inventory->readAll();
$totalinventory = $readallinventory->rowCount();

?>
<?php 
if(isset($_POST["action"]))  
 { 
	if($_POST['action'] == "insert"){
		$inventory->name = $_POST['modelname']; 
		$inventory->color = $_POST['color'];
		$inventory->price = $_POST['price'];
		$inventory->quantity = $_POST['quantity'];
		$inventory->manufacturing_year = $_POST['manufacturingyear'];
		$inventory->registration_number = $_POST['registrationnumber'];
		$inventory->description = $_POST['note'];
		$inventory->manufacturer_id = $_POST['manufacturer_id'];
		$inventory->image_1 = $inventory->upload_file($_FILES["image1"]);
		$inventory->image_2 = $inventory->upload_file($_FILES["image2"]);

		// create the inventory
		if($inventory->create()){
			echo "<div class='alert alert-success'>Inventory was created.</div>";
		}
		else{
			echo "<div class='alert alert-danger'>Unable to create inventory.</div>";
		}


	}

	if($_POST["action"] == "load")  
	{  
		// display the products if there are any
		if($totalinventory>0){
		 
			echo "<table class='table table-hover table-responsive table-bordered'>";
				echo "<tr>";
					echo "<th>No</th>";
					echo "<th>Model Name</th>";
					echo "<th>Quantity</th>";
					echo "<th>Color</th>";
					echo "<th>Manufacturer</th>";
					echo "<th>Actions</th>";
				echo "</tr>";
				$i=1;
				while ($row = $readallinventory->fetch(PDO::FETCH_ASSOC)){
		 
					extract($row);
		 
					echo "<tr>";
						echo "<td>{$i}</td>";
						echo "<td>{$name}</td>";
						echo "<td>{$quantity}</td>";
						echo "<td>{$color}</td>";
						echo "<td>";
							$manufacturer->id = $manufacturer_id;
							$manufacturer->readName();
							echo $manufacturer->name;
						echo "</td>";
		 
						echo "<td>";
							// read inventory button
						echo "<a href='javascript:void(0)' view-id='{$id}' class='btn btn-primary left-margin view-object'>";
							echo "<span class='glyphicon glyphicon-list'></span> View";
						echo "</a>";
						 
						// sold inventory button
						echo "<a href='javascript:void(0)' sold-id='{$id}' total-count='{$quantity}' class='btn btn-info left-margin sold-object'>";
							echo "<span class='glyphicon glyphicon-edit'></span> Sold";
						echo "</a>";
						 
						echo "</td>";
		 
					echo "</tr>";
				$i++;
				}
			
			echo "</table>";

			}
	 
		// tell the user there are no inventory
		else{
			echo "<div class='alert alert-info'>No inventory found.</div>";
		} 
	}
	if($_POST["action"] == "sold") 
	{	
		$inventory->id = $_POST['id'];
		$inventory->quantity = $_POST['remainingcount'];

		if($inventory->sold()){
			echo "Inventory was updated.";
		}
		else{
			echo "Unable to update.";
		}

	}
	
	if($_POST["action"] == "view") 
	{	
		$inventory->id = $_POST['id'];
		$inventory->readone();
		
		if($inventory->name !=''){
			
			echo "<div>";
			echo		"<div class='form-group'>
						<div class='row'>
							<div class='col-md-6'>
								<label for='modelname' class='control-label'>Model Name</label>
								<input type='text' class='form-control' value='{$inventory->name}' />
							</div>
							<div class='col-md-6'>
								<label for='manufacturer' class='control-label'>Manufacturer</label>";
								$stmt = $manufacturer->read();
								echo "<select class='form-control'>";
									echo "<option value=''>Select manufacturer</option>";
								 
									while ($row_manufacturer = $stmt->fetch(PDO::FETCH_ASSOC)){
										$manufacturer_id=$row_manufacturer['id'];
										$manufacturer_name = $row_manufacturer['name'];
										if($inventory->manufacturer_id==$manufacturer_id){
											echo "<option value='{$manufacturer_id}' selected>";
										}else{
										echo "<option value='{$manufacturer_id}'>";
										}
								 
									echo "{$manufacturer_name}</option>";
									}
								 
								echo "</select>
								
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='row'>
							<div class='col-md-6'>
								<label for='color' class='control-label'>Color</label>
								<input type='text' class='form-control' value='{$inventory->color}' />
							</div>
							<div class='col-md-6'>
								<label for='manufacturingyear' class='control-label'>Manufacturing year</label>
								<input type='text' class='form-control' value='{$inventory->manufacturing_year}'/>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='row'>
							<div class='col-md-6'>
								<label for='quantity' class='control-label'>Quantity</label>
								<input type='number' name='quantity'  class='form-control' value='{$inventory->quantity}' />
							</div>
							<div class='col-md-6'>
								<label for='price' class='control-label'>Price</label>
								<input type='text' name='price'  class='form-control' value='{$inventory->price}' />
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='row'>
							<div class='col-md-6'>
								<label for='registrationnumber' class='control-label'>Registration Number</label>
								<input type='text' class='form-control' value='{$inventory->registration_number}'' />
							</div>
							<div class='col-md-6'>
								<label for='note' class='control-label'>Note</label>
								<textarea class='form-control'>{$inventory->description}</textarea>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='row'>
							<div class='col-md-6'>
								<label for='image1' class='control-label'>Image 1</label>
								<img src='upload/{$inventory->image_1}' class='img-thumbnail' width='150' height='120' />
							</div>
							<div class='col-md-6'>
								<label for='image2' class='control-label'>Image 2</label>
								<img src='upload/{$inventory->image_2}' class='img-thumbnail' width='150' height='120' />
							</div>
						</div>
					</div>";
			echo "</div>";
		}
		else{
			echo "<div>Unable to view.</div>";
		}

	}
 }
?>