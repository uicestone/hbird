<!--    <div id="footer">
        <div class="container">
            <div class="sixteen columns">
                <div class="copyright">
			<?php /**<p>&copy; <?php the_time("Y");?> <?php _e('All Rights Reserved', 'SCRN');?>, <?php _e('designed by ', 'SCRN');?> <a title="WordPress Themes" href="http://teothemes.com">TeoThemes</a></p> */ ?>
                </div>
            </div>  
        </div>
    </div>          -->
          
<!-- JS
    ================================================== -->
  
  <!-- fancybox -->
  <script type="text/javascript">
    function scrollTo(target){
          var myArray = target.split('#');
          var targetPosition = jQuery('#' + myArray[1]).offset().top;
          jQuery('html,body').animate({ scrollTop: targetPosition}, 'slow');
        }
    jQuery(document).ready(function() {

        jQuery("nav").sticky({topSpacing:0});

        /* This is basic - uses default settings */
      
        jQuery("a[class^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: 'light_square'
          });
      
        /* Using custom settings */
      
        jQuery('.proj-img').hover(function() {
            jQuery(this).find('i').stop().animate({
              opacity: 0.8
            }, 'fast');
            jQuery(this).find('a').stop().animate({
              "top": "0"
            });
          }, function() {
            jQuery(this).find('i').stop().animate({
              opacity: 0
            }, 'fast');
            jQuery(this).find('a').stop().animate({
              "top": "-600px"
            });
        });

          jQuery('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
            slideshowSpeed: 3500,
            animationSpeed: 1000
          });

          jQuery('nav ul#menu-top-menu').mobileMenu({
               defaultText: '<?php _e("Navigate to...", "SCRN");?>',
               className: 'mobile-menu',
               subMenuDash: '&ndash;'
          });
          
          //uicestone: .jpg portfolios should fill container's size, while .png ones are scaled down
          jQuery('#work .filterable_portfolio .scale-with-grid[src$=".jpg"]').css('max-width', '100%').css('max-height', '100%');

    });
    
  </script>
    
    
<!-- End Document
================================================== -->

<?php global $scrn;
if(isset($scrn['integration_footer'])) echo $scrn['integration_footer'] . PHP_EOL; ?>

 <?php wp_footer(); ?>
 
</body>
</html>