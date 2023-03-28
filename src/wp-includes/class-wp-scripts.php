<?php
/**
 * Dependencies API: WP_Scripts class
 *
 * @since 2.6.0
 *
 * @package WordPress
 * @subpackage Dependencies
 */

/**
 * Core class used to register scripts.
 *
 * @since 2.1.0
 *
 * @see WP_Dependencies
 */
class WP_Scripts extends WP_Dependencies {
	/**
	 * Base URL for scripts.
	 *
	 * Full URL with trailing slash.
	 *
	 * @since 2.6.0
	 * @var string
	 */
	public $base_url;

	/**
	 * URL of the content directory.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $content_url;

	/**
	 * Default version string for scripts.
	 *
	 * @since 2.6.0
	 * @var string
	 */
	public $default_version;

	/**
	 * Holds handles of scripts which are enqueued in footer.
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $in_footer = array();

	/**
	 * Holds a list of script handles which will be concatenated.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $concat = '';

	/**
	 * Holds a string which contains script handles and their version.
	 *
	 * @since 2.8.0
	 * @deprecated 3.4.0
	 * @var string
	 */
	public $concat_version = '';

	/**
	 * Whether to perform concatenation.
	 *
	 * @since 2.8.0
	 * @var bool
	 */
	public $do_concat = false;

	/**
	 * Holds HTML markup of scripts and additional data if concatenation
	 * is enabled.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $print_html = '';

	/**
	 * Holds inline code if concatenation is enabled.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $print_code = '';

	/**
	 * Holds a list of script handles which are not in the default directory
	 * if concatenation is enabled.
	 *
	 * Unused in core.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $ext_handles = '';

	/**
	 * Holds a string which contains handles and versions of scripts which
	 * are not in the default directory if concatenation is enabled.
	 *
	 * Unused in core.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $ext_version = '';

	/**
	 * List of default directories.
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $default_dirs;

	/**
	 * Holds a string which contains the type attribute for script tag.
	 *
	 * If the active theme does not declare HTML5 support for 'script',
	 * then it initializes as `type='text/javascript'`.
	 *
	 * @since 5.3.0
	 * @var string
	 */
	private $type_attr = '';

	/**
	 * Constructor.
	 *
	 * @since 2.6.0
	 */
	public function __construct() {
		$this->init();
		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Initialize the class.
	 *
	 * @since 3.4.0
	 */
	public function init() {
		if (
			function_exists( 'is_admin' ) && ! is_admin()
		&&
			function_exists( 'current_theme_supports' ) && ! current_theme_supports( 'html5', 'script' )
		) {
			$this->type_attr = " type='text/javascript'";
		}

		/**
		 * Fires when the WP_Scripts instance is initialized.
		 *
		 * @since 2.6.0
		 *
		 * @param WP_Scripts $wp_scripts WP_Scripts instance (passed by reference).
		 */
		do_action_ref_array( 'wp_default_scripts', array( &$this ) );
	}

	/**
	 * Prints scripts.
	 *
	 * Prints the scripts passed to it or the print queue. Also prints all necessary dependencies.
	 *
	 * @since 2.1.0
	 * @since 2.8.0 Added the `$group` parameter.
	 *
	 * @param string|string[]|false $handles Optional. Scripts to be printed: queue (false),
	 *                                       single script (string), or multiple scripts (array of strings).
	 *                                       Default false.
	 * @param int|false             $group   Optional. Group level: level (int), no groups (false).
	 *                                       Default false.
	 * @return string[] Handles of scripts that have been printed.
	 */
	public function print_scripts( $handles = false, $group = false ) {
		return $this->do_items( $handles, $group );
	}

	/**
	 * Prints extra scripts of a registered script.
	 *
	 * @since 2.1.0
	 * @since 2.8.0 Added the `$display` parameter.
	 * @deprecated 3.3.0
	 *
	 * @see print_extra_script()
	 *
	 * @param string $handle  The script's registered handle.
	 * @param bool   $display Optional. Whether to print the extra script
	 *                        instead of just returning it. Default true.
	 * @return bool|string|void Void if no data exists, extra scripts if `$display` is true,
	 *                          true otherwise.
	 */
	public function print_scripts_l10n( $handle, $display = true ) {
		_deprecated_function( __FUNCTION__, '3.3.0', 'WP_Scripts::print_extra_script()' );
		return $this->print_extra_script( $handle, $display );
	}

	/**
	 * Prints extra scripts of a registered script.
	 *
	 * @since 3.3.0
	 *
	 * @param string $handle  The script's registered handle.
	 * @param bool   $display Optional. Whether to print the extra script
	 *                        instead of just returning it. Default true.
	 * @return bool|string|void Void if no data exists, extra scripts if `$display` is true,
	 *                          true otherwise.
	 */
	public function print_extra_script( $handle, $display = true ) {
		$output = $this->get_data( $handle, 'data' );
		if ( ! $output ) {
			return;
		}

		if ( ! $display ) {
			return $output;
		}

		printf( "<script%s id='%s-js-extra'>\n", $this->type_attr, esc_attr( $handle ) );

		// CDATA is not needed for HTML 5.
		if ( $this->type_attr ) {
			echo "/* <![CDATA[ */\n";
		}

		echo "$output\n";

		if ( $this->type_attr ) {
			echo "/* ]]> */\n";
		}

		echo "</script>\n";

		return true;
	}

	/**
	 * Processes a script dependency.
	 *
	 * @since 2.6.0
	 * @since 2.8.0 Added the `$group` parameter.
	 *
	 * @see WP_Dependencies::do_item()
	 *
	 * @param string    $handle The script's registered handle.
	 * @param int|false $group  Optional. Group level: level (int), no groups (false).
	 *                          Default false.
	 * @return bool True on success, false on failure.
	 */
	public function do_item( $handle, $group = false ) {
		if ( ! parent::do_item( $handle ) ) {
			return false;
		}

		if ( 0 === $group && $this->groups[ $handle ] > 0 ) {
			$this->in_footer[] = $handle;
			return false;
		}

		if ( false === $group && in_array( $handle, $this->in_footer, true ) ) {
			$this->in_footer = array_diff( $this->in_footer, (array) $handle );
		}

		$obj = $this->registered[ $handle ];

		if ( null === $obj->ver ) {
			$ver = '';
		} else {
			$ver = $obj->ver ? $obj->ver : $this->default_version;
		}

		if ( isset( $this->args[ $handle ] ) ) {
			$ver = $ver ? $ver . '&amp;' . $this->args[ $handle ] : $this->args[ $handle ];
		}

		$src         = $obj->src;
		$cond_before = '';
		$cond_after  = '';
		$conditional = isset( $obj->extra['conditional'] ) ? $obj->extra['conditional'] : '';

		if ( $conditional ) {
			$cond_before = "<!--[if {$conditional}]>\n";
			$cond_after  = "<![endif]-->\n";
		}

		$strategy = $this->get_eligible_loading_strategy( $handle );

		$before_handle = $this->print_inline_script( $handle, 'before', false );

		if ( $before_handle ) {
			$before_handle = sprintf( "<script%s id='%s-js-before'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), $before_handle );
		}

		$after_handle = '';
		if ( '' === $strategy ) {
			$after_handle = $this->print_inline_script( $handle, 'after', false );

			if ( $after_handle ) {
				$after_handle = sprintf( "<script%s id='%s-js-after'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), $after_handle );
			}
		} else {
			$after_standalone_handle = $this->print_inline_script( $handle, 'after-standalone', false );

			if ( $after_standalone_handle ) {
				$after_handle .= sprintf( "<script%s id='%s-js-after'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), $after_standalone_handle );
			}

			$after_non_standalone_handle = $this->print_inline_script( $handle, 'after-non-standalone', false );

			if ( $after_non_standalone_handle ) {
				$after_handle               .= sprintf(
					'<script%1$s id=\'%2$s-js-after\' type=\'text/template\' data-wp-executes-after=\'%2$s\'>%4$s%3$s%4$s</script>%4$s',
					$this->type_attr,
					esc_attr( $handle ),
					$after_non_standalone_handle,
					PHP_EOL
				);
				$this->has_load_later_inline = true;
			}
		}

		if ( $before_handle || $after_handle ) {
			$inline_script_tag = $cond_before . $before_handle . $after_handle . $cond_after;
		} else {
			$inline_script_tag = '';
		}

		/*
		 * Prevent concatenation of scripts if the text domain is defined
		 * to ensure the dependency order is respected.
		 */
		$translations_stop_concat = ! empty( $obj->textdomain );

		$translations = $this->print_translations( $handle, false );
		if ( $translations ) {
			$translations = sprintf( "<script%s id='%s-js-translations'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), $translations );
		}

		if ( $this->do_concat ) {
			/**
			 * Filters the script loader source.
			 *
			 * @since 2.2.0
			 *
			 * @param string $src    Script loader source path.
			 * @param string $handle Script handle.
			 */
			$srce = apply_filters( 'script_loader_src', $src, $handle );

			if ( $this->in_default_dir( $srce ) && ( $before_handle || $after_handle || $translations_stop_concat ) ) {
				$this->do_concat = false;

				// Have to print the so-far concatenated scripts right away to maintain the right order.
				_print_scripts();
				$this->reset();
			} elseif ( $this->in_default_dir( $srce ) && ! $conditional ) {
				$this->print_code     .= $this->print_extra_script( $handle, false );
				$this->concat         .= "$handle,";
				$this->concat_version .= "$handle$ver";
				return true;
			} else {
				$this->ext_handles .= "$handle,";
				$this->ext_version .= "$handle$ver";
			}
		}

		$has_conditional_data = $conditional && $this->get_data( $handle, 'data' );

		if ( $has_conditional_data ) {
			echo $cond_before;
		}

		$this->print_extra_script( $handle );

		if ( $has_conditional_data ) {
			echo $cond_after;
		}

		// A single item may alias a set of items, by having dependencies, but no source.
		if ( ! $src ) {
			if ( $inline_script_tag ) {
				if ( $this->do_concat ) {
					$this->print_html .= $inline_script_tag;
				} else {
					echo $inline_script_tag;
				}
			}

			return true;
		}

		if ( ! preg_match( '|^(https?:)?//|', $src ) && ! ( $this->content_url && 0 === strpos( $src, $this->content_url ) ) ) {
			$src = $this->base_url . $src;
		}

		if ( ! empty( $ver ) ) {
			$src = add_query_arg( 'ver', $ver, $src );
		}

		/** This filter is documented in wp-includes/class-wp-scripts.php */
		$src = esc_url( apply_filters( 'script_loader_src', $src, $handle ) );

		if ( ! $src ) {
			return true;
		}

		if ( '' !== $strategy ) {
			$strategy = ' ' . $strategy;
			if ( ! empty( $after_non_standalone_handle ) ) {
				$strategy .= sprintf( " onload='wpLoadAfterScripts(\"%s\")'", esc_attr( $handle ) );
			}
		}
		$tag  = $translations . $cond_before . $before_handle;
		$tag .= sprintf(
			"<script%s src='%s' id='%s-js'%s></script>\n",
			$this->type_attr,
			esc_url( $src ),
			esc_attr( $handle ),
			$strategy
		);
		$tag .= $after_handle . $cond_after;

		/**
		 * Filters the HTML script tag of an enqueued script.
		 *
		 * @since 4.1.0
		 *
		 * @param string $tag    The `<script>` tag for the enqueued script.
		 * @param string $handle The script's registered handle.
		 * @param string $src    The script's source URL.
		 */
		$tag = apply_filters( 'script_loader_tag', $tag, $handle, $src );

		if ( $this->do_concat ) {
			$this->print_html .= $tag;
		} else {
			echo $tag;
		}

		return true;
	}

	/**
	 * Adds extra code to a registered script.
	 *
	 * @since 4.5.0
	 *
	 * @param string $handle     Name of the script to add the inline script to.
	 *                           Must be lowercase.
	 * @param string $data       String containing the JavaScript to be added.
	 * @param string $position   Optional. Whether to add the inline script
	 *                           before the handle or after. Default 'after'.
	 * @param bool   $standalone Inline script opted to be standalone or not. Default false.
	 * @return bool True on success, false on failure.
	 */
	public function add_inline_script( $handle, $data, $position = 'after', $standalone = false ) {
		if ( ! $data ) {
			return false;
		}

		if ( 'after' !== $position ) {
			$position = 'before';
		}

		$script   = (array) $this->get_data( $handle, $position );
		$script[] = $data;

		// Maintain a list of standalone and non-standalone before/after scripts.
		$standalone_key      = $standalone ? $position . '-standalone' : $position . '-non-standalone';
		$standalone_script   = (array) $this->get_data( $handle, $standalone_key );
		$standalone_script[] = $data;
		$this->add_data( $handle, $standalone_key, $standalone_script );

		return $this->add_data( $handle, $position, $script );
	}

	/**
	 * Prints inline scripts registered for a specific handle.
	 *
	 * @since 4.5.0
	 *
	 * @param string $handle   Name of the script to add the inline script to.
	 *                         Must be lowercase.
	 * @param string $position Optional. Whether to add the inline script
	 *                         before the handle or after. Default 'after'.
	 * @param bool   $display  Optional. Whether to print the script
	 *                         instead of just returning it. Default true.
	 * @return string|false Script on success, false otherwise.
	 */
	public function print_inline_script( $handle, $position = 'after', $display = true ) {
		$output = $this->get_data( $handle, $position );

		if ( empty( $output ) ) {
			return false;
		}

		$output = trim( implode( "\n", $output ), "\n" );

		if ( $display ) {
			if ( 'after-non-standalone' === $position ) {
				printf(
					'<script%1$s id=\'%2$s-js-after\' type=\'text/template\' data-wp-executes-after=\'%2$s\'>%5$s%4$s%5$s</script>%5$s',
					$this->type_attr,
					esc_attr( $handle ),
					esc_attr( $position ),
					$output,
					PHP_EOL
				);
			} else {
				printf( "<script%s id='%s-js-%s'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), esc_attr( $position ), $output );
			}
		}

		return $output;
	}

	/**
	 * Localizes a script, only if the script has already been added.
	 *
	 * @since 2.1.0
	 *
	 * @param string $handle      Name of the script to attach data to.
	 * @param string $object_name Name of the variable that will contain the data.
	 * @param array  $l10n        Array of data to localize.
	 * @return bool True on success, false on failure.
	 */
	public function localize( $handle, $object_name, $l10n ) {
		if ( 'jquery' === $handle ) {
			$handle = 'jquery-core';
		}

		if ( is_array( $l10n ) && isset( $l10n['l10n_print_after'] ) ) { // back compat, preserve the code in 'l10n_print_after' if present.
			$after = $l10n['l10n_print_after'];
			unset( $l10n['l10n_print_after'] );
		}

		if ( ! is_array( $l10n ) ) {
			_doing_it_wrong(
				__METHOD__,
				sprintf(
					/* translators: 1: $l10n, 2: wp_add_inline_script() */
					__( 'The %1$s parameter must be an array. To pass arbitrary data to scripts, use the %2$s function instead.' ),
					'<code>$l10n</code>',
					'<code>wp_add_inline_script()</code>'
				),
				'5.7.0'
			);

			if ( false === $l10n ) {
				// This should really not be needed, but is necessary for backward compatibility.
				$l10n = array( $l10n );
			}
		}

		if ( is_string( $l10n ) ) {
			$l10n = html_entity_decode( $l10n, ENT_QUOTES, 'UTF-8' );
		} elseif ( is_array( $l10n ) ) {
			foreach ( $l10n as $key => $value ) {
				if ( ! is_scalar( $value ) ) {
					continue;
				}

				$l10n[ $key ] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );
			}
		}

		$script = "var $object_name = " . wp_json_encode( $l10n ) . ';';

		if ( ! empty( $after ) ) {
			$script .= "\n$after;";
		}

		$data = $this->get_data( $handle, 'data' );

		if ( ! empty( $data ) ) {
			$script = "$data\n$script";
		}

		return $this->add_data( $handle, 'data', $script );
	}

	/**
	 * Sets handle group.
	 *
	 * @since 2.8.0
	 *
	 * @see WP_Dependencies::set_group()
	 *
	 * @param string    $handle    Name of the item. Should be unique.
	 * @param bool      $recursion Internal flag that calling function was called recursively.
	 * @param int|false $group     Optional. Group level: level (int), no groups (false).
	 *                             Default false.
	 * @return bool Not already in the group or a lower group.
	 */
	public function set_group( $handle, $recursion, $group = false ) {
		if ( isset( $this->registered[ $handle ]->args ) && 1 === $this->registered[ $handle ]->args ) {
			$grp = 1;
		} else {
			$grp = (int) $this->get_data( $handle, 'group' );
		}

		if ( false !== $group && $grp > $group ) {
			$grp = $group;
		}

		return parent::set_group( $handle, $recursion, $grp );
	}

	/**
	 * Sets a translation textdomain.
	 *
	 * @since 5.0.0
	 * @since 5.1.0 The `$domain` parameter was made optional.
	 *
	 * @param string $handle Name of the script to register a translation domain to.
	 * @param string $domain Optional. Text domain. Default 'default'.
	 * @param string $path   Optional. The full file path to the directory containing translation files.
	 * @return bool True if the text domain was registered, false if not.
	 */
	public function set_translations( $handle, $domain = 'default', $path = '' ) {
		if ( ! isset( $this->registered[ $handle ] ) ) {
			return false;
		}

		/** @var \_WP_Dependency $obj */
		$obj = $this->registered[ $handle ];

		if ( ! in_array( 'wp-i18n', $obj->deps, true ) ) {
			$obj->deps[] = 'wp-i18n';
		}

		return $obj->set_translations( $domain, $path );
	}

	/**
	 * Prints translations set for a specific handle.
	 *
	 * @since 5.0.0
	 *
	 * @param string $handle  Name of the script to add the inline script to.
	 *                        Must be lowercase.
	 * @param bool   $display Optional. Whether to print the script
	 *                        instead of just returning it. Default true.
	 * @return string|false Script on success, false otherwise.
	 */
	public function print_translations( $handle, $display = true ) {
		if ( ! isset( $this->registered[ $handle ] ) || empty( $this->registered[ $handle ]->textdomain ) ) {
			return false;
		}

		$domain = $this->registered[ $handle ]->textdomain;
		$path   = '';

		if ( isset( $this->registered[ $handle ]->translations_path ) ) {
			$path = $this->registered[ $handle ]->translations_path;
		}

		$json_translations = load_script_textdomain( $handle, $domain, $path );

		if ( ! $json_translations ) {
			return false;
		}

		$output = <<<JS
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "{$domain}", {$json_translations} );
JS;

		if ( $display ) {
			printf( "<script%s id='%s-js-translations'>\n%s\n</script>\n", $this->type_attr, esc_attr( $handle ), $output );
		}

		return $output;
	}

	/**
	 * Determines script dependencies.
	 *
	 * @since 2.1.0
	 *
	 * @see WP_Dependencies::all_deps()
	 *
	 * @param string|string[] $handles   Item handle (string) or item handles (array of strings).
	 * @param bool            $recursion Optional. Internal flag that function is calling itself.
	 *                                   Default false.
	 * @param int|false       $group     Optional. Group level: level (int), no groups (false).
	 *                                   Default false.
	 * @return bool True on success, false on failure.
	 */
	public function all_deps( $handles, $recursion = false, $group = false ) {
		$r = parent::all_deps( $handles, $recursion, $group );
		if ( ! $recursion ) {
			/**
			 * Filters the list of script dependencies left to print.
			 *
			 * @since 2.3.0
			 *
			 * @param string[] $to_do An array of script dependency handles.
			 */
			$this->to_do = apply_filters( 'print_scripts_array', $this->to_do );
		}
		return $r;
	}

	/**
	 * Processes items and dependencies for the head group.
	 *
	 * @since 2.8.0
	 *
	 * @see WP_Dependencies::do_items()
	 *
	 * @return string[] Handles of items that have been processed.
	 */
	public function do_head_items() {
		$this->do_items( false, 0 );
		return $this->done;
	}

	/**
	 * Processes items and dependencies for the footer group.
	 *
	 * @since 2.8.0
	 *
	 * @see WP_Dependencies::do_items()
	 *
	 * @return string[] Handles of items that have been processed.
	 */
	public function do_footer_items() {
		$this->do_items( false, 1 );
		return $this->done;
	}

	/**
	 * Whether a handle's source is in a default directory.
	 *
	 * @since 2.8.0
	 *
	 * @param string $src The source of the enqueued script.
	 * @return bool True if found, false if not.
	 */
	public function in_default_dir( $src ) {
		if ( ! $this->default_dirs ) {
			return true;
		}

		if ( 0 === strpos( $src, '/' . WPINC . '/js/l10n' ) ) {
			return false;
		}

		foreach ( (array) $this->default_dirs as $test ) {
			if ( 0 === strpos( $src, $test ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * This overrides the add_data method from WP_Dependencies, to support normalizing of $args.
	 *
	 * @param string $handle Name of the item. Should be unique.
	 * @param string $key    The data key.
	 * @param mixed  $value  The data value.
	 * @return bool True on success, false on failure.
	 */
	public function add_data( $handle, $key, $value ) {
		if ( 'script_args' === $key ) {
			$args = $this->get_normalized_script_args( $handle, $value );
			if ( $args['in_footer'] ) {
				parent::add_data( $handle, 'group', 1 );
			}
			return parent::add_data( $handle, $key, $args );
		}
		return parent::add_data( $handle, $key, $value );
	}

	/**
	 * Checks all handles for any delayed inline scripts.
	 *
	 * @return bool True if script present. False if empty.
	 */
	public function has_delayed_inline_script() {
		foreach ( $this->registered as $handle => $script ) {
			if ( in_array( $this->get_intended_strategy( $handle ), array( 'defer', 'async' ), true ) ) {
				// non standalone after scripts of async or defer are usually delayed.
				if ( $this->has_non_standalone_inline_script( $handle, 'after' ) ) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Normalize the data inside the $args parameter and support backward compatibility.
	 *
	 * @param string        $handle Name of the script.
	 * @param array         $args     {
	 *      Optional. Additional script arguments. Default empty array.
	 *
	 *      @type boolean   $in_footer    Optional. Default true.
	 *      @type string    $strategy     Optional. Values blocking|defer|async .Default 'blocking'.
	 * }
	 * @return array        Normalized $args array.
	 */
	private function get_normalized_script_args( $handle, $args = array() ) {
		$default_args = array(
			'in_footer' => false,
			'strategy'  => 'blocking',
		);
		// Handle backward compatibility for $in_footer.
		if ( true === $args ) {
			$args = array( 'in_footer' => true );
		}
		return wp_parse_args( $args, $default_args );
	}

	/**
	 * Get all of the scripts that depend on a script.
	 *
	 * @param string $handle The script handle.
	 * @return array Array of script handles.
	 */
	private function get_dependents( $handle ) {
		$dependents = array();

		// Iterate over all registered scripts, finding ones that depend on the script.
		foreach ( $this->registered as $registered_handle => $args ) {
			if ( in_array( $handle, $args->deps, true ) ) {
				$dependents[] = $registered_handle;
			}
		}
		return $dependents;
	}

	/**
	 * Get the strategy assigned during script registration.
	 *
	 * @param string $handle The script handle.
	 * @return string|bool Strategy set during script registration. False if none was set.
	 */
	private function get_intended_strategy( $handle ) {
		$script_args = $this->get_data( $handle, 'script_args' );
		return isset( $script_args['strategy'] ) ? $script_args['strategy'] : false;
	}

	/**
	 * Check if a script has a non standalone inline script associated with it.
	 *
	 * @param string $handle   The script handle.
	 * @param string $position Position of the inline script.
	 *
	 * @return bool True if script present. False if empty.
	 */
	private function has_non_standalone_inline_script( $handle, $position ) {
		$non_standalone_script_key = $position . '-non-standalone';
		$non_standalone_script     = $this->get_data( $handle, $non_standalone_script_key );
		return ! empty( $non_standalone_script );
	}

	/**
	 * Check if all of a scripts dependents are deferrable, which is required to maintain execution order.
	 *
	 * @param string $handle  The script handle.
	 * @param array $checked An array of already checked script handles, used to avoid looping recursion.
	 * @return bool True if all dependents are deferrable, false otherwise.
	 */
	private function all_dependents_are_deferrable( $handle, $checked = array() ) {
		// If this node was already checked, this script can be deferred and the branch ends.
		if ( in_array( $handle, $checked, true ) ) {
			return true;
		}
		$checked[]  = $handle;
		$dependents = $this->get_dependents( $handle );

		// If there are no dependents remaining to consider, the script can be deferred and the branch ends.
		if ( empty( $dependents ) ) {
			return true;
		}

		// Consider each dependent and check if it is deferrable.
		foreach ( $dependents as $dependent ) {
			// If the dependent script is not using the defer or async strategy, no script in the chain is deferrable.
			if ( ! in_array( $this->get_intended_strategy( $dependent ), array( 'defer', 'async' ), true ) ) {
				return false;
			}

			// If the dependent script has a non-standalone inline script in the 'before' position associated with it, do not defer.
			if ( $this->has_non_standalone_inline_script( $dependent, 'before' ) ) {
				return false;
			}

			// Recursively check all dependents.
			if ( ! $this->all_dependents_are_deferrable( $dependent, $checked ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Get the most eligible loading strategy for a script.
	 *
	 * @param string  $handle The registered handle of the script.
	 * @return string $strategy return the final strategy.
	 */
	private function get_eligible_loading_strategy( $handle = '' ) {
		if ( ! isset( $this->registered[ $handle ] ) ) {
			return '';
		}

		$intended_strategy = $this->get_intended_strategy( $handle );
		/*
		 * Handle known blocking strategy scenarios.
		 *
		 * blocking if script args not set.
		 * blocking if explicitly set.
		 */
		if ( ! $intended_strategy || 'blocking' === $intended_strategy ) {
			return '';
		}

		// Handling async strategy scenarios.
		if ( 'async' === $intended_strategy && empty( $this->registered[ $handle ]->deps ) && empty( $this->get_dependents( $handle ) ) ) {
			return 'async';
		}

		// Handling defer strategy scenarios.
		if ( $this->all_dependents_are_deferrable( $handle ) ) {
			return 'defer';
		}

		return '';
	}

	/**
	 * Resets class properties.
	 *
	 * @since 2.8.0
	 */
	public function reset() {
		$this->do_concat      = false;
		$this->print_code     = '';
		$this->concat         = '';
		$this->concat_version = '';
		$this->print_html     = '';
		$this->ext_version    = '';
		$this->ext_handles    = '';
	}
}
