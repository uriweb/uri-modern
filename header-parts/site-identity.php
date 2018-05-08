<?php
/**
 * The template for the site identity
 * Child themes can override this file for greater control over site name/description
 *
 * @package uri-modern
 */

?>

<div id="siteidentity">
			
	<h1 class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
	</h1>
	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) :
	?>
		<h2 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h2>
	<?php
	endif;
	?>

</div>
