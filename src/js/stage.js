/**
 * The Stage
 *
 * @package uri-modern
 */

( function() {

	'use strict';

	var data;

	window.addEventListener( 'load', initStage, false );

	function initStage() {

		var stage, masthead;

		stage = document.getElementById( 'stage' );

		if ( null !== stage ) {

			masthead = document.getElementById( 'masthead' );

			data = {
				stage: {
					el: stage,
					h: stage.offsetHeight,
					offset: stage.getBoundingClientRect().top,
					initialOffset: stage.getBoundingClientRect().top + window.pageYOffset
				},
				bodyClassList: document.body.classList,
				content: document.getElementById( 'content' ),
				masthead: {
					el: masthead,
					h: masthead.offsetHeight,
					offset: document.getElementById( 'brandbar' ).offsetHeight
				}
			};

			data.bodyClassList.add( 'stage' );
			document.getElementById( 'page' ).insertBefore( data.stage.el, data.content );

			addPrompter();
			determineStageType();

		}

	}

	function determineStageType() {

		if ( data.stage.el.classList.contains( 'fade' ) ) {
			setTheStage();
		}

	}

	function addPrompter() {

		var prompt;

		prompt = document.createElement( 'div' );
		prompt.className = 'prompter';
		prompt.innerHTML = 'Scroll down';
		prompt.addEventListener( 'click', handlePrompterClick, false );
		data.stage.el.appendChild( prompt );

	}

	function handlePrompterClick() {

		data.content.scrollIntoView( { behavior: 'smooth', block: 'start', inline: 'nearest' } );

	}

	function setTheStage() {

		var overlay;

		// Store a reference to the body class list
		data.bodyClassList.add( 'stage-type-fade' );

		// Resize any superheros.
		if ( null !== CLResizeSuperheroes ) {
			CLResizeSuperheroes();
			data.stage.h = stage.offsetHeight;
		}

		// Create the stage overlay div.
		overlay = document.createElement( 'div' );
		overlay.className = 'stage-overlay';
		data.stage.el.insertBefore( overlay, data.stage.el.childNodes[0] );

		// Store the stage specs.
		data.stage.overlay = overlay;

		// Store a few other elements.
		data.backdrop   = document.getElementById( 'sb-backdrop' );
		data.navigation = document.getElementById( 'navigation' );
		data.widgets = document.getElementById( 'region-before-content' );

		data.content.style.marginTop = data.stage.h + data.masthead.offset + 'px';

		// Initialize scroll and add event listeners.
		handleScroll();
		window.addEventListener( 'scroll', handleScroll );
		window.addEventListener( 'resize', handelResize );

	}

	function handelResize() {

		data.stage.h = data.stage.el.offsetHeight;
		data.content.style.marginTop = data.stage.h + data.masthead.offset + 'px';

		handleScroll;

	}

	function handleScroll() {

		var contentPosition;

		contentPosition = data.content.getBoundingClientRect().top;

		// If the top of the content is below the bottom of the masthead...
		if ( contentPosition > data.masthead.h ) {

			// Make the masthead fixed (if it isn't already).
			if ( data.bodyClassList.contains( 'stage-fluid' ) ) {

				data.bodyClassList.remove( 'stage-fluid' );
				data.masthead.el.style.top = 'initial';

			} else { // If it is fixed, draw the elements.
				drawElements();
			}

		} else { // Otherwise, if the content is at or above the masthead...

			// Make the masthead fluid (if it isn't already).
			if ( ! data.bodyClassList.contains( 'stage-fluid' ) ) {
				data.bodyClassList.add( 'stage-fluid' );
				data.masthead.el.style.top = data.stage.h - data.masthead.h + data.masthead.offset + 'px';
			}

		}

	}

	function drawElements() {

		var p, d, t, l, u, e;

		// The scroll position.
		p = window.pageYOffset;

		// Set a special body class if the scroll is 0.
		if ( 0 === p && ! data.bodyClassList.contains( 'stage-initial' ) ) {
			data.bodyClassList.add( 'stage-initial' );
		} else if ( data.bodyClassList.contains( 'stage-initial' ) ) {
			data.bodyClassList.remove( 'stage-initial' );
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
