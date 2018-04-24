/**
 * Mobile breadcrumbs control
 *
 * @package uri-modern
 */

( function() {

    'use strict';

    window.addEventListener( 'load', initBreadcrumbs, false );

    function initBreadcrumbs() {

        var el, ol, crumbs, div;

        el = document.getElementById( 'breadcrumbs' );
        ol = el.querySelector( 'ol' );
        crumbs = ol.querySelectorAll( 'li' );
        
        el.classList.add( 'has-js' );

        div = document.createElement( 'div' );
        div.innerHTML = crumbs[crumbs.length - 2].querySelector( 'a' ).innerHTML;
        div.addEventListener( 'click', handleClick.bind( null, ol ) );

        el.insertBefore( div, ol );

    }

    function handleClick( ol ) {

        var c = 'active';

        if ( ol.classList.contains( c ) ) {
            ol.classList.remove( c );
        } else {
            ol.classList.add( c );
        }

    }

})();
