<?php

namespace BlockStub;

final class BlockFactory {
	private string $file;
	const HOOK = 'blockstub_init';

	private function __construct(string $file) {
		$this->file = $file;
	}

	/**
	 * @param string $file
	 *
	 * @uses registerBlocks
	 */
	public static function boot(string $file) {
		$factory = new self($file);
		add_action('init', [$factory, 'registerBlocks']);
	}

	public function registerBlocks() {
		do_action(self::HOOK, $this);
	}

	public function add(BlockContract $block): self {
		if (!function_exists( 'register_block_type')) {
			return $this;
		}
	
		$handle = $block->getHandle();
		$fullHandle = 'blockstub/' . $handle;
		$rootElement = $block->render();
		$wrapElement = new Wrap($rootElement);

		$jsHandle = json_encode($handle);
		$jsFullHandle = json_encode($fullHandle);
	
		$dir = dirname($this->file);
	
		$zeroJs = '0.js';
		$jsRender = $wrapElement->renderReact();
		$attributes = $block->getAttributes();
		$jsAttributes = json_encode($attributes);
		$jsTitle = json_encode($block->getTitle());
	
		wp_register_script(
			$handle . '-block-editor',
			plugins_url( $zeroJs, $this->file ),
			[
				'wp-blocks',
				'wp-i18n',
				'wp-element',
			],
			filemtime( "{$dir}/{$zeroJs}")
		);
		wp_add_inline_script($handle . '-block-editor', <<<JS
			(function(wp) {
				const el = wp.element.createElement
				const {
					Fragment,
					useContext,
					useEffect,
					useLayoutEffect,
					useReducer,
					useRef,
					useMemo,
					useState,
			 } = wp.element
				const F = Fragment

				wp.blocks.registerBlockType($jsFullHandle, {
					title: $jsTitle,
					icon: 'plugins-checked',
					category: 'widgets',
					attributes: $jsAttributes,
					apiVersion: 2,
					supports: {
						html: false,
					},
					edit: function(props) {
						const { attributes, setAttributes } = props 
						return $jsRender
					},
					save: () => null,
				})
			})(window.wp)
		JS);

		// $editor_css = 'editor.css';
		// wp_register_style(
		// 	$handle . '-block-editor',
		// 	plugins_url($editor_css, $this->file),
		// 	[],
		// 	filemtime("{$dir}/{$editor_css}")
		// );
	
		// $style_css = 'style.css';
		// wp_register_style(
		// 	$handle . '-block',
		// 	plugins_url($style_css, $this->file),
		// 	[],
		// 	filemtime("{$dir}/{$style_css}")
		// );
	
		register_block_type($fullHandle, [
			'render_callback' => function ($attributes = []) use ($wrapElement, $block) {
				$block->setAttributes($attributes);

				return call_user_func([$wrapElement, 'renderPhp'], $block);
			},
			'editor_script' => $handle . '-block-editor',
			// 'editor_style'  => $handle . '-block-editor',
			// 'style'         => $handle . '-block',
		]);

		return $this;
	}
}