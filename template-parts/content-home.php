<?php
/**
 * Template part for displaying homepage content
 *
 * @package EchoBroad
 */
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Amplify Your Brand's <span class="highlight">Voice</span></h1>
        <p class="hero-subtitle">From Strategy To Visuals, We Help Businesses Turn Views To Clients!</p>
        <div class="hero-buttons">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Book A Free Strategy Session</a>
            <a href="<?php echo esc_url(home_url('/courses')); ?>" class="cta-button cta-button-yellow">Explore Courses</a>
        </div>
    </div>
</section>

<!-- Why Choose EchoBroad Section -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose <span class="highlight">EchoBroad</span>?</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                <h3 class="feature-title">Strategic Marketing</h3>
                <p class="feature-description">Data-driven strategies that deliver measurable results for your brand.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h3 class="feature-title">Creative Excellence</h3>
                <p class="feature-description">Stunning visuals and compelling content that captivate your audience.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3 class="feature-title">Growth Focused</h3>
                <p class="feature-description">Proven methods to scale your business and maximize ROI.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h3 class="feature-title">Expert Team</h3>
                <p class="feature-description">Experienced professionals dedicated to your success.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section services-section">
    <div class="container">
        <div class="section-title">
            <h2>Our <span class="highlight">Services</span></h2>
            <p class="section-subtitle">Comprehensive digital marketing solutions tailored to your needs</p>
        </div>
        <div class="services-grid">
            <?php
            $services_query = new WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => 4,
            ));
            
            if ($services_query->have_posts()) :
                while ($services_query->have_posts()) : $services_query->the_post();
                    ?>
                    <div class="service-card">
                        <div class="service-icon"><i class="fas fa-share-alt"></i></div>
                        <h3 class="service-title"><?php the_title(); ?></h3>
                        <p class="service-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default services if none are created
                $default_services = array(
                    array('icon' => 'fa-share-alt', 'title' => 'Social Media Marketing', 'desc' => 'Build your brand presence across all major platforms'),
                    array('icon' => 'fa-bullhorn', 'title' => 'Paid Advertising', 'desc' => 'Maximize ROI with expertly managed ad campaigns'),
                    array('icon' => 'fa-pen-fancy', 'title' => 'Content Creation', 'desc' => 'Captivate your audience with high-quality content'),
                    array('icon' => 'fa-chart-bar', 'title' => 'Analytics & Reporting', 'desc' => 'Data-driven insights to optimize your marketing'),
                );
                
                foreach ($default_services as $service) :
                    ?>
                    <div class="service-card">
                        <div class="service-icon"><i class="fas <?php echo esc_attr($service['icon']); ?>"></i></div>
                        <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                        <p class="service-description"><?php echo esc_html($service['desc']); ?></p>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url(home_url('/services')); ?>" class="cta-button cta-button-navy">View All Services</a>
        </div>
    </div>
</section>

<!-- Trusted Brands Section -->
<section class="section brands-section">
    <div class="container">
        <div class="section-title">
            <h2>Trusted by <span class="highlight">Leading Brands</span></h2>
        </div>
        <div class="brands-grid">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
                <div class="brand-logo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/brand-' . $i . '.png'); ?>" alt="Brand Logo">
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="section products-section">
    <div class="container">
        <div class="section-title">
            <h2>Digital Products <span class="highlight">& Resources</span></h2>
            <p class="section-subtitle">Premium templates, guides, and toolkits to accelerate your marketing</p>
        </div>
        <div class="products-grid">
            <?php
            $products_query = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => 3,
            ));
            
            if ($products_query->have_posts()) :
                while ($products_query->have_posts()) : $products_query->the_post();
                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $icon = get_post_meta(get_the_ID(), '_product_icon', true);
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <div class="product-image-icon"><i class="fas <?php echo esc_attr($icon ? $icon : 'fa-shopping-bag'); ?>"></i></div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><?php the_title(); ?></h3>
                            <p class="product-description"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                            <p class="product-price">From ₦<?php echo esc_html($price ? number_format($price) : '0'); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default products
                $default_products = array(
                    array('icon' => 'fa-shopping-bag', 'title' => 'Ad Templates', 'desc' => 'Ready-to-use templates for high-converting ads', 'price' => '7,500'),
                    array('icon' => 'fa-bullseye', 'title' => 'Strategy Toolkits', 'desc' => 'Complete marketing strategy frameworks', 'price' => '10,000'),
                    array('icon' => 'fa-bolt', 'title' => 'Design Packs', 'desc' => 'Professional design templates for your brand', 'price' => '9,000'),
                );
                
                foreach ($default_products as $product) :
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <div class="product-image-icon"><i class="fas <?php echo esc_attr($product['icon']); ?>"></i></div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title"><?php echo esc_html($product['title']); ?></h3>
                            <p class="product-description"><?php echo esc_html($product['desc']); ?></p>
                            <p class="product-price">From ₦<?php echo esc_html($product['price']); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url(home_url('/products')); ?>" class="cta-button cta-button-navy">View All Products</a>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="section courses-section">
    <div class="container">
        <div class="section-title">
            <h2>Master Digital <span class="highlight">Marketing</span></h2>
            <p class="section-subtitle">Learn from industry experts and transform your career</p>
        </div>
        <div class="courses-grid">
            <?php
            $courses_query = new WP_Query(array(
                'post_type' => 'course',
                'posts_per_page' => 2,
            ));
            
            if ($courses_query->have_posts()) :
                while ($courses_query->have_posts()) : $courses_query->the_post();
                    $price = get_post_meta(get_the_ID(), '_course_price', true);
                    $level = get_post_meta(get_the_ID(), '_course_level', true);
                    ?>
                    <div class="course-card">
                        <div class="course-header">
                            <div class="course-icon"><i class="fas fa-book"></i></div>
                            <div class="course-meta">
                                <h3><?php the_title(); ?></h3>
                                <p class="course-level"><?php echo esc_html($level ? $level : 'All Levels'); ?></p>
                            </div>
                        </div>
                        <p class="course-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="course-footer">
                            <p class="course-price">₦<?php echo esc_html($price ? number_format($price) : '0'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="cta-button cta-button-navy">Learn More</a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default courses
                ?>
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-icon"><i class="fas fa-book"></i></div>
                        <div class="course-meta">
                            <h3>Facebook Ads Mastery</h3>
                            <p class="course-level">Beginner to Advanced</p>
                        </div>
                    </div>
                    <p class="course-description">Learn how to create, manage, and scale Facebook ads effectively with proven strategies.</p>
                    <div class="course-footer">
                        <p class="course-price">₦35,000</p>
                        <a href="#" class="cta-button cta-button-navy">Learn More</a>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-header">
                        <div class="course-icon"><i class="fas fa-book"></i></div>
                        <div class="course-meta">
                            <h3>Agency Starter Course</h3>
                            <p class="course-level">Build Your Business</p>
                        </div>
                    </div>
                    <p class="course-description">Start and scale your own digital agency using ads and automation strategies.</p>
                    <div class="course-footer">
                        <p class="course-price">₦50,000</p>
                        <a href="#" class="cta-button cta-button-navy">Learn More</a>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url(home_url('/courses')); ?>" class="cta-button cta-button-yellow">Browse All Courses</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section testimonials-section">
    <div class="container">
        <div class="section-title">
            <h2>What Our <span class="highlight">Clients Say</span></h2>
        </div>
        <div class="testimonials-grid">
            <?php
            $testimonials_query = new WP_Query(array(
                'post_type' => 'testimonial',
                'posts_per_page' => 3,
            ));
            
            if ($testimonials_query->have_posts()) :
                while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                    $author = get_post_meta(get_the_ID(), '_testimonial_author', true);
                    $position = get_post_meta(get_the_ID(), '_testimonial_position', true);
                    $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                    ?>
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <div class="testimonial-stars">
                            <?php
                            for ($i = 0; $i < ($rating ? $rating : 5); $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            ?>
                        </div>
                        <p class="testimonial-text"><?php the_content(); ?></p>
                        <p class="testimonial-author"><?php echo esc_html($author); ?></p>
                        <p class="testimonial-position"><?php echo esc_html($position); ?></p>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default testimonials
                $default_testimonials = array(
                    array(
                        'text' => 'EchoBroad Agency transformed our digital presence. Their strategic approach to social media marketing increased our engagement by 300% in just 3 months.',
                        'author' => 'John Adeyemi',
                        'position' => 'Tech Startup CEO'
                    ),
                    array(
                        'text' => 'The ROI we\'ve seen from their Facebook ad campaigns is incredible. They truly understand how to reach and convert our target audience.',
                        'author' => 'Sarah Okonkwo',
                        'position' => 'E-commerce Brand Owner'
                    ),
                    array(
                        'text' => 'Professional, creative, and results-driven. EchoBroad helped us scale our business through effective digital marketing strategies.',
                        'author' => 'Michael Bello',
                        'position' => 'Restaurant Chain Manager'
                    ),
                );
                
                foreach ($default_testimonials as $testimonial) :
                    ?>
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <div class="testimonial-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text"><?php echo esc_html($testimonial['text']); ?></p>
                        <p class="testimonial-author"><?php echo esc_html($testimonial['author']); ?></p>
                        <p class="testimonial-position"><?php echo esc_html($testimonial['position']); ?></p>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="section blog-section">
    <div class="container">
        <div class="section-title">
            <h2>Latest from Our <span class="highlight">Blog</span></h2>
            <p class="section-subtitle">Insights and strategies to help you succeed</p>
        </div>
        <div class="blog-grid">
            <?php
            $blog_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
            ));
            
            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    ?>
                    <article class="blog-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-image">
                                <?php the_post_thumbnail('echobroad-blog'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="blog-content">
                            <p class="blog-category"><?php echo get_the_category_list(', '); ?></p>
                            <h3 class="blog-title"><?php the_title(); ?></h3>
                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="cta-button cta-button-navy">View All Posts</a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section faq-section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked <span class="highlight">Questions</span></h2>
            <p class="section-subtitle">Check out our FAQ section. We might have answered your question already.</p>
        </div>
        <div class="faq-container">
            <?php
            $faqs = array(
                array('q' => 'What exactly does Echobroad Agency do?', 'a' => 'We are a full-service digital marketing agency specializing in social media marketing, paid advertising, content creation, and analytics. We help businesses grow their online presence and convert views into clients.'),
                array('q' => 'I\'m new to online advertising. Can you guide me?', 'a' => 'Absolutely! We offer both done-for-you services and comprehensive training courses. Our team will guide you through every step of your digital marketing journey.'),
                array('q' => 'How much do your services cost?', 'a' => 'Our pricing varies based on your specific needs and goals. Contact us for a free consultation and custom quote tailored to your business.'),
                array('q' => 'How long before I start seeing results from ads?', 'a' => 'Results can vary, but most clients start seeing initial results within 2-4 weeks. Significant growth typically occurs within 2-3 months of consistent campaigns.'),
                array('q' => 'Do you work with businesses outside Nigeria?', 'a' => 'Yes! We work with businesses globally. Our digital services can be delivered remotely to clients anywhere in the world.'),
            );
            
            foreach ($faqs as $index => $faq) :
                ?>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php echo esc_html($faq['q']); ?>
                        <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                    </button>
                    <div class="faq-answer">
                        <p><?php echo esc_html($faq['a']); ?></p>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Grow Your Business?</h2>
        <p>Prefer a one-on-one session or done-for-you service? Join 5,000+ growing brands already transforming their results with Echobroad</p>
        <a href="<?php echo esc_url(home_url('/products')); ?>" class="cta-button-white">Browse Store</a>
    </div>
</section>
