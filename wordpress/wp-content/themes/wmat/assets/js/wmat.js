/* West Michigan Art Therapy — small front-end enhancements. */
( function () {
	'use strict';

	/* Rotating hero taglines (progressive enhancement). */
	function initTaglines() {
		var el = document.querySelector( '.wmat-tagline' );
		if ( ! el ) {
			return;
		}
		var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		if ( reduce ) {
			return;
		}
		var lines;
		try {
			lines = JSON.parse( el.getAttribute( 'data-taglines' ) || '[]' );
		} catch ( e ) {
			lines = [];
		}
		if ( ! lines.length ) {
			return;
		}
		var span = el.querySelector( '.wmat-tagline-text' );
		if ( ! span ) {
			return;
		}
		span.style.transition = 'opacity 480ms ease';
		var i = 0;
		setInterval( function () {
			span.style.opacity = '0';
			setTimeout( function () {
				i = ( i + 1 ) % lines.length;
				span.textContent = lines[ i ];
				span.style.opacity = '1';
			}, 480 );
		}, 3600 );
	}

	if ( document.readyState !== 'loading' ) {
		initTaglines();
	} else {
		document.addEventListener( 'DOMContentLoaded', initTaglines );
	}
}() );
