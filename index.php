<?php

define('RECIPE_FILE_PATH', 'data/recipe.txt');

$recipe_names = lines_from_file(RECIPE_FILE_PATH);

// それぞれIDを振って$recipesに入れる
$recipes = array();
for ($id = 0, $cnt = count($recipe_names); $id < $cnt; $id++) {
    $recipes[$id] = new Recipe($id, $recipe_names[$id]);
}

// $argv[1]にIDが指定される
if (isset($argv[1])) {
    // IDが指定されたらそのIDのレシピを出力する
    $id = intval($argv[1]);
    echo $recipes[$id]."\n";
}
else {
    // IDが指定されなかったらすべて出力する
    echo_array_as_lines($recipes);
}


/**
 * ファイルから1行ずつ読み込んで配列を返す。
 */
function lines_from_file($path) {
    return file($path, FILE_IGNORE_NEW_LINES);
}
/**
 * 配列の要素を改行区切りですべて表示する。
 */
function echo_array_as_lines($arr) {
    foreach ($arr as $val) {
        echo $val."\n";
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