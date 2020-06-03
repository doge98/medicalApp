<?php
require_once '../../datos/Conexion.clase.php';

class Medico extends Conexion{
    private $p_codigounicoipress;
    private $p_ipressupscodigo;

    function getP_codigounicoipress() {
        return $this->p_codigounicoipress;
    }

    function setP_codigounicoipress($p_codigounicoipress) {
        $this->p_codigounicoipress = $p_codigounicoipress;
    }

    function getP_ipressupscodigo() {
        return $this->p_ipressupscodigo;
    }

    function setP_ipressupscodigo($p_ipressupscodigo) {
        $this->p_ipressupscodigo = $p_ipressupscodigo;
    }

    public function medicoupslistar(){
        try { 
            $sql="select pe.*,awp.codigo_cmp_medico from medico_ipress_ups miu
            inner join cuenta_web_afiliacion cwa on miu.id_afiliacion=cwa.id_afiliacion
            inner join afiliacion_web_persona awp on awp.codigo_cuenta=cwa.codigo_cuenta
            inner join persona pe on pe.documento_persona=awp.documento_persona
            where cwa.codigo_unico_ipress=:p_codigounicoipress and ipress_ups_codigo=:p_ipressupscodigo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_codigounicoipress", $this->getP_codigounicoipress());
            $sentencia -> bindParam(":p_ipressupscodigo", $this->getP_ipressupscodigo());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;    
        } catch (Exception $exc) {
            throw  $ex;
        }
    }
}
?>