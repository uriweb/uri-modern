/**
 * Init color scheme
 *
 */

( function() {
	'use strict';

	const localStorageName = {
		theme: 'uri-modern-color-scheme',
		alt: 'uri-modern-altered-color-scheme',
	};

	function setColorScheme() {
		let theme = 'light';
		let systemTheme = 'light';
		let altered = false;
		let userTheme;

		const mediaQuery = window.matchMedia( '(prefers-color-scheme: dark)' );
		mediaQuery.addEventListener( 'change', systemChange.bind( null, mediaQuery ), false );

		if ( localStorage.getItem( localStorageName.alt ) ) {
			if ( 'yes' === localStorage.getItem( localStorageName.alt ) ) {
				altered = true;
			}
		}

		if ( localStorage.getItem( localStorageName.theme ) ) {
			userTheme = localStorage.getItem( localStorageName.theme );
		}

		if ( mediaQuery.matches ) {
			systemTheme = 'dark';
		}

		if ( userTheme === systemTheme ) {
			theme = systemTheme;
			if ( altered ) {
				localStorage.setItem( localStorageName.alt, 'no' );
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

	setColorScheme();
	window.addEventListener( 'load', init, false );

	function init() {
		const toggleSwitch = document.querySelector( '#os-theme-switch input[type="checkbox"]' );

		toggleSwitch.addEventListener( 'change', function() {
			switchControl( toggleSwitch );
		}, false );

		if ( 'dark' === document.documentElement.getAttribute( 'data-theme' ) ) {
			toggleSwitch.checked = true;
		}
	}

	function switchControl( toggle ) {
		localStorage.setItem( localStorageName.alt, 'yes' );
		if ( toggle.checked ) {
			changeToDark( toggle );
			return;
		}
		changeToLight( toggle );
	}

	function systemChange( mq ) {
		const toggle = document.querySelector( '#os-theme-switch input[type="checkbox"]' );
		if ( mq.matches ) {
			changeToDark( toggle );
			return;
		}
		changeToLight( toggle );
	}

	function changeToDark( t ) {
		localStorage.setItem( localStorageName.theme, 'dark' );
		document.documentElement.setAttribute( 'data-theme', 'dark' );
		t.checked = true;
	}

	function changeToLight( t ) {
		localStorage.setItem( localStorageName.theme, 'light' );
		document.documentElement.setAttribute( 'data-theme', 'light' );
		t.checked = false;
	}
}() );
