<?php
/**
 * 
 * Template Name: Pekoe Blog
 * @package pekoe
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

// if (have_posts()){
// 	while ( have_posts() ) {
// 		the_post();
// 		the_content();
// }
// }



		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<div class="sidebar-blog">
			<?php get_sidebar();?>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
