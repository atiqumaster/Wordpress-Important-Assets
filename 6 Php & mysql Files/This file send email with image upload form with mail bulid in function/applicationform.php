<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ihr professioneller Zahnarzt Wedding Mitte für kompetente Behandlungen, frühzeitige Vorsorge, nachhaltige Therapien und patientenfreundliche Lösungen">
    <meta name="Sinergia" content="Zahnarzt Wedding">
    <title>Zahnarztpraxis Wedding | Zahnästhetik</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- WebFonts core CSS -->
    <link href="css/fonts.css" rel="stylesheet">
    <link href="css/animsition.css" rel="stylesheet">
    <!-- Simple Line Icons -->
    <link href="MegaNavbar/assets/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet">
    <!-- OWL -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
    <!-- MegaNavbar-->
    <link rel="stylesheet" type="text/css" href="MegaNavbar/assets/css/MegaNavbar.min.css">
    <link rel="stylesheet" type="text/css" href="MegaNavbar/assets/css/skins/navbar-default.css">
    <link rel="stylesheet" type="text/css" href="MegaNavbar/assets/css/animation/animation.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Goole fonts -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300,600,700,800" rel="stylesheet" type="text/css"> -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body>
    <div class="animsition">
        <div class="wrapper">

            <?php include 'header.html'; ?>

	   <div class="container" id="applyform">
	
	         
			 <?php 

if(isset($_POST['submit'])) {
  

    $to = "attiqumasterrr@gmail.com";
    $fullname = $_POST['name'];
    $message = $_POST['message'];
    $from = $_POST['email'];
  

    $from_email         =$from;  //from mail, sender email address
    $recipient_email = 'attiqumasterrr@gmail.com'; 
    $tmp_name = $_FILES['attachment']['tmp_name']; 
    $name     = $_FILES['attachment']['name']; 
    $size     = $_FILES['attachment']['size']; 
    $type     = $_FILES['attachment']['type']; 
    $error     = $_FILES['attachment']['error']; 
    $handle = fopen($tmp_name, "r");
    $content = fread($handle, $size); 
    fclose($handle);                
    
    $encoded_content = chunk_split(base64_encode($content));
    $boundary = md5("random"); 
     
    $medium = 'Email:' .$from ."\n". ' First Name:' . $fullname."\n".'Message:'. $message;

    //header
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "From:".$from_email."\r\n"; 
    $headers .= "Reply-To: ".$reply_to_email."\r\n"; 
    $headers .= "Content-Type: multipart/mixed;"; 
    $headers .= "boundary = $boundary\r\n"; 

    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($medium));

    
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $type; name=".$name."\r\n";
    $body .="Content-Disposition: attachment; filename=".$name."\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
    $body .= $encoded_content; 




    if(mail($to , $fullname , $body , $headers)){
    
    echo "<h1>Mail Send Sucessfully</h1>";
    } else{
        echo "<h1>no send</h1>";
    }
   


}


?>


			 
			 
			 
		    <div class="formheading">
		     	<h2>Apply Now: </h2>
		    </div>
		<form   method="post"  action="<?=$_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
			<div class="mb-3 form_align_top">

			    <label for="formName" class="form-label" id="lablename">Full-Name  *</label>
			    <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Enter Full Name" required>
			  </div>
			  <div class="mb-3 form_align_top">
			    <label for="exampleInputEmail1" class="form-label" id="lableemail"> Email-Address  *</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email Address" required>
			  </div>
			  <div class="mb-3 form_align_top">
			  	<label for="exampleFormControlTextarea1" class="form-label" id="labletext"> Enter-Message </label>
			 	<textarea class="form-control" name="message" id="exampleFormControlTextarea1" placeholder="Your message here" rows="3"></textarea>
			  </div>
			  <div class="mb-3 form_align_top">
			  	<label for="formFile" class="form-label" id="lablefile">Upload-Your-Resume  *</label>
			  	<input class="form-control" name="attachment" type="file" id="formFile" required>
			  </div>

			  <input type="submit" name="submit" class="btn btn-primary" id="btnform" />
		</form>
	</div>

<<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>



 <div class="cta bg-blue-light">
                <div class="container-fluid">
                    <div class="row cta-1">
                    </div>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
        <!-- end: animatsion -->
    </div>
    <!-- end:Wrapper -->
    <!-- core JavaScript
         ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- jQuery REVOLUTION Slider  -->
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
<?php

?>
