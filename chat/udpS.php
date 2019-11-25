<?php
error_reporting(E_ALL);
set_time_limit(0);

function cls(){
    echo "\e[H\e[J";
}

//Mensagens do clientes
function msg($text) {

    global $talkback;
    //tratamento do array chat
	/*for ($x = 0; $x < 20; $x++){
		$talkback[$x] = "$text \n";
		if (count($talkback) > 20)
			array_shift($talkback);
    }*/
    
    for ($i=0; $i < count($talkback); $i++) { 
        if($talkback[$i] == "\n") {
            unset($talkback[$i]);
            $talkback[$i] = $text;
            break;
        }
        if($i == count($talkback) - 2) {
            for ($j=1; $j < count($talkback) - 1; $j++)
                $talkback[$j] = $talkback[$j+1];

            unset($talkback[$i]);
            $talkback[$i] = $text;
            break;
        }
    }
}

//Inserção do IP
function menuIP() {
    back:
    cls();
    echo("Escolha uma das opcoes?
    \nLocalhost   - 1
    \nRemoto      - 2
    \nSair        - 3\n");
    $opcao = readline("Opcao: ");
    if($opcao == 1)
        return("localhost");
    else if ($opcao == 2)
        return $ip = getHostByName(getHostName()); 
    else if ($opcao!=1 or $opcao!=2 or $opcao!=3) goto back;
}

//Função para a escolher umas das varias opções
function protocolo() {
    back:
    cls();
    echo("Escolha um opcao:
    \nTCP     - 1
    \nUDP     - 2
    \nSair    - 3\n");
    return $protocolo = readline("Protocolo: ");
}

//output do array chat
function printArray($array){
    for ($i=0; $i < count($array) ; $i++) { 
        echo ($array[$i]);
    }
}

//start:
$ip = menuIP();
$port = readline("Digite um numero de porta: ");
if (ctype_space($port) or $port == "")
    $port = 9191;
    
$protocolo = protocolo();
if ($protocolo==3 or ctype_space($protocolo) or $protocolo == "")exit;

$topChat = "╔". str_repeat("═",100) ."╗\n";
$bottomChat = "╚". str_repeat("═", 100) . "╝\n";

$talkback = array_fill(0, 20, "\n");//array de mensagens

start:
//Apicação do protocolo TCP/IP
if($protocolo == 1) {
    //criação do socket
    $sock = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if(!$sock) die("Não foi possível criar o socket");
    //bind do socket
    if(!@socket_bind($sock, $ip, $port)) die("Não foi possível fazer o bind do socket");
    //socket_listen com um backlog de 10 conexões
    if(!@socket_listen($sock, 10)) die("Não foi possível pôr o socket à escuta");

    //array de todos os clientes que se vão conectar ao socket (incluindo o socket de escuta)
    $clientes = array($sock);
    cls();
    echo "

███████╗███████╗██████╗ ██╗   ██╗███████╗██████╗         ██████╗  ██████╗  ██████╗ ███╗   ███╗
██╔════╝██╔════╝██╔══██╗██║   ██║██╔════╝██╔══██╗        ██╔══██╗██╔═══██╗██╔═══██╗████╗ ████║
███████╗█████╗  ██████╔╝██║   ██║█████╗  ██████╔╝        ██████╔╝██║   ██║██║   ██║██╔████╔██║
╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██╔══╝  ██╔══██╗        ██╔══██╗██║   ██║██║   ██║██║╚██╔╝██║
███████║███████╗██║  ██║ ╚████╔╝ ███████╗██║  ██║        ██║  ██║╚██████╔╝╚██████╔╝██║ ╚═╝ ██║
╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚══════╝╚═╝  ╚═╝        ╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═╝     ╚═╝
                                                                                              

\n IP: $ip                            Porta: $port";

    while(true) {
        //criar uma copia do array dos cliente para não ser modificada pelo socket_select()
        $read = $clientes;
        $write = array();
        $except = array();
        if(socket_select($read, $write, $except, 0) < 1) continue;
        //verifica se há um cliente a estabelecer conexão
        if(in_array($sock, $read)){
            //aceita o cliente e adiciona-o ao array $clientes
            $clientes[] = $newsock = socket_accept($sock);
            socket_write($newsock, "

 ██████╗██╗  ██╗ █████╗ ████████╗        ██████╗  ██████╗  ██████╗ ███╗   ███╗
██╔════╝██║  ██║██╔══██╗╚══██╔══╝        ██╔══██╗██╔═══██╗██╔═══██╗████╗ ████║
██║     ███████║███████║   ██║           ██████╔╝██║   ██║██║   ██║██╔████╔██║
██║     ██╔══██║██╔══██║   ██║           ██╔══██╗██║   ██║██║   ██║██║╚██╔╝██║
╚██████╗██║  ██║██║  ██║   ██║           ██║  ██║╚██████╔╝╚██████╔╝██║ ╚═╝ ██║
 ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝           ╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═╝     ╚═╝
                                                                              

\n");

            //mensagem para o cliente quando entra
            socket_write($newsock, "Bem-vindo ao server! \nHá ". (count($clientes)-1)." cliente(s) conectados ao servidor\nPara sair digite 'q'");

            //Ip do cliente
            socket_getpeername($newsock, $ip);
            cls();

            //Mensagem  do cliente
            $text = "Novo cliente conectado: {$ip}\n";
            msg($text);
            printArray($talkback);
            
            //remover o socket de escuta do array dos clientes com dados (read)
            $key = array_search($sock, $read);
            unset($read[$key]);
        }

        //Loop de todos os cliente que têm dados para serem lidos
        foreach ($read as $read_sock) {
            //ler os dados dos clientes
            $data = @socket_read($read_sock, 1024);
            socket_getpeername($read_sock, $ip);
            if($data === false || $data == "q") {
                //remover o cliente do array dos $clientes
                $key = array_search($read_sock, $clientes);
                unset($clientes[$key]);
                $text = "Cliente {$ip} desconectado.\n";
                msg($text);
                printArray($talkback);
                //continuar para o próximo cliente que tiver dados para serem lidos
                continue;
            }       
            
            //Remove blank spaces
            $data = trim($data); 
            if(!empty($data)){
                //Send history
                if($data == "/hist") {
                    $json = json_encode($history);
                    socket_write($read_sock, $json);
                    cls();
                }
                else {
                    //Função Emoji 
                    $hora = date('H:i:s');
                    $text = "<$hora> | {$ip}: $data\n";
                    msg($text);
                    cls();
                    echo "$topChat";
                    printArray($talkback);
                    echo "$bottomChat";

                    //O array é enviado em formato JSON para o cliente
                    $json = json_encode($talkback);
                    socket_write($read_sock, $json);
                }
            }
        }
    }
    //Fechar o socket
    socket_close($sock);
} 


//Apicação do protocolo UDP
else if ($protocolo == 2) {
    //Criação do socket
    $sock = @socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if(!$sock) die("Não foi possível criar o socket");
    //Bind do socket
    if(!@socket_bind($sock, $ip, $port)) die("Não foi possível fazer bind do socket");
    
    cls();
    echo "

    ███████╗███████╗██████╗ ██╗   ██╗███████╗██████╗         ██████╗  ██████╗  ██████╗ ███╗   ███╗
    ██╔════╝██╔════╝██╔══██╗██║   ██║██╔════╝██╔══██╗        ██╔══██╗██╔═══██╗██╔═══██╗████╗ ████║
    ███████╗█████╗  ██████╔╝██║   ██║█████╗  ██████╔╝        ██████╔╝██║   ██║██║   ██║██╔████╔██║
    ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██╔══╝  ██╔══██╗        ██╔══██╗██║   ██║██║   ██║██║╚██╔╝██║
    ███████║███████╗██║  ██║ ╚████╔╝ ███████╗██║  ██║        ██║  ██║╚██████╔╝╚██████╔╝██║ ╚═╝ ██║
    ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚══════╝╚═╝  ╚═╝        ╚═╝  ╚═╝ ╚═════╝  ╚═════╝ ╚═╝     ╚═╝
                                                                                                

    \n IP:$ip                            Porta: $port";

    //Loop de mensagens
    while(true) {

        //Recebe os dados dos clientes
        socket_recvfrom($sock, $data, 1024, 0, $ipCliente, $portaCliente);
        
        $hora = date('H:i:s');
        $text = "<$hora> | {$ipCliente}: $data\n";
        msg($text);

        cls();
        echo "$topChat";
        printArray($talkback);
        echo "$bottomChat"; 

        $json = json_encode($talkback);
        socket_sendto($sock, $json, strlen($json), 0, $ipCliente, $portaCliente);
    }
    socket_close($sock);
} else if ($protocolo == 3) exit;
else {
    cls();
    $protocolo = protocolo();
    goto start; //Volta ao start
}