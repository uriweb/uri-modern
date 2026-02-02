/**
 * Main Menu Dropdown for Mobile
 */

( function() {
    'use strict';

    window.addEventListener( 'load', initMainMenuDropdown, false );

    function initMainMenuDropdown() {
        
        const mmbutton = document.getElementById( 'globalnav-label' );
      
      const mmdropdown = document.getElementById( 'globalnav-menu' );

        mmbutton.addEventListener(
            'click',
            () => {
                mmbutton.classList.toggle( 'globalnav-label-checked' );
              console.log(mmbutton.classList);
              mmdropdown.classList.toggle('globalnav-show-dropdown');
              console.log(mmdropdown.classList);

                if ( mmbutton.classList.contains( 'globalnav-label-checked' ) ) {
                    mmbutton.setAttribute( 'aria-expanded', "true" );
                } else {
                    mmbutton.setAttribute( 'aria-expanded', "false" );
                }
            },
            false
        );

        window.addEventListener(
            'click',
            ( e ) => {
                if ( mmbutton.classList.contains( 'globalnav-label-checked' ) && ! mmbutton.contains( e.target ) && ! mmbutton.contains( e.target ) ) {
                    mmbutton.classList.remove( 'globalnav-label-checked' );
             
                    mmbutton.setAttribute( 'aria-expanded', "false" );
                }
            },
            false
        );
    }
}() );