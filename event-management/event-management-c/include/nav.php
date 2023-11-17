<!-- Sidebar toggle button-->

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


<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
  	<li class="dropdown user user-menu"> 
		<a> 
		<span class="hidden-xs"></i>Welcome, <?php echo $username; ?></span> 
		</a>
	</li>
    <li class="dropdown user user-menu"> 
	<a href="loginForm.php"> 
	<span class="hidden-xs"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Log Out</span> 
	</a>
    </li>
  </ul>
</div>
