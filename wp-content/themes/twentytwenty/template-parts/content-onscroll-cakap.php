<?php
/**
 * Displays the content when the cover template is used.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-inner" id="post-inner">

		<div class="entry-contents-wp">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cakap-title mb-4 mt-4">
                        <h3>List Products Category Ajax Scroll</h3>
                        <div style="text-align:right;">
                            <a href="<?= home_url(); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> CRUD Product Category</a>
                        </div>
                    </div>
                    <div class="wrap-list"></div>
                </div>
            </div>
        </div>

        <!-- Bootstrap CRUD CAKAP -->
         
        <!-- END Bootstrap CRUD CAKAP -->

		</div><!-- .entry-content -->
		

	</div><!-- .post-inner -->


</article><!-- .post -->
