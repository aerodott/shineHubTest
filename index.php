<?php

require_once __DIR__ . '/src/Dotun/Docusign/mainController.php';


function router($route="index",$data=[])
{


	$start = new mainController($data);
	//$start->createTemplate($data);
	$start->createEnvelope();

	if($route == "makeTemplate")
		$start->createTemplate($data); //data will be form submit data

	if($route == "sendEnvelope")
		$start->createEnvelope($data); //data will be templateId

	if($route == "doBoth"){
		$start->createEnvelope($start->createTemplate($data));
	}
}

router();

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>ShineHub</title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src="js.js"></script>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<link href="style.css" type="text/css" rel="stylesheet">

</head>

<body>
	
	<nav class="navbar navbar-default navbar-doublerow navbar-trans navbar-fixed-top">
  <!-- top nav -->
  <nav class="navbar navbar-top hidden-xs">
    <div class="container">
      <!-- left nav top -->
      <ul class="nav navbar-nav pull-left">
        <li><a href="#"><span class="glyphicon glyphicon-thumbs-up text-white"></span></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-globe text-white"></span></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-pushpin text-white"></span></a></li>
        <li><a href="#"><span class="text-white">QUESTIONS? CALL: <b>+2348178501899</b></span></a></li>
      </ul>
      <!-- right nav top -->
      <ul class="nav navbar-nav pull-right">
        <li><a href="https://shinehub.com.au/about.php" class="text-white">About Us</a></li>
        <li><a href="https://shinehub.com.au/about.php" class="text-white">Contact Us</a></li> 
      </ul>
    </div>
    <div class="dividline light-grey"></div>
  </nav>
  <!-- down nav -->
  <nav class="navbar navbar-down">
    <div class="container">
      <div class="flex-container">  
        <div class="navbar-header flex-item">
          <div class="navbar-brand" href="https://github.com/alphadsy">ShineHub</div>
        </div>
        <ul class="nav navbar-nav flex-item hidden-xs">
          <li><a href="https://shinehub.com.au">Unit Calculator</a></li>
          <li><a href="https://shinehub.com.au/products">Pricing</a></li> 
          <li><a href="http://testshinehub.herokuapp.com/">Quotes</a></li> 
        </ul>
        <ul class="nav navbar-nav flex-item hidden-xs pull-right">
          <li><a href="https://shinehub.com.au/products/" class="">FAQs</a></li> 
        </ul>
        <!-- dropdown only moblie -->
          <div class="dropdown visible-xs pull-right">
            <button class="btn btn-default dropdown-toggle " type="button" id="dropdownmenu" data-toggle="dropdown">
              <span class="glyphicon glyphicon-align-justify"></span> 
            </button>
            <ul class="dropdown-menu">
               	<li><a href="https://shinehub.com.au">Unit Calculator</a></li>
          		<li><a href="https://shinehub.com.au/products">Pricing</a></li> 
          		<li><a href="http://testshinehub.herokuapp.com/">Quotes</a></li> 
              <li role="separator" class="divider"></li>
              <li><a href="#">contact us</a></li>
            </ul>
          </div>
        </div>  
      </div>
    </nav>
  </nav> 
<!--bg img  -->
	
    <div class="image-container set-full-height" style="background-image: url('https://images.freeimages.com/images/large-previews/76c/solarpower-is-beautiful-part-2-1623758.jpg')">
	    <!--   Creative Tim Branding   -->
	    

		<!--  Made With Material Kit  -->
		<a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk" target="_blank">
			<div class="brand">SH</div>
			<div class="made-with">ShineHub <strong>Shining While Saving</strong></div>
		</a>

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!-- Wizard container -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <form action="" method="post">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Wanna Shine?
		                        	</h3>
									<h5>Shine Like a Star While Saving like a Bank</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#details" data-toggle="tab">Information</a></li>
			                            <li><a href="#captain" data-toggle="tab">Package Type</a></li>
			                            <li><a href="#description" data-toggle="tab">Extra Details</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Let's start with the basic details.</h4>
			                            	</div>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Your Email</label>
			                                          	<input name="email" type="text" class="form-control">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">attach_money_outline</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Monthly Bill</label>
			                                          	<input name="bill" type="text" class="form-control">
			                                        </div>
												</div>

		                                	</div>
		                                	<div class="col-sm-6">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">State</label>
	                                        		<select class="form-control" name="state">
														<option value="Capital Territory">Capital Territory</option>
														<option value="New South Wales">New South Wales</option>
														<option value="Northern Territory">Northern Territory</option>
														<option value="Queensland">Queensland</option>
														<option value="South Australia">South Australia</option>
														<option value="Tasmania">Tasmania</option>
														<option value="Victoria">Victoria</option>
														<option value="Western Australia">Western Australia</option>
		                                        	</select>
		                                    	</div>
												<div class="form-group label-floating">
		                                        	<label class="control-label">Street Address</label>
	                                        		<input name="address" type="text" class="form-control">
		                                    	</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="captain">
		                                <h4 class="info-text">What type of Package would you want? </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This is good if You need solar for a bungalow or a mini house.">
		                                                <input type="radio" name="job" value="family">
		                                                <div class="icon">
		                                                    <i class="material-icons">weekend</i>
		                                                </div>
		                                                <h6>Family</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this Your house is quite big, like a big duplex or mansion.">
		                                                <input type="radio" name="job" value="bighome">
		                                                <div class="icon">
		                                                    <i class="material-icons">home</i>
		                                                </div>
		                                                <h6>Big Home</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this option if you need a large setup or you are a group of houses.">
		                                                <input type="radio" name="job" value="business">
		                                                <div class="icon">
		                                                    <i class="material-icons">business</i>
		                                                </div>
		                                                <h6>Business</h6>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="description">
		                                <div class="row">
		                                    <h4 class="info-text"> Do you have a specific Request?</h4>
		                                    <div class="col-sm-6 col-sm-offset-1">
	                                    		<div class="form-group">
		                                            <label>Extras...</label>
		                                            <textarea class="form-control" placeholder="" rows="6" name="extra"></textarea>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-4">
		                                    	<div class="form-group">
		                                            <label class="control-label">Example</label>
		                                            <p class="description">"I will like a battery rack and I have a shed where I want the battery installed 'cos of the unique styling of my house which is..."</p>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

										<div class="footer-checkbox">
											<div class="col-sm-12">
											  <div class="checkbox">
												  <label>
													  <input type="checkbox" name="optionsCheckboxes">
												  </label>
												  Subscribe to our newsletter
											  </div>
										  </div>
										</div>
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
		</div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Shine with <i class="fa fa-heart heart"></i> from <a href="http://www.creative-tim.com" target="_blank">ShineHub</a>.
	        </div>
	    </div>
	</div>
</body>

</html>


