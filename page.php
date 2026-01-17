<?php
/**
 * The template for displaying all pages
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
                <header class="entry-header" style="text-align: center; margin-bottom: 50px;">
                    <h1 class="entry-title" style="font-size: 2.5rem;"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail" style="margin-bottom: 30px;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content" style="line-height: 1.8; font-size: 1.1rem; max-width: 900px; margin: 0 auto;">
                    <?php the_content(); ?>
                </div>
            </article>
            
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
