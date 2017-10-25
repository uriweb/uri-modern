/*
 * Local Nav control
 * WP menu items must be have classes in the format 'li-{slug}'
 */

(function(){
    
    'use strict';
    
    window.addEventListener('load', init, false);
    
    function init() {
        var classes = document.body.classList,
            ln = document.getElementById('localnav'),
            menu = ln.querySelector('ul'),
            i, x;
        
        /*
        var submenus = menu.querySelectorAll('ul');
        for (i=0; i<submenus.length; i++) {
            submenus[i].style.display = 'none';
        }
        */
        
        for (x in classes) {
            if (String(classes[x]).match(/^ln-/)) {
                var name = classes[x];
            }
        }
                
        var li = menu.querySelector('.' + name);
        
        li.classList.add('active');
                
    }
    
})();