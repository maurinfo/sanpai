

    <!-- Core  -->
    <script src="<?php echo base_url(); ?>global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/animsition/animsition.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/waves/waves.js"></script>

    <!-- Plugins -->
    <script src="<?php echo base_url(); ?>global/vendor/switchery/switchery.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/intro-js/intro.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/screenfull/screenfull.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/chartist/chartist.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/matchheight/jquery.matchHeight-min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/aspaginator/jquery-asPaginator.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>global/vendor/bootstrap-select/bootstrap-select.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>global/js/Component.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Base.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Config.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/Section/Menubar.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Section/Sidebar.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Section/PageAside.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Plugin/menu.js"></script>

    <!-- Config -->
    <script src="<?php echo base_url(); ?>global/js/config/colors.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/config/tour.js"></script>
    <script>Config.set('assets', '<?php echo base_url(); ?>assets');</script>

    <!-- Page -->
    <script src="<?php echo base_url(); ?>global/js/Plugin/bootstrap-select.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/select2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/Site.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/asscrollable.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/slidepanel.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/switchery.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/matchheight.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/jvectormap.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/peity.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/aspaginator.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/responsive-tabs.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/tabs.js"></script>
    <script src="<?php echo base_url(); ?>global/js/Plugin/clockpicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/examples/js/dashboard/v1.js"></script>
    <script src="<?php echo base_url(); ?>assets/examples/js/forms/advanced.js"></script>
    <script>
      (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
          $("#flash-message").fadeTo(3000, 500).slideUp(500);
        });
      })(document, window, jQuery);
    </script>
  </body>
</html>
