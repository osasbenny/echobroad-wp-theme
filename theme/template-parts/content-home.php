<?php
/**
 * Template part for displaying homepage content with exact EchoBroad content
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
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-share-alt"></i></div>
                <h3 class="service-title">Social Media Marketing</h3>
                <p class="service-description">Build your brand presence across all major platforms</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-bullhorn"></i></div>
                <h3 class="service-title">Paid Advertising</h3>
                <p class="service-description">Maximize ROI with expertly managed ad campaigns</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-pen-fancy"></i></div>
                <h3 class="service-title">Content Creation</h3>
                <p class="service-description">Captivate your audience with high-quality content</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-chart-bar"></i></div>
                <h3 class="service-title">Analytics & Reporting</h3>
                <p class="service-description">Data-driven insights to optimize your marketing</p>
            </div>
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
            <div class="product-card">
                <div class="product-image">
                    <div class="product-image-icon"><i class="fas fa-shopping-bag"></i></div>
                </div>
                <div class="product-content">
                    <h3 class="product-title">Ad Templates</h3>
                    <p class="product-description">Ready-to-use templates for high-converting ads</p>
                    <p class="product-price">From ₦7,500</p>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-image-icon"><i class="fas fa-bullseye"></i></div>
                </div>
                <div class="product-content">
                    <h3 class="product-title">Strategy Toolkits</h3>
                    <p class="product-description">Complete marketing strategy frameworks</p>
                    <p class="product-price">From ₦10,000</p>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-image-icon"><i class="fas fa-bolt"></i></div>
                </div>
                <div class="product-content">
                    <h3 class="product-title">Design Packs</h3>
                    <p class="product-description">Professional design templates for your brand</p>
                    <p class="product-price">From ₦9,000</p>
                </div>
            </div>
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
                    <a href="<?php echo esc_url(home_url('/courses')); ?>" class="cta-button cta-button-navy">Learn More</a>
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
                    <a href="<?php echo esc_url(home_url('/courses')); ?>" class="cta-button cta-button-navy">Learn More</a>
                </div>
            </div>
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
            <div class="testimonial-card">
                <div class="testimonial-quote">"</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">EchoBroad Agency transformed our digital presence. Their strategic approach to social media marketing increased our engagement by 300% in just 3 months.</p>
                <p class="testimonial-author">John Adeyemi</p>
                <p class="testimonial-position">Tech Startup CEO</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote">"</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">The ROI we've seen from their Facebook ad campaigns is incredible. They truly understand how to reach and convert our target audience.</p>
                <p class="testimonial-author">Sarah Okonkwo</p>
                <p class="testimonial-position">E-commerce Brand Owner</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-quote">"</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">Professional, creative, and results-driven. EchoBroad helped us scale our business through effective digital marketing strategies.</p>
                <p class="testimonial-author">Michael Bello</p>
                <p class="testimonial-position">Restaurant Chain Manager</p>
            </div>
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
            <article class="blog-card">
                <div class="blog-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/blog-1.jpg'); ?>" alt="Facebook Ad Strategies">
                </div>
                <div class="blog-content">
                    <p class="blog-category">PAID ADVERTISING</p>
                    <h3 class="blog-title">10 Facebook Ad Strategies That Actually Work in 2025</h3>
                    <p class="blog-excerpt">Discover the latest Facebook advertising strategies that are driving real results for businesses in 2025.</p>
                    <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            <article class="blog-card">
                <div class="blog-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/blog-2.jpg'); ?>" alt="Instagram Growth">
                </div>
                <div class="blog-content">
                    <p class="blog-category">SOCIAL MEDIA</p>
                    <h3 class="blog-title">The Ultimate Guide to Instagram Growth in 2025</h3>
                    <p class="blog-excerpt">Learn proven strategies to grow your Instagram following organically and build an engaged community.</p>
                    <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            <article class="blog-card">
                <div class="blog-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/blog-3.jpg'); ?>" alt="Landing Pages">
                </div>
                <div class="blog-content">
                    <p class="blog-category">CONVERSION OPTIMIZATION</p>
                    <h3 class="blog-title">How to Create High-Converting Landing Pages</h3>
                    <p class="blog-excerpt">Master the art of landing page design with these proven tips and best practices.</p>
                    <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
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
            <div class="faq-item">
                <button class="faq-question">
                    What exactly does Echobroad Agency do?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>We are a full-service digital marketing agency specializing in social media marketing, paid advertising, content creation, and analytics. We help businesses grow their online presence and convert views into clients.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    I'm new to online advertising. Can you guide me?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! We offer both done-for-you services and comprehensive training courses. Our team will guide you through every step of your digital marketing journey.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How much do your services cost?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Our pricing varies based on your specific needs and goals. Contact us for a free consultation and custom quote tailored to your business.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How long before I start seeing results from ads?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Results can vary, but most clients start seeing initial results within 2-4 weeks. Significant growth typically occurs within 2-3 months of consistent campaigns.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Do you work with businesses outside Nigeria?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Yes! We work with businesses globally. Our digital services can be delivered remotely to clients anywhere in the world.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    What's the difference between your training and done-for-you service?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Our training courses teach you how to run your own campaigns, while our done-for-you service means we handle everything for you. Choose based on your time and expertise.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    What platforms do you run ads on?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>We run ads on Facebook, Instagram, Google, YouTube, LinkedIn, and other major platforms based on where your target audience is most active.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Can you design my website or sales funnel?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Yes! We offer website design and sales funnel creation as part of our comprehensive digital marketing services.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    I already have ads running but they're not performing. Can you fix them?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! We specialize in ad optimization and can audit your current campaigns to identify issues and implement improvements.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How do I get started with Echobroad?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>Simply contact us through our website or WhatsApp to book a free strategy session. We'll discuss your goals and create a custom plan for your business.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    Do you guarantee results?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>While we can't guarantee specific numbers, we use proven strategies and continuously optimize campaigns to maximize your ROI and achieve the best possible results.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How can I contact Echobroad directly?
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <p>You can reach us via email at info@echobroad.com, call us at +2349071447959, or visit our office at 30 East West Road, Rumuodara, Port Harcourt.</p>
                </div>
            </div>
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
