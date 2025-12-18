// CSRF Token setup for AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Navbar scroll effect
$(window).scroll(function() {
    const navbar = $('.navbar');
    if ($(window).scrollTop() > 50) {
        navbar.addClass('navbar-scrolled');
    } else {
        navbar.removeClass('navbar-scrolled');
    }
});

// Smooth scrolling for anchor links
$('a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    
    const targetId = $(this).attr('href');
    if(targetId === '#') return;
    
    const targetElement = $(targetId);
    if(targetElement.length) {
        $('html, body').animate({
            scrollTop: targetElement.offset().top - 80
        }, 800);
    }
});

// Fade-in animation on scroll
function fadeInOnScroll() {
    $('.fade-in').each(function() {
        const elementTop = $(this).offset().top;
        const elementVisible = 150;
        
        if ($(window).scrollTop() + $(window).height() > elementTop + elementVisible) {
            $(this).addClass('visible');
        }
    });
}

$(window).on('scroll', fadeInOnScroll);
// Initial check on page load
$(document).ready(function() {
    fadeInOnScroll();
    
    // Form submission
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.text();
        
        // Disable button and show loading
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Mengirim...');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                // Show success message
                alert(response.message);
                
                // Reset form
                $('#contactForm')[0].reset();
                
                // Re-enable button
                submitBtn.prop('disabled', false).text(originalText);
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors).join('\n');
                }
                
                alert(errorMessage);
                
                // Re-enable button
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });
    
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});