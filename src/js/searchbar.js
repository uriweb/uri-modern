/*
 * Search Bar Focus Control
 */

(function(){
    
    'use strict';
    
    window.addEventListener('load', init, false);
    
    function init() {
        var gstoggle = document.getElementById('gsform-toggle'),
            gsquery = document.getElementById('gs-query');
        
        gstoggle.addEventListener('change', function() {
            this.checked ? gsquery.focus() : gsquery.blur();
        });
    }
    
})();