<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $site_name; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="shortcut icon" href="/placemap/denver/favicon.ico">

   <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Cabin:regular,regularitalic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
<meta property="og:title" content="Power of Ten Ideas for Downtown San Antonio" />
<meta property="og:type" content="website" />
<?php if (!isset($og_description) OR !$og_description): ?>
<?php $og_description = "What do you like to do downtown? How would you change the city? Map Your Ideas to Re-Imagine the Heart of San Antonio."; ?>
<?php endif; ?>
<meta property="og:description" content="<?php echo $og_description; ?>" />
<meta property="og:url" content="<?php echo url::base() . url::current() ?>" /> 
<meta property="og:image" content="<?php echo url::site('themes/pps/images/logo.jpg'); ?>" />
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
           <span class='st_twitter_button' displayText='Tweet' st_url="http://pps.org/placemap/sanantonio/reports/submit" st_title="How can Downtown #SanAntonio become great? Share your #PowerOf10sa ideas now:"></span><span class='st_email_button' displayText='Email'></span><span class='st_facebook_button' displayText='Facebook'></span><span class='st_sharethis_button' displayText='ShareThis'></span><br /><iframe src="http://www.facebook.com/plugins/like.php?app_id=196983760348250&amp;href=http%3A%2F%2Fwww.pps.org%2Fplacemap%2Fsanantonio%2F&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:90px; padding-top:30px" allowTransparency="true"></iframe>
				<!-- languages -->
				<?php echo $languages;?>
				<!-- / languages -->

				<!-- searchform -->
				<!--<?php echo $search; ?>-->
				<!-- / searchform -->

			</div>
			<!-- / searchbox -->

			<!-- logo -->
			<div id="logo">
				<h1><?php echo $site_name; ?></h1>
				<h2><?php echo $site_tagline; ?></h2>
   </div><a href="<?php echo url::site('reports/submit'); ?>"><span><?php echo url::site('reports/submit'); ?></span></a>
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
					<ul><h1><?php nav::main_tabs($this_page); ?></h1></ul>

				</div>
				<!-- / mainmenu -->
