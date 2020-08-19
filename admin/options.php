<?php
/*
update value to enable or disable the sales banner visibible on all pages
*/
if (!empty($_POST)) {   
    if (isset($_POST['update_sales_banner'])) {
         update_option('show_sales_banner', $_POST['update_sales_banner']);
    //     update_option('sales_banner_field_1', $_POST['sales_banner_field_1']);
    //     update_option('sales_banner_field_2', $_POST['sales_banner_field_2']);
    //     update_option('sales_banner_field_3', $_POST['sales_banner_field_3']);
    }

    if (isset($_POST['add_sales_banner']) && $_POST['add_sales_banner'] != '') {
                
        global $wpdb;
        $add = $_POST['add_sales_banner'];        
        $active = 1;

        $table_name = $wpdb->prefix . 'sales_banner';

        $wpdb->insert(
            $table_name,
            array(                
                'information' => $add,
                'active' => $active               
            )
        );
    }

    if(isset($_POST['update_banner'])){
        global $wpdb;
        $table_name = $wpdb->prefix . 'sales_banner';       

        $wpdb->update( 
            $table_name, 
            array(                 
                'information' => $_POST['banner']
            ), 
            array( 'id' => $_POST['id'] ), 
            array(                 
                '%s'
            ), 
            array( '%s' ) 
        );
       
    }

    // delete banner
    if(isset($_POST['delete_banner'])){
        global $wpdb;
        $table_name = $wpdb->prefix . 'sales_banner';
        $wpdb->delete( $table_name, array( 'id' => $_POST['id'] ), array( '%d' ) );
    }

    // change a banner to inactive
    if(isset($_POST['inactive_banner'])){
        global $wpdb;
        $table_name = $wpdb->prefix . 'sales_banner';
        $wpdb->update( 
            $table_name, 
            array(                 
                'active' => 0 // make inactive
            ), 
            array( 'id' => $_POST['banner_id'] ), 
            array(                 
                '%d'
            ), 
            array( '%d' ) 
        );

    }

    // change a banner to active
    if(isset($_POST['active_banner'])){
        global $wpdb;
        $table_name = $wpdb->prefix . 'sales_banner';
        $wpdb->update( 
            $table_name, 
            array(                 
                'active' => 1 // make inactive
            ), 
            array( 'id' => $_POST['banner_id'] ), 
            array(                 
                '%d'
            ), 
            array( '%d' ) 
        );

    }
}
