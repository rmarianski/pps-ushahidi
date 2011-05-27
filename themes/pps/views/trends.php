<?php
function display_feed_items($feed_data) {
  foreach ($feed_data as $feed) {
      $feed_date = date('c', strtotime($feed->item_date));
    ?>
      <div class="feed-item">
        <h3 class="feed-title"><?php echo $feed->item_title; ?></h3>
        <p><?php echo $feed->item_description; ?></p>
        <p class="date"><abbr class="timeago" title="<?php echo $feed_date; ?>"><?php echo $feed_date; ?></abbr></p>
      </div>
    <?php
    }
}
?>

<div class="feeds-container">

   <div id="feed-list">
     <?php display_feed_items($feed_list); ?>
   </div>

   <div id="feed-post">
     <?php display_feed_items($feed_post); ?>
   </div>

</div>

<script type="text/javascript" src="<?php echo url::site('media/js/jquery.timeago.js'); ?>"></script>
<script type="text/javascript">
(function($) {
  $(document).ready(function() {
    jQuery("abbr.timeago").timeago();
  });
})(jQuery);
</script>
