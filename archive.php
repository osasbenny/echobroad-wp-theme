<?php
/**
 * The template for displaying archive pages
 *
 * @package EchoBroad
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container" style="padding: 80px 20px;">
        <header class="page-header" style="text-align: center; margin-bottom: 50px;">
            <?php
            the_archive_title('<h1 class="page-title" style="font-size: 2.5rem; margin-bottom: 20px;">', '</h1>');
            the_archive_description('<div class="archive-description" style="color: #666;">', '</div>');
            ?>
        </header>
        
        <?php if (have_posts()) : ?>
            <div class="archive-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
                <?php
                while (have_posts()) :
                    the_post();
                    
                    $post_type = get_post_type();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('archive-item'); ?> style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="archive-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div style="padding: 30px;">
                            <h2 style="font-size: 1.5rem; margin-bottom: 15px;">
                                <a href="<?php the_permalink(); ?>" style="color: #1a1a1a;"><?php the_title(); ?></a>
                            </h2>
                            
                            <div style="color: #666; margin-bottom: 20px;">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            
                            <?php if ($post_type === 'course') : ?>
                                <?php
                                $price = get_post_meta(get_the_ID(), '_course_price', true);
                                if ($price) :
                                    ?>
                                    <p style="color: #FF0050; font-size: 1.5rem; font-weight: 700; margin-bottom: 15px;">₦<?php echo number_format($price); ?></p>
                                <?php endif; ?>
                            <?php elseif ($post_type === 'product') : ?>
                                <?php
                                $price = get_post_meta(get_the_ID(), '_product_price', true);
                                if ($price) :
                                    ?>
                                    <p style="color: #FF0050; font-size: 1.5rem; font-weight: 700; margin-bottom: 15px;">From ₦<?php echo number_format($price); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="cta-button cta-button-navy" style="display: inline-block;">Learn More</a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>
            
            <div style="margin-top: 50px;">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i class="fas fa-arrow-left"></i> Previous',
                    'next_text' => 'Next <i class="fas fa-arrow-right"></i>',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <p style="text-align: center; font-size: 1.2rem; color: #666;">No items found.</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
