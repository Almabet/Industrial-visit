<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'admin/index.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php include('head.php'); ?>
<style>
  /* button.fbt1 {
    margin-left: 2%;
} */

button.fbt1 a {
  color: white;
}
</style>
<script>
        // Function to enable the buttons
        function enableButtons() {
            document.getElementById("staffRegistrationButton").removeAttribute("disabled");
            document.getElementById("studentRegistrationButton").removeAttribute("disabled");
        }

        // AJAX request to approve an event
        function approveEvent(userId) {
            if (confirm('Are you sure you want to approve this event?')) {
                // Send an AJAX request to eventlist.php to approve the event
                // ...

                // After successful approval, call enableButtons() to enable the buttons.
                enableButtons();
            }
        }

        // Event listeners to approve events and enable the buttons
        document.getElementById("staffRegistrationButton").addEventListener("click", function () {
            // Add code to handle staff registration form here
            alert("Staff Registration Form clicked");
        });

        document.getElementById("studentRegistrationButton").addEventListener("click", function () {
            // Add code to handle student registration form here
            alert("Student Registration Form clicked");
        });
    </script>
</head>
<body class="skin-blue sidebar-mini" >
<div class="wrapper" style="background:#ecf0f5;">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo WEB_ROOT; ?>" class="logo" style="background-color:red;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-lg"><b>SUMAGO</b> INFOTECH</span> </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:#dd0000;">
      <?php include('nav.php'); ?>
    </nav>
  </header>
 
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-left:-220px;">
      <h1> Book A Date For Industrial Visit  <small>and manage your events easily with the below calendar.</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calendar</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content" style="margin-left:-220px;" style="background-color:red">
      
	  <div class="row">
	  	<div class="col-md-12" >
		<?php include('messages.php'); ?>
		</div>
	  </div>
    
	  
	  <div class="row" >
	  	<?php
			require_once $content;	 
		?>
      </div>
      <?php
    // Connect to your database and fetch data from the "tbl_reservations" table
    // Replace the following code with your actual database connection and query
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'db_event_management';

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM tbl_reservations";
    $result = mysqli_query($conn, $query);

    // Check if any data is fetched with "status" set to "APPROVED"
    $approvedDataExists = false;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] === 'APPROVED' ) {
            $approvedDataExists = true;
            // echo  $row['uid'];
            break;
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="row" style="text-align: center; margin-top: 20px;">
        <a href="sta_reg.php" style="text-decoration: none;"><button class="btn btn-danger fbt1" id="staffRegistrationButton" <?php echo $approvedDataExists ? '' : 'disabled'; ?> >Staff Registration Form</button></a>
        <a href="stu_reg.php"><button class="btn btn-danger fbt1" id="studentRegistrationButton" <?php echo $approvedDataExists ? '' : 'disabled'; ?>>Student Registration Form</button></a>
    </div>

  
      <!-- /.row -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left:0px;">
		<?php include('footer.php'); ?>
	</footer>
</div>
<!-- ./wrapper -->

</body>
</html>
<!-- button#fbt1 {
    margin-left: 10%;
    margin-top: -60%;
} -->
