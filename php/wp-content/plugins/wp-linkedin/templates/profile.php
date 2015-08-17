<div class="linkedin"><div class="profile"><?php
echo wp_linkedin_load_template('profile-header', array('profile' => $profile));

if (isset($profile->positions->values) &&
		is_array($profile->positions->values)) {
	echo wp_linkedin_load_template('profile-positions', array('profile' => $profile));
}

if (LI_DEBUG) {
	echo wp_linkedin_load_template('profile-debug', array('profile' => $profile));
}
?></div></div>
