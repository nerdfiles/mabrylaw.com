/**
 * global.js
 */

$script.ready('jquery', function() {

// other stuff

    $('html.no-js').removeClass('no-js').addClass('js-enabled');

// domready

    $(document).ready(function() {
        
        // plugin init

        $.metadata.setType("attr", "validate");
        
        // Wicked credit to
        // http://www.zachstronaut.com/posts/2009/01/18/jquery-smooth-scroll-bugs.html
        
        var scrollElement = 'html, body';
        
        /*
        $('html, body').each(function () {
            var initScrollTop = $(this).attr('scrollTop');
            $(this).attr('scrollTop', initScrollTop + 1);
            if ($(this).attr('scrollTop') == initScrollTop + 1) {
                scrollElement = this.nodeName.toLowerCase();
                $(this).attr('scrollTop', initScrollTop);
                return false;
            }    
        });
        */
        
        // Smooth scrolling for internal links
        
        $("a[href^='#']").click(function(event) {
            event.preventDefault();
            
            var $this = $(this),
            target = this.hash,
            $target = $(target);
            
            $(scrollElement).stop().animate({
                'scrollTop': $target.offset().top
            }, 500, 'swing', function() {
                window.location.hash = target;
            });
            
        });
        
        // ...
        
        /*
        if ( $(window.location.hash).length ) {
            $(scrollElement).stop().delay(700).animate({
                'scrollTop': $(window.location.hash).offset().top
            }, 2000);
        }
        */
        
        
        // Set active page 
        
        $("a[title='"+$.trim($('h1').text())+"']").each(function() {
            
            //$(this).addClass('current-page').parent().addClass('current-page-container');
            
            $(this).animate({
                opacity: .5
            }, 100).delay(50).animate({
                opacity: 1
            }, 200);
        });
        
        // Clean up
        
        $('a[title="Added with HTML Javascript Adder Wordpress plugin"]').animate({
            opacity: .2
        }, 100);
        
        // Set external
        
        $('a[rel="external"]').bind('click', function(e) {
            var $self = $(this);
            $self.addClass('external');
            window.open($self.attr('href'));
            e.preventDefault();
        });
        
        // Show Google Map
        
        $('#google-map').delay(100).removeClass('hide').hide().delay(100).fadeIn();
        
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
        
        // Inputs (introduced at...)
        
        $('input[name="input_fullName"]').attr('validate', '{required:true, messages: { required: "Please provide your full name." }}');
        $('input[name="input_email"]').attr('validate', '{required:true, email: true, messages: { required: "Please provide a valid e-mail address." }}');
        $('input[name="input_subject"]').attr('validate', '{required:true, messages: { required: "What is your message about?" }}');
        $('textarea[name="textarea_message"]').attr('validate', '{required:true, messages: { required: "What would you like to say?" }}');
        
        $('#wpcf7-f1-p209-o1 form').validate({
            submitHandler: function(form) {
                
                /*
                var $form = $(form);
                
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(html){
                        var $o = $(html).find('.wpcf7-response-output');
                        $form.find('.wpcf7-response-output').remove();
                        $form.prepend( $o );
                        $(scrollElement).stop().delay(700).animate({
                            'scrollTop': $('.wpcf7-response-output').offset().top
                        }, 2000, 'swing');
                    }
                });
                */
               
                $('body').stop().delay(700).animate({
                    'scrollTop': 0
                }, 2000, function() {
                    form.submit();
                });
                
            }
        }); // Contact Form validation
        
        /* Request Legal Services Form validation */
        
        $('#wpcf7-f2-p215-o1 form').attr('id', 'form_wpcf7-f2-p215-o1') // Give Request Legal Services form id for plugin
        
        // Inputs (introduced at...)
        
        $('input[name="input_phone"]').attr('validate', '{required:true, phoneUS: true, messages: { required: "Please provide a contact number." }}');
        $('input[name="input_documents"]').attr('validate', '{required:true, messages: { required: "Please provide some documentation to your case." }}');
        
        $('#wpcf7-f2-p215-o1 form').validate({
            submitHandler: function(form) {
                
                /*
                var $form = $(form),
                    $form_clone = $form.clone();
                    
                $form_iframe = $('<iframe id="form_iframe">');
                $('body').append($form_iframe);
                $('#form_iframe').contents().find('body').append($form_clone);
                $('#form_iframe').contents().find('form').submit();
                */
                
                form.submit();
                
            }
        }); // Request Legal Services Form validation
        
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
