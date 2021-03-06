<?php
/**
 * Template Name: Services
 *
 * @package torque
 */
?>
<?php

get_template_part( 'parts/shared/html-header' );

if ( have_posts() ) while ( have_posts() ) : the_post();

  get_template_part( 'parts/shared/header' );

?>

  <main class="no-padding-bottom">

      <?php get_template_part( 'parts/templates/content-loop', 'services' ); ?>

  </main>

<?php

  get_template_part(  'parts/shared/footer' );

endwhile;

get_template_part(  'parts/shared/html-footer' );

?>
