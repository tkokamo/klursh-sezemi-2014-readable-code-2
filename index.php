<?php

define('RECIPE_FILE_PATH', 'data/recipe.txt');

$recipe_names = lines_from_file(RECIPE_FILE_PATH);

// それぞれIDを振って$recipesに入れる
$recipes = array();
for ($id = 0, $cnt = count($recipe_names); $id < $cnt; $id++) {
    $recipes[] = new Recipe($id, $recipe_names[$id]);
}

echo_array_as_lines($recipes);


/**
 * ファイルから1行ずつ読み込んで配列を返す。
 */
function lines_from_file($path) {
    return file($path, FILE_IGNORE_NEW_LINES);
}
/**
 * 配列を改行区切りで表示する。
 */
function echo_array_as_lines($arr) {
    for ($i = 0, $cnt = count($arr); $i < $cnt; $i++) {
        echo $arr[$i]."\n";
    }
}

class Recipe {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    public function __toString() {
        return $this->id.': '.$this->name;
    }
}