</div>
    <!-- /container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- date picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  
<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {
		
		load_data();
        function load_data()  
        {  
			var action = "load";  
			$.ajax({  
				 url:"action.php",  
				 method:"POST",  
				 data:{action:action},  
				 success:function(data)  
				 {  
					  $('#inventory_table').html(data);  
				 }  
			});  
         }
		   
		$('#manufacturingyear').datepicker({
			format: "mm/yyyy",
			autoclose: true,  
		});  
	
	// create inventory
		
		 $('#inventory_form').on('submit', function(event){  
                event.preventDefault();  
                var modelName = $('#modelname').val();
                var manufacturerID = $('#manufacturer_id').val();
				var manufacturingYear = $('#manufacturingyear').val();  
				var Color = $('#color').val();   
                var extensionImage1 = $('#image1').val().split('.').pop().toLowerCase();
				var extensionImage2 = $('#image2').val().split('.').pop().toLowerCase();
				var flag = true;
				$(".errormsg").html('');
				
				if(modelName == ''){
					$("#modelname_error").html("This field is required");
					flag = false;
				} else {
					$("#modelname_error").html("");
				}
				if(manufacturerID == ''){
					$("#manufacturerid_error").html("This field is required");
					flag = false;
				} else {
					$("#manufacturerid_error").html("");
				}
				if(Color == ''){
					$("#color_error").html("This field is required");
					flag = false;
				} else {
					$("#color_error").html("");
				}
				if(manufacturingYear == ''){
					$("#manufacturingyear_error").html("This field is required");
					flag = false;
				} else {
					$("#manufacturingyear_error").html("");
				}
				
                if(extensionImage1 != '')  
                {  
                     if(jQuery.inArray(extensionImage1, ['png','jpg','jpeg']) == -1)  
                     {  
                          $("#image1_error").html("Invalid image file ");
                          $('#image1').val('');  
                          flag = false;  
                     }  
                }
				
				if(extensionImage2 != '')  
                {  
                     if(jQuery.inArray(extensionImage2, ['png','jpg','jpeg']) == -1)  
                     {  
                          $("#image2_error").html("Invalid image file ");
                          $('#image2').val('');  
                          flage = false;  
                     }  
                }
                if(flag == true)  
                {  
                     $.ajax({  
                          url:"action.php",  
                          method:"POST",  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               $('#inventory_form')[0].reset(); 
								$('#inventoryModal').modal('toggle'); //or 
								$('#inventoryModal').modal('hide');
                               load_data();  
                          }  
                     })  
                }  
                else  
                {  
                     return false;
                }  
           }); 
		
		$(document).on('click', '.sold-object', function(){
		 
			var id = $(this).attr('sold-id');
			var totalCount = $(this).attr('total-count');

			var action = 'sold';
			bootbox.prompt({
				title: "Please enter sold count",
				inputType: 'number',
				callback: function (result) {
					if(result != ''){
						var remaincount = totalCount-result;
						$.ajax({  
                          url:"action.php",  
                          method:"POST",  
						  data:{action:action,id:id,remainingcount:remaincount},                           
                          success:function(data)  
                          {  
                               load_data();  
                          }  
                     })
					}
				}
			});
		 
			return false;
		});
		
		$(document).on('click', '.view-object', function(){
		 
			var id = $(this).attr('view-id');
			var action = 'view';
			$.ajax({  
				 url:"action.php",  
				 method:"POST",  
				 data:{action:action,id:id},  
				 success:function(data)  
				 {  
					  $('#view-inventory').html(data);
					  $('#viewInventoryModal').modal('show');
				 }  
			});
		});
		
	});
</script>
</body>
</html>