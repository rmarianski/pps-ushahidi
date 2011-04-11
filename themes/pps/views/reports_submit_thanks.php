
<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
			
			<!-- green-box -->
			<div class="green-box">
				<div class="thanks_msg">
                <h4><?php echo Kohana::lang('ui_main.reports_submit_new');?></h4>
				<p><?php echo Kohana::lang('ui_main.reports_submitted');?></p><br />
				<br />

				<p style="font-size:12px">More ways to participate:<br /><br />
					- You can also <a href="../reports/submit">add another</a> idea<br /><br />
                    - Comment on other New Yorkers' ideas, check out the <a href="../main">map</a> or  <a href="../reports">list</a> of everyone's suggestions. <br /><br /><br />In the meantime, you can help spread the word by:<br /><br />
                    - Sharing this via <span class='st_facebook_button' displayText='Facebook'></span> &  <span class='st_twitter_button' displayText='Tweet' st_url="http://ht.ly/4uAcb" st_title="I just shared my idea for improving NYC. What's yours? #btcftc"></span> to get your friends involved.<br /><br />
                    - Keeping up with updates & interesting trends on our <a href="http://urbandesignweek.tumblr.com/">Tumblr</a>.<br /><br />
                    - Emailing your idea once it's approved to friends & neighbors to get a debate going. <br /><br /><br />
                    Remember: the more public interest there is in your idea, the more likely it is to attract a designer's attention in the next phase!
</p>	
                
                <a href="<?php echo
					url::site().'reports' ?>"><?php echo Kohana::lang('ui_main.reports_return');?></a>
					<?php echo Kohana::lang('ui_main.feedback_reports');?>
					<?php 
					print form::open('http://feedback.ushahidi.com/fillsurvey.php?sid=2', array('target'=>'_blank'));
					print form::hidden('alert_code', $_SERVER['SERVER_NAME']);
					print "&nbsp;&nbsp;";
					/*print form::submit('button', Kohana::lang('ui_main.feedback'), ' class=btn_gray ');*/
					print form::close();
					?>
				</div>
			</div>
		</div>
		<!-- end block -->
	</div>
</div>