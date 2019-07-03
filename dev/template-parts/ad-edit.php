<?php
/**
 * Template part for displaying edit form ad
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

global $current_user;
$ad_id           = sanitize_text_field( get_query_var( 'ad_id' ) );
$ad_author_id = get_post_field( 'post_author', $ad_id );
?>
<form action="#" class="form-ad pet-form" id="editadvert" autocomplete="off">
	<input type="hidden" name="action" value="petdeals_editad">
	<select name="advert_type" id="advert_type">
		<option value="sale">For Sale Only</option>
	</select>
	<select name="pet_type" id="pet_type">
		<option value="">PET TYPE (ANY) </option>
		<?php
		$pet_query = new WP_Query( array(
			'post_type'  => 'pet',
			'posts_per_page' => -1,
		));
		if ( $pet_query->have_posts() ) :
			while ( $pet_query->have_posts() ) :
				$pet_query->the_post();
				$postname = get_post_field( 'post_name', get_the_ID() );
				?>
				<option value="<?php echo esc_attr( $postname ); ?>" <?php echo ( isset( $ad_id ) && get_field( 'pet_type', $ad_id ) == $postname ? 'selected' : '' ); ?>><?php the_title(); ?></option>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</select>
	<select name="pet_breed" id="pet_breed">
		<option value="">PET BREED (ANY)</option>
		<?php
		$petname = get_field( 'pet_type', $ad_id );
		$pet_id = get_page_by_path( $petname, OBJECT, 'pet' )->ID;
		if ( have_rows( 'breeds', $pet_id ) ) :
			?>
			<?php
			while ( have_rows( 'breeds', $pet_id ) ) :
				the_row();
				?>
				<option value="<?php the_sub_field( 'breed' ); ?>" <?php echo ( get_sub_field( 'breed' ) == get_field( 'pet_breed', $ad_id ) ? 'selected' : '' ); ?>><?php the_sub_field( 'breed' ); ?></option>
				<?php
			endwhile;
		endif;

		?>
	</select>
	<div class="group">
		<input type="text" id="ad_title" name="ad_title" value="<?php echo esc_attr( get_the_title( $ad_id ) ); ?>" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>ADVERT TITLE</label>
	</div>
	<div class="group">
		<input type="text" id="datepicker" required value="<?php echo esc_attr( date( 'F d, Y', strtotime( get_field( 'date_of_birth', $ad_id ) ) ) ); ?>">
		<span class="highlight"></span>
		<span class="bar"></span>
		<label class="wspan">DATE OF BIRTH OF PET <span>(All puppies and kittens cannot be sold if they are aged less than 8 weeks.)</span></label>
	</div>
	<input type="hidden" name="pet_dob" id="pet_dob" value="<?php echo esc_attr( get_field( 'date_of_birth', $ad_id ) ); ?>">
	<div class="group price-group">
		<span class="currency">£</span>
		<input type="number" id="price" name="price" required value="<?php echo esc_attr( get_field( 'asking_price', $ad_id ) ); ?>">
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>ASKING PRICE</span></label>
	</div>
	<textarea id="description" cols="30" rows="10" name="description" placeholder="DESCRIPTION"><?php echo esc_textarea( get_field( 'description', $ad_id ) ); ?></textarea>
	<div class="ads-images">
	<p>Add Images:</p>
	<div class="ads-images-wrap">
		<div class="image-item">
			<a href="#" id="add-image-1-btn">
			<?php if ( get_field( 'image_1', $ad_id ) ) { ?>
				<img src="<?php echo esc_url( get_field( 'image_1', $ad_id )['url'] ); ?>" alt="">
			<?php } else { ?>
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			<?php } ?>
			</a>
			<input type="hidden" id="ad_image_1" name="ad_image_1" value="<?php echo esc_attr( get_field( 'image_1', $ad_id ) ? get_field( 'image_1', $ad_id )['ID'] : '' ); ?>">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-2-btn">
				<?php if ( get_field( 'image_2', $ad_id ) ) { ?>
					<img src="<?php echo esc_url( get_field( 'image_2', $ad_id )['url'] ); ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
				<?php } ?>
			</a>
			<input type="hidden" id="ad_image_2" name="ad_image_2" value="<?php echo esc_attr( get_field( 'image_2', $ad_id ) ? get_field( 'image_2', $ad_id )['ID'] : '' ); ?>">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-3-btn">
				<?php if ( get_field( 'image_3', $ad_id ) ) { ?>
					<img src="<?php echo esc_url( get_field( 'image_3', $ad_id )['url'] ); ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
				<?php } ?>
			</a>
			<input type="hidden" id="ad_image_3" name="ad_image_3" value="<?php echo esc_attr( get_field( 'image_3', $ad_id ) ? get_field( 'image_3', $ad_id )['ID'] : '' ); ?>">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-4-btn">
				<?php if ( get_field( 'image_4', $ad_id ) ) { ?>
					<img src="<?php echo esc_url( get_field( 'image_4', $ad_id )['url'] ); ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
				<?php } ?>
			</a>
			<input type="hidden" id="ad_image_4" name="ad_image_4" value="<?php echo esc_attr( get_field( 'image_4', $ad_id ) ? get_field( 'image_4', $ad_id )['ID'] : '' ); ?>">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-5-btn">
				<?php if ( get_field( 'image_5', $ad_id ) ) { ?>
					<img src="<?php echo esc_url( get_field( 'image_5', $ad_id )['url'] ); ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
				<?php } ?>
			</a>
			<input type="hidden" id="ad_image_5" name="ad_image_5" value="<?php echo esc_attr( get_field( 'image_5', $ad_id ) ? get_field( 'image_5', $ad_id )['ID'] : '' ); ?>">
		</div>
	</div>
	</div>
	<h3>CONTACT DETAILS</h3>
	<div class="two-col">
	<div class="col">
		<div class="group">
			<input type="text" id="seller_name" name="seller_name" required value="<?php echo esc_attr( get_field( 'seller_name', $ad_id ) ); ?>">
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>NAME</label>
		</div>
		<div class="group">
			<input type="text" id="seller_tel" name="seller_tel" required value="<?php echo esc_attr( get_field( 'seller_telephone', $ad_id ) ); ?>">
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>TELEPHONE</label>
		</div>
	</div>
	<div class="col">
		<div class="group">
			<input type="email" id="seller_email" placeholder="EMAIL" name="seller_email" required value="<?php echo esc_attr( get_field( 'seller_email', $ad_id ) ); ?>">
			<span class="highlight"></span>
			<span class="bar"></span>
			<label></label>
		</div>
		<div class="group">
			<input type="text" placeholder="" required name="address" id="autocomplete" value="<?php echo esc_attr( get_field( 'contact_details', $ad_id )['address'] ); ?>">
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>POSTCODE</label>
		</div>
	</div>
	</div>
	<input type="hidden" id="lat" name="lat" value="<?php echo esc_attr( get_field( 'contact_details', $ad_id )['lat'] ); ?>">
	<input type="hidden" id="lng" name="lng" value="<?php echo esc_attr( get_field( 'contact_details', $ad_id )['lng'] ); ?>">
	<div class="checklists">
		<div class="check-item">
			<div>
				<label for="microchipped">MICROCHIPPED?</label>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="microchipped" id="microchipped" value="1" <?php echo esc_attr( get_field( 'microchipped', $ad_id ) ? 'checked' : '' ); ?>>
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-item">
			<div>
				<label for="neutered">NEUTERED?</label>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="neutered" id="neutered" value="1" <?php echo esc_attr( '1' == get_field( 'neutered', $ad_id ) ? 'checked' : '' ); ?>>
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-item">
			<div>
				<label for="vacc-up-to-date">VACCINATIONS UP TO DATE?</label>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="vacc-up-to-date" id="vacc-up-to-date" value="1" <?php echo esc_attr( '1' == get_field( 'vaccinations_up_to_date', $ad_id ) ? 'checked' : '' ); ?>>
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-item">
			<div>
			    <?php if ( 'cats' != get_field( 'pet_type', $ad_id ) ) : ?>
				<label for="kc_registered">KC REGISTERED? <span style="color: red;">(Only valid for dogs)</span></label>
				<?php else : ?>
				<label for="kc_registered">REGISTERED?</label>
				<?php endif; ?>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="kc_registered" id="kc_registered" value="1" <?php echo esc_attr( '1' == get_field( 'kc_registered', $ad_id ) ? 'checked' : '' ); ?>>
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-privacy">
			<div class="check-container">
				<input type="checkbox" name="agree" required id="agree-privacy" value="1" <?php echo esc_attr( '1' == get_field( 'i_agree_to_the_terms_&_condition_and_privacy_policy', $ad_id ) ? 'checked' : '' ); ?>>
				<span class="checkmark"></span>
			</div>
			<label for="agree-privacy">I agree to the <a href="" target="_blank">Terms & Condition</a> and <a href="#" target="_blank">Privacy Policy</a></label>
		</div>
	</div>
	<input type="hidden" name="ad_id" value="<?php echo esc_attr( $ad_id ); ?>" id="ad_id">
	<?php wp_nonce_field( 'edit_advert' ); ?>
	<button type="submit" class="yellow btn large" id="submit-edit">EDIT ADVERT</button>
	<button class="red btn large" id="submit-delete" data-ad="<?php echo esc_attr( $ad_id ); ?>"><i class="fas fa-trash-alt"></i> DELETE ADVERT</button>


</form>

<script>
	var input = document.getElementById('autocomplete');
	var options = {
		types: ['geocode'],
		componentRestrictions: {country: "uk"}
	};
	var autocomplete = new google.maps.places.Autocomplete(input, options);
	autocomplete.addListener('place_changed', function() {
		var lat = autocomplete.getPlace().geometry.location.lat();
		var lang = autocomplete.getPlace().geometry.location.lng();
		var adr = autocomplete.getPlace().formatted_address;
		document.getElementById('lat').value = lat;
		document.getElementById('lng').value = lang;
	});
</script>
