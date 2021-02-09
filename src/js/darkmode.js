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

		if ( 'dark' === document.documentElement.getAttribute( 'data-theme' ) ) {
			toggleSwitch.checked = true;
		}
	}

	function detectColorScheme() {
		let theme = 'light';
		let systemTheme = 'light';
		let altered = false;
		let userTheme;

		if ( localStorage.getItem( 'altered-theme' ) ) {
			if ( 'yes' === localStorage.getItem( 'altered-theme' ) ) {
				altered = true;
			}
		}

		if ( localStorage.getItem( 'theme' ) ) {
			userTheme = localStorage.getItem( 'theme' );
		}

		if ( window.matchMedia( '(prefers-color-scheme: dark)' ).matches ) {
			systemTheme = 'dark';
		}

		if ( userTheme === systemTheme ) {
			theme = systemTheme;
			if ( altered ) {
				localStorage.setItem( 'altered-theme', 'no' );
			}
		} else if ( ! altered ) {
			theme = systemTheme;
		} else {
			theme = userTheme;
		}

		if ( 'dark' === theme ) {
			document.documentElement.setAttribute( 'data-theme', 'dark' );
		}
	}

	function switchTheme( e, toggleSwitch ) {
		localStorage.setItem( 'altered-theme', 'yes' );

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
