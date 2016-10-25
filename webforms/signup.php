<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>sign up</title>
	<style type="text/css" media="screen">	
.bd-example {
	    box-sizing: inherit
    position: relative;
    padding: 1rem;
    margin: 1rem -1rem 1rem 1rem;
    border: solid #f7f7f9;
    border-width: .2rem .2 .2;
    width: 500px;
}
</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>NEW FORM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
</head>
<body>
<div class="bd-example container">
<p>Enter your first name, last name, and email to be added to the mailing list to recieve news about updates and new articles.</p>

<?php
require_once('convars.php');
$output_error = false;
$output_error_email = false;
$form_dissapear = false;
  if (isset($_POST['submit'])) {

		if (empty($_POST['firstname']) || empty($_POST['lastname']) ||empty($_POST['email'])){
			$output_error = true;
		}

		if ($output_error) {
			$form_dissapear = false;
			echo "<img class='tst3' src='images/whoops.png'><br><p class=S'danger' style='color:red;'>Please check the mandatory form fields marked with an *, you seem to be missing something.</p>";

		}else{
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
      ;
filter_input ( INPUT_POST, $_POST['firstname'], FILTER_SANITIZE_STRING );
			$firstname = mysqli_real_escape_string ($dbc, trim($_POST['firstname']));

 filter_input ( INPUT_POST, $_POST['lastname'], FILTER_SANITIZE_STRING );
			$lastname = mysqli_real_escape_string ($dbc, trim($_POST['lastname']));
			 filter_input ( INPUT_POST, $_POST['email'], FILTER_SANITIZE_EMAIL );
			$email = mysqli_real_escape_string ($dbc, trim($_POST['email']));


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$output_error_email = true;
			}

			
			if ($output_error_email) {
				$form_dissapear = false;
				echo  "<img class='img-thumbnail img-responsive' src='images/whoops.png'><br><p style='color:red;'>Hello, <br>$firstname $lastname<br><b>$email is not a valid email address. <br>";
			}else{

if (!empty($firstname) && !empty($lastname) && !empty($email)) {
	$form_dissapear = true;
	$query = "INSERT INTO email_list (firstname, lastname, email)  VALUES ('$firstname', '$lastname', '$email')";
    mysqli_query($dbc, $query);

    echo 'Customer added.';
     mysqli_close($dbc);

}
}
}
}
if ($form_dissapear)  {
		echo "Wikid";
		
		
	} else {
		?>
<hr>
  <form method="post" action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>">
  <div class="form-group row has-warning">
    <label for="firstname" class="col-xs-2 col-form-label">First name:</label>
<div class="col-xs-10">
    <input class="form-control form-control-warning" type="text" id="firstname" name="firstname" value="<?php  if (isset($_POST['firstname'])) echo strip_tags($_POST['firstname']); ?>"/><br />
    
    </div>
			</div>

<div class="form-group row has-warning">

    <label for="lastname" class="col-xs-2" >Last name:</label>
    <div class="col-xs-10">
    <input class="form-control form-control-warning" type="text" id="lastname" name="lastname" value="<?php  if (isset($_POST['lastname'])) echo strip_tags($_POST['lastname']); ?>"/><br />
</div>
			</div>

<div class="form-group row has-warning">
    <label for="email" class="col-xs-2">Email:</label>
    <div class="col-xs-10">
    <input class="form-control form-control-warning" type="text" id="email" name="email" placeholder="Required!"
							value="<?php  if (isset($_POST['email'])) echo strip_tags($_POST['email']); ?>"/><br />
    <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
  </form>
</div>
<?php
}


?>



</body>
</html>