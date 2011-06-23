<h2>
   <?php admin::settings_subtabs("nearby"); ?>
</h2>

<div style="padding: 10px">

<?php

echo form::open();
echo form::label("distance", "Distance (in feet)");
echo form::input("distance", $form["distance"]);
echo form::submit("save", "Save");
?>
<br />
<?php if (!empty($errors["distance"])): ?>
<span class="error"><?php echo $errors["distance"]; ?></span>
<?php endif; ?>

<?php
echo form::close();

?>

</div>
