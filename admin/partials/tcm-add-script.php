
<script type="text/javascript">

  var $wk_jq=jQuery.noConflict();
   (function($wk_jq){ 
      $wk_jq(window).bind("load",function(){
      $wk_jq("#tcm-taxonomy").change(function(eve){ 
        heart_1 = 'Tags Cloud';
        if( $wk_jq('#tcm-title').val() ){
          heart_1 = $wk_jq('#tcm-title').val();
        }
          heart_2 = $wk_jq(this).val();
          $wk_jq(this).val(heart_2.toLowerCase());
          $wk_jq.ajax({
              type: "post",
              url: ajaxurl,   // variable defined above with an array for url and nonce 
              data: "action=tcm_manage_cloud&cloud_title="+heart_1+"&cloud_taxonomy="+heart_2.toLowerCase(),  // Action variable defines the name of the php function which proceess ajax request based on the variable we have passed   
              success: function(response){
                   // Do your stuff here once ajax response is returned
                 $wk_jq(".tcm-custom .wp-heading-inline").html();
                 if( response && response == 'tcm-wrong-taxonomy' ){
                    $wk_jq("#tcm-slug").val();
                    $wk_jq(".tcm-custom .wp-heading-inline").html('Please Verify your Taxonomy - "'+heart_2.toLowerCase()+'"');
                    $wk_jq("div.tcm-submit").hide();
                 }
                 else if( response ){
                    var code1 = '[tcm id="'+response+'" title="true" taxonomy="'+heart_2.toLowerCase()+'"] <a href="?page=tcm_add_new" class="page-title-action">Add New</a>';
                    var code2 = response+'-tcm-'+heart_2.toLowerCase()+'-';
                    $wk_jq(".tcm-custom .wp-heading-inline").html(code1);
                    $wk_jq("#tcm-slug").val(code2);
                    $wk_jq("div.tcm-submit").show();
                 }else{

                  if( !$wk_jq('#tcm-title').val() ){
                    $wk_jq('#tcm-title').focus();
                    $wk_jq("div.tcm-submit").hide();
                  }

                  $wk_jq(".tcm-custom .wp-heading-inline").html("<?php esc_html_e('Add New Tags-Cloud','tcm'); ?>");
                  $wk_jq("#tcm-slug").val();
                  $wk_jq("div.tcm-submit").hide();
                 }

              }
          });

          $wk_jq.ajax({
            type: "post",
            url: ajaxurl,   // variable defined above with an array for url and nonce 
            data: {
              action : 'tcm_get_posttype',
              taxonomy : heart_2,
            },
            success: function(response){
              console.log(response);
              $wk_jq("#tcm_add_new_form #tcm-post-type").html(response);
            }
          });

          $wk_jq("#tcm_add_new_form .tcm-post-type").show();

          eve.preventDefault();
                   
          return false;
          });
      });
  })($wk_jq);

</script>