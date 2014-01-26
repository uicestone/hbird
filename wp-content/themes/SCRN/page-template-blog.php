<?php
/* 
Template name: Blog page template
*/
get_header();
global $scrn;
the_post(); 
$nrposts = get_post_meta($post->ID, '_blog_nrposts', true);
$fullwidth = get_post_meta($post->ID, '_blog_fullwidth', true);
$categories = get_post_meta($post->ID, '_blog_categories', true);
?>
 <div class="bg dark-bg" style="text-align: left" id="blog">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
                    <h2><span class="lines"><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></span></h2>
            </div>
        </div>
        <div class="clear"></div>
        <!-- start sixteen columns -->
        <div class="<?php if($fullwidth == 2) echo 'twelve'; else echo 'sixteen';?> columns">
            <?php
            $args['posts_per_page'] = $nrposts;
            if(count($categories) > 0)
                $args['category__in'] = $categories;
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            $i = 1;
            if(have_posts()) : while(have_posts()) : the_post();
                $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                <div <?php post_class('post');?>>
                    <?php if(has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink();?>">
                            <?php
                            $thumb = aq_resize($thumbnail, 960, 300, true);
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
            <?php endwhile; 
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
        </div> <!-- end sixteen columns -->

        <!-- start sidebar -->
        <div class="four columns">
            <div class="sidebar">
                <?php 
                if($fullwidth == 2) 
                    dynamic_sidebar("Right sidebar");
                ?>
            </div>
        </div>
        <!-- end sidebar -->

    </div>
</div>
<?php get_footer();?>