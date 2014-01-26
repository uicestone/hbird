<?php 
get_header();
the_post(); 
$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) )
?>
 <div class="bg dark-bg" style="text-align: left" id="blog">
    <div class="container">
            <div class="single-post">
                <div style="text-align: center">
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
                </div>
                <?php the_content();?>
                <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','SCRN').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <div class="tags">
                    <?php the_tags(esc_attr('Tags: ', 'SCRN') . '<div class="button1">', '</div> <div class="button1">', '</div><br />'); ?> 
                </div>
                <?php 
                edit_post_link(); 
                echo '<br />';
                ?>
            </div> <!-- end post -->
            <?php comments_template('', true); ?>
    </div>
</div>
<?php get_footer();?>