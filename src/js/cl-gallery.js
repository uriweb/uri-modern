/*
 * Turn WP image galleries into something pretty.
 * Testing here, eventually offload to component library.
 */


(function(){
        
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
            
            img = figs[i].querySelector('img');
            if(img) {
                parts.img = img.getAttribute('src');
            }
            
            caption = figs[i].querySelector('figcaption');
            if(caption) {
                parts.caption = caption.innerHTML;
            }
            
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
        var S, carouselWrapper, carousel, li, caption, i;
                
        S = document.createElement('div');
        S.className = 'cl-slideshow';
        
        carouselWrapper = document.createElement('div');
        carouselWrapper.className = 'carousel-wrapper';
        S.appendChild(carouselWrapper);
        
        carousel = document.createElement('ul');
        carousel.className = 'carousel';
        carouselWrapper.appendChild(carousel);
                
        for (i=0; i<parsed.length; i++) {
                        
            li = document.createElement('li');
            li.className = 'slide';
            li.style.backgroundImage = 'url(' + parsed[i].img + ')';
            
            if (parsed[i].caption) {
                caption = document.createElement('div');
                caption.className = 'caption';
                caption.innerHTML = parsed[i].caption;
                
                li.appendChild(caption);
            }
                      
            carousel.appendChild(li);
            
        }
        
        S.appendChild(initDots(carousel, parsed));
        
        setPosition(carousel, 0);
            
        el.parentNode.replaceChild(S, el);
        
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
            li.className = 'dot';
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
            dots[i].classList.remove('active');
        }
        dots[index].classList.add('active');
        
    }
    
    
})();