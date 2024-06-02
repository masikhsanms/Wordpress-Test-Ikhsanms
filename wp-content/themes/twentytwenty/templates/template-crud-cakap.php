<?php
/**
 * Template Name: CRUD Cakap
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

if(is_page_template('templates/template-crud-cakap.php')){
    wp_head();
}else{
    get_header();
}
?>

<div class="container">
    <main id="site-content" class="content-area">
    
        <?php
        // if ( have_posts() ) {
            // while ( have_posts() ) {
            // 	the_post();
            // }
        // }
    
            get_template_part( 'template-parts/content-crud-cakap' );
    
        ?>
    
    </main><!-- #site-content -->
</div>

<?php
if(is_page_template('templates/template-crud-cakap.php')){
    wp_footer();
}else{
    get_footer();
}

