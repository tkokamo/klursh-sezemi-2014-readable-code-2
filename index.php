<?php

define('RECIPE_FILE_PATH', 'data/recipe.txt');

$str_recipe = file_get_contents(RECIPE_FILE_PATH);
echo $str_recipe;
