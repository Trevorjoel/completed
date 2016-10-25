
<html>
<!-- This script concerns the processing of the marketplace_uploads.php form
	It sends the uploaded images to a file in the host directory and emails the text to the admins e-mail
	account
	ISSUES: 
	Does not gather and display all errors from all fields before displaying the error message and exiting
	script.
	Does not send email to uploader.
	Does not limit user to 10 images
	Does not display the filenames of ALL failed extention files only the first in the array.
	Does not show names of uploaded files in the confirmation message or email to user.
	Does not send names of the renamed image files to the admin.
	Does not return to form upon error, user must manually go back to form.
	Relies upon html5 required tag to ensure mandatory fields are not left blank 

-->
<head>

<title>other uploads</title>

<link rel="stylesheet" href="main.css">
<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<?php include 'header.php'; ?>
</head>


<body>
<br>
<br>
	<br>
<br>
	<article class="articleform">
<?php	



//assign variables
$first_name = $_POST ['first_name'];
$last_name = $_POST ['last_name'];
$email = $_POST ['email'];
$bus_name = $_POST ['bus_name'];
$describe = $_POST ['describe'];
$mission = $_POST ['mission'];
$achievements = $_POST ['achievements'];
$more = $_POST ['more'];
$links = $_POST ['links'];
$extra = $_POST ['extra'];

//recaptcha processing
$captcha = $_POST ['g-recaptcha-response'];
$first_name;
$email;
$captcha;
if (isset ( $_POST ['first_name'] )) {
	$first_name = $_POST ['first_name'];
	if (isset ( $_POST ['email'] )) {
		$email = $_POST ['email'];
	}

	if (isset ( $_POST ['g-recaptcha-response'] )) {
		$captcha = $_POST ['g-recaptcha-response'];
	}
	if (! $captcha) {
		echo "<img class='tst3' src='images/windowlicker.jpg' 
			><h1>Please fill out the the captcha form.</h1>";
		exit ();
	}else{
	}
}
$ip = $_SERVER ['REMOTE_ADDR'];
$secretKey = "6LdMTSETAAAAAGa9RS6XrJfgpOFHVIHLW7tluAFo";
$response = file_get_contents ( "https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip );

//sanitize input
$first_name = filter_input ( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
$last_name = filter_input ( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );
$email = filter_input ( INPUT_POST, 'email', FILTER_SANITIZE_EMAIL );
$bus_name = filter_input ( INPUT_POST, 'bus_name', FILTER_SANITIZE_STRING );
$describe = filter_input ( INPUT_POST, 'describe', FILTER_SANITIZE_STRING );
$mission = filter_input (INPUT_POST, 'mission', FILTER_SANITIZE_STRING);
$achievements = filter_input ( INPUT_POST, 'achievements', FILTER_SANITIZE_STRING );
$more = filter_input ( INPUT_POST, 'more', FILTER_SANITIZE_STRING );
$links = filter_input ( INPUT_POST, 'links', FILTER_SANITIZE_URL );
$extra = filter_input ( INPUT_POST, 'extra', FILTER_SANITIZE_STRING );

//Constructs messages using variables for e-mail and user confirmation message.
$msg = ("<br>" . "$first_name" . "<br>" . " $last_name" . "<br>" . " $email" . "<br>" . "  $bus_name " .
		"<br>" . "$describe" . "<br>" . "$mission". "<br>"." $achievements" ."<br>"."$more" ."<br>" . " $links" . "<br>" . " $extra" ."<br>");
$msg_mail = ("$first_name\n"  . " $last_name\n" . " $email\n" . "  $bus_name\n " .
		"$describe \n" ."$mission\n" . "$achievements\n" . "$more\n" ." $links\n" . " $extra\n");
//Admins email
$to = 'trevoofnorthcliffe@gmail.com';

//Process multiple image files
//ISSUES:Nesting many if/else statements
if ( empty ( $_FILES ['files'] ['name'] [0] )) {
echo "<p>You did not upload any images.<br><img class='tst3' src='images/windowlicker.jpg' 
			>Go back and select some images so that we may create a 
		nice looking article for you." . "<br><a style='cursor:pointer' onclick='history.go(-1);return true;' rel=nofollow'> 
			 		<img src='images/back_button_orange_1358241199.png'></a>";
exit ();
}

if (! empty ( $_FILES ['files'] ['name'] [0] )) {
	
	$files = $_FILES ['files'];
	$failed = array ();
	
	$allowed = array (
			'jpg',
			'jpeg',
			'png' 
	);
	
	foreach ( $files ['name'] as $position => $file_name ) {
		
		$file_tmp = $files ['tmp_name'] [$position];
		$file_size = $files ['size'] [$position];
		$file_error = $files ['error'] [$position];
		
		$file_ext = explode ( '.', $file_name );
		$file_ext = strtolower ( end ( $file_ext ) );
		
		if (in_array ( $file_ext, $allowed )) {
			
			if ($file_error === 0) {
				
				if ($file_size <= 2097152) {
					
					$file_name_new = uniqid ( '', true ) . $last_name . '.' . $file_ext;
					
					$file_destination = 'uploads/' . $file_name_new;
					
					if (move_uploaded_file ( $file_tmp, $file_destination )) {
						$uploaded [$position] = $file_destination;
					} else {
						$failed [$position] = "[{$file_name}] failed to upload.";
					}
				} else {
					$failed [$position] = "[{$file_name}] is too damn large.";
				}
			} else {
				$failed [$position] = "[{$file_name}] errored with code{$file_error}.";
			}
			//ISSUES: Does not indicate if more than one file extention fails to load
			//chooses first failed file, does not list subsequent failures.
		} else {
			
			
			echo "<img src='images/warning.png' WIDTH=100 HEIGHT=100 ></a><p style='color:red'>$file_name<br> file extention {$file_ext}, is not permitted!</p><p><br>Ensure you have <b> .jpg .jpeg .png </b>files only
					Please press the back button.<br>Your text will still be in the text boxes.</p>";
			
			echo ('<br>' . '<a style="cursor:pointer" onclick="history.go(-1);return true;" rel=nofollow”> <img src="images/back_button_orange_1358241199.png"></a>');
			exit ();
		}
	}
	//Checks to validate email and returns error or confirmation message
	if (! filter_var ( $email, FILTER_VALIDATE_EMAIL ) === false) {
		
		echo ("<p>" . "Hello,<br> " . "$first_name " . "$last_name" . "<br>" . " Your upload was a
				success!" . "<br>" . "Here is a copy of your message:" . "<b>$msg</b>");
	} 

	else {
		
		echo '<a href=><img src="images/warning.png" WIDTH=100 HEIGHT=100 ></a>' . "<p>" . "Hello,<br>" . " $first_name " . "$last_name<br>" . "<b>$email</b>" . " is not a valid email address. <br>
			Please press the back button and enter a valid email address.
			<br>Your text will still be in the text boxes.</p>'" . "</p>" . "<a style='cursor:pointer' onclick='history.go(-1);return true;' rel=nofollow'> 
			 		<img src='images/back_button_orange_1358241199.png'></a>');";
		exit ();
	}
	//needs code to specify what files have been uploaded
	if (! empty ( $uploaded )) {
		print ("Your image(s) have been uploaded") ;
	}
	
	if (! empty ( $failed )) {
		print_r ( $failed );
	}

}

//Sends e-mail to user but not to
//	ISSUE: Does not send to uploader
mail($to, $bus_name, $msg_mail, 'From: trevoofnorthcliffe@gmail.com')


?>
<div class="back"></div>
	</article>
</body>


</html>
