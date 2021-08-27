<?php
/*
Plugin Name: Block Stub
*/

namespace BlockStub;

require __DIR__ . '/app/BlockContract.php';
require __DIR__ . '/app/Block.php';
require __DIR__ . '/app/BlockFactory.php';
require __DIR__ . '/app/DateBlock.php';

BlockFactory::boot(__FILE__);
