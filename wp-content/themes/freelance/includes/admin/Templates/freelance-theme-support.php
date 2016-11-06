<h1>Freelance Theme Support</h1>

<?php settings_errors(); ?>

<form method="post" action="options.php" class="freelance-general-form">
	<?php settings_fields('freelance-theme-support-group'); ?>
	<?php do_settings_sections('freelance_settings_page'); ?>
	<?php submit_button(); ?>
</form>
