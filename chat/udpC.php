<?php
error_reporting(E_ALL);

function cls() {
    echo "\e[H\e[J";
} 

//Função para a escolha da opção desejada
function opcao() {
    echo("Escolha um opcao:
    \nTCP     - 1
    \nUDP     - 2
    \nSair    - 3\n");
    return $opcao = trim(readline("Opcao: "));
}

//Echo do array
function printArray($array){
    for ($i=0; $i < count($array) ; $i++) { 
        echo ($array[$i]);
    }
}

//menu emojis
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

//tramento emojis e badwords
function emoji_badword($msg){
    $badwords = array(
	    "anus" => "a____", "bastardo" => "b____", "bicha" => "b____", "buceta" => "b____", "burra" => "b____", "burro" => "b____", "cadela" => "c____", "cadelo" => "c____", "caralho" => "c____", "cassete" => "c____", "cona" => "c____", "chupado" => "c____", "chupado" => "c____", "cocaina" => "c____", "corno" => "c____", "cornuda" => "c____", "cornudo" => "c____", "colhao" => "c____", "doida" => "d____", "doido" => "d____", "escrota" => "e____", "escroto" => "e____", "feia" => "f____", "feio" => "f____", "fodas" => "f____", "foda" => "f____", "fudida" => "f____", "fudido" => "f____", "fudendo" => "f____", "fudida" => "f____", "fudido" => "f____", "furnicar" => "f____", "foda-se" => "f____", "foda" => "f____", "gay" => "g____", "homosexual" => "h____", "homossexual" => "h____", "idiota" => "i____", "leprosa" => "l____", "leproso" => "l____", "lesbica" => "l____", "maconha" => "m____", "moleque" => "m____", "paspalha" => "p____", "paspalhao" => "p____", "paspalho" => "p____", "pau" => "p____", "penis" => "p____", "pentelho" => "p____", "piça" => "p____", "pica" => "p____", "piroca," => "p____", "piropo" => "p____", "prostituta" => "p____", "prostituto" => "p____", "puta" => "p____", "retardada" => "r____", "retardado" => "r____", "sacana" => "s____", "vaca" => "v___", "vagina" => "v____"
    );
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
            ░░░░▀▀▀▀░░▀▀▀░░░░░░░░▀▀▀░░▀▀░░░░ "
    );

    $msg = str_replace(array_keys($badwords), array_values($badwords), $msg);
    $msg = str_replace(array_keys($emojis), array_values($emojis), $msg);

    return $msg;
}

cls();
$ip = trim(readline("IP para conectar: "));
$port = trim(readline("Porta para conectar: "));
$opcao = opcao();
/*if ($opcao==3){
    cls();
    $opcao = opcao();
    goto start;
}*/

$topChat = "╔". str_repeat("═",100) ."╗\n";
$bottomChat = "╚". str_repeat("═", 100) . "╝\n";

$user= readline("Digite o seu nome de utilizador: ");
if (ctype_space($user) or $user == "")
    $user = "Guest User";
    
start:

//Apicação do protocolo TCP/IP
if($opcao == 1) {

    echo "Bem vindo ao chat PHP via TCP/IP\nDigite 'q' para sair',\nDigite '_emoji' para listar emojis";
    readline("\n\nENTER...");

    //criação do socket
    $sock = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if(!$sock) die("Não foi possível criar o socket");
    //Ligação da socket
    if(!@socket_connect($sock, $ip, $port)) die("Não foi possível ligar ao socket");
    cls();
    
    $output = socket_read($sock, 8192);//Lê a mensagem de boas vindas.
    echo "$output \n";
    
    while(true){
        echo "
        ██████╗██╗  ██╗ █████╗ ████████╗    ██████╗ ██╗  ██╗██████╗ 
       ██╔════╝██║  ██║██╔══██╗╚══██╔══╝    ██╔══██╗██║  ██║██╔══██╗
       ██║     ███████║███████║   ██║       ██████╔╝███████║██████╔╝
       ██║     ██╔══██║██╔══██║   ██║       ██╔═══╝ ██╔══██║██╔═══╝ 
       ╚██████╗██║  ██║██║  ██║   ██║       ██║     ██║  ██║██║     
       ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ \n\n";
        $input = readline("--> "); //input utilizador
        cls();
        
        if($input == "q") {
            socket_write($sock, $input, strlen($input));
            socket_shutdown($sock, 2);
            socket_close($sock);
            echo "Sessão terminada com sucesso.\n";
            break;
        }
        else if($input =="_emoji")
            emojiMenu(); 
        else if (ctype_space($input) or $input == "")
            $input = "*blank message* ";

        $input = emoji_badword($input);
        $input = "$user diz: $input";
        socket_write($sock, $input, strlen($input));

        //O array em formato JSON é convertido é apresentado
        $output = socket_read($sock, 8192);
        $output = json_decode($output, true);

        echo "$topChat";
        printArray($output);
        echo "$bottomChat";

        
    }
} 

//Apicação do protocolo UDP
else if ($opcao == 2) {
    
    echo "Bem vindo ao chat PHP via UDP\nDigite 'q' para sair',\nDigite '_emoji' para listar emojis";
    readline("\nenter...");

    //Criação da socket
    $sock = @socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if(!$sock) 
        die("Não foi possível criar o socket");
    cls();
    while(true) {
        echo "
        ██████╗██╗  ██╗ █████╗ ████████╗    ██████╗ ██╗  ██╗██████╗ 
       ██╔════╝██║  ██║██╔══██╗╚══██╔══╝    ██╔══██╗██║  ██║██╔══██╗
       ██║     ███████║███████║   ██║       ██████╔╝███████║██████╔╝
       ██║     ██╔══██║██╔══██║   ██║       ██╔═══╝ ██╔══██║██╔═══╝ 
       ╚██████╗██║  ██║██║  ██║   ██║       ██║     ██║  ██║██║     
       ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ \n\n";

        $input = readline("--> "); //input utilizador
        cls();

        if($input == "q") {
            echo "A terminar sessão...\n";
            socket_shutdown($sock, 2);
            socket_close($sock);
            echo ("Sessão terminada com sucesso.\n\n");
            break;
        }
        else if($input =="_emoji")
            emojiMenu(); 
        else if (ctype_space($input) or $input == "")
            $input = "*blank message* ";

        $input = emoji_badword($input);
        $input = "$user diz: $input";

        socket_sendto($sock, $input, strlen($input), 0, $ip, $port);
        socket_recv($sock, $output, 2048, 0);
        $output = json_decode($output, true);
        
        echo "$topChat";
        printArray($output);
        echo "$bottomChat";
    }
}

else if ($opcao == 3) exit;

else {
    cls();
    $opcao = opcao();
    goto start;
}