<div id="search-by-idea">

<?php if ($no_query): ?>
<h2>No idea number specified</h2>
<?php else: ?>
<h2>Idea not found</h2>
<?php endif; ?>

<form method="get" action="<?php echo url::site('search/by_id'); ?>">
<input class="search-field" type="text" name="idea" value="<?php echo ($no_query ? "" : $_GET['idea']); ?>" />
<input type="submit" value="Go" />
</form>

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
