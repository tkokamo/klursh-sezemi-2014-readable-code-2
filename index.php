<?php

define('RECIPE_FILE_DIR', 'data/'); //データファイルディレクトリ定義
define('EXIT_FAILURE', '1'); // エラー定数定義

//正しくコマンドライン引数の指定数が足りているかチェック
if ($argc < 9) {
  echo "Uages:php {$argv[0]} <username1> <recipe_data1> <username2> <recipe_data2> <username3> <recipe_data3> <username4> <recipe_data4> [<recipe_id>]".PHP_EOL;
  exit(EXIT_FAILURE);
}


$i = 1;

//自分の集めたレシピを持ったユーザデータの作成
$users = array();
$recipe_id = 1;
for ($i < 0; $i < 4; $i++) {

  //ユーザ名取得
  $user_name = $argv[$i*2+1]; 
  //ユーザの作成とユーザ配列への追加
  $users[$i] = new User($user_name);
 
  //ファイルからレシピデータを配列で取得
  $recipe_data = lines_from_file(RECIPE_FILE_DIR . $argv[2*($i+1)]);
  //一つのファイルにあるレシピの数  
  $num_recipes = count($recipe_data);

  //ユーザの集めたレシピをユーザオブジェクトに登録
  for ($id = 0; $id < $num_recipes; $id++) {
    $recipe = new Recipe($recipe_id++, $recipe_data[$id]); 
    $users[$i]->addRecipe($recipe);
  }
}

exit(1);
  
// $argv[2]にIDが指定される
if (isset($argv[2])) {
    // IDが指定されたらそのIDのレシピを出力する
    $id = intval($argv[2]);
    echo $recipes[$id].PHP_EOL;
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

class User {
  
  private $userName;
  private $userId;
  private $recipes; //ユーザの集めたレシピ

  public function __construct($userName = "") 
  {
    $this->userName = $userName;
  }

  public function addRecipe($recipe)
  {
    $this->recipes[] = $recipe;
  }
  
}