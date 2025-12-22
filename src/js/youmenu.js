/**
 * You menu control
 */

(function () {
    'use strict';

    window.addEventListener('load', initYouMenu, false);

    function initYouMenu()
    {
        const gateways = document.getElementById('gateways');
        const input = document.getElementById('gateways-toggle');

        window.addEventListener(
            'click',
            function ( e ) {
                if (input.checked && ! gateways.contains(e.target) ) {
                    input.checked = false;
                }
            },
            false
        );
    }
}());