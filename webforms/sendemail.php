<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Send Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <style type="text/css" media="screen">	
.bd-example {
	    box-sizing: inherit
    position: relative;
    padding: 1rem;
    margin: 1rem -1rem 1rem 1rem;
    border: solid #f7f7f9;
    border-width: .2rem .2 .2;
    width: 600px;
}
</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>NEW FORM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
</head>
<body>
<div class="bd-example container-fluid ">
<p><strong>Private:</strong> For Administrators use ONLY<br />
  Write and send an email to mailing list members.</p>
  <?php
  require_once('authorise.php');
  require_once('convars.php');
  if (isset($_POST['submit'])) {
    $from = 'trecoofnorthcliffe@gmail.com';
    $subject = $_POST['subject'];
    $text = $_POST['text_body'];
    $output_form = false;

    if (empty($subject) && empty($text)) {
      // We know both $subject AND $text are blank 
      echo 'You forgot the email subject and body text.<br />';
      $output_form = true;
    }

    if (empty($subject) && (!empty($text))) {
      echo 'You forgot the email subject.<br />';
      $output_form = true;
    }

    if ((!empty($subject)) && empty($text)) {
      echo 'You forgot the email body text.<br />';
      $output_form = true;
    }
  }
  else {
    $output_form = true;

  }

  if ((!empty($subject)) && (!empty($text))) {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
      or die('Error connecting to MySQL server.');
 

    $query = "SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query)
      or die('Error querying database.');

    while ($row = mysqli_fetch_array($result)){
      $to = $row['email'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $msg = "Dear $firstname $lastname,\n$text";
      mail($to, $subject, $msg, 'From:' . $from);
      echo 'Email sent to: ' . $to . '<br />';
    } 

    mysqli_close($dbc);
  }

  if ($output_form) {
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="subject">Subject of email:</label><br>
    <input id="subject" name="subject" type="text" size="30" 
    value="<?php 
    if (
      isset($_POST['subject'])) echo $_POST['subject']; ?>" /><br />
    <label for="text_body">Body of email:</label><br>
    <textarea id="text_body" name="text_body" rows="8" cols="60"><?php if(isset($_POST['text_body']))echo $_POST['text_body']; ?></textarea><br /><br>
    <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php
  }
?>

	
</body>
</html>