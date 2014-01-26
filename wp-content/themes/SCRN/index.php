<?php 
global $scrn;
if(isset($_POST['submit']))
{
    if( !$_POST['name'] || !$_POST['email'] || !$_POST['comment'] || $_POST['name'] == '' || $_POST['email'] == ''|| $_POST['comment'] == '')
    {
        $error = 'Please fill in all the required fields';
    }
    else 
    {
            $absolute_path = __FILE__;
            $path_to_file = explode( 'wp-content', $absolute_path );
            $path_to_wp = $path_to_file[0];

            // Access WordPress
            require_once( $path_to_wp . '/wp-load.php' );
            $scrn = get_option('scrn');
            $name = esc_html($_POST['name']);
            $email = esc_html($_POST['email']);
            $comment = esc_html($_POST['comment']);
            $msg = esc_attr('Name: ', 'SCRN') . $name . PHP_EOL;
            $msg .= esc_attr('E-mail: ', 'SCRN') . $email . PHP_EOL;
            $msg .= esc_attr('Message: ', 'SCRN') . $comment;
            $to = $scrn['email'];
            $sitename = get_bloginfo('name');
            $subject = '[' . $sitename . ']' . ' New Message';
            $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
            //wp_mail($to, $subject, $msg, $headers);
    }
}
get_header(); ?>    
    <?php 
    if ( ( $locations = get_nav_menu_locations() ) && $locations['top-menu'] ) {
        $menu = wp_get_nav_menu_object( $locations['top-menu'] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $include = array();
        foreach($menu_items as $item) {
            if($item->object == 'page')
                $include[] = $item->object_id;
        }
        $query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $include, 'posts_per_page' => count($include), 'orderby' => 'post__in' ) );
    }
    else
    {
        if(isset($scrn['pages_topmenu']) && $scrn['pages_topmenu'] != '' )
            $query = new WP_Query(array( 'post_type' => 'page', 'post__in' => $scrn['pages_topmenu'], 'posts_per_page' => count($scrn['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
        else
            $query = new WP_Query(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    }
    $i = 1;
    while($query->have_posts() ) : $query->the_post(); 
        $template_file = get_post_meta($post->ID,'_wp_page_template',TRUE);
        $style = get_post_meta($post->ID, '_page_style', true);
        $bgimage = get_post_meta($post->ID, '_page_bgimage', true);
        $bgcolor = get_post_meta($post->ID, '_page_bgcolor', true);
        $slogantext = get_post_meta($post->ID, '_page_slogantext', true);
        $sloganimg = get_post_meta($post->ID, '_page_sloganimg', true);
        if($template_file == 'page-template-blog.php') {
            $style = 2;
        }
    ?>
        <div class="bg <?php if($style == 2) echo 'dark-bg';?>" id="<?php echo $post->post_name;?>"
            <?php if($style == 3) { echo 'style="';
            if($bgcolor != '#') echo 'background-color: ' . $bgcolor; 
            else if($bgimage != '') echo 'background-image: url(\'' . $bgimage . '\')'; echo '"'; } ?>>
            <div class="container">
                <div class="sixteen columns">
                        <h2>
                            <span class="lines">
                                <?php $top_title = get_post_meta($post->ID, 'top_title', true); 
                                if($top_title != '') echo $top_title; else the_title();?>
                            </span>
                        </h2>
                 </div> <!-- end sixteen columns -->

                 <div class="clear"></div>

            <?php global $more; $more = 0; the_content('');?>

            <?php
            //****** Blog page template *******//
            if($template_file == 'page-template-blog.php') {  
            $nrposts = get_post_meta($post->ID, '_blog_nrposts', true);
            $fullwidth = get_post_meta($post->ID, '_blog_fullwidth', true);
            $categories = get_post_meta($post->ID, '_blog_categories', true);
            $permalink = get_permalink();
            ?>

                <div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
                    <?php
                    $args = array();
                    $args['posts_per_page'] = $nrposts;
                    if(count($categories) > 0) {
                        $args['category__in'] = $categories;
                    }
                    $qquery = new WP_Query($args);
                    while($qquery->have_posts() ) : $qquery->the_post();
                        $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                        <div class="post">
                            <?php if(has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink();?>">
                                    <?php
                                    $thumb = aq_resize($thumbnail, 1000, 300, true);
                                    if($thumb == '' && $fullwidth != 2) {
                                        //trying to resize it to smaller dimensions
                                        $thumb = aq_resize($thumbnail, 700, 250, true);
                                    }
                                    if($thumb == '') {
                                        //too small image, we keep the original one
                                        $thumb = $thumbnail;
                                    }
                                    ?>
                                    <img src="<?php echo $thumb;?>" class="scale-with-grid" alt="<?php the_title();?>" />
                                </a>
                            <?php } ?>
                            <a href="<?php the_permalink();?>">
                                <p class="post-title"><?php the_title();?></p>
                                <p class="post-info">
                                    <?php
                                    _e('by', 'SCRN'); echo ' '; the_author_posts_link(); echo ' ';
                                    _e('on', 'SCRN'); echo ' '; the_time("d M, Y"); 
                                    echo ' - '; comments_popup_link(esc_html__('0 comments','SCRN'), esc_html__('1 comment','SCRN'), '% '.esc_html__('comments','SCRN'));
                                    ?>
                                </p>
                            </a>
                            <p><?php the_excerpt();?></p>
                            <a href="<?php the_permalink();?>">
                                <div class="button1"><?php _e('Read more', 'SCRN');?></div>
                            </a>
                        </div> <!-- end post -->
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <?php if($fullwidth == 2) { ?>
                    <div class="four columns">
                        <div class="sidebar">
                            <?php dynamic_sidebar("Right sidebar"); ?>
                        </div> <!-- end sidebar -->
                    </div> <!-- end four columns -->
            <?php }
            ?>
            <div class="sixteen columns">
                <div style="text-align: center">
                    <a href="<?php echo $permalink;?>">
                        <div class="button1"><?php _e('View all blog posts', 'SCRN');?></div>
                    </a>
                </div>
            </div>
            <?php }
            //****** Blog page template *******//
            ?>
                
            </div> <!-- end container -->
        </div> <!-- end bg -->
        <div id="separator_<?php echo $i;?>" class="separator1">
            <div class="bg<?php echo ($i+1); echo ' bg';?>" style="<?php if($sloganimg != '') echo 'background-image: url(\'' . $sloganimg . '\')';?> "></div>
            <p class="separator"><?php if($slogantext != '') echo $slogantext;?></p>
        </div>
    <?php $i++; endwhile; wp_reset_postdata(); ?>

    <div id="contact" class="dark-bg">
        <div class="container">
        
            <div class="sixteen columns">
                <h2 class="white"><span class="lines"><?php _e('Contact', 'SCRN');?></span></h2>
            </div> <!-- end sixteen columns -->

            <?php if(isset($scrn['contact_description']) && $scrn['contact_description'] != '') { ?>
                <div class="sixteen columns">
                    <p><?php echo esc_attr($scrn['contact_description']);?></p>
                </div> <!-- end sixteen columns -->
            <?php } ?>
            
            <div class="clear"></div>
            
            <div class="eight columns">
                <div class="contact-form">

                    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
                    if(is_plugin_active('contact-form-7/wp-contact-form-7.php') && isset($scrn['contactform7']) && $scrn['contactform7'] != '') { 
                        echo do_shortcode($scrn['contactform7']);
                    } else { ?>
                    
                        <div class="done">
                            <?php _e('<b>Thank you!</b> I have received your message.', 'SCRN');?> 
                        </div>
                    
                        <form method="post" action="process.php">
                            <p><?php _e('name', 'SCRN');?></p>
                            <input type="text" name="name" class="text" />
                            
                            <p><?php _e('email', 'SCRN');?></p>
                            <input type="text" name="email" class="text" id="email" />

                            <p><?php _e('message', 'SCRN');?></p>
                            <textarea name="comment" class="text"></textarea>

                            <input type="submit" id="submit" value="<?php _e('send', 'SCRN');?>" class="submit-button" />
                        </form>
                    <?php } ?>
                        
                </div> <!-- end contact-form -->
            </div> <!-- end eight columns -->
            
            <div class="eight columns">
                
                <div class="contact-info">
                    
                    <h5><?php _e('Contact Info', 'SCRN');?></h5>
                
                    <?php if(isset($scrn['phone']) && $scrn['phone'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-phone.png" alt="" /> <?php echo $scrn['phone'];?></p><?php } ?>
                    <?php if(isset($scrn['email']) && $scrn['email'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-email.png" alt="" /> <a href="mailto:<?php echo $scrn['email'];?>"><?php echo encEmail($scrn['email']);?></a></p><?php } ?>
                    <?php if(isset($scrn['location']) && $scrn['location'] != '') { ?><p class="white"><img src="<?php echo get_template_directory_uri();?>/images/icn-address.png" alt="" /> <?php echo $scrn['location'];?></p><?php } ?>
                </div> <!-- end contact-info -->
                
                <div class="social">
                    <ul>
                        <?php if(isset($scrn['twitter_username'])  && $scrn['twitter_username'] != '') { ?><li><a target="_blank" href="http://twitter.com/<?php echo $scrn['twitter_username'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-twitter2.png" alt="Twitter icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['facebook_url'])  && $scrn['facebook_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['facebook_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-facebook2.png" alt="Facebook icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['gplus_url'])  && $scrn['gplus_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['gplus_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-gplus.png" alt="Google+ icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['linkedin_url'])  && $scrn['linkedin_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['linkedin_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-linkedin.png" alt="LinkedIn icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['forrst_url'])  && $scrn['forrst_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['forrst_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-forrst.png" alt="Forrst icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['skype_url'])  && $scrn['skype_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['skype_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-skype.png" alt="Skype icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['dribbble_url'])  && $scrn['dribbble_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['dribbble_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-dribbble.png" alt="Dribbble icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['pinterest_url'])  && $scrn['pinterest_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['pinterest_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-pinterest.png" alt="Pinterest icon" /></a></li><?php } ?>
                        <?php if(isset($scrn['vimeo_url'])  && $scrn['vimeo_url'] != '') { ?><li><a target="_blank" href="<?php echo $scrn['vimeo_url'];?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-vimeo.png" alt="Vimeo icon" /></a></li><?php } ?>
                    </ul>
                </div> <!-- end social -->
                
            </div> <!-- end eight columns -->
            
            <div class="clear"></div>
            
            
        </div> <!-- end container -->
        
    </div> <!-- end contact -->

    
    
<?php get_footer();?>