<?php

class WP_Token_Map {
	const MAX_LENGTH = 256;

	private $key_length = 2;

	/**
	 * Stores an optimized form of the word set, where words are grouped
	 * by first two letters and then collapsed into a string.
	 *
	 * @var array
	 */
	private $large_words = array();

	/**
	 * Stores an optimized row of short words, where every entry is two
	 * bytes long and zero-extended if the word is only a single byte.
	 *
	 * @var string
	 */
	private $small_words = '';

	/**
	 * Holds mapping according to the index in the small words.
	 *
	 * @var string[]
	 */
	private $small_mappings = array();

	public static function from_array( $mappings, $key_length = 2 ) {
		$map             = new WP_Token_Map();
		$map->key_length = $key_length;

		// Start by grouping words.

		$groups = array();
		$shorts = array();
		foreach ( $mappings as $word => $mapping ) {
			if ( ! is_string( $word ) || self::MAX_LENGTH <= strlen( $word ) ) {
				return null;
			}

			$length = strlen( $word );

			if ( $key_length >= $length ) {
				$shorts[] = $word;
			} else {
				$group = substr( $word, 0, $key_length );

				if ( ! isset( $groups[ $group ] ) ) {
					$groups[ $group ] = array();
				}

				$groups[ $group ][] = array( substr( $word, $key_length ), $mapping );
			}
		}

		// Sort the words by longest-first, then alphabetical.

		usort( $shorts, array( self::class, 'longest_first_then_alphabetical' ) );
		foreach ( $groups as $group_key => $group ) {
			usort( $groups[ $group_key ], array( self::class, 'longest_first_then_alphabetical' ) );
		}

		// Finally construct the optimized lookups.

		foreach ( $shorts as $word ) {
			$map->small_words     .= str_pad( $word, $key_length, "\x00" );
			$map->small_mappings[] = $mapping;
		}

		foreach ( $groups as $group => $group_words ) {
			$group_string = '';

			foreach ( $group_words as $group_word ) {
				list( $word, $mapping ) = $group_word;

				$group_string .= pack( 'C', strlen( $word ) ) . $word . pack( 'C', strlen( $mapping ) ) . $mapping;
			}

			$map->large_words[ $group ] = $group_string;
		}

		return $map;
	}

	public static function from_precomputed_table( $key_length, $large_words, $small_words, $small_mappings ) {
		$map = new WP_Token_Map();

		$map->key_length     = $key_length;
		$map->large_words    = $large_words;
		$map->small_words    = $small_words;
		$map->small_mappings = $small_mappings;

		return $map;
	}

	public function contains( $word ) {
		if ( $this->key_length >= strlen( $word ) ) {
			$word_at = strpos( $this->small_words, str_pad( $word, $this->key_length, "\x00" ) );
			if ( false === $word_at ) {
				return false;
			}

			return $this->small_mappings[ $word_at / $this->key_length ];
		}

		$group_key = substr( $word, 0, $this->key_length );
		if ( ! isset( $this->large_words[ $group_key ] ) ) {
			return false;
		}

		$group  = $this->large_words[ $group_key ];
		$slug   = substr( $word, $this->key_length );
		$length = strlen( $slug );
		$at     = 0;
		while ( $at < strlen( $group ) ) {
			$token_length   = unpack( 'C', $group[ $at++ ] )[1];
			$token_at       = $at;
			$at            += $token_length;
			$mapping_length = unpack( 'C', $group[ $at++ ] )[1];
			$mapping_at     = $at;

			if ( $token_length === $length && 0 === substr_compare( $group, $slug, $token_at, $token_length ) ) {
				return substr( $group, $mapping_at, $mapping_length );
			}

			$at = $mapping_at + $mapping_length;
		}

		return false;
	}

	public function read_token( $text, $offset, &$skip_bytes ) {
		$text_length = strlen( $text );

		// Search for a long word first, if the text is long enough, and if that fails, a short one.
		if ( $this->key_length < $text_length ) {
			$group_key = substr( $text, $offset, $this->key_length );

			if ( ! isset( $this->large_words[ $group_key ] ) ) {
				return false;
			}

			$group        = $this->large_words[ $group_key ];
			$group_length = strlen( $group );
			$at           = 0;
			while ( $at < $group_length ) {
				$token_length   = unpack( 'C', $group[ $at++ ] )[1];
				$token          = substr( $group, $at, $token_length );
				$at            += $token_length;
				$mapping_length = unpack( 'C', $group[ $at++ ] )[1];
				$mapping_at     = $at;

				if ( 0 === substr_compare( $text, $token, $offset + $this->key_length, $token_length ) ) {
					$skip_bytes = $this->key_length + $token_length;
					return substr( $group, $mapping_at, $mapping_length );
				}

				$at = $mapping_at + $mapping_length;
			}
		}

		// Perhaps a short word then.
		$small_text = str_pad( substr( $text, $offset, $this->key_length ), $this->key_length, "\x00" );
		$at         = strpos( $this->small_words, $small_text );

		if ( false === $at ) {
			return false;
		}

		$skip_bytes = strlen( trim( $small_text, "\x00" ) );
		return $this->small_mappings[ $at / $this->key_length ];
	}

	public function to_array() {
		$tokens = array();

		$at            = 0;
		$small_mapping = 0;
		while ( $at < strlen( $this->small_words ) ) {
			$token = array();

			$token[]  = rtrim( substr( $this->small_words, $at, $this->key_length ), "\x00" );
			$token[]  = $this->small_mappings[ $small_mapping++ ];
			$tokens[] = $token;

			$at += $this->key_length;
		}

		foreach ( $this->large_words as $prefix => $group ) {
			$at = 0;
			while ( $at < strlen( $group ) ) {
				$token = array();

				$length  = unpack( 'C', $group[ $at++ ] )[1];
				$token[] = $prefix . substr( $group, $at, $length );

				$at     += $length;
				$length  = unpack( 'C', $group[ $at++ ] )[1];
				$token[] = substr( $group, $at, $length );

				$tokens[] = $token;
				$at      += $length;
			}
		}

		return $tokens;
	}

	public function precomputed_php_source_table( $indent = "\t" ) {
		$i1 = $indent;
		$i2 = $indent . $indent;

		$output  = self::class . "::from_precomputed_table(\n";
		$output .= "{$i1}{$this->key_length},\n";
		$output .= "{$i1}array(\n";

		$prefixes = array_keys( $this->large_words );
		sort( $prefixes );
		foreach ( $prefixes as $prefix ) {
			$group        = $this->large_words[ $prefix ];
			$comment_line = "{$i2}//";
			$data_line    = "{$i2}'{$prefix}' => \"";
			$at           = 0;
			while ( $at < strlen( $group ) ) {
				$token_length   = unpack( 'C', $group[ $at++ ] )[1];
				$token          = substr( $group, $at, $token_length );
				$at            += $token_length;
				$mapping_length = unpack( 'C', $group[ $at++ ] )[1];
				$mapping        = substr( $group, $at, $mapping_length );
				$at            += $mapping_length;

				$token_digits   = str_pad( dechex( $token_length ), 2, '0', STR_PAD_LEFT );
				$mapping_digits = str_pad( dechex( $mapping_length ), 2, '0', STR_PAD_LEFT );

				$mapping = preg_replace_callback(
					"~[\x00-\x1f\"]~",
					static function ( $match ) {
						if ( '"' === $match[0] ) {
							return '\\"';
						}
						$hex = dechex( ord( $match[0] ) );
						return "\\x{$hex}";
					},
					$mapping
				);

				$comment_line .= " {$prefix}{$token}[{$mapping}]";
				$data_line    .= "\\x{$token_digits}{$token}\\x{$mapping_digits}{$mapping}";
			}
			$comment_line .= "\n";
			$data_line    .= "\",\n";

			$output .= $comment_line;
			$output .= $data_line;
		}

		$output .= "{$i1}),\n";

		$small_words   = array();
		$at            = 0;
		while ( $at < strlen( $this->small_words ) ) {
			$small_words[] = substr( $this->small_words, $at, $this->key_length );
			$at           += $this->key_length;
		}
//		sort( $small_words );

		$small_text = str_replace( "\x00", '\x00', implode( '', $small_words ) );
		$output    .= "{$i1}\"{$small_text}\",\n";

		$output .= "{$i1}array(\n";
		foreach ( $this->small_mappings as $mapping ) {
			$output .= "{$i2}\"{$mapping}\",\n";
		}
		$output .= "{$i1})\n";

		$output    .= ");\n";

		return $output;
	}

	private static function longest_first_then_alphabetical( $a, $b ) {
		if ( $a[0] === $b[0] ) {
			return 0;
		}

		$la = strlen( $a[0] );
		$lb = strlen( $b[0] );

		// Longer strings are less-than for comparison's sake.
		if ( $la !== $lb ) {
			return $lb - $la;
		}

		return strcmp( $a[0], $b[0] );
	}
}
