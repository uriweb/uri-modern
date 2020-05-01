<?php
/**
 * Search & Filter Pro
 *
 * Results Template for URI People
 *
 * @package uri-modern
 */
?>

<div class="people-result">

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><figure><?php the_post_thumbnail( 'small', array( 'class' => 'u-photo' ) ); ?></figure></a>
	<?php else : ?>
		<a href="<?php the_permalink(); ?>"><figure><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/default/uri80.gif" alt="Person Icon" /></figure></a>
	<?php endif; ?>

	<h3><a href="<?php the_permalink(); ?>">
										<?php
		// the_title();
		$title = get_the_title();
		echo uri_modern_result_highlight( $title, $search );
	?>
	</a></h3>


	<?php if ( $people_title = uri_modern_get_field( 'peopletitle' ) ) : ?>
		<div class="people-title people-field">
		<?php
			 // the_field( 'peopletitle' );
			 echo uri_modern_result_highlight( $people_title, $search );
		?>
		</div>
	<?php endif; ?>

	<?php if ( $people_department = uri_modern_get_field( 'peopledepartment' ) ) : ?>
		<div class="people-department people-field">
		<?php
			// the_field( 'peopledepartment' );
			 echo uri_modern_result_highlight( $people_department, $search );
		?>
		</div>
	<?php endif; ?>

	<?php if ( $people_research = uri_modern_get_field( 'peopleresearch' ) ) : ?>
		<div class="people-research people-field">
		<?php
			// the_field( 'peopleresearch' );
			 echo uri_modern_result_highlight( $people_research, $search );
		?>
		</div>
	<?php endif; ?>

	<?php
		// $term_lists = get_the_term_list( $post->ID, 'peoplegroups', '', ', ' );
		// format the links so that they point to new searches
		$terms_raw = get_the_terms( $post, 'peoplegroups' );
		$terms = array();
		foreach ( $terms_raw as $t ) {
		$terms[] = '<a href="?_sft_peoplegroups=' . $t->slug . '">' . uri_modern_result_highlight( $t->name, $search ) . '</a>';
		}
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
		?>
		<div class="people-expertise people-field tags-links"><span class="people-expertise-label">Areas of expertise: </span>
		<?php
		$terms = implode( ' ', $terms );
		echo $terms;
		?>
		</div>
		<?php endif; ?>

</div>
