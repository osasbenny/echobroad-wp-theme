<?php
/**
 * The template for displaying single posts
 *
 * @package EchoBroad
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container" style="padding: 80px 20px;">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header" style="margin-bottom: 30px;">
                    <h1 class="entry-title" style="font-size: 2.5rem; margin-bottom: 20px;"><?php the_title(); ?></h1>
                    <div class="entry-meta" style="color: #666; margin-bottom: 20px;">
                        <span><i class="fas fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <span style="margin-left: 20px;"><i class="fas fa-user"></i> <?php the_author(); ?></span>
                        <span style="margin-left: 20px;"><i class="fas fa-folder"></i> <?php the_category(', '); ?></span>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail" style="margin-bottom: 30px;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content" style="line-height: 1.8; font-size: 1.1rem;">
                    <?php the_content(); ?>
                </div>
                
                <footer class="entry-footer" style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                    <?php
                    the_tags('<p><i class="fas fa-tags"></i> Tags: ', ', ', '</p>');
                    ?>
                </footer>
            </article>
            
            <?php
            // Navigation
            the_post_navigation(array(
                'prev_text' => '<i class="fas fa-arrow-left"></i> Previous Post',
                'next_text' => 'Next Post <i class="fas fa-arrow-right"></i>',
            ));
            
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
