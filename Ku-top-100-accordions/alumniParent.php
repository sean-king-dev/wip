<?php

// v4 php 5.6 compatible

// Get the current resource ID
$id = isset($scriptProperties['id']) ? $scriptProperties['id'] : $modx->resource->get('id');

// Call UltimateParent snippet
$ultimateParent = $modx->runSnippet('UltimateParent', array('id' => $id));

// Map ultimate parents to alumni folders
$map = array(
    'ultimate_us'      => 273,
);

// Return numeric folder ID or 0
return isset($map[$ultimateParent]) ? $map[$ultimateParent] : 0;