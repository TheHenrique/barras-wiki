<?php

// For line break
header("Content-type: text/php charset=utf-8");

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\Notice;
use Source\Models\Image;

$notice = new Notice();
$notice->user_id = "12128219281928";
$notice->type_notice = "Lazer";
$notice->title = "Lazer na lagoa azul";
$notice->description = "Muita gente tirando o grude na lagoa azul";
$notice->save();

$image = new Image();
$image->add($notice, "kjkdjs");
$image->save();

var_dump($data);