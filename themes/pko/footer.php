<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pekoe
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">

		<div class="pko-footer">
		
		<div class="pko-query-footer">

		<?php
		$args = array(
        'post_type' =>  'tea',
        'post_status' =>  'publish',
        'limit' => 3,
        'orderby' => 'rand'
    );
			// Call WP_Query and load the content from the database
			$tea_query = new WP_Query( $args );
							
			// Now display the "tea posts"
							
			if ( $tea_query->have_posts() ) :
				while ( $tea_query->have_posts() ) : $tea_query->the_post();
				echo "
					<div class='pko-query-footer-info'>";
					if ( has_post_thumbnail() ) :
						echo 
						"<a href='" . get_the_permalink() . "' title='" . the_title(null,null,false) . "'>" 
						. get_the_post_thumbnail() . "</a>";
					endif;
					echo the_title( '
					<h2>', '</h2>
					
					', false);
					the_excerpt();
								echo "<button class='button-style'><a href='" . get_the_permalink() . "'>Learn more</button>";
								echo "</div>
				";

				endwhile;
				wp_reset_postdata();
				endif;
				?>
				</div>

		<div class="pko-quiz-footer">
			<p>Feel good with every sip</p>
			<button class="pko-button">Perfect Tea Quiz</button>
		</div>
		<div class="pko-bottom-footer">
			<div class="pko-footer-nav">

	
			<?php
				wp_nav_menu(
					array(
						'menu_id'        => 'footer-menu',
					)
				);
				?>


			</div>
			<div class="pko-footer-social-icons">	
			<i class="fa-brands fa-twitter fa-xl" style="color:#f2dcd8"></i>
			<i class="fa-brands fa-instagram fa-xl" style="color:#f2dcd8"></i>
			<i class="fa-brands fa-pinterest-p fa-xl" style="color:#f2dcd8"></i>
			<i class="fa-brands fa-facebook-f fa-xl" style="color:#f2dcd8"></i>
		</div>
			<div class="pko-footer-subscribe">
				<h3>Get all the latest tea</h3>
				<p>Take 15% off your first purchase when you sign up for our newsletter		
				</p>

			<div class="pko-subscribe-form">
				<input type="email" name="" id="pko-form-box" placeholder="Email Address">
			</div>

				<button type="submit" class="pko-footer-button">Subscribe</button>
		</div>

		<!-- <?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Copyright: %1$s by %2$s', 'pko' ), '2022', '<a href="https://luccivera.com">Luccivera</a>' );
				?> -->
		</div>
			</div>
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); 





?>
<script defer src="https://use.fontawesome.com/releases/v6.0.0/js/all.js" integrity="sha384-l+HksIGR+lyuyBo1+1zCBSRt6v4yklWu7RbG0Cv+jDLDD9WFcEIwZLHioVB4Wkau" crossorigin="anonymous"></script>

</body>
</html>
