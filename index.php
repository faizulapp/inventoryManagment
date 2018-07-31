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
$page_title = "Inventory Managment";
include_once "header.php";
?>
<div class="container-box rotated">
<button type="button" class="btn btn-info btn-lg turned-button" data-toggle="modal" data-target="#inventoryModal">Add Inventory</button>
</div>
<br/>
<div class="container">
	<div class="row" id="inventory_table">
	</div>
<!-- View Modal -->
<div id="viewInventoryModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h4 class="modal-title">View Inventory</h4>
			</div>
			<div class="modal-body" id="view-inventory">
				
			</div>
		</div>

	</div>
</div>

<!-- End -->
<!-- Modal -->
<div id="inventoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">×</button>
<h4 class="modal-title">Create Inventory</h4>
</div>
<div class="modal-body">

<!-- HTML form for creating a inventory -->
	<form  method="post" id="inventory_form">
		<input type="hidden" name="action" id="action" value="insert" />
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="modelname" class="control-label">Model Name</label>
					<input type="text" name="modelname"  class="form-control" id="modelname" placeholder="Model Name" />
					<span class="errormsg" id="modelname_error"></span>
				</div>
				<div class="col-md-6">
					<label for="manufacturer" class="control-label">Manufacturer</label>
					<?php
					// read the product categories from the database
					$stmt = $manufacturer->read();
					 
					// put them in a select drop-down
					echo "<select class='form-control' name='manufacturer_id' id='manufacturer_id'>";
						echo "<option value=''>Select manufacturer</option>";
					 
						while ($row_manufacturer = $stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row_manufacturer);
							echo "<option value='{$id}'>{$name}</option>";
						}
					 
					echo "</select>";
					?>
					<span class="errormsg" id="manufacturerid_error"></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="color" class="control-label">Color</label>
					<input type="text" name="color"  class="form-control" id="color" placeholder="color" />
					<span class="errormsg" id="color_error"></span>
				</div>
				<div class="col-md-6">
					<label for="manufacturingyear" class="control-label">Manufacturing year</label>
					<input type="text" name="manufacturingyear"  class="form-control" id="manufacturingyear" placeholder="Manufacturing year" />
					<span class="errormsg" id="manufacturingyear_error"></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="quantity" class="control-label">Quantity</label>
					<input type="number" name="quantity"  class="form-control" id="quantity" placeholder="Quantity" />
				</div>
				<div class="col-md-6">
					<label for="price" class="control-label">Price</label>
					<input type="text" name="price"  class="form-control" id="price" placeholder="Price" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="registrationnumber" class="control-label">Registration Number</label>
					<input type="text" name="registrationnumber"  class="form-control" id="registrationnumber" placeholder="Registration number" />
				</div>
				<div class="col-md-6">
					<label for="note" class="control-label">Note</label>
					<textarea name="note" class="form-control" /></textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label for="image1" class="control-label">Image 1 (Onlye png,jpg,jpeg image allow)</label>
					<input type="file" name="image1"  class="form-control" id="image1" placeholder="image1" />
					<span class="errormsg" id="image1_error"></span>
				</div>
				<div class="col-md-6">
					<label for="image2" class="control-label">Image 2 (Onlye png,jpg,jpeg image allow)</label>
					<input type="file" name="image2"  class="form-control" id="image2" placeholder="image2" />
					<span class="errormsg" id="image2_error"></span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<button type="submit" class="btn btn-primary btn-block">Create</button>
				</div>
				<div class="col-md-6">
					<button type="reset" class="btn btn-primary btn-block">Reset</button>
				</div>
			</div>
		</div>
		
	</form>
    <div id="success_message" style="width:100%; height:100%; display:none; ">
        <h3>Inventory added successfully!</h3>
    </div>
    <div id="error_message"
    style="width:100%; height:100%; display:none; ">
        <h3>Error</h3>
        Sorry there was an error please try again.

    </div>
</div>

</div>

 </div>
</div>
</div>
<?php
 
// footer
include_once "footer.php";
?>