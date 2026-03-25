<?php
// Step 1: Get related course IDs from the RelatedKingsCourses TV
$result = $modx->runSnippet("pdoResources", [
    "parents" => '15471',
    "depth" => '0',
    "processTVs" => 'true',
    "includeTVs" => 'RelatedKingsCourses',
    "tpl" => '@INLINE [[+tv.RelatedKingsCourses]]||',
    "limit" => '1000'
]);

$result = explode("||", $result);
$result = array_filter(array_map('trim', $result));
$result = array_unique($result);

// Prepend '-' for exclusions
foreach ($result as $k => $value) {
    $result[$k] = '-' . $value;
}
$result = implode(",", $result);

// Step 2: Exclude these courses from parent 44
$excludes = $modx->runSnippet("pdoResources", [
    "parents" => '44',
    "resources" => $result,
    "depth" => '0',
    "tpl" => '@INLINE [[+id]]||',
    "limit" => '1000'
]);

$excludes = explode("||", $excludes);
$excludes = array_filter(array_map('trim', $excludes));
$excludes = array_unique($excludes);

foreach ($excludes as $k => $value) {
    $excludes[$k] = '-' . $value;
}
$excludes = implode(",", $excludes);

// Step 3: Fetch final courses with pagetitles
$resourceIds = explode(",", $excludes);
$resourceIds = array_map('trim', $resourceIds);
$resourceIds = array_filter($resourceIds);

$resources = $modx->getCollection('modResource', ['id:IN' => $resourceIds]);

$output = '';
$ids = [];

foreach ($resources as $res) {
    $id = $res->get('id');
    $title = $res->get('pagetitle');  // Fetch pagetitle
    $output .= '<div class="option" onclick="insertStaticParam(\'course\', '.$id.', \'subject\')" data-value="'.$id.'">'.$title.'</div>';
    $ids[] = $id;
}

// Step 4: Set placeholder for hidden select
$modx->setPlaceholder('KingsCourseFilterIdsUS', implode(",", $ids));

return $output;