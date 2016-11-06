<h1>Freelance Theme Options</h1>
<?php
	settings_errors();
	
	$avatar = esc_attr( get_option('profile_picture'));
	$firstName = esc_attr( get_option('first_name'));
	$lastName = esc_attr( get_option('last_name'));
	$fullName = $firstName .' ' . $lastName;
	$description = esc_attr( get_option('user_description'));
 ?>
<div class="freelance-sidebar-preview">
	<div class="freelance-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php echo $avatar; ?>)">
			</div>
		</div>
		<h1 class="freelance-name"><?php print ($fullName) ?></h1>
		<p class="freelance-description"> <?php print($description) ?></p>
		<div class="icons-wrapper">

		</div>
	</div>
</div>

<form method="post" action="options.php" class="freelance-general-form">
	<?php settings_fields('freelance-settings-group'); ?>
	<?php do_settings_sections('freelance_lifestyle'); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btn-submit'); ?>
</form>
