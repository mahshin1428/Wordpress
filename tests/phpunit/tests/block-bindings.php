<?php
/**
 * Unit tests covering WP_Block_Bindings_Registry functionality.
 *
 * @group block-bindings
 *
 * @covers WP_Block_Bindings_Registry
 *
 * @since 6.5.0
 * @package WordPress
 */
class WP_Block_Bindings_Registry_Test extends WP_UnitTestCase {

	/**
	* Test register_source method.
	*
	* @covers WP_Block_Bindings_Registry::register_source
	*/
	public function test_register_source() {
		$wp_block_bindings = WP_Block_Bindings_Registry::get_instance();

		$source_name = 'test_source';
		$label       = 'Test Source';
		$apply       = function () { };

		$wp_block_bindings->register(
			$source_name,
			array(
				'label' => $label,
				'apply' => $apply,
			)
		);

		$sources = $wp_block_bindings->get_all_registered();
		$this->assertArrayHasKey( $source_name, $sources );
		$this->assertEquals( $label, $sources[ $source_name ]['label'], 'The label should match the one in the registered source' );
		$this->assertEquals( $apply, $sources[ $source_name ]['apply'], 'The apply callback should match the one in the registered source' );
	}

	/**
	* Test
	*
	* @covers WP_Block_Bindings_Registry::
	*/
	public function test_replace_html_for_paragraph_content() {
		$wp_block_bindings = WP_Block_Bindings_Registry::get_instance();

		$source_name = 'test_source';
		$label       = 'Test Source';
		$apply       = function () {
			return 'test source value';
		};

		$wp_block_bindings->register(
			$source_name,
			array(
				'label' => $label,
				'apply' => $apply,
			)
		);

		$block_content = '<p>Hello World</p>';
		$block_name    = 'core/paragraph';

		$block = new WP_Block(
			array(
				'blockName' => $block_name,
				'innerHTML' => $block_content,
				'attrs'     => array(
					'metadata' => array(
						'bindings' => array(
							'content' => array(
								'source' => array(
									'name' => $source_name,
								),
							),
						),
					),
				),
			)
		);

		$expected = '<p>test source value</p>';
		$result   = $block->render();

		// Check if the block content was updated correctly.
		$this->assertEquals( $expected, $result, 'The block content should be updated with the value returned by the source.' );
	}

	/**
	* Test replace_html method for attributes.
	*
	* @covers WP_Block_Bindings_Registry::replace_html
	*/
	public function test_replace_html_for_attribute() {
		// $wp_block_bindings = new WP_Block_Bindings_Registry();
		// $block_content     = '<div><a url\="">Hello World</a></div>';
		// $block_name        = 'core/button';
		// $block_attr        = 'url';
		// $source_value      = 'Updated URL';

		// $result = $wp_block_bindings->replace_html( $block_content, $block_name, $block_attr, $source_value );
		// $this->assertStringContainsString( $source_value, $result, 'The block content should be updated with the value returned by the source.' );
	}

	/**
	* Test case for scenarios where block type is not registered.
	*
	* @covers WP_Block_Bindings_Registry::replace_html
	*/
	public function test_replace_html_with_unregistered_block() {
		// $wp_block_bindings = new WP_Block_Bindings_Registry();

		// $block_content = '<p>Hello World</p>';
		// $block_name    = 'NONEXISTENT';
		// $block_attr    = 'content';
		// $source_value  = 'Updated Content';

		// $result = $wp_block_bindings->replace_html( $block_content, $block_name, $block_attr, $source_value );

		// $this->assertEquals( $block_content, $result, 'The block content should not be updated if the block type is not registered.' );
	}

	/**
	* Test case for scenarios where block is registered but attribute does not
	* exist on block type.
	*
	* @covers WP_Block_Bindings_Registry::replace_html
	*/
	public function test_replace_html_with_registered_block_but_unsupported_source_type() {
		// $wp_block_bindings = new WP_Block_Bindings_Registry();

		// $block_content = '<div>Hello World</div>';
		// $block_name    = 'core/paragraph';
		// $block_attr    = 'NONEXISTENT';
		// $source_value  = 'Updated Content';

		// $result = $wp_block_bindings->replace_html( $block_content, $block_name, $block_attr, $source_value );

		// $this->assertEquals( $block_content, $result, 'The block content should not be updated if the block type does not support the attribute.' );
	}

	/**
	 * Test case for the _process_block_bindings function using a custom binding source.
	 *
	 * @covers _process_block_bindings
	 */
	public function test_post_meta_bindings_source() {
		$wp_block_bindings = WP_Block_Bindings_Registry::get_instance();

		// Register a custom binding source.
		$source_name = 'test_source';
		$label       = 'Test Source';
		$apply       = function () {
			return 'test source value';
		};
		$wp_block_bindings->register( $source_name, array( $label, $apply ) );

		// Parsed block representing a paragraph block.
		$block = array(
			'blockName' => 'core/paragraph',
			'attrs'     => array(
				'metadata' => array(
					'bindings' => array(
						'content' => array(
							'source' => array(
								'name'       => 'test_source',
								'attributes' => array(
									'value' => 'does not matter, it is not used by the test source',
								),
							),
						),
					),
				),
			),
		);

		// Block instance representing a paragraph block.
		$block_instance = new WP_Block( $block );

		$content = $block_instance->render();
		$result  = '<p>test source value</p>';

		$this->assertEquals( $result, $content, 'The block content should be updated with the value returned by the custom binding source.' );
	}
}