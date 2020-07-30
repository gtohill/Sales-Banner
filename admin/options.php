<?php
/*
update value to enable or disable the sales banner visibible on all pages
*/  
if (!empty($_POST)) {
    if (isset($_POST['update_sales_banner'])) {
        update_option('show_sales_banner', $_POST['update_sales_banner']);
        update_option('sales_banner_field_1', $_POST['sales_banner_field_1']);
        update_option('sales_banner_field_2', $_POST['sales_banner_field_2']);
        update_option('sales_banner_field_3', $_POST['sales_banner_field_3']);
    }
}
