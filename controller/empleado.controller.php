<?php
require_once 'model/empleado.php';

class EmpleadoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Empleado();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/empleado/empleado.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Empleado();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/empleado/empleado-editar.php';
        require_once 'view/footer.php';
    }

    public function forValid(){

        $tipo = $_FILES['archivo']['type'];
 
        $tamanio = $_FILES['archivo']['size'];
        
        $archivotmp = $_FILES['archivo']['tmp_name'];

        $separador = $_POST['separador'];

        $tabla = $_POST['tabla'];


        $lineas = file($archivotmp);

        copy($archivotmp, 'archivos/copia.txt');

        $labels = explode($separador,$lineas[0]);

        $options = "<option value='N'>No Aplica</option>";
        foreach ($labels as $clave => $valor) {
            $options .= "<option value='$clave'>$valor</option>";  
        }


        $estructura = $this->model->ObtenerEstructura($tabla);
     
        $select = "";
        foreach ($estructura as $val) {
            if($val->columna != 'codigo_campana' && $val->columna != 'consecutivo'){
                $select .= "<label>$val->columna</label> Importar De ----->";
                $select .= "<div class='form-group'><select class='form-control' name='$val->columna'>";
                $select .=  $options;     
                $select .= "</select></div><br>";
            }
            
        }
       // var_dump($select);
        
        /*
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        */
        
        require_once 'view/header.php';
        require_once 'view/empleado/empleado-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $idCampana = $this->model->idCampana()->consecutivo;
        $lineas = file('archivos/copia.txt');

        $arrayEstruc = $_REQUEST;
        $arrayEstruc['codigo_campana'] = $idCampana;
        $arrayInsert = array();
        
        foreach ($lineas as $clave => $valor) {
            if($clave != 0){
                $data = explode($arrayEstruc['separador'],$valor);
                $campos="(";
                $valores = "(";
                foreach($arrayEstruc as $calve2 => $valor2){
                    if($calve2!="c" && $calve2!="a" && $calve2!="separador" && $calve2!="tabla"){
                        $campos .= $calve2.",";
                        if($calve2=="codigo_campana"){
                            $valores .= "'$idCampana',";
                        } else {
                            if($valor2 == 'N'){
                                $valores .= "null,";
                            } else {
                                $valores .= "'".$data[$valor2]."',";
                            }
                        }
                    }
                }
                $campos = substr($campos, 0, -1);
                $campos.=")";
                $valores = substr($valores, 0, -1);
                $valores.=")";
                $arrayInsert[] = $campos." VALUES ".$valores;
            }
        }
        $resp = 'S';
         foreach($arrayInsert as $valor){
             $result = $this->model->registrar($valor,$arrayEstruc['tabla']);
             if(empty($result)){
                 $resp = 'N';
             } 
          }

        echo $resp;
          
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}