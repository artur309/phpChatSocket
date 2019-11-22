<?php


$badWords = array(
        "anus" => "a____",
        "bastardo"=> "b____",
        "bicha" => "b____",
        "buceta"=> "b____",
        "burra"=> "b____",
        "burro"=> "b____",
        "cadela"=> "c____",
        "cadelo"=> "c____",
        "caralho" => "c____",
        "cassete"=> "c____",
        "cona" => "c____",
        "chupado"=> "c____",
        "chupado"=> "c____",
        "cocaina"=> "c____",
        "corno"=> "c____",
        "cornuda"=> "c____",
        "cornudo"=> "c____",
        "colhao"=> "c____",
        "doida" => "d____",
        "doido"=> "d____",
        "escrota"=> "e____",
        "escroto" => "e____",
        "feia" => "f____",
        "feio"=> "f____",
        "fodas"=> "f____",
        "foda"=> "f____",
        "fudida"=> "f____",
        "fudido"=> "f____",
        "fudendo"=> "f____",
        "fudida"=> "f____",
        "fudido"=> "f____",
        "furnicar"=> "f____",
        "foda-se"=> "f____",
        "foda"=> "f____",
        "gay"=> "g____",
        "homosexual"=> "h____",
        "homossexual"=> "h____",
        "idiota"=> "i____",
        "leprosa" => "l____",
        "leproso" => "l____",
        "lesbica" => "l____",
        "maconha" => "m____",
        "moleque" => "m____",
        "paspalha" => "p____",
        "paspalhao" => "p____",
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

$string = "vagina ";

echo str_replace(array_keys($badWords), array_values($badwords), $string);


$ssadsa = readline("ss");
?>