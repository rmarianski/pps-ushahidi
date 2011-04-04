<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="shortcut icon" href="/placemap/nyc-demo/favicon.ico">
   
    <link href='http://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
 <meta property="og:title" content="BY THE CITY / FOR THE CITY" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://pps.org/placemap/nyc-demo/" />
<meta property="og:image" content="http://pps.org/placemap/nyc-demo/themes/pps/images/btc-ftc.png" />
<meta property="og:site_name" content="" />
<meta property="fb:admins" content="753810374" />   
    
  <!--  <meta property="og:title" content="ShareThis Homepage" />
<meta property="og:type" content="Sharing Widgets" />
<meta property="og:url" content="http://urbandesignweek.org/bythecityforthecity/" />
<meta property="og:image" content="http://pps.org/placemap/nyc-demo/themes/pps/images/btc-ftc.png" />
<meta property="og:description" content="Sample copy" />
<meta property="og:site_name" content="BY THE CITY / FOR THE CITY" />-->
  <script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'247bd840-c484-4e7e-8df6-e3412a4fb36c'});</script>
   
   
   
   
</head>

<body id="page">
	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- header -->
		<div id="header">

			<!-- searchbox -->
			<div id="searchbox">
           <span class='st_twitter_button' displayText='Tweet' ></span><span class='st_email_button' displayText='Email'></span><span class='st_facebook_button' displayText='Facebook'></span><span class='st_sharethis_button' displayText='ShareThis'></span>
				<!-- languages -->
				<!--<?php echo $languages;?>-->
				<!-- / languages -->

				<!-- searchform -->
				<!--<?php echo $search; ?>-->
				<!-- / searchform -->

			</div> 
			<!-- / searchbox -->

			<!-- logo -->
			<div id="logo">
				<span><img src="/placemap/nyc-demo/themes/pps/images/btc-ftc.png"  />
				<?php echo $site_tagline; ?></span>
			</div>
			<!-- / logo -->
			
			<!-- submit incident -->
			<!--<?php echo $submit_btn; ?>-->
			<!-- / submit incident -->
			
		</div>
		<!-- / header -->

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">

				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul><?php nav::main_tabs($this_page); ?></ul>

				</div>
				<!-- / mainmenu -->
