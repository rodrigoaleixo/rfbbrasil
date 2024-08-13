<?php

namespace RodrigoAleixo\RFBrasil;
use Smalot\PdfParser\Parser;

class ReceitaFederal
{

    private $content;
    private $contentHtml;

    public function openPDF($url)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($url);

        $string = htmlentities($pdf->getText(), null, 'utf-8');
        $content = str_replace("&nbsp;", "<hr>", $string);
        $content = html_entity_decode($content);

        $contentArray = explode("<hr>", $content);
        $this->contentHtml = $content;
        $this->content = $contentArray;
    }

    public function get_CNPJ()
    {

        //CNPJ
        $maskCnpj = "^[0-9]{2}[.]?[0-9]{3}[.]?[0-9]{3}[/]?[0-9]{4}[-]?[0-9]{2}^";
        preg_match_all($maskCnpj, $this->content[6], $saida);
        return $saida[0][0];
    }
    public function get_DataAbertura()
    {
        $maskData = "^[0-9]{2}[/]?[0-9]{2}[/]?[0-9]{4}?^";
        preg_match_all($maskData, $this->content[6], $saida);
        return $saida[0][0];
    }
    public function get_RazaoSocial()
    {
        //RAZAO SOCIAL
        return trim(str_replace("NOME EMPRESARIAL", "", $this->content[7]));

    }
    public function get_NomeFantasia()
    {
        //NOME FANTASIA
        $str = explode(")", $this->content[8]);
        $st2 = explode("PORTE", $str[1]);
        return $this->verifyAsterisk(trim($st2[0]));

    }
    public function get_Porte()
    {
        //PORTE
        $str = explode(")", $this->content[8]);
        $st2 = explode("PORTE", $str[1]);
        return trim($st2[1]);
    }
    public function get_CNAEPrincipal()
    {
        //CNAE P
        if($this->verifyAsterisk($this->content[9])){
            $maskCnae = "^[0-9]{2}[.]?[0-9]{2}[-]?[0-9]{1}?[-]?[0-9]{2}^";
            preg_match_all($maskCnae, $this->content[9], $saida);
           return $saida[0][0];
        }
    }
    public function get_CNAESecundario()
    {
        $pIni = 10;
        $maskCnae = "^[0-9]{2}[.]?[0-9]{2}[-]?[0-9]{1}?[-]?[0-9]{2}^";
        $nP = $this->countPages($this->contentHtml);
        $json["cnaeS"] = array();
        for($i = 1; $i <= $nP; $i++){
            preg_match_all($maskCnae, $this->content[$pIni], $saida);
            $json["cnaeS"] = array_merge($json["cnaeS"], $saida[0]);
            $pIni = $pIni+17;
        }
        return $json;
    }
    public function get_NaturezaJuridica()
    {
        //NATUREZA JURIDICA
        $maskNj = "^[0-9]{3}[-]?[0-9]{1}^";
        preg_match_all($maskNj, $this->content[11], $saida);
        return $saida[0][0];
    }
    public function get_Endereco()
    {
        if($this->verifyAsterisk($this->content[13])) {
            //ENDEREÇO 12 E 13
            //PEGO CEP PARA USAR A API CEP ABERTO
            $maskCEP = "^[0-9]{2}[.]?[0-9]{3}[-]?[0-9]{3}^";
            preg_match_all($maskCEP, $this->content[13], $saida);
            $json["cep"] = str_replace(".", "", $saida[0][0]);

            //SEPARO OS DELIMITADORES PRA PEGAR NUMERO E COMPLENTO
            $sepNum = "NÚMERO";
            $sepCom = "COMPLEMENT O";
            $endAr = explode($sepNum,$this->content[12]);
            $endAr2 = explode($sepCom,$endAr[1]);

            $json["logradouro"] = trim(substr($endAr[0], 11));
            $json["numero"] = trim($endAr2[0]);
            $json["complemento"] = $this->verifyAsterisk(trim(str_replace("\n", " ",$endAr2[1])));
            return $json;
        }else{
            return null;
        }
    }
    public function get_Email()
    {
        //EMAIL
        $conta = "^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+\.";
        $extensao = "[a-zA-Z]{2,4}^";
        $pattern = $conta.$domino.$extensao;
        preg_match_all($pattern, $this->content[14], $saida);
        return strtolower($saida[0][0]);
    }
    public function get_Telefone()
    {
        $maskTel = "^\(?[0-9]{2}?\)\s?[0-9]{4,5}[-]?[0-9]{4}^";
        preg_match_all($maskTel, $this->content[14], $saida);
        return $saida[0];
    }
    public function get_SituacaoCadastral()
    {
        //SITUACAO CADASTRAL
        $sepSit = "CADASTRAL";
        $sepData = "DATA";
        $sitAr = explode($sepSit,$this->content[16]);
        $sitAr2 = explode($sepData,$sitAr[1]);
        return trim($sitAr2[0]);
    }


    public function verifyAsterisk($string)
    {
        if(strpos($string, '***') === 0){
           return null;
        }else{
            return $string;
        }
    }
    public function countPages($html)
    {
        $ocorrencias = substr_count($html, "Página:");
        return $ocorrencias;
    }
}

