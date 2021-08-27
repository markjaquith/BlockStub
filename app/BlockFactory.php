<?php

namespace BlockStub;

final class BlockFactory {
	private string $file;
	const HOOK = 'blockstub_init';

	private function __construct(string $file) {
		$this->file = $file;
	}

	public static function boot($file) {
		$factory = new self($file);
		add_action('init', [$factory, 'registerBlocks']);
	}

	public function registerBlocks() {
		do_action(self::HOOK, $this);
	}

	public function addBlock(BlockContract $block) {
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}
		
			$handle = $block->getHandle();
			$fullHandle = 'blockstub/' . $handle;

			$jsHandle = json_encode($handle);
			$jsFullHandle = json_encode($fullHandle);
		
			$dir = dirname($this->file);
		
			$zeroJs = '0.js';
			[$wrapTag, $jsRender] = $block->renderJs();
			$jsWrapTag = json_encode($wrapTag);
			$attributes = $block->getAttributes();
			$jsAttributes = json_encode($attributes);
		
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
		
					wp.blocks.registerBlockType($jsFullHandle, {
						title: $jsHandle,
						icon: 'plugins-checked',
						category: 'widgets',
						attributes: $jsAttributes,
						supports: {
							html: false,
						},
						edit: function(props) {
							return el(
								$jsWrapTag,
								{ className: props.className },
								$jsRender
							);
						},
						save: () => null,
					});
				})(
					window.wp
				);
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
				'render_callback' => [$block, 'renderPhp'],
				'editor_script' => $handle . '-block-editor',
				// 'editor_style'  => $handle . '-block-editor',
				// 'style'         => $handle . '-block',
			]);
	}
}