/**
 * The Stage
 *
 * @package uri-modern
 */

( function() {

	'use strict';

	window.addEventListener( 'load', initStage, false );

	function initStage() {

		var stage = document.getElementById( 'stage' );

		if ( null !== stage ) {
			setTheStage( stage );
		}

	}

	function setTheStage( stage ) {

		var els = {}, overlay, masthead;

		// Store a reference to the body class list and add the 'stage' class.
		els.docClassList = document.body.classList;
		els.docClassList.add( 'stage' );

		// Store the content div and put the stage before it.
		els.content = document.getElementById( 'content' );
		document.getElementById( 'page' ).insertBefore( stage, els.content );

		// Resize any superheros.
		if ( null !== CLResizeSuperheroes ) {
			CLResizeSuperheroes();
		}

		// Create the stage overlay div.
		overlay           = document.createElement( 'div' );
		overlay.className = 'stage-overlay';
		stage.insertBefore( overlay, stage.childNodes[0] );

		// Store the masthead specs.
		masthead     = document.getElementById( 'masthead' );
		els.masthead = {
			el: masthead,
			h: masthead.offsetHeight,
			offset: masthead.getBoundingClientRect().top
		};

		// Store the stage specs.
		els.stage = {
			el: stage,
			overlay: overlay,
			h: stage.offsetHeight,
			offset: stage.getBoundingClientRect().top,
			initialOffset: stage.getBoundingClientRect().top + window.pageYOffset
		};

		// Store a few other elements.
		els.backdrop   = document.getElementById( 'sb-backdrop' );
		els.navigation = document.getElementById( 'navigation' );

		// Initialize scroll and add event listeners.
		handleScroll( els );
		window.addEventListener( 'scroll', handleScroll.bind( null, els ) );
		window.addEventListener( 'resize', handleScroll.bind( null, els ) );

	}

	function handleScroll( els ) {

		var contentPosition, windowHeight;

		contentPosition = els.content.getBoundingClientRect().top;
		windowHeight    = window.innerHeight;

		// If the top of the content is below the bottom of the masthead...
		if ( contentPosition > els.masthead.h + els.masthead.offset ) {

			// Make the masthead fixed (if it isn't already).
			if ( els.docClassList.contains( 'stage-fluid' ) ) {

				els.docClassList.remove( 'stage-fluid' );
				els.masthead.el.style.top = 'initial';

			} else { // If it is fixed, draw the elements.
				drawElements( els );
			}

		} else { // Otherwise, if the content is at or above the masthead...

			// Make the masthead fluid (if it isn't already).
			if ( ! els.docClassList.contains( 'stage-fluid' ) ) {
				els.docClassList.add( 'stage-fluid' );
				els.masthead.el.style.top = windowHeight - els.masthead.h + els.masthead.offset + 'px';
			}

		}

	}

	function drawElements( els ) {

		var p, d, t, l, u, e;

		// The scroll position.
		p = window.pageYOffset;

		// Set a special body class if the scroll is 0.
		if ( 0 === p && ! els.docClassList.contains( 'stage-initial' ) ) {
			els.docClassList.add( 'stage-initial' );
		} else if ( els.docClassList.contains( 'stage-initial' ) ) {
			els.docClassList.remove( 'stage-initial' );
		}

		// The distance over which to tween the animation.
		d = els.stage.h - els.masthead.h;

		/*
		 * The position of the animation along the timing function, from 0 - 1.
		 * This could be thought of as the percent of the animation that is complete.
		 */
		t = Math.min( p / d * 1, 1 );

		/*
		 * The animation delay, from 0 - 1.
		 * Essentially, the value of t at which the animaion should start.
		 * Note that this does not add to the total animation time, but rather subtracts from it.
		 */
		l = 0.2; // Set this.
		u = Math.max( ( t - l ) / ( 1 - l ), 0 ); // The adjusted timing function.

		/*
		 * The easing function.
		 * The second parameter is the power.
		 * 1: linear, 2: quad, 3: cubic, 4: quart, 5: quint, and so on.
		 *
		 * @link http://upshots.org/actionscript/jsas-understanding-easing
		 */
		e = Math.pow( u / 1, 4 );

		// Adjust the styles accordingly.
		els.stage.overlay.style.cssText = '-webkit-backdrop-filter: blur(' + ( u * 50 ) + 'px); backdrop-filter: blur(' + ( u * 50 ) + 'px); background-color: rgba(250,250,250,' + u + ')';
		if ( null !== els.navigation ) {
			els.navigation.style.opacity = Math.min( e * 8, 1 );
		}
		if ( null !== els.backdrop ) {
			els.backdrop.style.opacity = Math.min( e * 8, 1 );
		}

	}

})();
