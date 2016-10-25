

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Remove email</title>
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
<p>Select the email adresses to delete from the email list and click remove.</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
require_once('authorise.php');
//phpinfo();
require_once('convars.php');

$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
or die('error connecting to mysql server');
 
// Delete the customer rows (only if the form has been submitted)
  if (isset($_POST['submit'])) {
  	foreach ($_POST['todelete'] as $delete_id) {
      $query = "DELETE FROM email_list WHERE id = $delete_id";
      mysqli_query($dbc, $query)
        or die('Error querying database.');
  	 }
    
 	echo 'Customer(s) removed.<br />';
 }
$query = "SELECT * FROM email_list ORDER BY firstname ASC";
$result =  mysqli_query($dbc, $query);
 While ($row = mysqli_fetch_array($result)){
 	
echo '<input type="checkbox" value="' . $row['id'] . ' "name="todelete[]" />'; 


echo $row ['firstname'] . ' ';
echo $row ['lastname']. '<br>';
echo $row ['email']. '<br>';
echo '<br />'; 
}

mysqli_close($dbc);
?>
<input class="btn btn-primary" type="submit" name="submit" value="remove" />
</form>
</body>
</html>
