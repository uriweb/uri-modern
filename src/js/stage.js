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

			document.body.classList.add( 'stage' );
			document.getElementById( 'page' ).insertBefore( stage, document.getElementById( 'content' ) );

			addPrompter( stage );
			determineStageType( stage );

		}

	}

	function determineStageType( stage ) {

		if ( stage.classList.contains( 'fade' ) ) {
			setTheStage( stage );
		}

	}

	function addPrompter( stage ) {

		var prompt;

		prompt = document.createElement( 'div' );
		prompt.className = 'prompter';
		prompt.innerHTML = 'Scroll down';
		prompt.addEventListener( 'click', handlePrompterClick, false );
		stage.appendChild( prompt );

	}

	function handlePrompterClick() {

		document.getElementById( 'content' ).scrollIntoView( { behavior: 'smooth', block: 'start', inline: 'nearest' } );

	}

	function setTheStage( stage ) {

		var data = {}, overlay, masthead;

		// Store a reference to the body class list
		data.docClassList = document.body.classList;
		data.docClassList.add( 'stage-type-fade' )

		// Store the content div
		data.content = document.getElementById( 'content' );

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
		data.masthead = {
			el: masthead,
			h: masthead.offsetHeight,
			offset: masthead.getBoundingClientRect().top
		};

		// Store the stage specs.
		data.stage = {
			el: stage,
			overlay: overlay,
			h: stage.offsetHeight,
			offset: stage.getBoundingClientRect().top,
			initialOffset: stage.getBoundingClientRect().top + window.pageYOffset
		};

		// Store a few other elements.
		data.backdrop   = document.getElementById( 'sb-backdrop' );
		data.navigation = document.getElementById( 'navigation' );
		data.widgets = document.getElementById( 'region-before-content' );

		// Initialize scroll and add event listeners.
		handleScroll( data );
		window.addEventListener( 'scroll', handleScroll.bind( null, data ) );
		window.addEventListener( 'resize', handleScroll.bind( null, data ) );

	}

	function handleScroll( data ) {

		var contentPosition, windowHeight;

		contentPosition = data.content.getBoundingClientRect().top;
		windowHeight    = window.innerHeight;

		// If the top of the content is below the bottom of the masthead...
		if ( contentPosition > data.masthead.h + data.masthead.offset ) {

			// Make the masthead fixed (if it isn't already).
			if ( data.docClassList.contains( 'stage-fluid' ) ) {

				data.docClassList.remove( 'stage-fluid' );
				data.masthead.el.style.top = 'initial';

			} else { // If it is fixed, draw the elements.
				drawElements( data );
			}

		} else { // Otherwise, if the content is at or above the masthead...

			// Make the masthead fluid (if it isn't already).
			if ( ! data.docClassList.contains( 'stage-fluid' ) ) {
				data.docClassList.add( 'stage-fluid' );
				data.masthead.el.style.top = windowHeight - data.masthead.h + data.masthead.offset + 'px';
			}

		}

	}

	function drawElements( data ) {

		var p, d, t, l, u, e;

		// The scroll position.
		p = window.pageYOffset;

		// Set a special body class if the scroll is 0.
		if ( 0 === p && ! data.docClassList.contains( 'stage-initial' ) ) {
			data.docClassList.add( 'stage-initial' );
		} else if ( data.docClassList.contains( 'stage-initial' ) ) {
			data.docClassList.remove( 'stage-initial' );
		}

		// The distance over which to tween the animation.
		d = data.stage.h - data.masthead.h;

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
		data.stage.overlay.style.cssText = '-webkit-backdrop-filter: blur(' + ( u * 50 ) + 'px); backdrop-filter: blur(' + ( u * 50 ) + 'px); background-color: rgba(250,250,250,' + u + ')';
		if ( null !== data.navigation ) {
			data.navigation.style.opacity = Math.min( e * 8, 1 );
		}
		if ( null !== data.backdrop ) {
			data.backdrop.style.opacity = Math.min( e * 8, 1 );
		}
		if ( null !== data.widgets ) {
			data.widgets.style.opacity = Math.min( e * 8, 1 );
		}

	}

})();
