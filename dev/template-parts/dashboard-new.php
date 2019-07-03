<?php
/**
 * Template part for displaying dashboard new
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

if ( petdeals_can_post_ad() ) :
	?>
<form action="#" class="form-ad pet-form" id="newadvert" autocomplete="off">
	<h3>You can post <?php echo esc_attr( petdeals_ads_left() ); ?> more ad/ads.</h3>
	<input type="hidden" name="action" value="petdeals_newad">
	<select name="advert_type" id="advert_type" required>
		<option value="sale">For Sale Only</option>
	</select>
	<select name="pet_type" id="pet_type">
		<option value="">PET TYPE (ANY)</option>
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
				<option value="<?php echo esc_attr( $postname ); ?>"><?php the_title(); ?></option>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</select>
	<select name="pet_breed" id="pet_breed">
		<option value="">PET BREED (ANY)</option>
	</select>
	<div class="group">
		<input type="text" id="ad_title" name="ad_title" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>ADVERT TITLE</label>
	</div>
	<div class="group">
		<input type="text" id="datepicker" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label class="wspan">DATE OF BIRTH OF PET<span class="required">*</span><span>(All puppies and kittens cannot be sold if they are aged less than 8 weeks.)</span></label>
	</div>
	<input type="hidden" name="pet_dob" id="pet_dob">
	<div class="group price-group">
		<span class="currency">£</span>
		<input type="number" id="price" name="price" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>ASKING PRICE<span class="required">*</span></label>
	</div>
	<textarea id="description" cols="30" rows="10" name="description" placeholder="DESCRIPTION" required></textarea>
	<div class="ads-images">
	<p>Add Images:</p>
	<div class="ads-images-wrap">
		<div class="image-item">
			<a href="#" id="add-image-1-btn">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			</a>
			<input type="hidden" id="ad_image_1" name="ad_image_1">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-2-btn">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			</a>
			<input type="hidden" id="ad_image_2" name="ad_image_2">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-3-btn">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			</a>
			<input type="hidden" id="ad_image_3" name="ad_image_3">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-4-btn">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			</a>
			<input type="hidden" id="ad_image_4" name="ad_image_4">
		</div>
		<div class="image-item">
			<a href="#" id="add-image-5-btn">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
			</a>
			<input type="hidden" id="ad_image_5" name="ad_image_5">
		</div>
	</div>
	</div>
	<h3>CONTACT DETAILS</h3>
	<div class="two-col">
	<div class="col">
		<div class="group">
			<input type="text" id="seller_name" name="seller_name" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>NAME<span class="required">*</span></label>
		</div>
		<div class="group">
			<input type="text" id="seller_tel" name="seller_tel" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>TELEPHONE<span class="required">*</span></label>
		</div>
	</div>
	<div class="col">
		<div class="group">
			<input type="email" id="seller_email" name="seller_email" required>
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>EMAIL<span class="required">*</span></label>
		</div>
		<div class="group">
			<input type="text" placeholder="" required name="address" id="autocomplete">
			<span class="highlight"></span>
			<span class="bar"></span>
			<label>POSTCODE<span class="required">*</span></label>
		</div>
	</div>
	</div>
	<input type="hidden" id="lat" name="lat">
	<input type="hidden" id="lng" name="lng">
	<div class="checklists">
		<div class="check-item">
			<div>
				<label for="microchipped">MICROCHIPPED?</label>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="microchipped" id="microchipped" value="1">
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
					<input type="checkbox" name="neutered" id="neutered" value="1">
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
					<input type="checkbox" name="vacc-up-to-date" id="vacc-up-to-date" value="1">
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-item">
			<div>
				<label for="kc_registered">KC REGISTERED? <span style="color: red;">(Only valid for dogs)</span></label>
			</div>
			<div>
				<div class="check-container">
					<input type="checkbox" name="kc_registered" id="kc_registered" value="1">
					<span class="checkmark"></span>
				</div>
			</div>
		</div>
		<div class="check-privacy">
			<div class="check-container">
				<input type="checkbox" name="agree" id="agree-privacy" value="1">
				<span class="checkmark"></span>
			</div>
			<label for="agree-privacy">I agree to the <a href="" target="_blank">Terms & Condition</a> and <a href="#" target="_blank">Privacy Policy</a></label>
		</div>
	</div>
	<?php wp_nonce_field( 'new_advert' ); ?>
	<button type="submit" class="yellow btn large" id="submit-ad">POST ADVERT</button>

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
<?php else : ?>
<h1>You cannot post ad anymore.</h1>
<?php endif; ?>
