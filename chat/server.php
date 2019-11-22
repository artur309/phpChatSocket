<?php
error_reporting(0);
set_time_limit(0); //Mete o limite de resposta como 0

$host = "127.0.0.1"; //Ip da maquina
$port = 2020; //Porta
$chat = [];

//Criação do socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
//Juncao da socket com a porta
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
//Escuta de ligacoes
$result = socket_listen($socket, 10) or die("Could not set up socket listener\n");

echo "
 _                     _ _                __              _____                            _   _                 
| |                   | (_)              / _|            / ____|                          | | (_)                
| |     ___   __ _  __| |_ _ __   __ _  | |_ ___  _ __  | |     ___  _ __  _ __   ___  ___| |_ _  ___  _ __  ___ 
| |    / _ \ / _` |/ _` | | '_ \ / _` | |  _/ _ \| '__| | |    / _ \| '_ \| '_ \ / _ \/ __| __| |/ _ \| '_ \/ __|
| |___| (_) | (_| | (_| | | | | | (_| | | || (_) | |    | |___| (_) | | | | | | |  __/ (__| |_| | (_) | | | \__ \
|______\___/ \__,_|\__,_|_|_| |_|\__, | |_| \___/|_|     \_____\___/|_| |_|_| |_|\___|\___|\__|_|\___/|_| |_|___/
								  __/ |                                                                          
								 |___/     
								 \n\n";

//Enquanto houver um cliente
while (true) {
	//Verificacao do socket
	$spawn[++$i] = socket_accept($socket) or die("Could not accept incoming connection\n");

	echo "_______________________________________________________\n";
	$client = socket_read($spawn[$i], 1024) or die("Could not read input\n"); //Lê a socket do cliente 
	$chat[$i] = $client; //insercao das mensagens num array para guardar chat	

	for ($x = 0; $x < 20; $x++) {
		echo $chat[$x] . "\n";
		if (count($chat) > 20)
			array_shift($chat);
	}

	//faz a limpeza do chat, fazendo pushup

	//var_dump(count($chat));
	//var_dump($chat);

	//Escreve na socket do cliente Seja Bem-Vindo nome do cliente
	socket_write($spawn[$i], "\n $client\n", 9080);

	//escreve o nome do cliente em verde
	echo "$client \n";

	//Fecha a socket do cliente
	socket_close($spawn[$i]);
	socket_write($spawn[$i], $client, 9080); //Volta a escrever a socket do cliente que vai ser enviada para o server
	echo "_______________________________________________________\n";
}

// O que o cliente envia vai ser enviado para o server reverse client input and send back
$output = strrev($input) . "\n";
socket_write($chat, $output, strlen($output)) or die("Could not write output\n");
socket_close($socket);