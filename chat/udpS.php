<?php
error_reporting(E_ALL);
set_time_limit(0);

function cls(){
    echo "\e[H\e[J";
}

function opcao(){
    cls();
    echo("Escolhe uma opcao: 
        \nTCP       - 1
        \nUDP       - 2
        \nSair      - 3\n");
    return $opcao = readline("Opcao: ");
}

function emoji($data){
    global $data;
    $emojis = array(
        "smile" => ":-)",
    );
    $palavra = preg_split("/[\s,]+/",$data);
    foreach ($emojis as $key => $value) {
        if (in_array($key, $palavra))
            $data = str_replace($key,$value,$data);
    }
}

function Msg($text){
    global $talkback;
    for ($i=1; $i < count($talkback) - 1 ; $i++) { 
        if ($talkback[$i] == "\n"){
            unset($talkback[$i]);
            $talkback[$i] = $text;
            break;
        }
        if ($i == count($talkback) - 2) {
            for ($j=1; $j < count($talkback) - 1; $j++)
                $talkback[$j] = $talkback[$j+1];
            unset($talkback[$i]);
            $talkback[$i] = $text;
            break;
        }
    }

    global $history;
    for ($i=1; $i < count($history) - 1; $i++) { 
        if ($history[$i] == "\n") {
            unset($history[$i]);
            $history[$i] = text;
            break;
        }
        if ($i == count($history) - 2) {
            for ($j = 1; $j < count($history) - 1 ; $j++)
                $history[$j] = $history[$j +1];
            unset($history[$i]);
            $history[$i] = $text;
            break;
        }
    }
}

function IP(){
    cls();
    echo("Qual opção desejada?
        \nLocalhost     - 1
        \nRemoto        - 2
        \nSair          - 3\n");
    $opcao = readline("Opcao: ");
    if($opcao ==1)
        return ("localhost");
    else if ($opcao == 2) {
        $ip = readline("Insira o IP: ");
        return $ip;
    }
}

function printArray($array){
    for ($i=0; $i < count($array); $i++)
        echo($array[$i]);
}

$ip = IP();
$port = readline("Insira a sua porta: ");
$opcao = opcao();
$linhaCima = "╔══════╗";
$linhaBaixo ="╚══════╝";

$talkback = array_fill(0,20,"\n");
$talkback[0] = $linhaCima;
$talkback[19] = $linhaBaixo;

$history = array_fill(0,100,"\n");
$history[0] = $linhaCima;
$history[99] = $linhaBaixo;

start:

//TCP/IP
if ($opcao==1) {
    $sock = @socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    if (!$sock) die("Não foi possivel criar o socket");
    if (!@socket_bind($sock,$ip,$port)) die ("Nao foi possivel fazer o bind do socket");
    if (!@socket_listen($sock,10)) die ("Nao foi possivel por o socket a escuta");

    $clientes = array($sock);
    cls();
    echo("Server ROOM\n\nIP: $ip\nPorta: $port");
    
    while(true){
        $read = $clientes;
        $write = array();
        $except = array(); 
        if(socket_select($read,$write,$except,0) < 1) continue;
        if (in_array($sock,$read)) {
            $clientes[] = $newsock = socket_accept($sock);
            socket_write($newsock,"
            ██████╗██╗  ██╗ █████╗ ████████╗    ██████╗ ██╗  ██╗██████╗ 
           ██╔════╝██║  ██║██╔══██╗╚══██╔══╝    ██╔══██╗██║  ██║██╔══██╗
           ██║     ███████║███████║   ██║       ██████╔╝███████║██████╔╝
           ██║     ██╔══██║██╔══██║   ██║       ██╔═══╝ ██╔══██║██╔═══╝ 
           ╚██████╗██║  ██║██║  ██║   ██║       ██║     ██║  ██║██║     
           ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ 
          
           \n");

           socket_write($newsock,"Bem Vindo ao server!\n Existe ".(count($clientes)-1)."clientes(s) conectados ao servidor\n
           Para sair digite 'q' e para ver o historico digite 'hist'");

           socket_getpeername($newsock,$ip);
           cls();

           //mensagem do cliente
           $text= "Novo cliente conectado: ${$ip}\n";
           Msg($text);
           printArray($talkback);
           
           $key = array_search($sock,$read);
           unset($read[$key]);
        }

        foreach ($read as $read_sock){
            $data = @socket_read($read_sock,1024);
            socket_getpeername($read_sock,$ip);
            if ($data === false || $data == "q") {
                $key = array_search($read_sock,$clientes);
                unset($clientes[$key]);
                $text = "Cliente {$ip} desconectado.\n";
                Msg($text);
                printArray($talkback);
                continue;
            }

            $data = trim($data);
            if (!empty($data)) {
                if ($data == "/hist") {
                    $json = json_encode($history);
                    socket_write($read_sock,$json);
                    cls();
                }else{
                    emoji($data);
                    $hora = date('H:i:s');
                    $text = "<$hora> | {$ip}: $data\n";
                    Msg($text);
                    cls();
                    printArray($talkback);
                    $json = json_encode($talkback);
                    socket_write($read_sock,$json);
                }
            }
        }
        socket_close($sock);
    }
}

//UDP
else if ($opcao == 2) {
    $sock = @socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
    if (!$sock) die ("Não foi possivel criar o socket");
    if (!@socket_bind($sock,$ip,$port)) die("Não foi possivel fazer bind do socket");
    
    cls();
    echo "Server Room $ip Porta: $port";

    while(true){
        socket_recvfrom($sock, $data, 1024, 0, $ip_cliente,$porta_cliente);
        emoji($data);
        $hora=date('H:i:s');
        cls();
        $text="<$hora> | {$ip_cliente}: $data \n";
        Msg($text);
        printArray($talkback);
        $json = json_encode($talkback);
        socket_sendto($sock,$json,strlen($json),0,$ip_cliente,$porta_cliente);
    }
    socket_close($sock);
}
elseif($opcao ==3){}
else{
    cls();
    $opcao = opcao();

    goto start;
}