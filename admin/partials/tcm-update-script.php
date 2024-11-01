
<script type="text/javascript">

  jQuery(document).ready(function(){
    jQuery('#tcm-title').keyup(function(){
      var tcm_id = jQuery('#edit-tcm-hidden').val();
      var tcm_title = jQuery(this).val();
      var tcm_tag = jQuery('#tcm-taxonomy').val();

      var code1 = '[tcm id="'+tcm_id+'" title="true" taxonomy="'+tcm_tag.toLowerCase()+'"] <a href="?page=tcm_add_new" class="page-title-action">Add New</a>';
                    
      jQuery(".tcm-custom .wp-heading-inline").html(code1);
    });
  });

</script>