<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wprig
 */

if ( ! is_active_sidebar( 'shop' ) ) {
	return;
}
?>
<aside id="secondary" class="shop-sidebar widget-area side-item-wrap">
	<?php dynamic_sidebar( 'shop' ); ?>
</aside><!-- #secondary -->

<?php

$top_selling = new WP_Query( array(
	'posts_per_page'      => 4,
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'meta_key'            => 'total_sales',
	'orderby'             => 'meta_value_num',
	'order'               => 'DESC',
) );

if ( $top_selling->have_posts() ) :
	?>
	<div class="side-item-wrap">
	<h2>Top Selling Products</h2>
	<?php
	while( $top_selling->have_posts() ) :
		$top_selling->the_post();
		?>
		<div class="side-item">
			<div class="side-img">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
				</a>
			</div>
			<div class="side-desc">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
				<h4><?php echo wc_price( $price ); ?></h4>
			</div>
		</div>
		<hr>
		<?php
	endwhile;
	wp_reset_postdata();
	?>
	</div>
	<?php
endif;

$meta_query  = WC()->query->get_meta_query();
$tax_query   = WC()->query->get_tax_query();
$tax_query[] = array(
	'taxonomy' => 'product_visibility',
	'field'    => 'name',
	'terms'    => 'featured',
	'operator' => 'IN',
);
$args = array(
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'posts_per_page'      => 10,
	'meta_query'          => $meta_query,
	'tax_query'           => $tax_query,
);

$featured_query = new WP_Query( $args );

if ( $featured_query->have_posts() ) {
	?>
	<style>
	.swiper-container {
		width: 100%;
		height: 100%;
	}
	.swiper-slide {
		text-align: center;
		font-size: 18px;
		background: #fff;
		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;
	}
	.swiper-button-next,
	.swiper-button-prev {
		width: 25px;
		height: 25px;
		background-color: #2c3e50;
		background-size: 35%;
	}
	.swiper-button-next {
		right: 0;
	}
	.swiper-button-prev {
		left: 0;
	}
  </style>
	<div class="side-item-wrap">
	<h2>Featured Products</h2>
	<div class="swiper-container">
    <div class="swiper-wrapper">
	<?php
	while ( $featured_query->have_posts() ) :
		$featured_query->the_post();
		$product = wc_get_product( $featured_query->post->ID );
		$price = $product->get_price_html();
		?>
		<div class="swiper-slide">
			<div class="featured-product">
				<div class="featured-item">
					<a href="<?php the_permalink(); ?>">
						<?php echo woocommerce_get_product_thumbnail(); ?>
					</a>
					<div class="featured-details">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
						</a>
						<?php echo ( $price ); ?>
					</div>

				</div>
			</div>
		</div>
		<?php
	endwhile;
	wp_reset_postdata();
	?>
	</div>
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>
	</div>
</div>
	<script>
	var swiper = new Swiper('.swiper-container', {
		loop: true,
		navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
		},
	});
  </script>
	<?php
}

