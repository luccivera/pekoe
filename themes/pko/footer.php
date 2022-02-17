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

		<div class="pko-quiz-footer">
			<p>Feel good with every sip</p>
			<button class="pko-quiz-button">Perfect Tea Quiz</button>
		</div>
		<div class="pko-footer">

		<div class="pko-footer-nav"></div>
		<div class="pko-footer-social-icons"></div>
		<div class="pko-footer-subscribe">
			<h3>Get all the latest tea</h3>
			<p>Take 15% off your first purchase when you sign up for our newsletter</p>
			<input type="email" name="" id="" placeholder="Email Address">
			<button type="submit">Subscribe</button>
		</div>
		</div>
			<span class="sep"> | </span>



				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Copyright: %1$s by %2$s.', 'pko' ), '2022', '<a href="https://luccivera.com">Luccivera</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
