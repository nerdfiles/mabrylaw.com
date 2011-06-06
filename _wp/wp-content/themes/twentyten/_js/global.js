/**
 * global.js
 */

$script.ready('jquery', function() {
    
// plugin init

    $.metadata.setType("attr", "validate");

// other stuff

    $('html.no-js').removeClass('no-js').addClass('js-enabled');

// domready

    $(document).ready(function() {
        
        // Set active page 
        
        $("a[title='"+$.trim($('h1').text())+"']").each(function() {
            
            //$(this).addClass('current-page').parent().addClass('current-page-container');
            
            $(this).animate({
                opacity: .5
            }, 300).delay(100).animate({
                opacity: 1
            }, 200);
        });
        
        // Set focus to search
        
        $('input[name="s"]').focus();
        
        // Init 
        
        $('input[name="s"]').attr('tabindex', '1');
        $('#skip-language-switcher').attr('tabindex', '2');
        $('#skip-main').attr('tabindex', '3');
        $('#skip-search').attr('tabindex', '4');
        $('#skip-primary').attr('tabindex', '5');
        $('#logo').attr('tabindex', '6');
        
        // Config main navigation
        
        //$('#nav li').addClass('originize');
        $('#nav ul li ul').addClass('hide');
        $('#menu-main-navigation').addClass('clearfix');
        $('#nav ul li').hover(function() {
            $(this).addClass('hover');
            $(this).find('ul').removeClass('hide').addClass('show-sub-menu');
        }, function() {
            $(this).removeClass('hover');
            $(this).find('ul').addClass('hide').removeClass('show-sub-menu');
        });
        
        // Set placeholder for modern browsers
        
        $('#s').attr('placeholder', 'What would you like to find?');
        
        /**
         * Form Validation
         */
        
        /* Contact Form validation */
       
        $('#wpcf7-f1-p209-o1 form').attr('id', 'form_wpcf7-f1-p209-o1');  // Give Contact form id for plugin
        
        // Inputs 
        $('input[name="input_fullName"]').attr('validate', '{required:true, messages: { \
            required: "Please provide your full name." \
        }}');
        $('input[name="input_email"]').attr('validate', '{required:true, messages: { \
            required: "Please provide a valid e-mail address." \
        }}');
        $('input[name="input_subject"]').attr('validate', '{required:true, messages: { \
            required: "What is your message about?" \
        }}');
        $('textarea[name="textarea_message"]').attr('validate', '{required:true, messages: { \
            required: "What would you like to say?" \
        }}');
        
        $('#wpcf7-f1-p209-o1 form').validate(); // Contact Form validation
        
        /* Request Legal Services Form validation */
        
        $('#wpcf7-f1-p215-o1 form').attr('id', 'formwpcf7-f2-p215-o1 form') // Give Request Legal Services form id for plugin
        
        // Inputs
        
        $('#wpcf7-f1-p215-o1 form').validate(); // Request Legal Services Form validation
        
    });

/**
 * Carousel
 */
    
    function goToItem(carousel, itemClicked) {
    
                var $lastItem = carousel.find('li.carousel-item-visible'),
                    l = carousel.find('li.carousel-item-visible').next().length,
                    $currentItem = carousel.find('li:eq('+(itemClicked-1)+')');
                                
                $currentItem
                    .animate({
                        opacity: 'show',
                        easing: 'swing'
                    }, 1500)
                    .removeClass("bleach")
                    .addClass('carousel-item-visible')
                    .queue(function() {
                        
                        $lastItem
                            .animate({
                                opacity: 'hide',
                                easing: 'swing'
                            }, 1500)
                            .removeClass('carousel-item-visible');
                                    
                        $currentItem.dequeue();
                        
                    });
    
    }
        
    $('#carousel ul').each(function(e) {
        var carousel = $(this);
        var paused = false,
            $carouselItemVisible = $('.carousel-item-visible');
        
        carousel.find('li:gt(0)').css({
            display: "none",
            left: 0
        });
        
        /*
        carousel.after("<a href='#3' class='goto-carousel-item'>1</a>");
        carousel.after("<a href='#3' class='goto-carousel-item'>2</a>");
        carousel.after("<a href='#3' class='goto-carousel-item'>3</a>");
        */
        
        $('.goto-carousel-item').live('click', function(e) {
            
            var $self = $(this),
                itemClicked = $self.text();
            
            goToItem(carousel, itemClicked);
            
            e.preventDefault();
            
        });
        
        carousel.find('li:eq(0)').addClass('carousel-item-visible');
        
        carouseler = window.setInterval(function() {
                
            var $lastItem = carousel.find('li.carousel-item-visible'),
                l = carousel.find('li.carousel-item-visible').next().length,
                $currentItem = (l > 0) ? 
                       carousel.find('li.carousel-item-visible').next() :
                       carousel.find('li.carousel-item').first();
               
            if (paused == true) {
                return false;
            }
                            
            $currentItem
                .animate({
                    opacity: 'show',
                    easing: 'swing'
                }, 1500)
                .removeClass("bleach")
                .addClass('carousel-item-visible')
                .queue(function() {
                    
                    $lastItem
                        .animate({
                            opacity: 'hide',
                            easing: 'swing'
                        }, 1500, function() {
                            
                        })
                        .removeClass('carousel-item-visible');
                          
                    $currentItem.dequeue();
                    
                });
                
                //carousel.find('li div.carousel-text-container').css({opacity: "0", left: "-9999px"});
                //$('div.carousel-text-container').css({opacity: "0.4", left: "0px" });
        
            
            //return current;
                            
        }, 7000);
        
        $carouselItemVisible.live('mouseover', function() {
            paused = true;
        });
        
        $carouselItemVisible.live('mouseout', function() {
            paused = false;
        });
    
    });

}); // global.js

