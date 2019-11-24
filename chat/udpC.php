<?php
error_reporting(E_ALL);

function cls(){
    echo "\e[H\e[J";
}

function opcao(){
    cls();
    echo("Escolhe uma opcao: 
        \nTCP       - 1
        \nUDP       - 2
        \nSair      - 3\n");
    return $opcao = readline(": ");
}

function history($historico){
    for ($i=0; $i < count($historico); $i++) { 
        if ($historico[$i] != "\n")
            echo $historico[$i];
    }
}

function printArray($array){
    for ($i=0; $i < count($array); $i++) 
        echo ($array[$i]);
}

cls();
$ip = trim(readline("Insira o seu IP: "));
$port = trim(readline("Insira a sua porta: "));
$opcao=opcao();

start:

if ($opcao == 1) {
    $sock = @socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    if (!$sock) die ("Nao foi possivel criar o socket");
    if (!@socket_connect($sock,$ip,$port)) die("Nao foi possivel ligar ao servidor");
    cls();

    $output=socket_read($sock,8192);
    echo "$output \n";

    while(true){
        $input = trim(readline(": "));
        cls();

        if ($input =="q"){
            socket_write($sock,$input,strlen($input));
            socket_shutdown($sock, 2);
            socket_close($sock);
            echo "Sessao terminada";
            break;
        }
        else if($input == ":hist"){
            cls();
            socket_write($sock,$input,strlen($input));
            $historico = socket_read($sock,8192);
            $historico = json_decode($historico,true);
            history($historico);

            echo("Historico de mensagens\n");
            echo("Clique numa tecla para voltar\n");
            readline(": ");
        }
        socket_write($sock,$input,strlen($input));

        $output = socket_read($sock,8192);
        $output = json_decode($output,true);
        printArray($output);
    }


}
else if($opcao ==2){
    $sock = @socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
    if (!$sock) die("Nao foi possivel criar o socket");
    cls();
    while(true){
        $input = readline(": ");
        cls();
        if ($input =="q") {
            echo "A terminar sessao\n";
            socket_shutdown($sock,2);
            socket_close($sock);
            echo("Sessao terminada com sucesso.\n\n");
            break;
        }
        socket_sendto($sock,$input,strlen($input),0,$ip,$port);
        socket_recv($sock,$output,2048,0);
        $output=json_decode($output,true);
        printArray($output);
    }
}
else if ($opcao ==3){}
else{
    cls();
    $opcao=opcao();
    goto start;
}