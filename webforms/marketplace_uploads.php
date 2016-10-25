<html>

<header>
	<title>Marketplace Upload</title>
	<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="main.css">
	<script src='https://www.google.com/recaptcha/api.js'
		type="text/javascript"></script>
<?php // include 'header1.1.php';
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78511318-1', 'auto');
  ga('send', 'pageview');

</script>
	</header>
	
	<?php include 'sidebar_right.php'; ?>
	<br>
<br>
<br>
<br>
<h1 id="sub">Marketplace Uploads</h1>
.
<body>
	<!-- Marketplace form -->
	<article class="articleform">
		<h1 id="sub" style="font-size: 250%">Marketplace</h1>
		<p>Please read the instructions before filling out the form.</p>
		<form name="htmlform" method="post" action="<?php echo $_SERVER ['PHP_SELF'];?>"
			enctype="multipart/form-data">
			<div width="450px">

				<label for="first_name"><p>
						First Name * <br> <input name="first_name" maxlength="50"
							size="30" placeholder="What's up?" value="" required="required"
							type="text"> <br> <br> 
							<label for="last_name">Last Name *</label><br>
						<input style="float: left" name="last_name" maxlength="50"
							size="30" placeholder="What's up?" value="" required="required">
						<br> <br> <label for="email">Email Address *<br></label> <input
							name="email" maxlength="80" size="30" placeholder="What's up?"
							value="" required="required" type="text">
					</p>
					<p>

						<label for="bus_name">Name of your orginization:*<br></label> <input
							name="bus_name" placeholder="What's up?" value=""
							required="required" type="text"> <br> <br> 

							<label for="comments">Describe
							exactly you sell or do.</label><br>

						<textarea style="float: none;" name="describe" maxlength="10000"
							cols="68" rows="8" placeholder="What's up?" value=""
							required="required"></textarea>


						<br>
						<label for="comments"><br> <br>How long have you been doing it and
							how would you describe your philosophy or mission statement. What
							makes it unique?</label><br>

						<textarea data-gramm="" style="float: none;" name="mission"
							maxlength="10000" cols="68" rows="8" placeholder="What's up?"
							value="" required="required"></textarea>

						<br> <label for="comments"><br>Tell me something cool about
							yourself, services and achievements.</label>

						<textarea style="float: none;" name="achievements"
							maxlength="10000" cols="68" rows="8" placeholder="What's up?"
							value="" required="required"></textarea>


						<br> <label for="comments"><br>Anything else you would like to add
							about your business or product/ copy your self written article
							here.</label><br>

						<textarea data-gramm="" style="float: none;" name="more"
							maxlength="10000" cols="68" rows="8" placeholder="What's up?"
							value="" required="required"></textarea>

						<br> <label for="urls"><br>Copy your links here:</label> <br>
						<textarea style="float: none;" name="links" maxlength="10000"
							cols="68" rows="5" placeholder="What's up?"></textarea>


					</p>
					<div>
						<p>
							<label for="uploads"><br> <br>Upload your images. Only jpg, jpeg,
								png files accepted 2mb or smaller. Maximum 10 files:</label>
						</p>
						<input name="files[]" multiple type="file">

					</div>

					<div>
						<p>
							<label for="comments">Message to admin *</label> <br>

							<textarea data-gramm="" name="extra" maxlength="1000" cols="68"
								rows="10" placeholder="What's up?" value="" required="required"></textarea>

						</p>
					</div>


					<div colspan="2" style="text-align: center">
		  			<div class="g-recaptcha" data-sitekey="6LdMTSETAAAAANCTNvekuc8iitEvmEMWk4pK0hm7"></div>
			
						<input value="Submit" type="submit">
					</div> </label>
			</div>
		</form>
	</article>
</body>
<footer>
																																		<?php include 'footer.php';?>
  </footer>



</html>