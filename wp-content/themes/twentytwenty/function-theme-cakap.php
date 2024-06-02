<?php 
/**
 * Proper way to enqueue scripts and styles
 */
function bootstrap_assets() {
    
    if( is_page_template('templates/template-crud-cakap.php') OR is_page_template('templates/template-onscrool-cakap.php') ){
        wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',array(),rand(111,9999),'all' );
        wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',array(),rand(111,9999),'all' );
        wp_enqueue_style( 'dt-bootstrap', 'https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css',array(),rand(111,9999),'all' );
       
        
        wp_enqueue_script( 'jqueryoke', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), rand(111,9999), true );
        
        
        wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'dt', 'https://cdn.datatables.net/2.0.8/js/dataTables.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'bootstrap5-dt', 'https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js', array(), rand(111,9999), true );
        
        wp_enqueue_script( 'swallalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), rand(111,9999), true );

        wp_enqueue_script( 'cakapjs', get_template_directory_uri().'/assets/js/cakap.js', array(), rand(111,9999), true );
        wp_localize_script( 'cakapjs', 'cakap',
            array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                '_nonce' => wp_create_nonce(),
            )
        );
    
        wp_dequeue_style( 'twentytwenty-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'bootstrap_assets',99);

add_action('init','crate_table_products');
function crate_table_products(){
    global $table_prefix, $wpdb;

    $cakap_tb = $table_prefix.'product_category';
    $charset_collate = $wpdb->get_charset_collate();

    if($wpdb->get_var( "show tables like '$cakap_tb'" ) != $cakap_tb){

        $sql = "CREATE TABLE $cakap_tb (
                    `product_category_id` MEDIUMINT(7) NOT NULL AUTO_INCREMENT,
                    `product_category_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb3_general_ci',
                    `product_category_slug` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb3_general_ci',
                    `product_category_desc` TEXT NULL DEFAULT NULL COLLATE 'utf8mb3_general_ci',
                    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `unique_id` CHAR(50) NOT NULL COLLATE 'utf8mb3_general_ci',
                    `product_category_status` INT(10) NOT NULL,
                    PRIMARY KEY (`product_category_id`) USING BTREE
                ) $charset_collate;";
       
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    
    }
}


/**
 * Handle AJAX FORM
 */
add_action('wp_ajax_simpan_form_productcat','simpan_form_productcat');
add_action('wp_ajax_nopriv_simpan_form_productcat','simpan_form_productcat');
function simpan_form_productcat(){
    global $sql;

    $tb = 'product_category';
    
    $post = $_POST;

    unset($post['action']);

    if ( ! isset( $post['_nonce'] ) || ! wp_verify_nonce( $post['_nonce'], 'cakap_nonce' ) ) {
        $return = ['msg'=>'warning','txt'=>'Sorry, your nonce did not verify.'];
    } else {
        unset($post['_nonce']);
        unset($post['_wp_http_referer']);

        if( isset($post['product_category_status']) ){
            $post['product_category_status'] = 1; //aktif
        }else{
            $post['product_category_status'] = 0; //non aktif
        }

        $post['unique_id'] = wp_generate_uuid4();
        $post['product_category_slug'] = strtolower( str_replace(' ', '_', $post['product_category_name']) );
        
        if( $post['mode'] == 'edit' ){
            $post['modified'] = date('Y-m-d H:i:s');
            
            $data = [
                'product_category_name' => $post['product_category_name'],
                'product_category_slug' => strtolower( str_replace(' ', '_', $post['product_category_name']) ),
                'product_category_status' => $post['product_category_status'],
                'product_category_desc' => $post['product_category_desc'],
                'modified' => $post['modified'],
            ];

            $updateDB = $sql->updateDB($tb,$data,['unique_id'=>$post['id']]);
            if( $updateDB > 0 ){
                $return = ['msg'=>'success','txt'=>'Update Success'];
            }else{
                $return = ['msg'=>'warning','txt'=>'Data Not Update'];
            }

        }else{
            unset($post['mode']);

            $insertDB = $sql->addDB($tb,$post);
            
            if( $insertDB > 0 ){
                $return = ['msg'=>'success','txt'=>'Success Submit'];
            }else{
                $return = ['msg'=>'error','txt'=>'Failed Submit'];
            }
        }
        
    }
    
    echo json_encode($return);

    die();
}


add_action('wp_ajax_editproduct','editproduct');
add_action('wp_ajax_nopriv_editproduct','editproduct');
function editproduct(){
    global $sql;
    $post = $_POST;
    $tb = 'product_category';

    $unique_id = $post['id'];

    $return = $sql->getRowDB($tb," AND unique_id='".$unique_id."'");
    
    echo json_encode($return);
    
    die();
}

add_action('wp_ajax_deleteproduct','deleteproduct');
add_action('wp_ajax_nopriv_deleteproduct','deleteproduct');
function deleteproduct(){
    global $sql;
    $post = $_POST;
    $tb = 'product_category';

    $unique_id = $post['id'];

    $delete = $sql->deleteDB($tb,['unique_id'=>$unique_id]);
    
    if( $delete > 0 ){
        $return = ['msg'=>'success','txt'=>'Success Delete'];
    }else{
        $return = ['msg'=>'error','txt'=>'Failed Delete'];
    }

    echo json_encode($return);
    
    die();
}

add_action('wp_ajax_ajax_list_serverside','ajax_list_serverside');
add_action('wp_ajax_nopriv_ajax_list_serverside','ajax_list_serverside');
function ajax_list_serverside()
{
    global $sql;

    $page_url = wp_get_referer();

    $tb = 'product_category';

    $columns = array(
        0 => 'product_category_id ',
    );
    
    //set limit query pagination
    $andWhere_limit = "";
    if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
        // Add a limit section to your query
        $andWhere_limit .= " LIMIT ".$_REQUEST['start'].",".$_REQUEST['length'];
    
    }

    //set search value
    $where_condition = $sqlTot = $sqlRec = "";

    if( !empty($_REQUEST['search']['value']) ) {
        $where_condition .= " AND ( product_category_name LIKE '%".$_REQUEST['search']['value']."%' ";    
        $where_condition .= " OR product_category_desc LIKE '%".$_REQUEST['search']['value']."%' )";
    }
    
    if(isset($where_condition) && $where_condition != '') {

        $sqlTot .= $where_condition;
        $sqlRec .= $where_condition;
    }

    $sqlRec .= " ORDER BY ". $columns[$_REQUEST['order'][0]['column']]." ".( $_REQUEST['draw'] == '1' ? 'desc' : $_REQUEST['order'][0]['dir'])." ".$andWhere_limit;

    $queryTot = $sql->showDB($tb,$sqlTot);
    $totalRecords = count($queryTot);

    $list = $sql->showDB($tb,$sqlRec);
    
    $data_side = [];
    $no =1;
    foreach( $list as $key => $row ){
        
        $btn = '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button class="btn btn-primary btn-sm editproduct" type="button" data-id="'.$row->unique_id.'"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm deleteproduct" type="button" data-id="'.$row->unique_id.'"><i class="fa fa-trash"></i></button>
        </div>';

        $data_side[$key][] = $row->product_category_name;
        $data_side[$key][] = $row->product_category_desc;
        $data_side[$key][] = ( $row->product_category_status == 1 ) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Not Active</span>';
        $data_side[$key][] = $btn;
    }

    $arr = [
        "draw"=> intval( $_REQUEST['draw'] ),
        "recordsTotal"=> intval( $totalRecords ),
        "recordsFiltered"=> intval( $totalRecords ),
        'data'=>$data_side,
        'sqlRec'=>$sqlRec
    ];
    
    echo json_encode($arr);

    die();
}


add_action('wp_ajax_scroll_list','scroll_list');
add_action('wp_ajax_nopriv_scroll_list','scroll_list');
function scroll_list(){
    global $sql;
    $post = $_POST;
    $tb = 'product_category';

    $limit = 6;
    $page = $post['page'];

    $page_index = ($page-1) * $limit;      // 0


    $return = $sql->showDB($tb," LIMIT $page_index, $limit");
    
    echo json_encode($return);
    
    die();
}

?>