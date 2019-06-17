<?php
/**
 * Template part for displaying page content in page-dashboard.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="dashboard-wrap">
			<div class="dashboard-left">
				<div class="dwrap">
					<a href="<?php echo esc_url( home_url( '/dashboard/new' ) ); ?>" <?php echo ( get_query_var( 'dashboard' ) == 'new' ? ' class="active"' : '' ); ?>>Post New Advert</a>
					<a href="<?php echo esc_url( home_url( '/dashboard/manage' ) ); ?>" <?php echo ( get_query_var( 'dashboard' ) == 'manage' ? ' class="active"' : '' ); ?>>Manage Adverts</a>
					<a href="<?php echo esc_url( home_url( '/dashboard/favorites' ) ); ?>" <?php echo ( get_query_var( 'dashboard' ) == 'favorites' ? ' class="active"' : '' ); ?>>My Favorites</a>
					<a href="<?php echo esc_url( home_url( '/dashboard/personal-details' ) ); ?>" <?php echo ( get_query_var( 'dashboard' ) == 'personal-details' ? ' class="active"' : '' ); ?>>Edit Personal Details</a>
					<a href="<?php echo esc_url( home_url( '/dashboard/login-details' ) ); ?>" <?php echo ( get_query_var( 'dashboard' ) == 'login-details' ? ' class="active"' : '' ); ?>>Edit Login Details</a>
				</div>
			</div>
			<div class="dashboard-right">
				<?php
				switch ( get_query_var( 'dashboard' ) ) {
					case 'new':
						get_template_part( 'template-parts/dashboard', 'new' );
						break;
					case 'manage':
						get_template_part( 'template-parts/dashboard', 'manage' );
						break;
					case 'favorites':
						get_template_part( 'template-parts/dashboard', 'favorites' );
						break;
					case 'personal-details':
						get_template_part( 'template-parts/dashboard', 'personal-details' );
						break;
					case 'login-details':
						get_template_part( 'template-parts/dashboard', 'login-details' );
						break;
					case 'edit':
						get_template_part( 'template-parts/dashboard', 'edit' );
						break;
					default:
						get_template_part( 'template-parts/dashboard', 'default' );
				}
				?>
			</div>
		</div>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				wprig_edit_post_link();
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
