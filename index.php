<?php
/**
 * The main template file
 *
 * @package EchoBroad
 */

get_header();
?>

<main id="main-content" class="site-main">
    <?php if (is_home() || is_front_page()) : ?>
        <?php get_template_part('template-parts/content', 'home'); ?>
    <?php else : ?>
        <div class="container">
            <div class="content-area">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;
                    
                    the_posts_navigation();
                else :
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
