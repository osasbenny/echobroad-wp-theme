/**
 * EchoBroad Theme JavaScript
 */

(function($) {
    'use strict';
    
    // Mobile Menu Toggle
    $('.menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });
    
    // Scroll to Top Button
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('.scroll-to-top').addClass('visible');
        } else {
            $('.scroll-to-top').removeClass('visible');
        }
    });
    
    $('.scroll-to-top').on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });
    
    // FAQ Accordion
    $('.faq-question').on('click', function() {
        var $item = $(this).closest('.faq-item');
        
        // Close other items
        $('.faq-item').not($item).removeClass('active');
        
        // Toggle current item
        $item.toggleClass('active');
    });
    
    // Smooth Scroll for Anchor Links
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(event) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        }
    });
    
    // Add animation on scroll
    function animateOnScroll() {
        $('.feature-card, .service-card, .product-card, .course-card, .blog-card, .testimonial-card').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('fade-in');
            }
        });
    }
    
    $(window).on('scroll', animateOnScroll);
    $(document).ready(animateOnScroll);
    
})(jQuery);
