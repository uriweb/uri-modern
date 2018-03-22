/*
 * The Stage
 */

(function(){
    
    'use strict';
    
    var header = document.getElementById('siteheader');
    
    window.addEventListener('load', initStage, false);
    
    function initStage() {
        
        var stage, header, animated;
        
        stage = document.getElementById('stage');
        if (stage !== null) {
            
            hideHeader();
            
            animated = stage.querySelector('.animated');
            if (animated !== null) {
                listenForAnimation(animated);
            }
            
            window.addEventListener('scroll', detectScroll);
            
        }
        
    }
    
    function detectScroll(animated) {
        
        animated = stage.querySelector('.animated');
        if (animated !== null) {
            animated.classList.add('endframe');
        }
        showHeader();
        window.removeEventListener('scroll', detectScroll);
        
    }
    
    function hideHeader() {
        header.style.display = 'none';
        if(CLResizeSuperheros !== null) {
            CLResizeSuperheros();
        }
    }
    
    function showHeader() {
        header.style.display = 'block';
        if(CLResizeSuperheros !== null) {
            CLResizeSuperheros();
        }
    }
    
    function whichTransitionEvent(){
        var t;
        var el = document.createElement('fakeelement');
        var transitions = {
            'animation':'animationend',
            'OAnimation':'oAnimationEnd',
            'MozAnimation':'animationend',
            'WebkitAnimation':'webkitAnimationEnd'
        }

        for(t in transitions){
            if( el.style[t] !== undefined ){
                return transitions[t];
            }
        }
    }

    function listenForAnimation(e) {
        
        var transitionEvent = whichTransitionEvent();
        
        console.log(e, transitionEvent);
        
        transitionEvent && e.addEventListener(transitionEvent, function() {
            showHeader();
        });
        
    }
    
    
})();