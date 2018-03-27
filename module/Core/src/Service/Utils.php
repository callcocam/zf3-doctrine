<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 15:47
 */

namespace Core\Service;


class Utils
{

    const SUCCESS = 'success';
    const DANGER = 'danger';
    const ERROR = 'error';
    const INFO = 'info';


    public function form_read($post) {
        //$res=str_replace ( ",", "", $post );
        return @number_format($post, 2, ",", ".");
    }

    public function form_w($post) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $post); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    public function Calcular($v1, $v2, $op) {
        $v1 = str_replace(".", "", $v1);
        $v1 = str_replace(",", ".", $v1);
        $v2 = str_replace(".", "", $v2);
        $v2 = str_replace(",", ".", $v2);
        switch ($op) {
            case "+":
                $r = $v1 + $v2;
                break;
            case "-":
                $r = $v1 - $v2;
                break;
            case "*":
                $r = $v1 * $v2;
                break;
            case "%":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $v1 + $j;
                break;
            case "/":
                $r = $v1 / $v2;
                break;
            case "tj":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $j;
                break;
            default :
                $r = $v1;
                break;
        }
        $ret = @number_format($r, 2, ",", ".");
        return $ret;
    }

    public function margem_lucro($post) {
        $c = $this->Calcular(['capital' => $post['custo'], 'calculo' => "100", 'operacao' => "/"]); // valor($v1, 100, "/");
        $df = $this->Calcular(['capital' => $post['venda'], 'calculo' => $post['custo'], 'operacao' => "-"]); //valor($v2, $v1, "-");
        return $this->Calcular(['capital' => $df, 'calculo' => $c, 'operacao' => "/"]); ///($df, $c, "/");
    }

    public function form_conferir($v1, $v2, $op) {
        $v1 = str_replace(".", "", $v1);
        $v1 = str_replace(",", ".", $v1);
        $v2 = str_replace(".", "", $v2);
        $v2 = str_replace(",", ".", $v2);
        switch ($op) {
            case "!":
                if ($v1 != $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            case ">":
                if ($v1 > $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            case ">=":
                if ($v1 >= $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            case "<=":
                if ($v1 <= $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            case "<":
                if ($v1 < $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            case "=":
                if ($v1 == $v2)
                    $ret = TRUE;
                else
                    $ret = FALSE;
                break;
            default :
                $ret = TRUE;
                break;
        }

        return $ret;
    }
    public function Calculajuros($valo_inicial,$dt_vencimento,$retorno='total',$taxa="0,03")
    {
        $valor_doc=$valo_inicial;
        $juro=0;

        $resultado=array();
        $dt_vencimento=str_replace( "/", "-",$dt_vencimento);
        $dias=$this->form_diasEntreData($dt_vencimento,date('d-m-Y'),0);
        if ($dias <= 0) {
            $resultado['total']=$valor_doc;
            $resultado['taxa'] = 0;
            $resultado['juro'] =0;
            $resultado['dias'] =0;
        } else {
            //se estiver atrasa e n�o foi paga soma o juro
            $juro=$this->Calcular($dias,$taxa,'*');
            // mais o valor real da parcela
            $resultado['total']=$this->Calcular($valor_doc, $juro, "%");
            $resultado['taxa'] = $this->Calcular($valor_doc, $juro, "tj");
            $resultado['juro'] = $this->Calcular($resultado['total'],$valor_doc, "-");
            $resultado['dias'] =(int)$dias;
        }//Moeda(($valor_doc * 2) / 100);

        return $resultado[$retorno];

    }
    //$timestamp = strtotime ($dataparcela . "+28 days" );
    public function form_diasEntreData($date_ini, $date_end,$tipo=0) {

        $data_ini = strtotime($this->Data($date_ini)); //data inicial '29 de julho de 2003'
        $hoje =$this->form_convdata($date_end,$tipo); //date("m/d/Y"); // data atual
        $foo = strtotime($hoje); // transforma data atual em segundos (eu acho)
        $dias = ($foo - $data_ini) / 86400; //calcula intervalo
        return (int) $dias;

    }
    public function form_convdata($dataform, $tipo=0) {
        if ($tipo == 0) {
            $datatrans = explode("-", $dataform);
            @$data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
        } elseif ($tipo == 1) {
            $datatrans = explode("/", $dataform);
            $data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
        } elseif ($tipo == 2) {
            $datatrans = explode("/", substr_replace("-", "/", $dataform));
            $data = "$datatrans[0]-$datatrans[1]-$datatrans[2]";
        }

        return @$data;
    }

    public function form_extenso($valor = 0, $maiusculas = false) {

        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
            "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
            "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
            "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
            "sete", "oito", "nove");

        $z = 0;
        $rt = "";
        $valor = str_replace(",", ".", $valor);
        $valor = @number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++)
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000")
                $z++; elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
            return($rt ? $rt : "zero");
        } else {

            if ($rt)
                $rt = preg_replace(" E ", " e ", ucwords($rt));
            return (($rt) ? ($rt) : "Zero");
        }

    }

    public function form_data_hora($data,$tipo=0) {
        /* Primeiramente temos que definir um nome pra variavel que pega a DATA/HORA do computador.
         Vamos dar, o nome de horario.
        */

        error_reporting ( 0 );
        $horario =$this->form_convdata($data,$tipo);// date("Y-m-d H:i:s");

        /* pronto, agora a DATA/HORA do PC , esta armazenada nesta variavel no formato timestamp (AAAA-MM-DD HH:ii:ss).
         agora vamos decompor esta variavel.. */

        $month = substr($horario, 5, 2);
        $date = substr($horario, 8, 2);
        $year = substr($horario, 0, 4);
        $hour = substr($horario, 11, 2);
        $minutes = substr($horario, 14, 2);
        $seconds = substr($horario, 17, 4);

        $data = date("D M j G:i:s T Y", mktime($hour, $minutes, $seconds, $month, $date, $year));

        /* usei substr para restringir o numero de caracter desejado.
         se dermos um echo na $data - teremos no formato padrao a data assim:
        Mon Aug 28 17:53:45 Hora oficial do Brasil 2006
        mas queremos transformar isto em, Segunda Feira 28 Agosto 17:53, entao criaremos agora a variavel, que pegara no banco de dados o dia da semana. */

        $divi = explode(" ", $data);
        $dia_semana_eng = $divi[0];

        $mes = $divi[1];
        $dia = $divi[2];
        $horario = $divi[3];

        switch ($dia_semana_eng) {
            case 'Mon' :
                $dia_semana_port = 2;
                $text = "Segunda-Feira";
                break;

            case 'Tue' :
                $dia_semana_port = 3;
                $text = "Terça-Feira";
                break;

            case 'Wed' :
                $dia_semana_port = 4;
                $text = "Quarta-Feira";
                break;

            case 'Thu' :
                $dia_semana_port = 5;
                $text = "Quinta-Feira";
                break;

            case 'Fri' :
                $dia_semana_port = 6;
                $text = "Sexta-Feira";
                break;

            case 'Sat' :
                $text = "Sabado";
                $dia_semana_port = 7;
                break;

            case 'Sun' :
                $text = "Domingo";
                $dia_semana_port = 1;
                break;
        }

        /* variavel, $dia_semana_pt = busca o valor do dia do banco, e passa para o portugues.
         vamos criar tambem uma variavel que "arrume" a data no formato portugues (DD/MM/AAAA)
        esta é a parte mais facil */

        // echo $date . "/" . $month . "/" . $year;
        $array_mes = array("01" => "Janeiro",
            "02" => "Fevereiro",
            "03" => "Março",
            "04" => "Abril",
            "05" => "Maio",
            "06" => "Junho",
            "02" => "Julho",
            "08" => "Agosto",
            "09" => "Setembro",
            "10" => "Outubro",
            "11" => "novembro",
            "12" => "Dezembro");
        return $text . ",  " . $date . " de " . $array_mes[$month] . " de $year";
    }

    /**
     * <b>Tranforma TimeStamp:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public function Data($Data) {
        if(empty($Data)):
            return null;
        endif;
        $Format = explode(' ', $Data);
        $OldData = explode('/', str_replace("-", "/", $Format[0]));

        if (!checkdate($OldData[1], $OldData[0], $OldData[2])):
            $Data = date('Y-m-d H:i:s');
            return $Data;
        else:
            if (empty($Format[1])):
                $Format[1] = date('H:i:s');
            endif;

            $NewData = $OldData[2] . '-' . $OldData[1] . '-' . $OldData[0] . ' ' . $Format[1];

            return $NewData;
        endif;
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @param INT $name Description INT = $Limite = String limitada pelo $Limite
     * @return string
     */
    public  function Words($String, $Limite, $Pointer = null) {
        $Data = strip_tags(trim($String));
        $Format = (int) $Limite;

        $ArrWords = explode(' ', $Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, $Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( $Format < $NumWords ? $NewWords . $Pointer : $Data );
        return $Result;
    }

    /**
     * <b>Limita os Caracteres:</b> Limita a quantidade de letras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @param INT $name Description INT = $Limite = String limitada pelo $Limite
     * @return string
     */
    public static function Chars($String, $Limite) {
        $Data = strip_tags($String);
        $Format = $Limite;
        if (strlen($Data) <= $Format) {
            return $Data;
        } else {
            $subStr = strrpos(substr($Data, 0, $Format), ' ');
            return substr($Data, 0, $subStr) . '...';
        }
    }

}
