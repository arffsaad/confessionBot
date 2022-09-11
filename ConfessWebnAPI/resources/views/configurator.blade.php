{{-- 
DISCLAIMER : I DO NOT OWN THIS HTML, IT IS A FORK OF CREATIVE TIM'S BOOTSTRAP WIZARD. 
I AM NOT A FRONTEND DEVELOPER, BUT MORE OF A BACKEND DEVELOPER. 
I AM NOT RESPONSIBLE FOR ANY ISSUES WITH THIS HTML.

Last but not least, credit to Creative Tim.
    --}}

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Configure Confession Bot</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

	<!-- CSS Files -->
    <link href={{ asset("assets/css/bootstrap.min.css")}} rel="stylesheet" />
	<link href={{ asset("assets/css/gsdk-bootstrap-wizard.css")}} rel="stylesheet" />

</head>

<body>
<div class="image-container set-full-height" style="background-image: url('assets/img/wizard.jpg')">
    <!--   Creative Tim Branding   -->

	<!--  Made With Get Shit Done Kit  -->
		<a href="http://demos.creative-tim.com/get-shit-done/index.html?ref=get-shit-done-bootstrap-wizard" class="made-with-mk">
			<div class="brand">GK</div>
			<div class="made-with">Made with <strong>GSDK</strong></div>
		</a>

    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="orange" id="wizardProfile">
                    <form action="" method="">
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                    	<div class="wizard-header">
                        	<h3>
                        	   <b>Configure</b> Confession Bot<br>
                        	   <small>Connect the system to your bot, and start using ConfessionBot!</small>
                        	</h3>
                    	</div>

						<div class="wizard-navigation">
							<ul>
	                            <li><a href="#about" data-toggle="tab" style="pointer-events: none">Bot Credentials</a></li>
	                            <li><a href="#account" data-toggle="tab" style="pointer-events: none">API Token</a></li>
	                            <li><a href="#address" data-toggle="tab"style="pointer-events: none">Complete!</a></li>
	                        </ul>

						</div>

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                              <div class="row">
                                  <h4 class="info-text">Please provide your bot's credentials</h4>
                                  <div class="col-sm-10 col-sm-offset-1">
                                    <form method="post" action="setBot" id="botCredForm">
                                      <div class="form-group">
                                          <label>Bot ID and Token <small>(required)</small></label>
                                          <input id="botToken" type="text" class="form-control" placeholder="123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11">
                                      </div>
                                  </div>
                                  <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Channel ID <small>(required)</small></label>
                                        <input id="channelID" type="text" class="form-control" placeholder="-13847189234">
                                    </div>
                                </form>
                                    <div id="statusIndicators">
                                    <span style="display:none" id="botConnectionGroup"><small id="botConnection">Connecting to Bot...</small> <span id="botIndicator"><i class="fa fa-spinner spinning" aria-hidden="true"></i></span> </span><br>
                                    <span style="display:none" id="channelConnectionGroup"><small id="channelConnection">Connecting to Channel</small> <span id="channelIndicator"><i class="fa fa-spinner spinning" aria-hidden="true"></i></span> </span>
                                    </div>
                                    <input type='button' class='btn btn-fill btn-warning btn-wd btn-sm' id='testCon' value='Test Connection' />
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="account">
                                <h4 class="info-text">Your API Token</h4>
                                <div class="row">
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <input id="botToken" type="text" class="form-control" value="{{$apitoken}}" disabled>
                                      </div>
                                      <input type='button' class='btn btn-fill btn-warning btn-wd btn-sm' id="copyToken" value='Copy API Token' />
                                  </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-4">
                                        <h1><i class='fa fa-check' aria-hidden='true'></i></h1>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-sm-12">
                                        <h4 class="info-text">Confession Bot has been setup! Press Finish to continue.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input id="nextBtn" type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' disabled/>
                                <form method="post" action="setBot">
                                    <input type="hidden" id="finalToken" name="finalToken" value="">
                                    <input type="hidden" id="finalChannel" name="finalChannel" value="">
                                    @csrf
                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />
                                
                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->

</div>

</body>

	<!--   Core JS Files   -->
	<script src={{ asset("assets/js/jquery-2.2.4.min.js")}} type="text/javascript"></script>
	<script src={{ asset("assets/js/bootstrap.min.js")}} type="text/javascript"></script>
	<script src={{ asset("assets/js/jquery.bootstrap.wizard.js")}} type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src={{ asset("assets/js/gsdk-bootstrap-wizard.js")}}></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src={{ asset("assets/js/jquery.validate.min.js")}}></script>

</html>
