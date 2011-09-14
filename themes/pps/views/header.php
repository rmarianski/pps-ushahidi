<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="shortcut icon" href="/by-the-city/favicon.ico">

    <link href='http://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
<meta property="og:title" content="<?php echo Kohana::config('pps.og_title'); ?>" />
<meta property="og:type" content="website" />
<?php if (!isset($og_description) OR !$og_description): ?>
<?php $og_description = "Calling all Designers: New Yorkers shared their ideas about making the city's public realm smarter, more beautiful, and accessible, and now it's your turn to respond! The By the City / For the City design competition will be open now through midnight on Thursday, July 14th!"; ?>
<?php endif; ?>
<meta property="og:description" content="<?php echo $og_description; ?>" />
<meta property="og:url" content="<?php echo url::base() . url::current() ?>" /> 
<meta property="og:image" content="<?php echo url::site('themes/pps/images/btc-ftc.png'); ?>" />
<meta property="og:site_name" content="<?php echo $site_name; ?>" />
<meta property="fb:admins" content="<?php echo Kohana::config('pps.fb_admins'); ?>" />


  <script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'247bd840-c484-4e7e-8df6-e3412a4fb36c'});</script>
</head>

<body id="page">
	<!-- wrapper -->
	<div class="rapidxwpr floatholder">

		<!-- header -->
		<div id="header">

			<!-- searchbox -->
			<div id="searchbox">
           <span class='st_twitter_button' displayText='Tweet' st_url="http://ht.ly/4uAcb" st_title="Calling all Designers: #ByTheCity / For the City design competition challenges YOU to address New Yorkers' top concerns: http://ht.ly/58GFp"></span><span class='st_facebook_button' displayText='Facebook'></span><span class='st_email_button' displayText='Email'></span><span class='st_sharethis_button' displayText='ShareThis'></span>
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
				<span><img src="<?php echo url::site('themes/pps/images/btc-ftc.png'); ?>" />
				<?php echo $site_tagline; ?></span>
                        </div>
			<!-- / logo -->
                        <a id="starburst"
                           href="http://ifud.submishmash.com/Submit/5458/Account"
                           ><?php echo $site_tagline; ?></a>

                        <a href="http://ifud.submishmash.com/Submit/5458/Account"
                           ><img class="cta" src="<?php echo url::site('themes/pps/images/cta.png'); ?>" /></a>

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
