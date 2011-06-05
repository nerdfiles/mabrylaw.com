/**
 * global.js
 */

$script.ready('jquery', function() {

// other stuff

    $('html.no-js').removeClass('no-js').addClass('js-enabled');

// domready

    $(document).ready(function() {
        $('input[name="s"]').focus();
        
        $('input[name="s"]').attr('tabindex', '1');
        $('#skip-language-switcher').attr('tabindex', '2');
        $('#skip-main').attr('tabindex', '3');
        $('#skip-search').attr('tabindex', '4');
        $('#skip-primary').attr('tabindex', '5');
        $('#logo').attr('tabindex', '6');
        
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
        
        $('#s').attr('placeholder', 'What would you like to find?');
        
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

