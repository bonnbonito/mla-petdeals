<?php
/**
 * Template part for displaying results in search pet page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mlapetdeals
 */

?>

<div class="header-dog-imgs">
	<div class="container">
		<?php the_title( '<h2 class="title-head">', '</h2>' ); ?>
	</div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php wp_print_styles( array( 'mlapetdeals-responsive-slider' ) ); ?>
	<div class="search-wrap">
		<div class="container">
			<div class="search-grid">
				<div class="show-search" id="show-search">
					<button><i class="fas fa-bars"></i> SEARCH</button>
				</div>
				<div class="search-left">
					<?php
					if ( isset( $_GET['pet_type'] ) && ! empty( $_GET['pet_type'] ) ) {
						$pet_type = sanitize_text_field( wp_unslash( $_GET['pet_type'] ) );
					}
					if ( isset( $_GET['pet_breed'] ) && ! empty( $_GET['pet_breed'] ) ) {
						$pet_breed = sanitize_text_field( wp_unslash( $_GET['pet_breed'] ) );
					}
					if ( isset( $_GET['advert_type'] ) && ! empty( $_GET['advert_type'] ) ) {
						$advert_type = sanitize_text_field( wp_unslash( $_GET['advert_type'] ) );
					}
					if ( isset( $_GET['distance'] ) && ! empty( $_GET['distance'] ) ) {
						$proximity = sanitize_text_field( wp_unslash( $_GET['distance'] ) );
					}
					if ( isset( $_GET['origin'] ) && ! empty( $_GET['origin'] ) ) {
						$origin = sanitize_text_field( wp_unslash( $_GET['origin'] ) );
					}
					if ( isset( $_GET['minprice'] ) && ! empty( $_GET['minprice'] ) ) {
						$minprice = sanitize_text_field( wp_unslash( $_GET['minprice'] ) );
					}
					if ( isset( $_GET['maxprice'] ) && ! empty( $_GET['maxprice'] ) ) {
						$maxprice = sanitize_text_field( wp_unslash( $_GET['maxprice'] ) );
					}
					$paged = 10;
					if ( isset( $_GET['results'] ) && ! empty( $_GET['results'] ) ) {
						$paged = sanitize_text_field( wp_unslash( $_GET['results'] ) );
					}
					if ( isset( $_GET['keywords'] ) && ! empty( $_GET['keywords'] ) ) {
						$keywords = sanitize_text_field( wp_unslash( $_GET['keywords'] ) );
					}
					if ( isset( $_GET['sort'] ) && ! empty( $_GET['sort'] ) ) {
						$sort = sanitize_text_field( wp_unslash( $_GET['sort'] ) );
					}
					$perpage = 10;
					if ( isset( $_GET['results'] ) ) {
						$perpage = sanitize_text_field( wp_unslash( $_GET['results'] ) );
					}
					?>
					<form action="" id="petsearch">
						<div class="form-group">
							<label for="pet_type">Pet Type</label>
							<select name="pet_type" id="pet_type">
								<option value="">Pet Type (Any)</option>
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
										<option value="<?php echo esc_attr( $postname ); ?>" <?php echo ( isset( $pet_type ) && $postname == $pet_type ? 'selected' : '' ); ?>><?php the_title(); ?></option>
										<?php
									endwhile;
									wp_reset_postdata();
								endif;
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="pet_breed">Pet Breed</label>
							<select name="pet_breed" id="pet_breed">
								<option value="">Pet Breed (Any)</option>
								<?php
								$pet_id = get_page_by_path( $pet_type, OBJECT, 'pet' )->ID;
								if ( have_rows( 'breeds', $pet_id ) ) :
									?>
									<?php
									while ( have_rows( 'breeds', $pet_id ) ) :
										the_row();
										?>
										<option value="<?php the_sub_field( 'breed' ); ?>" <?php echo ( isset( $pet_breed ) && get_sub_field( 'breed' ) == $pet_breed ? 'selected' : '' ); ?>><?php the_sub_field( 'breed' ); ?></option>
										<?php
									endwhile;
								endif;
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="advert_type">Advert Type</label>
							<select name="advert_type" id="advert_type">
								<option value="">Advert Type (Any)</option>
								<option value="sell" <?php echo( isset( $advert_type ) && 'sell' === $advert_type ? 'selected' : '' ); ?>>Sell</option>
							</select>
						</div>

						<div class="form-group">
							<label for="Location">Location</label>
							<input type="text" id="location" name="origin" value="<?php echo ( isset( $origin ) ? esc_attr( $origin ) : '' ); ?>">
							<input type="hidden" id="lat">
							<input type="hidden" id="lng">
						</div>

						<div class="form-group">
							<label for="distance">Distance</label>
							<br>
							<div class="slider-labels">
							<div>1 Mile</div>
							<div>
							<input type="text" readonly="readonly" id="distance-disp" style="border:0px;text-align:center;padding:0px;background-color:rgba(0, 0, 0, 0);width:100%;font-size:12px;font-style:italic;margin-top:0px;font-weight:bold;">
							</div>
							<div>National</div>
							</div>
							<div id="slider-distance"></div>
							<input type="hidden" name="distance" id="distance" value="<?php echo ( isset( $proximity ) ? esc_attr( $proximity ) : '' ); ?>">
						</div>

						<div class="form-group">
							<label for="distance">Price</label>
							<br>
							<div class="slider-labels">
							<div>£0</div>
							<div>
							<input type="text" readonly="readonly" id="amount" style="border:0px;text-align:center;padding:0px;background-color:rgba(0, 0, 0, 0);width:100%;font-size:12px;font-style:italic;margin-top:0px;font-weight:bold;">
							</div>
							<div>£1000+</div>
							</div>
							<div id="slider-price"></div>
							<input type="hidden" name="minprice" id="minprice" value="<?php echo ( isset( $minprice ) ? esc_attr( $minprice ) : '100' ); ?>">
							<input type="hidden" name="maxprice" id="maxprice" value="<?php echo ( isset( $maxprice ) ? esc_attr( $maxprice ) : '1000' ); ?>">
						</div>

						<div class="form-group">
							<label for="keywords">Keywords</label>
							<input type="text" id="keywords" name="keywords" value="<?php echo ( isset( $keywords ) ? esc_attr( $keywords ) : '' ); ?>">
						</div>

						<div class="form-group">
							<label for="results">Results Per Page</label>
							<select name="results" id="results">
								<option value="10" <?php echo ( isset( $paged ) && '10' == $paged ? 'selected' : '' ); ?>>10</option>
								<option value="20" <?php echo ( isset( $paged ) && '20' == $paged ? 'selected' : '' ); ?>>20</option>
							</select>
						</div>

						<input type="hidden" id="sortvalue" name="sort">

						<button type="submit" class="yellow btn fluid">Update Search</button>
					</form>
				</div>
				<div class="search-right">
					<?php
					$page = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					$args        = array(
						'post_type'      => 'ad',
						'posts_per_page' => $perpage,
						'paged'          => $page,
						'post_status'    => 'publish',
						'meta_query'     => array(
							'relation' => 'AND',
						),
					);

					if ( isset( $origin ) && $proximity < 200 ) {

						$origin_coords     = petdeals_get_lat_and_lng( $origin );
						$lat1              = $origin_coords['lat'];
						$lng1              = $origin_coords['lng'];
						$args['geo_query'] = array(
							'lat_field' => 'pet_lat',  // this is the name of the meta field storing latitude.
							'lng_field' => 'pet_lng', // this is the name of the meta field storing longitude.
							'latitude'  => $lat1, // this is the latitude of the point we are getting distance from.
							'longitude' => $lng1, // this is the longitude of the point we are getting distance from.
							'distance'  => $proximity, // this is the maximum distance to search.
							'units'     => 'miles',
						);
					}

					if ( isset( $pet_type ) ) {
						$args['meta_query'][] = array(
							'key'     => 'pet_type',
							'value'   => $pet_type,
							'compare' => '=',
						);
					}

					if ( isset( $pet_breed ) ) {
						$args['meta_query'][] = array(
							'key'     => 'pet_breed',
							'value'   => $pet_breed,
							'compare' => '=',
						);
					}

					if ( isset( $maxprice ) || isset( $minprice ) ) {

						if ( 1000 == $maxprice && 0 == $minprice ) {
							$args['meta_query'][] = array();
						} elseif ( 1000 == $maxprice ) {
							$args['meta_query'][] = array(
								'key'     => 'asking_price',
								'value'   => $minprice,
								'compare' => '>',
								'type'    => 'NUMERIC',
							);
						} elseif ( 0 == $minprice ) {
							$args['meta_query'][] = array(
								'key'     => 'asking_price',
								'value'   => $maxprice,
								'compare' => '<',
								'type'    => 'NUMERIC',
							);
						} else {
							$args['meta_query'][] = array(
								'key'     => 'asking_price',
								'value'   => array( $minprice, $maxprice ),
								'compare' => 'BETWEEN',
								'type'    => 'NUMERIC',
							);
						}
					}

					if ( isset( $keywords ) ) {
						$args['s'] = $keywords;
					}

					if ( isset( $sort ) ) {
						switch ( $sort ) {
							case 'datenew':
								$args['orderby'] = 'modified';
								$args['order']   = 'DESC';
								break;
							case 'dateold':
								$args['orderby'] = 'modified';
								$args['order']   = 'ASC';
								break;
							case 'creatednew':
								$args['orderby'] = 'ID';
								$args['order']   = 'DESC';
								break;
							case 'creatednew':
								$args['orderby'] = 'ID';
								$args['order']   = 'DESC';
								break;
							case 'createdold':
								$args['orderby'] = 'ID';
								$args['order']   = 'ASC';
								break;
							case 'pricelow':
								$args['meta_key'] = 'asking_price';
								$args['orderby']  = 'meta_value_num';
								$args['order']    = 'ASC';
								break;
							case 'pricehigh':
								$args['meta_key'] = 'asking_price';
								$args['orderby']  = 'meta_value_num';
								$args['order']    = 'DESC';
								break;
							default:
								$args['orderby']  = 'distance';
								$args['order']    = 'ASC';
						}
					}

					$ads_query = new WP_Query( $args );
					if ( $ads_query->have_posts() ) {
						?>
					<div class="page-sort">
						<?php echo esc_html( $ads_query->found_posts ); ?> results found.
					<div class="sort-select">
						<select name="sort" id="sort">
						<option value="">Sort By</option>
						<option value="datenew" <?php echo( isset( $sort ) && 'datenew' === $sort ? 'selected' : '' ); ?>>Date Updated (Newest)</option>
						<option value="dateold" <?php echo( isset( $sort ) && 'dateold' === $sort ? 'selected' : '' ); ?>>Date Updated (Oldest)</option>
						<option value="creatednew" <?php echo( isset( $sort ) && 'creatednew' === $sort ? 'selected' : '' ); ?>>Date Created (Newest)</option>
						<option value="createdold" <?php echo( isset( $sort ) && 'createdold' === $sort ? 'selected' : '' ); ?>>Date Created (Oldest)</option>
						<option value="pricelow" <?php echo( isset( $sort ) && 'pricelow' === $sort ? 'selected' : '' ); ?>>Price (Lowest)</option>
						<option value="pricehigh" <?php echo( isset( $sort ) && 'pricehigh' === $sort ? 'selected' : '' ); ?>>Price (Highest)</option>
						<?php if ( $origin && $proximity < 200 ) { ?>
						<option value="distance" <?php echo( isset( $sort ) && 'distance' === $sort ? 'selected' : '' ); ?>>Distance</option>
						<?php } ?>
						</select>
					</div>
					</div>
					<div class="pet-lists">
						<?php
						while ( $ads_query->have_posts() ) {
								$ads_query->the_post();
								$address = get_field( 'contact_details' );
							?>
							<div class="pet-item">
								<div class="pet_img">
									<a href="<?php the_permalink(); ?>">
									 <img src="<?php echo esc_url( get_field( 'image_1' )['url'] ); ?>" alt="<?php the_title(); ?> Image" />
									</a>
								</div>
								<div class="pet_details">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

									<?php if ( isset( $origin ) && $proximity < 200 ) { ?>
									<p>Distance: <?php echo esc_html( round( petdeals_get_distance( $origin, $address['lat'], $address['lng'] ), 2 ) ); ?> Miles</p>
									<?php } ?>

									<div class="pet_description">
										<?php the_field( 'description' ); ?>
									</div>

									<p class="location">LOCATION: <?php echo esc_html( get_field( 'contact_details' )['address'] ); ?></p>

									<h3>£<?php the_field( 'asking_price' ); ?></h3>
								</div>

							</div>

							<hr>
							<?php
						}
						?>
						<div class="pagination">
						<?php
						$pagearr = array();
						if ( isset( $pet_type ) ) {
							$pagearr['pet_type'] = get_query_var( 'pet_type' );
						}
						if ( isset( $pet_breed ) ) {
							$pagearr['pet_breed'] = get_query_var( 'pet_breed' );
						}
						if ( isset( $advert_type ) ) {
							$pagearr['advert_type'] = get_query_var( 'advert_type' );
						}
						if ( isset( $proximity ) ) {
							$pagearr['distance'] = get_query_var( 'distance' );
						}
						if ( isset( $origin ) ) {
							$pagearr['origin'] = get_query_var( 'origin' );
						}
						if ( isset( $minprice ) ) {
							$pagearr['minprice'] = get_query_var( 'minprice' );
						}
						if ( isset( $maxprice ) ) {
							$pagearr['maxprice'] = get_query_var( 'maxprice' );
						}
						if ( $paged ) {
							$pagearr['results'] = get_query_var( 'results' );
						}
						if ( isset( $keywords ) ) {
							$pagearr['keywords'] = get_query_var( 'keywords' );
						}
						if ( isset( $sort ) ) {
							$pagearr['sort'] = get_query_var( 'sort' );
						}
						echo paginate_links( array(
							'base'     => preg_replace( '/\?.*/', '', get_pagenum_link( 1 ) ) . '%_%',
							'current'  => max( 1, get_query_var( 'paged' ) ),
							'format'   => '?paged=%#%',
							'total'    => $ads_query->max_num_pages,
							'add_args' => $pagearr,
						));
						?>
						</div>
					</div>
						<?php
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
		</div>
	</div>



	<footer class="entry-footer">
		<?php
			mlapetdeals_edit_post_link();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<script>
jQuery( document ).ready( function( $ ) {
	$( "#distance-disp" ).val("<?php echo ( isset( $proximity ) ? esc_attr( $proximity ) . ' Miles' : 'National' ); ?> ");
	$( "#distance" ).val(<?php echo ( isset( $proximity ) ? esc_attr( $proximity ) : '30' ); ?>);
	$( "#slider-distance" ).slider({
	range: "min",
	min: 1,
	max: 200,
	step: 1,
	value: <?php echo ( isset( $proximity ) ? esc_attr( $proximity ) : '200' ); ?>,
	slide: function( event, ui ) {
				switch(ui.value) {
				case 1: $( "#distance-disp" ).val( ui.value  + " Mile");$( "#distance" ).val( ui.value);break;
				case 200: $( "#distance-disp" ).val( "National");$( "#distance" ).val( ui.value);break;
				default: $( "#distance-disp" ).val( ui.value  + " Miles");$( "#distance" ).val( ui.value);break;
				}
			}
	});

	$( "#slider-price" ).slider({
			range: true,
			min: 0,
			max: 1000,
			step: 50,
			values: [ <?php echo ( isset( $minprice ) ? esc_attr( $minprice ) : '100' ); ?>, <?php echo ( isset( $maxprice ) ? esc_attr( $maxprice ) : '1000' ); ?>],
			slide: function( event, ui ) {
				$( "#minprice").val(ui.values[0]);
				$( "#maxprice").val(ui.values[1]);
				if (ui.values[1] == 1000 && ui.values[0] == 0) {
					$( "#amount").val("Any Price");
				} else if (ui.values[1] == 1000) {
				$( "#amount" ).val( "Above \u00A3" + ui.values[ 0 ] );
				} else if (ui.values[0] == 0) {
				$( "#amount" ).val( "Below \u00A3" + ui.values[ 1 ] );
				} else {
				$( "#amount" ).val( "\u00A3" + ui.values[ 0 ] + " - \u00A3" + ui.values[ 1 ] );
				}
			}
		});
		<?php
		if ( isset( $maxprice ) && isset( $minprice ) && 1000 === $maxprice && 0 === $minprice ) {
			?>
			$( "#amount").val("Any Price");
		<?php } elseif ( isset( $maxprice ) && 1000 == $maxprice ) { ?>
			$( "#amount" ).val( "Above \u00A3" + <?php echo ( isset( $minprice ) ? esc_attr( $minprice ) : '100' ); ?> );
		<?php } elseif ( isset( $minprice ) && 0 == $minprice ) { ?>
			$( "#amount" ).val( "Below \u00A3" + <?php echo ( isset( $maxprice ) ? esc_attr( $maxprice ) : '1000' ); ?> );
		<?php } else { ?>
			$( "#amount" ).val( "\u00A3" + <?php echo ( isset( $minprice ) ? esc_attr( $minprice ) : '100' ); ?> + " - \u00A3" + <?php echo ( isset( $maxprice ) ? esc_attr( $maxprice ) : '1000' ); ?> );
		<?php } ?>
		$( "#minprice" ).val(<?php echo ( isset( $minprice ) ? esc_attr( $minprice ) : '100' ); ?>);
		$( "#maxprice" ).val(<?php echo ( isset( $maxprice ) ? esc_attr( $maxprice ) : '1000' ); ?>);

		$("#sort").on('change', function(){
			var sort = $( this ).val();
			if ( ! sort ) {
				$( '#sortvalue' ).val('');
			} else {
				$( '#sortvalue' ).val( sort );
				$( '#petsearch' ).submit();
			}
		});

		$( '#petsearch' ).submit( function() {
			$(this).find( ':input' ).filter(function(){ return !this.value; }).attr( 'disabled', 'disabled' );
			return true; // ensure form still submits.
		});
		// Un-disable form fields when page loads, in case they click back after submission.
		$( '#petsearch' ).find( ':input' ).prop( 'disabled', false );

	});
	var input = document.getElementById('location');
	var options = {
		componentRestrictions: {country: "uk"}
	};
	var autocomplete = new google.maps.places.Autocomplete(input, options);
	autocomplete.addListener('place_changed', function() {
		var lat = autocomplete.getPlace().geometry.location.lat();
		var lang = autocomplete.getPlace().geometry.location.lng();
		document.getElementById('lat').value = lat;
		document.getElementById('lng').value = lang;
	});
</script>
