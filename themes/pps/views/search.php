<div id="content">
	<div class="content-bg">
		<!-- start search block -->
		<div class="big-block">
        <div class="search-box">
   <form method="get" action="<?php echo url::site('search'); ?>">
     <input class="search-field" type="text" name="k" value="<?php echo (isset($_GET['k']) ? $_GET['k'] : 'Search'); ?>" />
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

<script type="text/javascript">
(function($) {
$(document).ready(function() {
$('.search-field').each(function() {
  var text = $(this).val();
  $(this).focus(function() {
    if ($(this).val() === text) {
        $(this).val('');
    }
  })
  .blur(function() {
    if ($(this).val().length === 0) {
        $(this).val(text);
    }
  });
});
});
})(jQuery);
</script>
