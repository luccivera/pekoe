<?php
/*Template Name: Teas*/
get_header();
?>
<div class="tea-post-temp-content">
<?php

query_posts(array(
   'post_type' => 'tea'
)); ?>

<?php
while (have_posts()) : the_post(); ?>
<div class="tea-post-content">
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p><?php the_excerpt(); ?></p>
</div>

<?php endwhile;
get_footer();
?>


