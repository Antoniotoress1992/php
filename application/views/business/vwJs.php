<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/respond.min.js"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_METRONIC_PATH; ?>global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo HTTP_METRONIC_PATH; ?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo HTTP_METRONIC_PATH; ?>admin/pages/scripts/table-managed.js"></script>

<script type="text/javascript" src="<?php echo base_url()."assets/js/dropdown.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/js/modal.js"?>"></script>
<script src="<?php echo base_url()."assets/js/bootbox.js"?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init() // init quick sidebar
});
</script>
