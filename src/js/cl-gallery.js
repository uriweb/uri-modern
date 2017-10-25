/*
 * Turn WP image galleries into something pretty.
 * Testing here, eventually offload to component library.
 */


(function(){
    
    var slideTimer,
        interval = 8000;
        
    window.addEventListener('load', init, false);
    
    function init() {
        var g, i;
        
        g = document.querySelectorAll('.gallery.gallery-size-full');
        for (i=0; i<g.length; i++) {
            parse(g[i]);
        } 
    }
    
    /*
     * Parse gallery element
     * @param el obj the gallery element
     */
    function parse(el) {
        
        var figs, i, parts, a, img, caption, parsed = [];
        
        figs = el.querySelectorAll('figure');
        
        for (i=0; i<figs.length; i++) {
            
            parts = {};
            
            a = figs[i].querySelector('a');
            if (a) {
                parts.a = a.getAttribute('href');
            }
            
            img = figs[i].querySelector('img');
            if(img) {
                parts.img = img.getAttribute('src');
            }
            
            /*
            caption = figs[i].querySelector('figcaption');
            if(caption) {
                parts.caption = caption.innerHTML;
            }
            */
            
            parsed.push(parts);
            
        }
        
        build(el, parsed);
                
    }
    
    
    /*
     * Build slideshow DOM
     * @param el obj the gallery element
     * @param parsed obj the parsed gallery
     */
    function build(el, parsed) {
        var S, carouselWrapper, carousel, li, html, i, button;
                
        S = document.createElement('div');
        S.className = 'cl-slideshow';
        
        carouselWrapper = document.createElement('div');
        carouselWrapper.className = 'carousel-wrapper';
        S.appendChild(carouselWrapper);
        
        carousel = document.createElement('ul');
        carouselWrapper.appendChild(carousel);
                
        for (i=0; i<parsed.length; i++) {
                        
            li = document.createElement('li');
            
            html = '';
            
            html += '<a href="' + parsed[i].a + '">';
            html += '<img src="' + parsed[i].img + '">';
            html += '</a>';
            
            /*
            if (parsed[i].caption) {
                html += '<span>' + parsed[i].caption + '</span>';
            }
            */
            
            li.innerHTML = html;
                        
            carousel.appendChild(li);
            
        }
        
        button = document.createElement('div');
        button.className = 'motionswitch';
        button.title = 'Pause';
        button.addEventListener('click', motionHandler.bind(null, carousel), false);
        carouselWrapper.appendChild(button);
        
        S.appendChild(initDots(carousel, parsed));
        
        setPosition(carousel, 0);
        
        initAutoAdvance(carousel);
    
        el.parentNode.replaceChild(S, el);
        
    }
    
    
    /*
     * Initiate auto advance
     * @param c obj the carousel
     */
    function initAutoAdvance(c) {
		c.parentNode.addEventListener('mouseover', function() {
			window.clearTimeout(slideTimer);
		}, true );
		c.parentNode.addEventListener('mouseout', function() {
            if (!c.parentNode.classList.contains('paused')) {
                autoAdvance(c);
            }
		}, true );
		autoAdvance(c);
	}
	
    
    /*
     * Control the auto advance timer
     * @param c obj the carousel
     */
	function autoAdvance(c) {
		window.clearTimeout(slideTimer);
		var adv = function(c) {
            controlDirection(c, 'Next');
			autoAdvance(c);
		};
		slideTimer = window.setTimeout(adv, interval, c);
	}
    
    
    /*
     * Handle the motion switch
     * @param c obj the carousel
     */
    function motionHandler(c) {
        
        var p = c.parentNode;
        
        if (p.classList.contains('paused')) {
            p.classList.remove('paused');
            autoAdvance(c);
        } else {
            p.classList.add('paused');
            window.clearTimeout(slideTimer);
        }
        
    }
    
    
    /*
     * Initiate nav dots
     * @param c obj the carousel
     * @param parsed obj the parsed gallery
     */
    function initDots(c, parsed) {
        var ul, li, i;
        
        ul = document.createElement('ul');
        ul.className = 'navdots';
        
        for (i=0; i<parsed.length; i++) {
            li = document.createElement('li');
            li.title = 'Slide ' + (i + 1);
            li.innerHTML = i + 1;
            li.addEventListener('click', setPosition.bind(null, c, i) );
            ul.appendChild(li);
        }
        
        return ul;
         
    }
    
    
    /*
     * Control direction of movement
     * @param c obj the carousel
     * @param direction str the direction to move in
     */
    function controlDirection(c, direction) {
		var index, count;
		index = c.getAttribute('data-position');
		count = c.children.length -1;
		
		if(direction == 'Next') {
			index++;
			if(index > count) {
				index = 0;
			}
		} else {
			index--;
			if(index < 0) {
				index = count;
			}
		}
        
		setPosition(c, index);
	}
    
    
    /*
     * Set position of slideshow
     * @param c obj the carousel
     * @param index int the index to move to
     */
    function setPosition(c, index) {
                
        var dots, i;
        
        c.style.transform = 'translateX(-' + (index * 100) + '%)';
        c.setAttribute('data-position', index);
        
        dots = c.parentNode.parentNode.querySelector('.navdots').querySelectorAll('li');
        for(i=0; i<dots.length; i++) {
            dots[i].className = '';
        }
        dots[index].className = 'active';
        
    }
    
    
})();