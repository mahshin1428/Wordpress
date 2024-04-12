<?php

class WP_HTML_Decoder {
	public static function decode_normal_text_node( $text, $at = 0, $length = null ) {
		$decoded = '';
		$end     = isset( $length ) ? $at + $length : strlen( $text );
		$was_at  = $at;

		while ( $at < $end ) {
			$next_character_reference_at = strpos( $text, '&', $at );
			if ( false === $next_character_reference_at ) {
				break;
			}

			$character_reference = self::read_character_reference( $text, $next_character_reference_at, true, $skip_bytes );
			if ( isset( $character_reference ) ) {
				$at       = $next_character_reference_at;
				$decoded .= substr( $text, $was_at, $at - $was_at );
				$decoded .= $character_reference;
				$at      += $skip_bytes;
				$was_at   = $at;
				continue;
			}

			++$at;
		}

		if ( $at < $end ) {
			$decoded .= substr( $text, $was_at, $end - $was_at );
		}

		return $decoded;
	}

	public static function decode_non_url_attribute( $text, $at = 0, $length = null ) {
		$decoded = '';
		$end     = isset( $length ) ? $at + $length : strlen( $text );
		$was_at  = $at;

		while ( $at < $end ) {
			$next_character_reference_at = strpos( $text, '&', $at );
			if ( false === $next_character_reference_at ) {
				break;
			}

			$character_reference = self::read_character_reference( $text, $next_character_reference_at, false, $skip_bytes );
			if ( isset( $character_reference ) ) {
				$at       = $next_character_reference_at;
				$decoded .= substr( $text, $was_at, $at - $was_at );
				$decoded .= $character_reference;
				$at      += $skip_bytes;
				$was_at   = $at;
				continue;
			}

			++$at;
		}

		if ( $at < $end ) {
			$decoded .= substr( $text, $was_at, $end - $was_at );
		}

		return $decoded;
	}

	public static function read_character_reference( $text, $at, $allow_ambiguous_ampersand, &$skip_bytes ) {
		global $html5_named_character_entity_set;

		$length = strlen( $text );
		if ( $at + 1 >= $length ) {
			return null;
		}

		/*
		 * Numeric character references.
		 *
		 * When truncated, these will encode the code point found by parsing the
		 * digits that are available. For example, when `&#x1f170;` is truncated
		 * to `&#x1f1` it will encode `Ǳ`. It does not:
		 *  - know how to parse the original `🅰`.
		 *  - fail to parse and return plaintext `&#x1f1`.
		 *  - fail to parse and return the replacement character `�`
		 */
		if ( '#' === $text[ $at + 1 ] ) {
			if ( $at + 2 >= $length ) {
				return null;
			}

			/** Tracks inner parsing within the numeric character reference. */
			$digits_at = $at + 2;

			if ( 'x' === $text[ $digits_at ] || 'X' === $text[ $digits_at ] ) {
				$numeric_base   = 16;
				$numeric_digits = '0123456789abcdefABCDEF';
				$max_digits     = 6; // &#x10FFFF;
				$digits_at     += 1;
			} else {
				$numeric_base   = 10;
				$numeric_digits = '0123456789';
				$max_digits     = 7; // &#1114111;
			}

			// Cannot encode invalid Unicode code points. Max is to U+10FFFF.
			$digit_count   = strspn( $text, $numeric_digits, $digits_at );
			$after_digits  = $digits_at + $digit_count;
			$has_semicolon = $after_digits < $length && ';' === $text[ $after_digits ];
			$end_of_span   = $has_semicolon ? $after_digits + 1 : $after_digits;

			// `&#` or `&#x` without digits returns into plaintext.
			if ( 0 === $digit_count ) {
				return null;
			}

			if ( $digit_count > $max_digits ) {
				$skip_bytes = $end_of_span - $at;
				return '�';
			}

			$digits     = substr( $text, $digits_at, $digit_count );
			$code_point = intval( $digits, $numeric_base );

			if (
				// Null character.
				0 === $code_point ||

				// Outside Unicode range.
				$code_point > 0x10FFFF ||

				// Surrogate.
				( $code_point >= 0xD800 && $code_point <= 0xDFFF ) ||

				// Noncharacters.
				( $code_point >= 0xFDD0 && $code_point <= 0xFDEF ) ||
				( 0xFFFE === ( $code_point & 0xFFFE ) ) ||

				// 0x0D or non-ASCII-whitespace control
				0x0D === $code_point ||
				(
					$code_point >= 0 &&
					$code_point <= 0x1F &&
					0x9 !== $code_point &&
					0xA !== $code_point &&
					0xC !== $code_point &&
					0xD !== $code_point
				)
			) {
				$skip_bytes = $end_of_span - $at;
				return '�';
			}

			/*
			 * > If the number is one of the numbers in the first column of
			 * > the following table, then find the row with that number in
			 * > the first column, and set the character reference code to
			 * > the number in the second column of that row.
			 */
			if ( $code_point >= 0x80 && $code_point <= 0x9F ) {
				$windows_1252_mapping = array(
					0x20AC, // 0x80 -> EURO SIGN (€).
					0x81,   // 0x81 -> (no change).
					0x201A, // 0x82 -> SINGLE LOW-9 QUOTATION MARK (‚).
					0x0192, // 0x83 -> LATIN SMALL LETTER F WITH HOOK (ƒ).
					0x201E, // 0x84 -> DOUBLE LOW-9 QUOTATION MARK („).
					0x2026, // 0x85 -> HORIZONTAL ELLIPSIS (…).
					0x2020, // 0x86 -> DAGGER (†).
					0x2021, // 0x87 -> DOUBLE DAGGER (‡).
					0x02C6, // 0x88 -> MODIFIER LETTER CIRCUMFLEX ACCENT (ˆ).
					0x2030, // 0x89 -> PER MILLE SIGN (‰).
					0x0160, // 0x8A -> LATIN CAPITAL LETTER S WITH CARON (Š).
					0x2039, // 0x8B -> SINGLE LEFT-POINTING ANGLE QUOTATION MARK (‹).
					0x0152, // 0x8C -> LATIN CAPITAL LIGATURE OE (Œ).
					0x8D,   // 0x8D -> (no change).
					0x017D, // 0x8E -> LATIN CAPITAL LETTER Z WITH CARON (Ž).
					0x8F,   // 0x8F -> (no change).
					0x90,   // 0x90 -> (no change).
					0x2018, // 0x91 -> LEFT SINGLE QUOTATION MARK (‘).
					0x2019, // 0x92 -> RIGHT SINGLE QUOTATION MARK (’).
					0x201C, // 0x93 -> LEFT DOUBLE QUOTATION MARK (“).
					0x201D, // 0x94 -> RIGHT DOUBLE QUOTATION MARK (”).
					0x2022, // 0x95 -> BULLET (•).
					0x2013, // 0x96 -> EN DASH (–).
					0x2014, // 0x97 -> EM DASH (—).
					0x02DC, // 0x98 -> SMALL TILDE (˜).
					0x2122, // 0x99 -> TRADE MARK SIGN (™).
					0x0161, // 0x9A -> LATIN SMALL LETTER S WITH CARON (š).
					0x203A, // 0x9B -> SINGLE RIGHT-POINTING ANGLE QUOTATION MARK (›).
					0x0153, // 0x9C -> LATIN SMALL LIGATURE OE (œ).
					0x9D,   // 0x9D -> (no change).
					0x017E, // 0x9E -> LATIN SMALL LETTER Z WITH CARON (ž).
					0x0178, // 0x9F -> LATIN CAPITAL LETTER Y WITH DIAERESIS (Ÿ).
				);

				$code_point = $windows_1252_mapping[ $code_point - 0x80 ];
			}

			$skip_bytes = $end_of_span - $at;
			return self::code_point_to_utf8_bytes( $code_point );
		}

		/** Tracks inner parsing within the named character reference. */
		$name_at = $at;
		// Minimum named character reference is three characters. E.g. `&GT`.
		if ( $name_at + 3 > $length ) {
			return null;
		}

		// Advance past the `&`.
		++$name_at;

		$name = $html5_named_character_entity_set->read_token( $text, $name_at );
		if ( false === $name ) {
			return null;
		}

		$name_length = strlen( $name );
		$after_name  = $name_at + $name_length;

		// If we have an un-ambiguous ampersand we can safely leave it in.
		if ( ';' === $name[ $name_length - 1 ] ) {
			$skip_bytes = $after_name - $at;
			// @todo bring back the WP_Token_Map so we can decode these.
			return html_entity_decode( "&{$name}" );
		}

		/*
		 * At this point though have matched an entry in the named
		 * character reference table but the match doesn't end in `;`.
		 * We need to determine if the next letter makes it an ambiguous.
		 */
		$ambiguous_follower = (
			$after_name < $length &&
			$name_at < $length &&
			(
				ctype_alnum( $text[ $after_name ] ) ||
				'=' === $text[ $after_name ]
			)
		);

		// It's non-ambiguous, safe to leave it in.
		if ( ! $ambiguous_follower ) {
			$skip_bytes = $after_name - $at;
			// @todo Bring back WP_Token_Map to replace properly.
			return html_entity_decode( "&{$name};" );
		}

		if ( ! $allow_ambiguous_ampersand ) {
			return null;
		}

		$skip_bytes = $after_name - $at;
		return html_entity_decode( "&{$name};" );
	}

	public static function code_point_to_utf8_bytes( $code_point ) {
		if ( $code_point < 0x80 ) {
			return chr( $code_point );
		}

		if ( $code_point < 0x800 ) {
			$byte1 = ( $code_point >> 6 ) & 0x1F | 0xC0;
			$byte2 = $code_point & 0x3F | 0x80;

			return pack( 'CC', $byte1, $byte2 );
		}

		if ( $code_point < 0x10000 ) {
			$byte1 = ( $code_point >> 12 ) & 0x0F | 0xE0;
			$byte2 = ( $code_point >> 6 ) & 0x3F | 0x80;
			$byte3 = $code_point & 0x3F | 0x80;

			return pack( 'CCC', $byte1, $byte2, $byte3 );
		}

		if ( $code_point < 0x110000 ) {
			$byte1 = ( $code_point >> 18 ) & 0x07 | 0xF0;
			$byte2 = ( $code_point >> 12 ) & 0x3F | 0x80;
			$byte3 = ( $code_point >> 6 ) & 0x3F | 0x80;
			$byte4 = $code_point & 0x3F | 0x80;

			return pack( 'CCCC', $byte1, $byte2, $byte3, $byte4 );
		}
	}
}
