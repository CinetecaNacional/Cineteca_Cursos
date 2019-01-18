<?php
require '../config/Conexion.php';
ini_set('date.timezone',"America/Mexico_City");
class Referencia{
  public $matricula;
  public $curso;
  public $digito_precio;
  public $fecha_limite_pago;
  public $referencia;
  public $digitos_fecha;
  function __construct($boleta, $curso_id, $precio){
    //la boleta debe de ser siempre igual a 9 dígitos por lo que se completara con ceros en caso de no ser lo
    $this->matricula = $this->convertir_maticula($boleta);
    //la clave de curso debe ser siempre igual a 3 dígitos por lo que se completara con ceros en caso de no ser lo
    $this->curso = str_pad($curso_id, 3, "0", STR_PAD_LEFT);
    //Se obtiene los 4 digitos que representaran la fecha en la referencia
    $this->digitos_fecha = str_pad($this->convertir_fecha(), 4, "0", STR_PAD_LEFT);
    //Se obtiene el digito que representaran el precio en la referencia
    $this->digito_precio = $this->convertir_precio($precio);
    //Se obtiene los 2 digitos que representaran el codigo verificador de toda la referencia
    $this->digitos_verificadores = str_pad($this->codigo_verificador_referencia(), 2, "0", STR_PAD_LEFT);

    $this->referencia = "$this->matricula"."$this->curso"."$this->digitos_fecha"."$this->digito_precio"."$this->digitos_verificadores";
  }
  public function convertir_fecha(){
    $hoy = date('Y-m-j'); //formato de fecha
    $this->fecha_limite_pago = strtotime ( '+15 day' , strtotime ( $hoy ) ) ;
    $year = date("Y", $this->fecha_limite_pago);
    $month= date("m", $this->fecha_limite_pago);
    $day = date("j", $this->fecha_limite_pago);
    //dígito fecha
    $digitos_fecha = (($year-2000)*372)+(($month-1)*31)+($day-1);
    return $digitos_fecha;
  }
  public function convertir_maticula($boleta){
    $matricula = str_pad($boleta, 9, "0", STR_PAD_LEFT);

    $array_digitos_matricula = str_split($matricula);
    $array_digitos_matricula2 = array();
    for ($i = 0; $i <count($array_digitos_matricula); $i++) {
        if($array_digitos_matricula[$i]=='a' ||$array_digitos_matricula[$i]=='A' || $array_digitos_matricula[$i]=='j' || $array_digitos_matricula[$i]=='J'){
          array_push($array_digitos_matricula2, '1');
        }elseif ($array_digitos_matricula[$i]=='b' ||$array_digitos_matricula[$i]=='B' || $array_digitos_matricula[$i]=='k' ||$array_digitos_matricula[$i]=='K' || $array_digitos_matricula[$i]=='s' ||$array_digitos_matricula[$i]=='S') {
          array_push($array_digitos_matricula2, '2');
        }elseif ($array_digitos_matricula[$i]=='c' ||$array_digitos_matricula[$i]=='C' || $array_digitos_matricula[$i]=='l' ||$array_digitos_matricula[$i]=='L' || $array_digitos_matricula[$i]=='t' ||$array_digitos_matricula[$i]=='T') {
          array_push($array_digitos_matricula2, '3');
        }elseif ($array_digitos_matricula[$i]=='d' ||$array_digitos_matricula[$i]=='D' || $array_digitos_matricula[$i]=='m' ||$array_digitos_matricula[$i]=='M' || $array_digitos_matricula[$i]=='u' ||$array_digitos_matricula[$i]=='U') {
          array_push($array_digitos_matricula2, '4');
        }elseif ($array_digitos_matricula[$i]=='e' ||$array_digitos_matricula[$i]=='E' || $array_digitos_matricula[$i]=='n' ||$array_digitos_matricula[$i]=='N' || $array_digitos_matricula[$i]=='v' ||$array_digitos_matricula[$i]=='V') {
          array_push($array_digitos_matricula2, '5');
        }elseif ($array_digitos_matricula[$i]=='f' ||$array_digitos_matricula[$i]=='F' || $array_digitos_matricula[$i]=='o' ||$array_digitos_matricula[$i]=='O' || $array_digitos_matricula[$i]=='w' ||$array_digitos_matricula[$i]=='W') {
          array_push($array_digitos_matricula2, '6');
        }elseif ($array_digitos_matricula[$i]=='g' ||$array_digitos_matricula[$i]=='G' || $array_digitos_matricula[$i]=='p' ||$array_digitos_matricula[$i]=='P' || $array_digitos_matricula[$i]=='x' ||$array_digitos_matricula[$i]=='X') {
          array_push($array_digitos_matricula2, '7');
        }elseif ($array_digitos_matricula[$i]=='h' ||$array_digitos_matricula[$i]=='H' || $array_digitos_matricula[$i]=='q' ||$array_digitos_matricula[$i]=='Q' || $array_digitos_matricula[$i]=='y' ||$array_digitos_matricula[$i]=='Y') {
          array_push($array_digitos_matricula2, '8');
        }elseif ($array_digitos_matricula[$i]=='i' ||$array_digitos_matricula[$i]=='I' || $array_digitos_matricula[$i]=='r' ||$array_digitos_matricula[$i]=='R' || $array_digitos_matricula[$i]=='z' ||$array_digitos_matricula[$i]=='Z') {
          array_push($array_digitos_matricula2, '9');
        }else{
          array_push($array_digitos_matricula2, $array_digitos_matricula[$i]);
        }
    }
    $digitos_maticula =implode("", $array_digitos_matricula2);
    return $digitos_maticula;
  }
  public function convertir_precio($precio){
    $precio_sin_decimal =str_replace(".", "", $precio);
    $array_digitos_precio  = array_map('intval', str_split($precio_sin_decimal));
    $array_ponderados = array();
    $ponderado_actual=7;
    for ($i = 0; $i <count($array_digitos_precio); $i++) {
      array_push($array_ponderados, $ponderado_actual);
        if($ponderado_actual==7){
          $ponderado_actual=3;
        }else if($ponderado_actual==3){
          $ponderado_actual=1;
        }else{
          $ponderado_actual=7;
        }
    }
    $reversed = array_reverse($array_ponderados);
    $array_precio_ponderados = array();
    for ($i = 0; $i <count($array_digitos_precio); $i++) {
      array_push($array_precio_ponderados, $array_digitos_precio[$i]*$reversed[$i]);
    }
    //dígito cantidad
    return $residuo= array_sum($array_precio_ponderados) % 10;
  }
  public function codigo_verificador_referencia(){
    $referencia = "$this->matricula"."$this->curso"."$this->digitos_fecha"."$this->digito_precio";
    $referenciaArray  = array_map('intval', str_split($referencia));
    $ponderadosReferencia=11;
    $referenciaPonderados = array();
    for ($i = 0; $i <count($referenciaArray); $i++) {
      array_push($referenciaPonderados, $ponderadosReferencia);
        if($ponderadosReferencia==11){
          $ponderadosReferencia=13;
        }else if($ponderadosReferencia==13){
          $ponderadosReferencia=17;
        }else if($ponderadosReferencia==17){
          $ponderadosReferencia=19;
        }else if($ponderadosReferencia==19){
          $ponderadosReferencia=23;
        }else{
          $ponderadosReferencia=11;
        }
    }
    $reversed2 = array_reverse($referenciaPonderados);
    $ponderadosvsReferencia = array();
    for ($i = 0; $i <count($referenciaPonderados); $i++) {
      array_push($ponderadosvsReferencia, $referenciaArray[$i]*$reversed2[$i]);
      $nuevo=$referenciaArray[$i]*$reversed2[$i];

    }
    $cantidadReferenciaPonderados=array_sum($ponderadosvsReferencia);
    //dígito cantidad
    return ($cantidadReferenciaPonderados % 97)+1;
  }
  public function get_referencia(){
    return $this->referencia;
  }
  public function get_fecha_limite_pago(){
    return $this->fecha_limite_pago;
  }
}


?>
