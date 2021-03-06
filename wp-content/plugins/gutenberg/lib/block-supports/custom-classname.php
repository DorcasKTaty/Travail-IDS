<?php
/**
 * Custom classname block support flag.
 *
 * @package gutenberg
 */

/**
 * Registers the custom classname block attribute for block types that support it.
 *
 * @param  array $block_type Block Type.
 */
function gutenberg_register_custom_classname_support( $block_type ) {
	$has_custom_classname_support = gutenberg_experimental_get( $block_type->supports, array( 'customClassName' ), true );
	if ( $has_custom_classname_support ) {
		if ( ! $block_type->attributes ) {
			$block_type->attributes = array();
		}

		if ( ! array_key_exists( 'className', $block_type->attributes ) ) {
			$block_type->attributes['className'] = array(
				'type' => 'string',
			);
		}
	}
}

/**
 * Add the custom classnames to the output.
 *
 * @param  array $attributes comprehensive list of attributes to be applied.
 * @param  array $block_attributes block attributes.
 * @param  array $block_type Block Type.
 * @return array Block CSS classes and inline styles.
 */
function gutenberg_apply_custom_classname_support( $attributes, $block_attributes, $block_type ) {
	$has_custom_classname_support = gutenberg_experimental_get( $block_type->supports, array( 'customClassName' ), true );
	if ( $has_custom_classname_support ) {
		$has_custom_classnames = array_key_exists( 'className', $block_attributes );

		if ( $has_custom_classnames ) {
			$attributes['css_classes'][] = $block_attributes['className'];
		}
	}

	return $attributes;
}
