<?php

$mainCssPath = '../main.css';
$partialsFolderPath = '../partials/';
$compiledFilePath = '../compiled/main.min.css';
$sourceMapFilePath = '../compiled/main.min.css.map';

$partialFiles = [
    // 'pathway-blocks.css',
    // 'kings-life-teaser.css',
    // 'sign-off.css',
    // 'student-story-row.css',
    // 'two-blocks-layout.css',
    // 'banner-row.css',
    // 'course-page-nav.css',
    // 'course-overview.css',
    // 'two-up-checked-list.css',
    // 'title-top-row.css',
    // 'programme-length.css',
    // 'intro-three-columns.css',
    // 'three-text-columns.css',
    // 'two-text-columns.css',
    // 'factfile-row.css',
    // 'all-stories.css',
    // 'icon-list.css',
    // 'story-content.css',
    // 'asset-grid.css',
    // 'uni-list.css',
    // 'blog-list.css',
    // 'progression-filters.css',
    // 'accommodation-grid.css',
    // 'filter-row.css',

    // wi-444 270525
    'accreditationFooter.css',
    'location_title_bg_col.css',
    'font_size.css',
    'factfile-row-accent.css',
    'normalize.css',
    'base.css',
    'kings_life_italy.css',
    'navbar.css',
    'footer.css',
    'megaMenuModal.css',
    'imgCircles.css',
    'defaultCarouselStyles.css',
    'carousel.css',
    'removeGlobalNav.css',
];

$compiledContent = @file_get_contents($mainCssPath);

if ($compiledContent === false) {
    exit('Error: Unable to load main CSS file.');
}

$partialContents = array_map(function ($partialFile) use ($partialsFolderPath) {
    $partialFilePath = $partialsFolderPath.'/'.$partialFile;
    $content = @file_get_contents($partialFilePath);

    if ($content === false) {
        exit("Error: Unable to load partial file: $partialFilePath");
    }

    return $content;
}, $partialFiles);

$compiledContent .= PHP_EOL.implode(PHP_EOL, $partialContents);

$minifiedCss = minifyCss($compiledContent);

$sourceMap = generateSourceMap($compiledFilePath, $partialFiles);

if (@file_put_contents($compiledFilePath, $minifiedCss) === false) {
    exit('Error: Unable to save compiled file.');
}

if (@file_put_contents($sourceMapFilePath, json_encode($sourceMap)) === false) {
    exit('Error: Unable to save source map file.');
}

echo "Compilation and Minification completed. Output file: $compiledFilePath\n";
echo "Source map generated. Output file: $sourceMapFilePath\n";

/**
 * Minify CSS content using a simple approach.
 *
 * @param string $cssContent
 *
 * @return string
 */
function minifyCss($cssContent)
{
    $cssContent = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $cssContent);

    $cssContent = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $cssContent);

    return $cssContent;
}

/**
 * Generate a simple source map.
 *
 * @param string $compiledFilePath
 * @param array  $partialFiles
 *
 * @return array
 */
function generateSourceMap($compiledFilePath, $partialFiles)
{
    $sourceMap = [
        'version' => 3,
        'file' => basename($compiledFilePath),
        'sources' => array_map(function ($partialFile) {
            return '../partials/'.$partialFile;
        }, $partialFiles),
        'names' => [],
        'mappings' => '',
    ];

    return $sourceMap;
}
