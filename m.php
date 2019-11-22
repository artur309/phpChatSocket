<?php
$string = "paspalho buddy, I'm your friend or maybe a fellow";

$badwords = array(
    "paspalho" => "p____",
    "pau" => "p____",
    "penis" => "p____",
    "pentelho" => "p____",
    "piça" => "p____",
    "pica" => "p____",
    "piroca," => "p____",
    "piropo" => "p____",
    "prostituta" => "p____",
    "prostituto" => "p____",
    "puta" => "p____", 
    "retardada" => "r____",
    "retardado" => "r____",
    "sacana" => "s____",
    "vaca" => "v___",
    "vagina" => "v____"
);

echo str_replace(array_keys($swears), array_values($swears), $string);

$s = readline("");
?>