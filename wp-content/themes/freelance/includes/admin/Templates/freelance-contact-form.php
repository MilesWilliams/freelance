<h1>Freelance Contact Form</h1>

<?php settings_errors(); ?>

<form method="post" action="options.php" class="freelance-general-form">
	<?php settings_fields('freelance-contact-options'); ?>
	<?php do_settings_sections('freelance_theme_contact'); ?>
	<?php submit_button(); ?>
</form>
