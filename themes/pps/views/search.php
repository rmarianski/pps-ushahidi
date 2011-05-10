<div id="content">
	<div class="content-bg">
		<!-- start search block -->
		<div class="big-block">
        <div class="search-box">
   <form method="get" action="<?php echo url::site('search'); ?>">
     <input id="ideas-search" type="text" name="k" value="Search" />
   </form>
</div>
			<h1>Search Results</h1>
			<div class="search_block">
				<?php echo $search_info; ?>
				<?php echo $search_results; ?>
			</div>
		</div>
		<!-- end search block -->
	</div>
</div>