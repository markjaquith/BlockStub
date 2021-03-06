<?php
/*
Plugin Name: Block Stub
*/

namespace BlockStub;

$_blockstub_autoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists($_blockstub_autoload)) {
	wp_die('Run composer install');
}

require $_blockstub_autoload;
unset($_blockstub_autoload);

BlockFactory::boot(__FILE__);

add_action('blockstub_init', function (BlockFactory $blocks) {
	$blocks
		->add(new UnixTimestampBlock)
		->add(new AnnounceRenderingEngineBlock)
		->add(new MagicHtmlBlock)
		->add(new GreetingBlock);
});
