/**
 * You menu control
 */

( function() {
    'use strict';

    window.addEventListener( 'load', initYouMenu, false );

    function initYouMenu() {
        const gateways = document.getElementById( 'gateways-dropdown' );
        const input = document.getElementById( 'gateways-toggle' );

        input.addEventListener(
            'click',
            () => {
                gateways.classList.toggle( 'show-dropdown' );
                input.classList.toggle( 'gateways-toggle-checked' );

                if ( gateways.classList.contains( 'show-dropdown' ) ) {
                    input.setAttribute( 'aria-expanded', "true" );
                } else {
                    input.setAttribute( 'aria-expanded', "false" );
                }
            },
            false
        );

        window.addEventListener(
            'click',
            ( e ) => {
                if ( gateways.classList.contains( 'show-dropdown' ) && ! gateways.contains( e.target ) && ! input.contains( e.target ) ) {
                    gateways.classList.remove( 'show-dropdown' );
                    input.classList.remove( 'gateways-toggle-checked' );
                    input.setAttribute( 'aria-expanded', "false" );
                }
            },
            false
        );
    }
}() );
