<?php

define('RECIPE_FILE_PATH', 'data/recipe.txt');

$recipes = lines_from_file(RECIPE_FILE_PATH);
// $recipesを全表示
for ($i = 0, $count = count($recipes); $i < $count; $i++) {
    echo $recipes[$i]."\n";
}

/**
 * ファイルから1行ずつ読み込んで配列を返す。
 */
function lines_from_file($path) {
    return file($path, FILE_IGNORE_NEW_LINES);
}
