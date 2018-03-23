/*
 * The Stage
 */

(function(){
    
    'use strict';
        
    window.addEventListener('load', initStage, false);
    
    function initStage() {
                
        var stage = document.getElementById('stage');
        
        if (stage !== null) {  
            setTheStage(stage);
        }
        
    }
    
    function setTheStage(stage) {
        
        var els = {};
        
        els.docClassList = document.body.classList;
                    
        els.docClassList.add('stage');
        document.getElementById('siteheader').appendChild(stage);
        
        var overlay = document.createElement('div');
        overlay.classList = "overlay";
        stage.insertBefore(overlay, stage.childNodes[0]);

        // Resize any superheros
        if(CLResizeSuperheros !== null) {
            CLResizeSuperheros();
        }

        // Store the masthead specs
        var masthead = document.getElementById('masthead');
        els.masthead = {
            el : masthead,
            h : masthead.offsetHeight,
            offset : masthead.getBoundingClientRect().top
        };
                
        // Store the stage specs
        els.stage = {
            el : stage,
            overlay : overlay,
            h : stage.offsetHeight,
            offset : stage.getBoundingClientRect().top,
            initialOffset : stage.getBoundingClientRect().top + window.pageYOffset
        };
        
        els.backdrop = document.getElementById('sb-backdrop');
        els.breadcrumbs = document.getElementById('breadcrumbs');
        els.content = document.getElementById('content');
        
        handleScroll(els);
        window.addEventListener('scroll', handleScroll.bind(null, els)); 
        window.addEventListener('resize', handleScroll.bind(null, els)); 
        
    }
    
    function handleScroll(els) {
                
        var contentPosition = els.content.getBoundingClientRect().top,
            windowHeight = window.innerHeight;
                        
        if (contentPosition <= els.masthead.h + els.masthead.offset) {
            if (!els.docClassList.contains('stage-fluid')) {
                els.docClassList.add('stage-fluid');
                els.masthead.el.style.top = windowHeight - els.masthead.h + els.masthead.offset + 'px';
            }
        } else {
            if (els.docClassList.contains('stage-fluid')) {
                els.docClassList.remove('stage-fluid');
                els.masthead.el.style.top = 'initial';
            }
        }
        
        var p = window.pageYOffset,
            h = els.stage.h - els.masthead.h,
            t = Math.min(p/h*1, 1),
            q = Math.pow(t / 1, 4);

        els.stage.overlay.style.cssText = '-webkit-backdrop-filter: blur(' + (t * 50) + 'px); background-color: rgba(250,250,250,' + t + ')';
        els.breadcrumbs.style.opacity = q;
        els.backdrop.style.opacity = q;
    }
    
})();