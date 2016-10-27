<h1>Freelance Theme Options</h1>
<?php
	$firstName = esc_attr( get_option('first_name'));
	$fullName = $firstName;
	$description = esc_attr( get_option('user_description'));
 ?>
<div class="freelance_sidebar_preview">
	<div class="freelance_sidebar">
		<h1 class="freelance_username"><?php print ($fullName) ?></h1>
		<h2 class="freelance_description"> <?php print($description) ?></h2>
		<div class="social_icon_wrapper">

		</div>
	</div>
</div>
<?php settings_errors(); ?>
<form method="post" action="options.php" class="general_settings_form">
	<?php settings_fields('freelance-settings-group'); ?>
	<?php do_settings_sections('freelance_lifestyle'); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btn-submit'); ?>
</form>
