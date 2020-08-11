
jQuery(document).ready(function() 
{  
  jQuery.ajax({
      type: 'GET',
      url: 'http://192.168.33.11/wp-admin/admin-ajax.php',
      data: {          
          action: 'get_sales_banner_slider'
      },
      success: function(result) {
        console.log(result.data);
        jQuery(result.data).insertBefore("#main");
        showSlides(1);
      },
      error: function() {
        console.log('Error occured');
    }
  });
});