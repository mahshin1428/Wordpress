<?php

class WP_HTML_To_Markdown_Converter {
	public static function convert( $html ) {
		$processor   = WP_HTML_Processor::create_fragment( $html );
		$md          = '';
		$list_items  = array();
		$depth       = 0;
		$blockquotes = array();
		$link        = null;

		while ( $processor->next_token() ) {
			$indent      = str_pad( '', $depth * 2, ' ' );
			$token_name  = $processor->get_token_name();
			$breadcrumbs = $processor->get_breadcrumbs();

			if ( $processor->is_tag_closer() ) {
				switch ( $token_name ) {
					case 'H1':
					case 'H2':
					case 'H3':
					case 'H4':
					case 'H5':
					case 'H6':
						$md .= "\n";
						break;

					case 'A':
						$md  .= "]({$link})";
						$link = null;
						break;

					case 'B':
					case 'STRONG':
						$md .= '**';
						break;

					case 'BLOCKQUOTE':
						$blockquote_at = array_pop( $blockquotes );
						$blockquote    = substr( $md, $blockquote_at );
						$blockquote    = implode( "\n", array_map( fn ( $l ) => "> {$l}", explode( "\n", $blockquote ) ) );
						$md            = substr( $md, 0, $blockquote_at ) . "\n" . $blockquote;
						if ( 0 === count( $blockquotes ) ) {
							$md .= "\n";
						}
						break;

					case 'I':
					case 'EM':
						$md .= '_';
						break;

					case 'OL':
					case 'UL':
						--$depth;
						array_pop( $list_items );
						break;
				}

				// Proceed to the next token.
				continue;
			}

			switch ( $token_name ) {
				case '#text':
					$text_chunk = $processor->get_modifiable_text();

					// Skip inter-element whitespace.
					// @todo: Detect this properly, ensuring it's actually inter-element.
					if ( '' === trim( $text_chunk, "\t\r\n\f" ) ) {
						break;
					}

					if ( null !== $link ) {
						$text_chunk = str_replace( ']', '\\]', $text_chunk );
					}

					$md .= $text_chunk;
					break;

				case 'P':
					$md .= "\n";
					break;

				case 'H1':
				case 'H2':
				case 'H3':
				case 'H4':
				case 'H5':
				case 'H6':
					$hash_count = intval( $token_name[1] );
					$hashes     = str_pad( '', $hash_count, '#' );
					$md        .= "\n\n{$hashes} ";
					break;

				case 'A':
					$href = $processor->get_attribute( 'href' );
					$link = $href;
					$md  .= '[';
					break;

				case 'B':
				case 'STRONG':
					$md .= '**';
					break;

				case 'I':
				case 'EM':
					$md .= '_';
					break;

				case 'IMG':
					$src = $processor->get_attribute( 'src' );
					$src = str_replace( ')', '%29', $src );
					$md .= "![]({$src})";
					break;

				case 'BLOCKQUOTE':
					$blockquotes[] = strlen( $md );
					break;

				case 'LI':
					$list_item = end( $list_items );
					$md       .= "\n{$indent}{$list_item} ";
					break;

				case 'OL':
					++$depth;
					$list_items[] = '*';
					break;

				case 'UL':
					++$depth;
					$list_items[] = '-';
					break;
			}

			$last_breadcrumbs = $breadcrumbs;
		}

		if ( null !== $processor->get_last_error() ) {
			die( "Encountered unsupported HTML: failed to convert.\n" );
		}

		$closed_elements = array();
		for ( $i = 0; $i < count( $last_breadcrumbs ); $i++ ) {
			if (
				isset( $last_breadcrumbs[ $i ], $breadcrumbs[ $i ] ) &&
				$last_breadcrumbs[ $i ] === $breadcrumbs[ $i ]
			) {
				continue;
			}

			$closed_elements = array_slice( $last_breadcrumbs, $i );
			break;
		}

		$closed_elements = array_reverse( $closed_elements );
		foreach ( $closed_elements as $element ) {
			switch ( $element ) {
				case 'H1':
				case 'H2':
				case 'H3':
				case 'H4':
				case 'H5':
				case 'H6':
					$md .= "\n";
					break;

				case 'A':
					$md  .= "]({$link})";
					$link = null;
					break;

				case 'B':
				case 'STRONG':
					$md .= '**';
					break;

				case 'BLOCKQUOTE':
					$blockquote_at = array_pop( $blockquotes );
					$blockquote    = substr( $md, $blockquote_at );
					$blockquote    = implode( "\n", array_map( fn ( $l ) => "> {$l}", explode( "\n", $blockquote ) ) );
					$md            = substr( $md, 0, $blockquote_at ) . "\n" . $blockquote;
					if ( 0 === count( $blockquotes ) ) {
						$md .= "\n";
					}
					break;

				case 'I':
				case 'EM':
					$md .= '_';
					break;

				case 'OL':
				case 'UL':
					--$depth;
					array_pop( $list_items );
					break;
			}
		}

		return trim( $md );
	}
}
