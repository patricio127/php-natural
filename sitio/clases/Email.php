<?php

class Email {
    protected $destinatario;
    protected $asunto;
    protected $cuerpo;
    protected $headers;

    public function __construct($destinatario = null, $asunto = null, $cuerpo = null, $headers = ''){
        $this->destinatario = $destinatario;
        $this->asunto = $asunto;
        $this->cuerpo = $cuerpo;
        $this->headers = $headers;
    }

    public function send(){  
        
        $this->headers .= "From: shopveggie0@gmail.com;\r\n".
        "Reply-To: ". $this->destinatario ."\r\n";
        $this->headers .= "MIME-Version: 1.0\r\n";
        $this->headers .= "content-Type: text/html; charset=utf-8\r\n";
        

        if(mail($this->destinatario, $this->asunto, $this->cuerpo, $this->headers)) {
            $nombre = date('Ymd_His_') . 'bienvenida_' . $this->destinatario . '.html';
            file_put_contents(__DIR__ . '/../emails/fallidos/'. $nombre, $this->cuerpo);
        }
    }

    public function cargar(string $archivo, array $reemplazos = []){
        $this->cuerpo = file_get_contents(__DIR__ . '/../emails/plantillas/' . $archivo);
        foreach($reemplazos as $token => $valor) {
            $this->cuerpo = str_replace($token, $valor, $this->cuerpo);
        }
    }

    public function getDestinatario(): ?string {
        return $this->destinatario;
    }
    public function setDestinatario(?string $destinatario):void {
        $this->destinatario = $destinatario;
    }

    public function getAsunto(): ?string {
        return $this->asunto;
    }
    public function setAsunto(?string $asunto):void {
        $this->asunto = $asunto;
    }

    public function getCuerpo(): ?string {
        return $this->cuerpo;
    }
    public function setCuerpo(?string $cuerpo):void {
        $this->cuerpo = $cuerpo;
    }

    public function getHeaders(): ?string {
        return $this->headers;
    }
    public function setHeaders(?string $headers):void {
        $this->headers = $headers;
    }
}