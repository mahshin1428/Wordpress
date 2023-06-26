/**
 * @output wp-includes/js/wp-emoji-loader.js
 */

/**
 * Emoji Settings as exported in PHP via _print_emoji_detection_script().
 * @typedef WPEmojiSettings
 * @type {object}
 * @property {!object} source
 * @property {!string} source.concatemoji
 * @property {!string} source.twemoji
 * @property {!string} source.wpemoji
 */

/**
 * IIFE to detect emoji support and load Twemoji if needed.
 *
 * @param {Window} window
 * @param {Document} document
 * @param {WPEmojiSettings} settings
 */
( async function( window, document, settings ) {
	let sessionSupports;
	let sessionUpdated = false;
	const sessionStorageKey = 'wpEmojiSettingsSupports';

	// Create a promise for DOMContentLoaded since the worker logic may finish after the event has fired.
	const domReadyPromise = new Promise( ( resolve ) => {
		document.addEventListener( 'DOMContentLoaded', resolve, {
			once: true,
		} );
	} );

	/**
	 * Checks if two sets of Emoji characters render the same visually.
	 *
	 * @since 4.9.0
	 *
	 * @private
	 *
	 * @param {CanvasRenderingContext2D} context 2D Context.
	 * @param {string} set1 Set of Emoji to test.
	 * @param {string} set2 Set of Emoji to test.
	 *
	 * @return {boolean} True if the two sets render the same.
	 */
	function emojiSetsRenderIdentically( context, set1, set2 ) {
		// Cleanup from previous test.
		context.clearRect( 0, 0, context.canvas.width, context.canvas.height );
		context.fillText( set1, 0, 0 );
		const rendered1 = new Uint32Array(
			context.getImageData(
				0,
				0,
				context.canvas.width,
				context.canvas.height
			).data
		);

		// Cleanup from previous test.
		context.clearRect( 0, 0, context.canvas.width, context.canvas.height );
		context.fillText( set2, 0, 0 );
		const rendered2 = new Uint32Array(
			context.getImageData(
				0,
				0,
				context.canvas.width,
				context.canvas.height
			).data
		);

		return rendered1.every( ( rendered2Data, index ) => {
			return rendered2Data === rendered2[ index ];
		} );
	}

	/**
	 * Determines if the browser properly renders Emoji that Twemoji can supplement.
	 *
	 * @since 4.2.0
	 *
	 * @private
	 *
	 * @param {string} type Whether to test for support of "flag" or "emoji".
	 *
	 * @return {boolean} True if the browser can render emoji, false if it cannot.
	 */
	function browserSupportsEmoji( type ) {
		let canvas, isIdentical;

		/*
		 * Chrome on OS X added native emoji rendering in M41. Unfortunately,
		 * it doesn't work when the font is bolder than 500 weight. So, we
		 * check for bold rendering support to avoid invisible emoji in Chrome.
		 */
		if (
			typeof WorkerGlobalScope !== 'undefined' &&
			self instanceof WorkerGlobalScope &&
			typeof OffscreenCanvas !== 'undefined'
		) {
			canvas = new OffscreenCanvas( 300, 150 ); // Dimensions are default for HTMLCanvasElement.
		} else {
			canvas = document.createElement( 'canvas' );
		}
		const context = canvas.getContext( '2d', { willReadFrequently: true } );
		context.textBaseline = 'top';
		context.font = '600 32px Arial';

		switch ( type ) {
			case 'flag':
				/*
				 * Test for Transgender flag compatibility. Added in Unicode 13.
				 *
				 * To test for support, we try to render it, and compare the rendering to how it would look if
				 * the browser doesn't render it correctly (white flag emoji + transgender symbol).
				 */
				isIdentical = emojiSetsRenderIdentically(
					context,
					'\uD83C\uDFF3\uFE0F\u200D\u26A7\uFE0F', // as a zero-width joiner sequence
					'\uD83C\uDFF3\uFE0F\u200B\u26A7\uFE0F' // separated by a zero-width space
				);

				if ( isIdentical ) {
					return false;
				}

				/*
				 * Test for UN flag compatibility. This is the least supported of the letter locale flags,
				 * so gives us an easy test for full support.
				 *
				 * To test for support, we try to render it, and compare the rendering to how it would look if
				 * the browser doesn't render it correctly ([U] + [N]).
				 */
				isIdentical = emojiSetsRenderIdentically(
					context,
					'\uD83C\uDDFA\uD83C\uDDF3', // as the sequence of two code points
					'\uD83C\uDDFA\u200B\uD83C\uDDF3' // as the two code points separated by a zero-width space
				);

				if ( isIdentical ) {
					return false;
				}

				/*
				 * Test for English flag compatibility. England is a country in the United Kingdom, it
				 * does not have a two letter locale code but rather a five letter sub-division code.
				 *
				 * To test for support, we try to render it, and compare the rendering to how it would look if
				 * the browser doesn't render it correctly (black flag emoji + [G] + [B] + [E] + [N] + [G]).
				 */
				isIdentical = emojiSetsRenderIdentically(
					context,
					// as the flag sequence
					'\uD83C\uDFF4\uDB40\uDC67\uDB40\uDC62\uDB40\uDC65\uDB40\uDC6E\uDB40\uDC67\uDB40\uDC7F',
					// with each code point separated by a zero-width space
					'\uD83C\uDFF4\u200B\uDB40\uDC67\u200B\uDB40\uDC62\u200B\uDB40\uDC65\u200B\uDB40\uDC6E\u200B\uDB40\uDC67\u200B\uDB40\uDC7F'
				);

				return ! isIdentical;
			case 'emoji':
				/*
				 * Why can't we be friends? Everyone can now shake hands in emoji, regardless of skin tone!
				 *
				 * To test for Emoji 14.0 support, try to render a new emoji: Handshake: Light Skin Tone, Dark Skin Tone.
				 *
				 * The Handshake: Light Skin Tone, Dark Skin Tone emoji is a ZWJ sequence combining 🫱 Rightwards Hand,
				 * 🏻 Light Skin Tone, a Zero Width Joiner, 🫲 Leftwards Hand, and 🏿 Dark Skin Tone.
				 *
				 * 0x1FAF1 == Rightwards Hand
				 * 0x1F3FB == Light Skin Tone
				 * 0x200D == Zero-Width Joiner (ZWJ) that links the code points for the new emoji or
				 * 0x200B == Zero-Width Space (ZWS) that is rendered for clients not supporting the new emoji.
				 * 0x1FAF2 == Leftwards Hand
				 * 0x1F3FF == Dark Skin Tone.
				 *
				 * When updating this test for future Emoji releases, ensure that individual emoji that make up the
				 * sequence come from older emoji standards.
				 */
				isIdentical = emojiSetsRenderIdentically(
					context,
					'\uD83E\uDEF1\uD83C\uDFFB\u200D\uD83E\uDEF2\uD83C\uDFFF', // as the zero-width joiner sequence
					'\uD83E\uDEF1\uD83C\uDFFB\u200B\uD83E\uDEF2\uD83C\uDFFF' // separated by a zero-width space
				);

				return ! isIdentical;
		}

		return false;
	}

	/**
	 * Determines if the browser properly renders Emoji that Twemoji can supplement.
	 *
	 * This is a wrapper for browserSupportsEmoji() which attempts to offload the work to a worker to free up the main
	 * thread.
	 *
	 * @since 6.3.0
	 *
	 * @private
	 * @async
	 *
	 * @param {string} type Whether to test for support of "flag" or "emoji".
	 *
	 * @return {bool} True if the browser can render emoji, false if it cannot.
	 */
	async function browserSupportsEmojiOptimized( type ) {
		if ( typeof OffscreenCanvas !== 'undefined' ) {
			/*
			 * Note that this string contains the real source code for the
			 * copied functions, _not_ a string representation of them. This
			 * is because it's not possible to transfer a Function across
			 * threads. The lack of quotes is intentional.
			 *
			 * Example
			 *
			 *     > console.log( workerScript );
			 *     const emojiSetsRenderIdentically = function emojiSetsRenderIdentically(context, set1, set2) { … }
			 *     …
			 */
			const workerScript = `
				/** @var {Function} copy of comparison function to send into worker. */
				const emojiSetsRenderIdentically = ${ emojiSetsRenderIdentically };
				/** @var {Function} copy of detection function to send into worker. */
				const browserSupportsEmoji = ${ browserSupportsEmoji };
				postMessage(browserSupportsEmoji(${ JSON.stringify( type ) }));
			`;
			const blob = new Blob( [ workerScript ], {
				type: 'text/javascript',
			} );
			const worker = new Worker( URL.createObjectURL( blob ) );
			return await new Promise( ( resolve ) => {
				worker.onmessage = ( event ) => {
					resolve( event.data );
				};
			} );
		} else {
			return browserSupportsEmoji( type );
		}
	}

	/**
	 * Adds a script to the head of the document.
	 *
	 * @ignore
	 *
	 * @since 4.2.0
	 *
	 * @param {string} src The url where the script is located.
	 *
	 * @return {void}
	 */
	function addScript( src ) {
		const script = document.createElement( 'script' );

		script.src = src;
		script.defer = true;
		document.head.appendChild( script );
	}

	const tests = [ 'flag', 'emoji' ];

	settings.supports = {
		everything: true,
		everythingExceptFlag: true,
	};

	// Initialize sessionSupports from sessionStorage if available. This avoids expensive calls to browserSupportsEmoji().
	if (
		typeof sessionStorage !== 'undefined' &&
		sessionStorageKey in sessionStorage
	) {
		try {
			sessionSupports = JSON.parse(
				sessionStorage.getItem( sessionStorageKey )
			);
			Object.assign( settings.supports, sessionSupports );
		} catch ( e ) {
			sessionSupports = {};
		}
	} else {
		sessionSupports = {};
	}

	/*
	 * Tests the browser support for flag emojis and other emojis, and adjusts the
	 * support settings accordingly.
	 */
	for ( const test of tests ) {
		if ( ! ( test in sessionSupports ) ) {
			sessionSupports[ test ] = await browserSupportsEmojiOptimized(
				test
			);
			settings.supports[ test ] = sessionSupports[ test ];
			sessionUpdated = true;
		}

		settings.supports.everything =
			settings.supports.everything && settings.supports[ test ];

		if ( 'flag' !== test ) {
			settings.supports.everythingExceptFlag =
				settings.supports.everythingExceptFlag &&
				settings.supports[ test ];
		}
	}

	// If the sessionSupports was touched, persist the new object in sessionStorage.
	if ( sessionUpdated && typeof sessionStorage !== 'undefined' ) {
		try {
			sessionStorage.setItem(
				sessionStorageKey,
				JSON.stringify( sessionSupports )
			);
		} catch ( e ) {}
	}

	settings.supports.everythingExceptFlag =
		settings.supports.everythingExceptFlag && ! settings.supports.flag;

	// Sets DOMReady to false and assigns a ready function to settings.
	settings.DOMReady = false;
	settings.readyCallback = () => {
		settings.DOMReady = true;
	};

	// When the browser can not render everything we need to load a polyfill.
	if ( ! settings.supports.everything ) {
		await domReadyPromise;
		settings.readyCallback();

		const src = settings.source || {};

		if ( src.concatemoji ) {
			addScript( src.concatemoji );
		} else if ( src.wpemoji && src.twemoji ) {
			addScript( src.twemoji );
			addScript( src.wpemoji );
		}
	}
} )( window, document, window._wpemojiSettings );
