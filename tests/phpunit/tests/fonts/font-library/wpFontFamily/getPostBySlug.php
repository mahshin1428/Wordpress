<?php
/**
 * Test WP_Font_Family::get_post_by_slug().
 *
 * @package WordPress
 * @subpackage Fonts
 */

require_once __DIR__ . '/base.php';

/**
 * @group fonts
 * @group font-library
 *
 * @covers WP_Font_Family::get_post_by_slug
 */
class Tests_Fonts_WpFontFamily_GetPostBySlug extends WP_Font_Family_UnitTestCase {

	public function test_should_return_post() {
		// Set up the post.
		$post    = array(
			'post_title'   => $this->merriweather['font_data']['name'],
			'post_name'    => $this->merriweather['font_data']['slug'],
			'post_type'    => 'wp_font_family',
			'post_content' => '',
			'post_status'  => 'publish',
		);
		$post_id = self::factory()->post->create( $post );
		$font    = new WP_Font_Family( $this->merriweather['font_data'] );

		// Test.
		$actual = $font->get_post_by_slug();
		$this->assertInstanceOf( WP_Post::class, $actual, 'Font post should exist' );
		$this->assertSame( $post_id, $actual->ID, 'Font post ID should match' );
	}

	public function test_should_return_null_when_post_does_not_exist() {
		$font = new WP_Font_Family( $this->merriweather['font_data'] );

		$this->assertNull( $font->get_post_by_slug() );
	}
}