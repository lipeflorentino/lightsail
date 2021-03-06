<?php

class SimpleTags_Client {
	/**
	 * Initialize Simple Tags client
	 *
	 * @return boolean
	 */
	public function __construct() {
		// Load translation
		add_action( 'init', array( __CLASS__, 'init_translation' ) );

		// Add pages in WP_Query
		if ( (int) SimpleTags_Plugin::get_option_value( 'use_tag_pages' ) == 1 ) {
			add_action( 'init', array( __CLASS__, 'init' ), 11 );
			add_action( 'parse_query', array( __CLASS__, 'parse_query' ) );
		}

		// Call autolinks ?
		if ( (int) SimpleTags_Plugin::get_option_value( 'auto_link_tags' ) == 1 ) {
			require( STAGS_DIR . '/inc/class.client.autolinks.php' );
			new SimpleTags_Client_Autolinks();
		}

		// Call related posts ?
		if ( (int) SimpleTags_Plugin::get_option_value( 'active_related_posts' ) == 1 ) {
			require( STAGS_DIR . '/inc/class.client.related_posts.php' );
			new SimpleTags_Client_RelatedPosts();
		}

		// Call auto terms ?
		require( STAGS_DIR . '/inc/class.client.autoterms.php' );
		new SimpleTags_Client_Autoterms();

		// Call post tags ?
		require( STAGS_DIR . '/inc/class.client.post_tags.php' );
		new SimpleTags_Client_PostTags();

		return true;
	}

	/**
	 * Load translations
	 */
	public static function init_translation() {
		load_plugin_textdomain( 'simpletags', false, basename( STAGS_DIR ) . '/languages' );
	}

	/**
	 * Register taxonomy post_tags for page post type
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	public static function init() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}

	/**
	 * Add page post type during the query
	 *
	 * @param WP_Query $query
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	public static function parse_query( $query ) {
		if ( $query->is_tag == true ) {
			if ( ! isset( $query->query_vars['post_type'] ) || $query->query_vars['post_type'] == 'post' ) {
				$query->query_vars['post_type'] = array( 'post', 'page' );
			} elseif ( isset( $query->query_vars['post_type'] ) && is_array( $query->query_vars['post_type'] ) && in_array( 'post', $query->query_vars['post_type'] ) ) {
				$query->query_vars['post_type'][] = 'page';
			}
		}
	}

	/**
	 * Randomize an array and keep association
	 *
	 * @param array $array
	 *
	 * @return boolean
	 */
	public static function random_array( &$array ) {
		if ( ! is_array( $array ) || empty( $array ) ) {
			return false;
		}

		$keys = array_keys( $array );
		shuffle( $keys );

		$new = array();
		foreach ( (array) $keys as $key ) {
			$new[ $key ] = $array[ $key ];
		}

		$array = $new;

		return true;
	}

	/**
	 * Build rel for tag link
	 *
	 * @return string
	 */
	public static function get_rel_attribut() {
		global $wp_rewrite;
		$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'tag' : ''; // Tag ?
		if ( ! empty( $rel ) ) {
			$rel = 'rel="' . $rel . '"'; // Add HTML Tag
		}

		return $rel;
	}

	/**
	 * Format data for output
	 *
	 * @param string $html_class
	 * @param string $format
	 * @param string $title
	 * @param string $content
	 * @param boolean $copyright
	 * @param string $separator
	 *
	 * @return string|array
	 */
	public static function output_content( $html_class = '', $format = 'list', $title = '', $content = '', $copyright = true, $separator = '' ) {
		if ( empty( $content ) ) {
			return ''; // return nothing
		}

		if ( $format == 'array' && is_array( $content ) ) {
			return $content; // Return PHP array if format is array
		}

		if ( is_array( $content ) ) {
			switch ( $format ) {
				case 'list' :
					$output = '<ul class="' . $html_class . '">' . "\n\t" . '<li>' . implode( "</li>\n\t<li>", $content ) . "</li>\n</ul>\n";
					break;
				default :
					$output = '<div class="' . $html_class . '">' . "\n\t" . implode( "{$separator}\n", $content ) . "</div>\n";
					break;
			}
		} else {
			$content = trim( $content );
			switch ( $format ) {
				case 'string' :
					$output = $content;
					break;
				case 'list' :
					$output = '<ul class="' . $html_class . '">' . "\n\t" . '<li>' . $content . "</li>\n\t" . "</ul>\n";
					break;
				default :
					$output = '<div class="' . $html_class . '">' . "\n\t" . $content . "</div>\n";
					break;
			}
		}

		// Replace false by empty
		$title = trim( $title );
		if ( strtolower( $title ) == 'false' ) {
			$title = '';
		}

		// Put title if exist
		if ( ! empty( $title ) ) {
			$title .= "\n\t";
		}

		if ( $copyright === true ) {
			return "\n" . '<!-- Generated by Simple Tags ' . STAGS_VERSION . ' - http://wordpress.org/extend/plugins/simple-tags -->' . "\n\t" . $title . $output . "\n";
		} else {
			return "\n\t" . $title . $output . "\n";
		}
	}

	/**
	 * Remplace marker by dynamic values (use for related tags, current tags and tag cloud)
	 *
	 * @param string $element_loop
	 * @param object $term
	 * @param string $rel
	 * @param integer $scale_result
	 * @param integer $scale_max
	 * @param integer $scale_min
	 * @param integer $largest
	 * @param integer $smallest
	 * @param string $unit
	 * @param string $maxcolor
	 * @param string $mincolor
	 *
	 * @return string
	 */
	public static function format_internal_tag( $element_loop = '', $term = null, $rel = '', $scale_result = 0, $scale_max = null, $scale_min = 0, $largest = 0, $smallest = 0, $unit = '', $maxcolor = '', $mincolor = '' ) {
		// Need term object
		$element_loop = str_replace( '%tag_link%', esc_url( get_term_link( $term, $term->taxonomy ) ), $element_loop );
		$element_loop = str_replace( '%tag_feed%', esc_url( get_term_feed_link( $term->term_id, $term->taxonomy, '' ) ), $element_loop );

		$element_loop = str_replace( '%tag_name%', esc_html( $term->name ), $element_loop );
		$element_loop = str_replace( '%tag_name_attribute%', esc_html( strip_tags( $term->name ) ), $element_loop );
		$element_loop = str_replace( '%tag_id%', $term->term_id, $element_loop );
		$element_loop = str_replace( '%tag_count%', (int) $term->count, $element_loop );

		// Need rel
		$element_loop = str_replace( '%tag_rel%', $rel, $element_loop );

		// Need max/min/scale and other :)
		if ( $scale_result !== null ) {
			$element_loop = str_replace( '%tag_size%', 'font-size:' . self::round( ( $scale_result - $scale_min ) * ( $largest - $smallest ) / ( $scale_max - $scale_min ) + $smallest, 2 ) . $unit . ';', $element_loop );
			$element_loop = str_replace( '%tag_color%', 'color:' . self::get_color_by_scale( self::round( ( $scale_result - $scale_min ) * ( 100 ) / ( $scale_max - $scale_min ), 2 ), $mincolor, $maxcolor ) . ';', $element_loop );
			$element_loop = str_replace( '%tag_scale%', $scale_result, $element_loop );
		}

		// External link
		$element_loop = str_replace( '%tag_technorati%', self::format_external_tag( 'technorati', $term->name ), $element_loop );
		$element_loop = str_replace( '%tag_flickr%', self::format_external_tag( 'flickr', $term->name ), $element_loop );
		$element_loop = str_replace( '%tag_delicious%', self::format_external_tag( 'delicious', $term->name ), $element_loop );

		return $element_loop;
	}

	/**
	 * This is pretty filthy. Doing math in hex is much too weird. It's more likely to work, this way!
	 * Provided from UTW. Thanks.
	 *
	 * @param integer $scale_color
	 * @param string $min_color
	 * @param string $max_color
	 *
	 * @return string
	 */
	public static function get_color_by_scale( $scale_color, $min_color, $max_color ) {
		$scale_color = $scale_color / 100;

		$minr = hexdec( substr( $min_color, 1, 2 ) );
		$ming = hexdec( substr( $min_color, 3, 2 ) );
		$minb = hexdec( substr( $min_color, 5, 2 ) );

		$maxr = hexdec( substr( $max_color, 1, 2 ) );
		$maxg = hexdec( substr( $max_color, 3, 2 ) );
		$maxb = hexdec( substr( $max_color, 5, 2 ) );

		$r = dechex( intval( ( ( $maxr - $minr ) * $scale_color ) + $minr ) );
		$g = dechex( intval( ( ( $maxg - $ming ) * $scale_color ) + $ming ) );
		$b = dechex( intval( ( ( $maxb - $minb ) * $scale_color ) + $minb ) );

		if ( strlen( $r ) == 1 ) {
			$r = '0' . $r;
		}
		if ( strlen( $g ) == 1 ) {
			$g = '0' . $g;
		}
		if ( strlen( $b ) == 1 ) {
			$b = '0' . $b;
		}

		return '#' . $r . $g . $b;
	}

	/**
	 * Extend the round PHP public static function for force a dot for all locales instead the comma.
	 *
	 * @param string $value
	 * @param string $approximation
	 *
	 * @return float
	 * @author Amaury Balmer
	 */
	public static function round( $value, $approximation ) {
		$value = round( $value, $approximation );
		$value = str_replace( ',', '.', $value ); // Fixes locale comma
		$value = str_replace( ' ', '', $value ); // No space

		return $value;
	}

	/**
	 * Format nice URL depending service
	 *
	 * @param string $type
	 * @param string $term_name
	 *
	 * @return string
	 */
	public static function format_external_tag( $type = '', $term_name = '' ) {
		if ( empty( $term_name ) ) {
			return '';
		}

		$term_name = esc_html( $term_name );
		switch ( $type ) {
			case 'technorati':
				return '<a class="tag_technorati" href="' . esc_url( 'http://technorati.com/tag/' . str_replace( ' ', '+', $term_name ) ) . '" rel="tag">' . $term_name . '</a>';
				break;
			case 'flickr':
				return '<a class="tag_flickr" href="' . esc_url( 'http://www.flickr.com/photos/tags/' . preg_replace( '/[^a-zA-Z0-9]/', '', strtolower( $term_name ) ) . '/' ) . '" rel="tag">' . $term_name . '</a>';
				break;
			case 'delicious':
				return '<a class="tag_delicious" href="' . esc_url( 'http://del.icio.us/popular/' . strtolower( str_replace( ' ', '', $term_name ) ) ) . '" rel="tag">' . $term_name . '</a>';
				break;
			default:
				return '';
				break;
		}
	}
}