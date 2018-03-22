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
                    
        document.body.classList.add('stage');
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
        var M = {
            el : masthead,
            h : masthead.offsetHeight,
            offset : masthead.getBoundingClientRect().top
        };
                
        // Store the stage specs
        var S = {
            el : stage,
            overlay : overlay,
            h : stage.offsetHeight,
            offset : stage.getBoundingClientRect().top,
            initialOffset : stage.getBoundingClientRect().top + window.pageYOffset
        };
        
        var content = document.getElementById('content');

        //console.log(M, S);
        
        window.addEventListener('scroll', handleScroll.bind(null, M, S, content)); 
        
    }
    
    function handleScroll(M, S, content) {
                
        var scroll = content.getBoundingClientRect().top;
        //console.log(scroll);
        
        if (scroll < M.h + M.offset ) {
            document.body.classList.add('stage-fluid');
        } else {
            document.body.classList.remove('stage-fluid');
        }
        
        var p = window.pageYOffset,
            h = S.h + S.initialOffset,
            b = Math.min(p/h*50, 50),
            c = Math.min(p/h*1, 1);

        S.overlay.style.webkitBackdropFilter = 'blur(' + b + 'px)';
        S.overlay.style.backgroundColor = 'rgba(243,243,243,' + c + ')';
        
    }
    
})();