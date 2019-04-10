/**
 * Shame
 *
 * @package uri-modern
 */

// jshint esversion: 6
// jscs:disable requireVarDeclFirst

( function() {

	'use strict';

	var data = {
		'elClass': 'shamed-element',
		'messageClass': 'shame-message',
		'issues': {
			'total': 0,
			'errors': 0,
			'warnings': 0,
			'suggestions': 0
		}
	};

	document.addEventListener( 'DOMContentLoaded', init, false );

	class Shame {

		/**
		 * Iterate over the tests
		 * @param specs obj The element information
		 * @param tests obj The tests to perform
		 */
		static iterateTests( specs, tests ) {

			var i, j, test = {};

			for ( i = 0; i < tests.length; i++ ) {

				test.message = tests[i].message;
				test.type = tests[i].type;

				for ( j = 0; j < tests[i].selectors.length; j++ ) {
					test.selector = tests[i].selectors[j];
					Shame.runTest( specs.tag, specs.class, test );
				}

			}

		}

		/**
		 * Do the test
		 * @param tag str The tag to search for
		 * @param classname str The wrapper class to pass to Shame.display()
		 * @param test obj The test information
		 */
		static runTest( tag, classname, test ) {

			var els, i;

			els = data.main.querySelectorAll( tag + '[' + test.selector + ']' );

			for ( i = 0; i < els.length; i++ ) {

				Shame.display( els[i], classname, test.message, test.type );

			}

		}

		/**
		 * Display the shame
		 * @param el el The element to shame
		 * @param classname str The class to give the wrapper
		 * @param message str The message to display
		 * @param type str The issue type
		 */
		static display( el, classname, message, type ) {

			var wrapper, div;

			el.classList.add( data.elClass );

			++data.issues.total;
			++data.issues[type + 's'];

			wrapper = document.createElement( 'span' );
			wrapper.className = 'shame-wrapper ' + classname + ' shame-type-' + type;

			div = document.createElement( 'div' );
			div.className = data.messageClass;
			div.innerHTML = message;
			wrapper.appendChild( div );

			el.parentNode.insertBefore( wrapper, el.nextSibling );
			wrapper.appendChild( el );

		}

	}

	function init() {

		if ( ! document.body.classList.contains( 'logged-in' ) ) {
			return;
		}

		startShaming();

	}

	function startShaming() {

		var x, div;

		data.main = document.getElementById( 'main' );

		shameImages();
		shameLinks();
		shameIDs();

		displayStatus();

	}

	function shameImages() {

		var specs, tests;

		specs = {
			tag: 'img',
			class: 'shamed-image'
		};

		tests = [
			{
				selectors: ['alt=""'],
				message: 'Alt attribute required',
				type: 'error'
			},
			{
				selectors: ['src^="file:"'],
				message: 'No sourcing local resources',
				type: 'error'
			}
		];

		Shame.iterateTests( specs, tests );

	}

	function shameLinks() {

		var specs, tests;

		specs = {
			tag: 'a',
			class: 'shamed-link'
		};

		tests = [
			{
				selectors: ['href="#"'],
				message: '"#" is not a valid URL',
				type: 'error'
			},
			{
				selectors: ['href^="javascript:"'],
				message: 'No JavaScript in links',
				type: 'error'
			},
			{
				selectors: ['href^="file:"'],
				message: 'No linking to local resources',
				type: 'error'
			},
			{
				selectors: ['href^="///"'],
				message: 'Link href syntax error',
				type: 'error'
			},
			{
				selectors: ['href$=".pdf"'],
				message: 'PDF: Consider linking to a webpage instead',
				type: 'suggestion'
			},
			{
				selectors: [
					'href$=".doc"',
					'href$=".docx"',
					'href$=".docm"',
					'href$=".xls"',
					'href$=".xlm"',
					'href$=".xlsx"',
					'href$=".xlsm"',
					'href$=".ppt"',
					'href$=".pps"',
					'href$=".pptx"',
					'href$=".pptm"',
					'href$=".ppsx"',
					'href$=".sldx"',
					'href$=".sldm"'
					],
				message: 'Not all users may be able to open this file.  Provide a download link to the required software.',
				type: 'warning'
			}
		];

		Shame.iterateTests( specs, tests );

	}

	function shameIDs() {

		var els, i, id, ids = {}, x;

		els = data.main.querySelectorAll( '*[id]' );

		for ( i = 0; i < els.length; i++ ) {
			id = els[i].id;
			id in ids ? ids[id]++ : ids[id] = 1;
		}

		for ( x in ids ) {

			if ( ids[x] > 1 ) {
				els = data.main.querySelectorAll( '[id="' + x + '"]' );
				for ( i = 0; i < els.length; i++ ) {
					Shame.display( els[i], 'shamed-duplicate-id', 'No duplicate ids ("' + x + '")', 'error' );
				}
			}

		}

	}

	function displayStatus() {

		var div, plural, string;

		div = document.createElement( 'div' );
		div.className = 'shame-status';

		plural = ( 1 == data.issues.errors ) ? '' : 's';
		string = 'This page has ' + data.issues.errors + ' error' + plural;

		plural = ( 1 == data.issues.warnings ) ? '' : 's';
		string += ', ' + data.issues.warnings + ' warning' + plural;

		plural = ( 1 == data.issues.suggestions ) ? '' : 's';
		string += ', and ' + data.issues.suggestions + ' suggestion' + plural + '.';

		div.innerHTML = string;

		data.main.insertBefore( div, data.main.firstChild );

	}

})();
