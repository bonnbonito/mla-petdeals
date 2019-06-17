<?php
/**
 * Template part for displaying dashboard Login Details
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>
<?php
	$current_user = wp_get_current_user();
?>
<form action="post" id="changeLoginDetails">
	<div class="group">
		<input type="text" name="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>EMAIL</label>
	</div>

	<div class="group">
		<input type="text" name="username" value="<?php echo esc_attr( $current_user->user_login ); ?>" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>USERNAME</label>
	</div>

	<div class="group">
		<input type="password" name="password1" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>CREATE NEW PASSWORD</label>
	</div>

	<div class="group">
		<input type="password" name="password2" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>CONFIRM NEW PASSWORD</label>
	</div>

	<button type="submit" class="yellow btn">Submit</button>
</form>
