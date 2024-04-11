<?php

/**
 * Test the remove_filter method of WP_Hook
 *
 * @group hooks
 * @covers WP_Hook::remove_filter
 */
class Tests_Hooks_WpHook_RemoveFilter extends WP_UnitTestCase {

	public function test_remove_filter_with_function() {
		$callback      = '__return_null';
		$hook          = new WP_Hook();
		$hook_name     = __FUNCTION__;
		$priority      = 1;
		$accepted_args = 2;

		$hook->add_filter( $hook_name, $callback, $priority, $accepted_args );
		$hook->remove_filter( $hook_name, $callback, $priority );
		$this->check_priority_non_existent( $hook, $priority );

		$this->assertArrayNotHasKey( $priority, $hook->callbacks );
	}

	public function test_remove_filter_with_object() {
		$a             = new MockAction();
		$callback      = array( $a, 'action' );
		$hook          = new WP_Hook();
		$hook_name     = __FUNCTION__;
		$priority      = 1;
		$accepted_args = 2;

		$hook->add_filter( $hook_name, $callback, $priority, $accepted_args );
		$hook->remove_filter( $hook_name, $callback, $priority );
		$this->check_priority_non_existent( $hook, $priority );

		$this->assertArrayNotHasKey( $priority, $hook->callbacks );
	}

	public function test_remove_filter_with_static_method() {
		$callback      = array( 'MockAction', 'action' );
		$hook          = new WP_Hook();
		$hook_name     = __FUNCTION__;
		$priority      = 1;
		$accepted_args = 2;

		$hook->add_filter( $hook_name, $callback, $priority, $accepted_args );
		$hook->remove_filter( $hook_name, $callback, $priority );
		$this->check_priority_non_existent( $hook, $priority );

		$this->assertArrayNotHasKey( $priority, $hook->callbacks );
	}

	public function test_remove_filters_with_another_at_same_priority() {
		$callback_one  = '__return_null';
		$callback_two  = '__return_false';
		$hook          = new WP_Hook();
		$hook_name     = __FUNCTION__;
		$priority      = 1;
		$accepted_args = 2;

		$hook->add_filter( $hook_name, $callback_one, $priority, $accepted_args );
		$hook->add_filter( $hook_name, $callback_two, $priority, $accepted_args );

		$hook->remove_filter( $hook_name, $callback_one, $priority );

		$this->assertCount( 1, $hook->callbacks[ $priority ] );
		$this->check_priority_exists( $hook, $priority, 'Has priority of 2' );
	}

	public function test_remove_filter_with_another_at_different_priority() {
		$callback_one  = '__return_null';
		$callback_two  = '__return_false';
		$hook          = new WP_Hook();
		$hook_name     = __FUNCTION__;
		$priority      = 1;
		$accepted_args = 2;

		$hook->add_filter( $hook_name, $callback_one, $priority, $accepted_args );
		$hook->add_filter( $hook_name, $callback_two, $priority + 1, $accepted_args );

		$hook->remove_filter( $hook_name, $callback_one, $priority );
		$this->check_priority_non_existent( $hook, $priority );
		$this->assertArrayNotHasKey( $priority, $hook->callbacks );
		$this->assertCount( 1, $hook->callbacks[ $priority + 1 ] );
		$this->check_priority_exists( $hook, $priority + 1, 'Should priority of 3' );
	}

	/**
	 * @ticket 17817
	 *
	 * This specificaly addresses the concern raised at
	 * https://core.trac.wordpress.org/ticket/17817#comment:52
	 */
	public function test_remove_anonymous_callback() {
		$hook_name = __FUNCTION__;
		$a         = new MockAction();
		add_action( $hook_name, array( $a, 'action' ), 12, 1 );
		$this->assertTrue( has_action( $hook_name ) );

		$hook = $GLOBALS['wp_filter'][ $hook_name ];

		// From http://wordpress.stackexchange.com/a/57088/6445
		foreach ( $hook as $priority => $filter ) {
			foreach ( $filter as $identifier => $function ) {
				if (
					is_array( $function ) &&
					$function['function'][0] instanceof MockAction &&
					'action' === $function['function'][1]
				) {
					remove_filter(
						$hook_name,
						array( $function['function'][0], 'action' ),
						$priority
					);
				}
			}
		}

		$this->assertFalse( has_action( $hook_name ) );
	}

	protected function check_priority_non_existent( $hook, $priority ) {
		$priorities = $this->get_priorities( $hook );

		$this->assertNotContains( $priority, $priorities );
	}

	protected function check_priority_exists( $hook, $priority ) {
		$priorities = $this->get_priorities( $hook );

		$this->assertContains( $priority, $priorities );
	}

	protected function get_priorities( $hook ) {
		$reflection          = new ReflectionClass( $hook );
		$reflection_property = $reflection->getProperty( 'priorities' );
		$reflection_property->setAccessible( true );

		return $reflection_property->getValue( $hook );
	}
}
