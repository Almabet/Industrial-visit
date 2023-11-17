<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>views/eventform.css" rel="stylesheet" type="text/css" />

<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Request Form</b></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="<?php echo WEB_ROOT; ?>api/process.php?cmd=book" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="form-group" >
        <label for="exampleInputEmail1" >Name</label>
		<input type="hidden" name="userId" value=""  id="userId" />
        <span id="sprytf_name">
		<select name="name" class="form-control input-sm" >
			<option>--select user--</option>
			<?php
			// Check if the user is logged in
			if (isset($_SESSION['username'])) {
				$username = $_SESSION['username'];
			} else {
				// Redirect to the login page if the user is not logged in
				header("Location: login.php");
				exit();
			}
			?>
			<?php
			$sql = "SELECT id FROM tbl_users WHERE name = '$username'";
			$result = dbQuery($sql);
			while($row = dbFetchAssoc($result)) {
				if($username){
					extract($row);

				}
				
			?>
			<?php 
			}
			?>
			<option value="<?php echo $id; ?>"><?php echo $username; ?></option>
		</select>
		<!-- <span class="selectRequiredMsg">Name is required.</span> -->
		
		</span>
      </div>
	  
	  <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
		<span id="sprytf_address">
        <textarea name="address" class="form-control" placeholder="Address" id="address" rows=1></textarea>
		<span class="textareaRequiredMsg">Address is required.</span>
		<span class="textareaMinCharsMsg">Address must specify at least 10 characters.</span>	
		</span>
      </div>

	  <div class="form-group">
		<div class="row">
		<div class="col-xs-6">
        <label for="exampleInputEmail1">Phone</label>
		<span id="sprytf_phone">
        <input type="text" name="phone" class="form-control"  placeholder="Phone number" id="phone">
		<span class="textfieldRequiredMsg">Phone number is required.</span>
		</span>
		</div>
      
		<div class="col-xs-6">
        <label for="exampleInputEmail1">Email address</label>
		<span id="sprytf_email">
        <input type="text" name="email" class="form-control" placeholder="Enter email" id="email">
		<span class="textfieldRequiredMsg">Email ID is required.</span>
		<span class="textfieldInvalidFormatMsg">Please enter a valid email (user@domain.com).</span>
		</span>
		</div>
      </div>
	</div>
	  
      <div class="form-group">
      <div class="row">
      	<div class="col-xs-6">
			<label>Reservation Date</label>
			<span id="sprytf_rdate">
        	<input type="text" name="rdate" class="form-control" placeholder="YYYY-mm-dd">
			<span class="textfieldRequiredMsg">Date is required.</span>
			<span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
			</span>
        </div>
        <div class="col-xs-6">
			<label>Reservation Time</label>
			<span id="sprytf_rtime">
            <input type="text" name="rtime" class="form-control" placeholder="HH:mm">
			<span class="textfieldRequiredMsg">Time is required.</span>
			<span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
			</span>
       </div>
      </div>
	  </div>
				  
	  <div class="form-group">
        <label for="exampleInputPassword1">No of Peoples</label>
		<span id="sprytf_ucount">
        <input type="text" name="ucount" class="form-control" placeholder="No of peoples" >
		<span class="textfieldRequiredMsg">No of peoples is required.</span>
		<span class="textfieldInvalidFormatMsg">Invalid Format.</span>
      </div>

<!-- Added -->
	<div class="form-group">
		<div class="row">
		<div class="col-xs-4">
    <label for="exampleInputPassword1">College Name</label>
    <span id="sprytf_college_name">
        <input type="text" name="college_name" class="form-control" placeholder="College Name">
        <span class="textfieldRequiredMsg">College Name is required.</span>
        <!-- Add any other validation messages as needed -->
    </span>
	</div>
	

	<div class="col-xs-4">
		<label for="exampleInputPassword1">College Code</label>
		<span id="sprytf_college_code">
			<input type="text" name="college_code" class="form-control" placeholder="College Code">
			<span class="textfieldRequiredMsg">College Code is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
		</div>
	

		<div class="col-xs-4">
		<label for="exampleInputPassword1">Department</label>
		<span id="sprytf_department">
			<input type="text" name="department" class="form-control" placeholder="Department">
			<span class="textfieldRequiredMsg">Department is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
		</div>
	</div>
	</div>

	<div class="form-group">
		<div class="row">
		<div class="col-xs-4">
		<label for="exampleInputPassword1">Department Head</label>
		<span id="sprytf_department_head">
			<input type="text" name="department_head" class="form-control" placeholder="Department Head">
			<span class="textfieldRequiredMsg">Department Head is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
		</div>
	

		<div class="col-xs-8">
		<label for="exampleInputPassword1">Department Head Email</label>
		<span id="sprytf_department_head_email">
			<input type="text" name="department_head_email" class="form-control" placeholder="Department Head Email">
			<span class="textfieldRequiredMsg">Department Head Email is required.</span>
			<span class="textfieldInvalidFormatMsg">Please enter a valid email (user@domain.com).</span>
		</span>
		</div>
	</div>
	</div>

	<div class="form-group">
		<div class="row">
		<div class="col-xs-6">
		<label for="exampleInputPassword1">WhatsApp Number</label>
		<span id="sprytf_whatsapp_number">
			<input type="text" name="whatsapp_number" class="form-control" placeholder="WhatsApp Number">
			<span class="textfieldRequiredMsg">WhatsApp Number is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
		</div>
	
		<div class="col-xs-6">
		<label for="exampleInputPassword1">Academic Year of Student</label>
		<span id="sprytf_academic_year">
			<input type="text" name="academic_year" class="form-control" placeholder="Academic Year of Student">
			<span class="textfieldRequiredMsg">Academic Year is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
		</div>
	</div>
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Upload Permission Letter</label>
		<span id="sprytf_permission_letter">
			<input type="file" name="permission_letter" class="form-control">
			<span class="fileRequiredMsg">Permission Letter is required.</span>
			<!-- Add any other validation messages as needed -->
		</span>
	
	</div>

    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-danger" style="width:100%">Submit</button>
    </div>
  </form>
</div>
<!-- /.box -->
<script type="text/javascript">
<!--
// var sprytf_name 	= new Spry.Widget.ValidationSelect("sprytf_name");
var sprytf_address 	= new Spry.Widget.ValidationTextarea("sprytf_address", {minChars:6, isRequired:true, validateOn:["blur", "change"]});
var sprytf_phone 	= new Spry.Widget.ValidationTextField("sprytf_phone", 'integer', {validateOn:["blur", "change"]});
var sprytf_mail 	= new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
var sprytf_rdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_rtime 	= new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {hint:"i.e 20:10", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_ucount 	= new Spry.Widget.ValidationTextField("sprytf_ucount", "integer", {validateOn:["blur", "change"]});

var sprytf_college_name = new Spry.Widget.ValidationTextField("sprytf_college_name", 'none', {validateOn:["blur", "change"]});
var sprytf_college_code = new Spry.Widget.ValidationTextField("sprytf_college_code", 'none', {validateOn:["blur", "change"]});
var sprytf_department = new Spry.Widget.ValidationTextField("sprytf_department", 'none', {validateOn:["blur", "change"]});
var sprytf_department_head = new Spry.Widget.ValidationTextField("sprytf_department_head", 'none', {validateOn:["blur", "change"]});
var sprytf_department_head_email = new Spry.Widget.ValidationTextField("sprytf_department_head_email", 'email', {validateOn:["blur", "change"]});
var sprytf_whatsapp_number = new Spry.Widget.ValidationTextField("sprytf_whatsapp_number", 'none', {validateOn:["blur", "change"]});
var sprytf_academic_year = new Spry.Widget.ValidationTextField("sprytf_academic_year", 'none', {validateOn:["blur", "change"]});
var sprytf_permission_letter = new Spry.Widget.ValidationTextField("sprytf_permission_letter", 'none', {validateOn:["blur", "change"]});


</script>

<script type="text/javascript">
$('select').on('change', function() {
	//alert( this.value );
	var id = this.value;
	$.get('<?php echo WEB_ROOT. 'api/process.php?cmd=user&userId=' ?>'+id, function(data, status){
		var obj = $.parseJSON(data);
		$('#userId').val(obj.user_id);
		$('#email').val(obj.email);
		$('#address').val(obj.address);
		$('#phone').val(obj.phone_no);

		$('#college_name').val(obj.college_name);
        $('#college_code').val(obj.college_code);
        $('#department').val(obj.department);
        $('#department_head').val(obj.department_head);
        $('#department_head_email').val(obj.department_head_email);
        $('#whatsapp_number').val(obj.whatsapp_number);
        $('#academic_year').val(obj.academic_year);
	});
	
})
</script>