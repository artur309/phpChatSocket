<?php
error_reporting(E_ALL);
set_time_limit(0); //Mete o limite de resposta como 0

function emojiMenu(){
	return "
	_  _ ____ _  _ _  _    ____ _  _ ____  _ _ ____    
	|\/| |___ |\ | |  |    |___ |\/| |  |  | | [__     
	|  | |___ | \| |__|    |___ |  | |__| _| | ___]    
                                                   
		Digite o comando para obter o emoji\n\n

		_sad --> ( ͡° ʖ̯ ͡°) \n
		_happy --> \(ᵔᵕᵔ)/ \n
		_vibecheck --> ╰( ͡° ͜ʖ ͡° )つ ︻╦╤─ \n
		_wtf --> (._.) \n
		_tux --> 
			 .--.
			|o_o |
			|:_/ |
		   //   \ \
		  (|     | )
		 /'\_   _/`\
		 \___)=(___/ \n
		 
		_cat --> 
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
		░░░░▀▀▀▀░░▀▀▀░░░░░░░░▀▀▀░░▀▀░░░░\n";
}

function printArray($array){
	$array = [];
    for ($i = 0; $i < count($array); $i++)
        echo ($array[$i]);
}

echo "
 ██████╗██╗  ██╗ █████╗ ████████╗    ██████╗ ██╗  ██╗██████╗ 
██╔════╝██║  ██║██╔══██╗╚══██╔══╝    ██╔══██╗██║  ██║██╔══██╗
██║     ███████║███████║   ██║       ██████╔╝███████║██████╔╝
██║     ██╔══██║██╔══██║   ██║       ██╔═══╝ ██╔══██║██╔═══╝ 
╚██████╗██║  ██║██║  ██║   ██║       ██║     ██║  ██║██║     
╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ ";
echo "\n\n║═════════════════════════════════════\n";

//array de palavras de baixo calao
$badwords = array(
	"anus" => "a____", "bastardo" => "b____", "bicha" => "b____", "buceta" => "b____", "burra" => "b____", "burro" => "b____", "cadela" => "c____", "cadelo" => "c____", "caralho" => "c____", "cassete" => "c____", "cona" => "c____", "chupado" => "c____", "chupado" => "c____", "cocaina" => "c____", "corno" => "c____", "cornuda" => "c____", "cornudo" => "c____", "colhao" => "c____", "doida" => "d____", "doido" => "d____", "escrota" => "e____", "escroto" => "e____", "feia" => "f____", "feio" => "f____", "fodas" => "f____", "foda" => "f____", "fudida" => "f____", "fudido" => "f____", "fudendo" => "f____", "fudida" => "f____", "fudido" => "f____", "furnicar" => "f____", "foda-se" => "f____", "foda" => "f____", "gay" => "g____", "homosexual" => "h____", "homossexual" => "h____", "idiota" => "i____", "leprosa" => "l____", "leproso" => "l____", "lesbica" => "l____", "maconha" => "m____", "moleque" => "m____", "paspalha" => "p____", "paspalhao" => "p____", "paspalho" => "p____", "pau" => "p____", "penis" => "p____", "pentelho" => "p____", "piça" => "p____", "pica" => "p____", "piroca," => "p____", "piropo" => "p____", "prostituta" => "p____", "prostituto" => "p____", "puta" => "p____", "retardada" => "r____", "retardado" => "r____", "sacana" => "s____", "vaca" => "v___", "vagina" => "v____"
);

//array de emojis
$emojis = array(
	"_sad" => "( ͡° ʖ̯ ͡°)",
	"_happy" => "\(ᵔᵕᵔ)/",
	"_vibecheck" => "╰( ͡° ͜ʖ ͡° )つ ︻╦╤─",
	"_wtf" => "(._.)",
	"_tux" => ",
			 .--.
			|o_o |
			|:_/ |
		   //   \ \
		  (|     | )
		 /'\_   _/`\
		 \___)=(___/ ",
	"_cat" => "
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

$host = "127.0.0.1"; //IP Server
$port = 2020; //Porta Server
$date = DATE("H:i"); //Hora do cliente
echo "Bem vindo ao chat PHP!\nDigite texto para enviar\nDigite 'q' para sair\nDigite '_emoji' para ver lista emojis\n\n";
$user = readline('Insira o seu nome: '); //Leitura do nome do cliente

if (ctype_space($user) or $user == "") //se user nao digiar texto
	$user = "Guest User";

//socket_write($socket, "$user entrou no chat", 1024);	

while (true) {

	echo "
	 ██████╗██╗  ██╗ █████╗ ████████╗    ██████╗ ██╗  ██╗██████╗ 
	██╔════╝██║  ██║██╔══██╗╚══██╔══╝    ██╔══██╗██║  ██║██╔══██╗
	██║     ███████║███████║   ██║       ██████╔╝███████║██████╔╝
	██║     ██╔══██║██╔══██║   ██║       ██╔═══╝ ██╔══██║██╔═══╝ 
	╚██████╗██║  ██║██║  ██║   ██║       ██║     ██║  ██║██║     
	╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ \n\n";

	echo "\n";
	$ticker = readline('Msg: ');
	//echo chr(27).chr(91).'H'.chr(27).chr(91).'J';  //limpa tela 


	if ($ticker == 'q') exit; //user sai do chat
	elseif ($ticker == '_emoji') echo emojiMenu(); //apresenta menu de emojis

	else {
		// Criação da socket
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

		//Se a socket não for encontrada mostra um aviso
		if ($socket === false)
			echo "Socket creation failed!";

		$result = socket_connect($socket, $host, $port);
		if ($result === false)
			echo "Socket connection failed!";

		//Envia para o servidor e recebe a menssagem do outro utilizador
		else {
			echo "╔═══════════════════════════════════════════════════════╗";

			//troca os palavras de baixo de baixo calao, pelo censrua no array
			$ticker = str_replace(array_keys($badwords), array_values($badwords), $ticker);
			//troca os codigos para emojis
			$ticker = str_replace(array_keys($emojis), array_values($emojis), $ticker);

			socket_write($socket, "<$date> $user digitou --> $ticker", 1024);
			$receber = socket_read($socket, 1024);
			echo ("$receber \n");

			echo socket_read($socket, 1024);

			echo "╚═══════════════════════════════════════════════════════╝";
		}
	}
	
	$output = socket_read($socket, 8192);
	$output = json_decode($output, true);
	printArray($output);
	
	echo "╚═══════════════════════════════════════════════════════╝";
}