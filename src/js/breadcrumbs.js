/**
 * Mobile breadcrumbs control
 *
 * @package uri-modern
 */

( function() {

    'use strict';

    window.addEventListener( 'load', initBreadcrumbs, false );

    function initBreadcrumbs() {

        var BC = {}, div = {}, i;

        BC.el = document.getElementById( 'breadcrumbs' );
        BC.ol = BC.el.querySelector( 'ol' );
        BC.crumbs = BC.ol.querySelectorAll( 'li' );

        BC.el.classList.add( 'has-js' );

        div.el = document.createElement( 'div' );

        div.span = document.createElement( 'span' );
        div.span.innerHTML = BC.crumbs[BC.crumbs.length - 2].querySelector( 'a' ).innerHTML;
        div.el.appendChild( div.span );

        div.span = document.createElement( 'span' );
        div.span.innerHTML = BC.crumbs[BC.crumbs.length - 1].innerHTML;
        div.el.appendChild( div.span );

        div.el.addEventListener( 'click', handleClick.bind( null, BC.el ) );

        BC.el.insertBefore( div.el, BC.ol );

    }

    function handleClick( el ) {

        var c = 'active';

        if ( el.classList.contains( c ) ) {
            el.classList.remove( c );
        } else {
            el.classList.add( c );
        }

    }

})();
