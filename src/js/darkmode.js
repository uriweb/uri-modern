/**
 * OS theme switching controls
 *
 */

( function() {
	'use strict';

	window.addEventListener( 'load', init, false );

	function init() {
		detectColorScheme();

		const toggleSwitch = document.querySelector( '#os-theme-switch input[type="checkbox"]' );

		toggleSwitch.addEventListener( 'change', function( e ) {
			switchTheme( e, toggleSwitch );
		}, false );

		//pre-check the dark-theme checkbox if dark-theme is set
		if ( 'dark' === document.documentElement.getAttribute( 'data-theme' ) ) {
			toggleSwitch.checked = true;
		}
	}

	//determines if the user has a set theme
	function detectColorScheme() {
		let theme = 'light'; //default to light

		//local storage is used to override OS theme settings
		if ( localStorage.getItem( 'theme' ) ) {
			if ( 'dark' === localStorage.getItem( 'theme' ) ) {
				theme = 'dark';
			}
		} else if ( ! window.matchMedia ) {
			//matchMedia method not supported
			return false;
		} else if ( window.matchMedia( '(prefers-color-scheme: dark)' ).matches ) {
			//OS theme setting detected as dark
			theme = 'dark';
		}

		//dark theme preferred, set document with a `data-theme` attribute
		if ( 'dark' === theme ) {
			document.documentElement.setAttribute( 'data-theme', 'dark' );
		}
	}

	//function that changes the theme, and sets a localStorage variable to track the theme between page loads
	function switchTheme( e, toggleSwitch ) {
		if ( e.target.checked ) {
			localStorage.setItem( 'theme', 'dark' );
			document.documentElement.setAttribute( 'data-theme', 'dark' );
			toggleSwitch.checked = true;
		} else {
			localStorage.setItem( 'theme', 'light' );
			document.documentElement.setAttribute( 'data-theme', 'light' );
			toggleSwitch.checked = false;
		}
	}
}() );
