<?php

$emoji = array(
	"_sad" => "( ͡° ʖ̯ ͡°)",
	"_happy" => "\(ᵔᵕᵔ)/",
	"_vibe_check" => "╰( ͡° ͜ʖ ͡° )つ ︻╦╤─",
	"_wtf" => "(._.)",
	"_tux" =>",
			 .--.
			|o_o |
			|:_/ |
		   //   \ \
		  (|     | )
		 /'\_   _/`\
		 \___)=(___/ ",
	"_cat" =>"
		░░░░░░░▄▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▀▄░░░░░░
		░░░░░░█░░▄▀▀▀▀▀▀▀▀▀▀▀▀▀▄░░█░░░░░
		░░░░░░█░█░▀░░░░░▀░░▀░░░░█░█░░░░░
		░░░░░░█░█░░░░░░░░▄▀▀▄░▀░█░█▄▀▀▄░
		█▀▀█▄░█░█░░▀░░░░░█░░░▀▄▄█▄▀░░░█░
		▀▄▄░▀██░█▄░▀░░░▄▄▀░░░░░░░░░░░░▀▄
		░░▀█▄▄█░█░░░░▄░░█░░░▄█░░░▄░▄█░░█
		░░░░░▀█░▀▄▀░░░░░█░██░▄░░▄░░▄░███
		░░░░░▄█▄░░▀▀▀▀▀▀▀▀▄░░▀▀▀▀▀▀▀░▄▀░
		░░░░█░░▄█▀█▀▀█▀▀▀▀▀▀█▀▀█▀█▀▀█░░░
		░░░░▀▀▀▀░░▀▀▀░░░░░░░░▀▀▀░░▀▀░░░░"

);

$string = readline("texto --> ");

$string = str_replace(array_keys($emoji), array_values($emoji), $string);

while(true){
	echo "$string";
	$string = readline("\ntexto --> ");
	$string = str_replace(array_keys($emoji), array_values($emoji), $string);
}

$ssadsa = readline("ss");


/*

		//statment para encontra do codigo do emoji
		/*if (preg_match('/\b(' . preg_quote($needle, '/') . '\w+)/', $ticker, $match)) {
			$emoji = emojiConv($match[1]);
			$ticker =  str_replace($match[1], $emoji, $ticker); //replacedo codigo pro emoji
		}*/