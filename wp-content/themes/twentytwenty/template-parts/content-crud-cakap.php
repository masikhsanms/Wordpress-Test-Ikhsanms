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

		<?php // the_content(); ?>

        <!-- Bootstrap CRUD CAKAP -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-cakap">
                                <div class="card">
                                    <div class="card-header">
                                        <label class="fw-bold">Add Product Category</label> 
                                    </div>
                                    <div class="card-body">
                                        <form id="frm-productcat-cakap">
                                            <?php wp_nonce_field('cakap_nonce', '_nonce'); ?>
                                            <input type="hidden"  name="mode" value="add">
                                            <div class="mb-3 form-group">
                                                <label class="fw-normal form-label">Category Name (<span class="required text-danger">*</span>)</label>
                                                <input autocomplete="off" type="text" class="form-control" placeholder="Input Here ..." name="product_category_name" required>
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label class="fw-normal form-label">Category Description</label>
                                                <textarea autocomplete="off" name="product_category_desc" class="form-control" placeholder="Input Here ..."></textarea>
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label class="fw-normal form-label">Status</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="product_category_status" role="switch" id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                </div>
                                            </div>
                                            <div class="mb-3 form-group buttonform">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-cakap mt-4">
                                <div class="mb-4 buttonback" style="text-align:right;">
                                    <a href="<?= home_url('onscroll-cakap'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Onscroll Products Category</a>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label class="fw-bold">Manage Products Category</label>
                                    </div>
                                    <div class="card-body">
                                        
                                        <!-- <div class="wrap-table"></div> -->

                                        <table class="table table-striped table-hover table-bordered" id="dt-cakap">
                                            <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody><tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- END Bootstrap CRUD CAKAP -->

		</div><!-- .entry-content -->
		

	</div><!-- .post-inner -->

	<?php

	if ( is_single() ) {

		// get_template_part( 'template-parts/navigation' );
	}
	?>

</article><!-- .post -->
