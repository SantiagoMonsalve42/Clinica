<?php
include 'admonDAO.php';
include 'medicoDAO.php';
include 'pacienteDAO.php';
include 'tipodDAO.php';
include 'especialidadDAO.php';
include 'citaDAO.php';
include 'historiaDAO.php';
class facade{
    public function readDatesToSearchById($id){
    $objC=new citaDAO();
    $resul=$objC->readDatesToSearchById($id);
    return $resul; 
    }
    public function TipoUser($idmail){//FUNCION PARA IDENTIFICAR TIPO DE USUARIO CON EL MAIL O ID
     $tipo=0;                  //1= admon con mail  
     $objA=new admonDAO();    //2=medico con mail  3=medico con id
     $objM=new medicoDAO();   //4=paciente con mail 5=paciente con id
     $objP=new pacienteDAO();  //0=no existe
     $resul1=$objA->readall();
     $resul2=$objM->readall();
     $resul3=$objP->readall();
     for($i=0;$i<count($resul1);$i++){
       if($resul1[$i]['correo'] == $idmail){
           $tipo=1;//es admin 
       }
     }
     for($i=0;$i<count($resul2);$i++){
        if($resul2[$i]['correo'] == $idmail ){
            $tipo=2;//es medico con mail
        }
        if( $resul2[$i]['id_medico'] == $idmail){
            $tipo=3;//es medico con id
        }
     }
     for($i=0;$i<count($resul3);$i++){
        if($resul3[$i]['correo'] == $idmail){
            $tipo=4;//es paciente con correo
        }
        if($resul3[$i]['id_paciente'] == $idmail ){
            $tipo=5;//es paciente con id
        }
     }
     return $tipo;
    }
    //Funcion que nos a el dia de una fecha
    public function dayOfTheWeek($fecha){
        $i = strtotime($fecha);
        $day= jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 );
        return $day;
       }

    public function validar_fecha($fecha, $hora){
        $fecha_valida=true;

        $hora_actual=date("G");
        $fecha_actual = strtotime(date('Y-m-d'));
        $fecha_entrada = strtotime($fecha);
        if(($fecha_entrada <$fecha_actual) or ($fecha_entrada == $fecha_actual && 
                $hora<=$hora_actual)){
                $fecha_valida=false;
        }
        return $fecha_valida;
    }
    public function validarCredencial($mail,$pass1){//funcion para validar clave y correo/id
     $direccionador1=0;
     $tipo=$this->TipoUser($mail);
     $pass=$this->encriptarClave($pass1);
     $objA=new admonDAO();    //direcionador =1 mandar a admon
     $objM=new medicoDAO();   //direcionar=2 mandar a medico
     $objP=new pacienteDAO();  //direccionar=3 mandar a paciente
     $resul1=$objA->readall(); //error en datos
     $resul2=$objM->readall();
     $resul3=$objP->readall();
    if($tipo==1){
        for($i=0;$i<count($resul1);$i++){
            if($resul1[$i]['correo'] == $mail && $resul1[$i]['clave'] == $pass){
               
                $direccionador1=1;//es admin 
                
            }
        }
    }
    if($tipo==2){
        for($i=0;$i<count($resul2);$i++){
            if($resul2[$i]['correo'] == $mail && $resul2[$i]['clave'] == $pass){
                $direccionador1=2;//es medico 
            }
        }
    }
    if($tipo==3){
        for($i=0;$i<count($resul2);$i++){
            if($resul2[$i]['id_medico'] == $mail && $resul2[$i]['clave'] == $pass){
                $direccionador1=2;//es medico
            }
        }
    }
    if($tipo==4){
        for($i=0;$i<count($resul3);$i++){
            if($resul3[$i]['correo'] == $mail && $resul3[$i]['clave'] == $pass){
                $direccionador1=3;//es paciente
            }
        }
    }
    if($tipo==5){
        for($i=0;$i<count($resul3);$i++){
            if($resul3[$i]['id_paciente'] == $mail && $resul3[$i]['clave'] == $pass){
                $direccionador1=3;//es paciente
            }
        }
    }
    return $direccionador1;
   }
   //Nos trae aca desde la seccion de recuperar contraseña(en validarLogin)
   //retorna el tipo de usuario, si retorna 0 el correo no existe
    public function validarCorreo($mail){//funcion para validar clave y correo/id
        $direccionador1=0;
        $objA=new admonDAO();    //direcionador =1 mandar a admon
        $objM=new medicoDAO();   //direcionar=2 mandar a medico
        $objP=new pacienteDAO();  //direccionar=3 mandar a paciente
        $resul1=$objA->readall(); //error en datos
        $resul2=$objM->readall();
        $resul3=$objP->readall();
       
           for($i=0;$i<count($resul1);$i++){
               if(strtoupper($resul1[$i]['correo']) == strtoupper($mail)){
                   $direccionador1=1;//es admin    
               }
           }
       
           for($i=0;$i<count($resul2);$i++){
               if(strtoupper($resul2[$i]['correo']) == strtoupper($mail)){
                   $direccionador1=2;//es medico 
               }
           }
       
           for($i=0;$i<count($resul3);$i++){
               if(strtoupper($resul3[$i]['correo']) == strtoupper($mail)){
                   $direccionador1=3;//es paciente
               }
           }
       
    return $direccionador1;
    }

    //Valida si la respuesta ingresada por el usuario es la correcta
    //RETORNA TRUE CUENADO LA RESPUESTA ES LA ACERTADA, ENVIANDOLO A VALIDARLOGIN
    public function validarPregunta($tipo,$id,$respuesta){//funcion para validar clave y correo/id
        $objA=new admonDAO();    //direcionador =1 mandar a admon
        $objM=new medicoDAO();   //direcionar=2 mandar a medico
        $objP=new pacienteDAO();  //direccionar=3 mandar a paciente
        $resul1=$objA->readall(); //error en datos
        $resul2=$objM->readall();
        $resul3=$objP->readall();
        if($tipo==1){
           for($i=0;$i<count($resul1);$i++){
               if($resul1[$i]['id_admon'] == $id){
                  if(strtoupper($resul1[$i]['respuesta']) == strtoupper($respuesta)){
                      return true;
                  }   
               }
           }
        }
       
           for($i=0;$i<count($resul2);$i++){
            if($resul2[$i]['id_medico'] == $id){
                if(strtoupper($resul2[$i]['respuesta']) == strtoupper($respuesta)){
                    return true;
                }   
             }
           }
       
           for($i=0;$i<count($resul3);$i++){
              if($resul3[$i]['id_paciente'] == $id){
                if(strtoupper($resul3[$i]['respuesta']) == strtoupper($respuesta)){
                    return true;
                }   
             }
           }
       return false;
    }
    
    public function idDefinitivo($tipo,$id){ //funcion para definir id de la sesion
     $iddef=0;
     $objA=new admonDAO();    //direcionador =1 mandar a admon
     $objM=new medicoDAO();   //direcionar=2 mandar a medico
     $objP=new pacienteDAO();  //direccionar=3 mandar a paciente
     $resul1=$objA->readOneById($id); //error en datos
     $resul2=$objM->readOneById($id);
     $resul3=$objP->readOneById($id);
     
     if($tipo==1){
         for($i=0;$i<count($resul1);$i++){
             $iddef=$resul1[$i]['id_admon'];
         }
     }
     if($tipo==2){
        for($i=0;$i<count($resul2);$i++){
            $iddef=$resul2[$i]['id_medico'];
        }
    }
    if($tipo==3){
        for($i=0;$i<count($resul3);$i++){
            $iddef=$resul3[$i]['id_paciente'];
        }
    }
     
    return $iddef;
    }

    public function readAllTD(){//FUNCION PARA LEER TODOS LOS TIPOS DE DOCUMENTOS
        $objT=new tipodocDAO();//leer todos los tipos de documentos para los registros 
        $resul=$objT->readall();
        return $resul;
        
    }
    public function readAdmonById($id){
        $objA=new admonDAO(); 
        $resul=$objA->readOneById($id);
        return $resul;
    }
    public function readMedicoById($id){//-----------------------
       
        $objM=new medicoDAO();
        $resul=$objM->readOneById($id);
        return $resul;
    }
    public function readMedicoEspecial(){//FUNCION PARA LEER DATOS DE JOIN ENTRE MEDICO Y ESPECIALIDAD
        $objM=new medicoDAO();
        $resul=$objM->readMedicoEspecialidad();
        return $resul;
    }
    public function readAllEspecialidadDisponible(){
        $objE=new especialidadDAO();
        $resul=$objE->readAllEspecialidadDisponible();
        return $resul;
    }
    public function readOneMedicoEspecialidad($id){
        $objM=new medicoDAO();
        $resul=$objM->readOneMedicoEspecialidad($id);
        return $resul;
    }

    public function verificarIdMedico($id){//FUNCION PARA VERIFICAR LA EXISTENCIA DE UN ID EN TABLA MEDICO
        $direccionador1=0;
        $objA=new admonDAO();    //direcionador =1 mandar a admon
        $objM=new medicoDAO();   //direcionar=2 mandar a medico
        $objP=new pacienteDAO();  //direccionar=3 mandar a paciente
        $resul1=$objA->readall(); //error en datos
        $resul2=$objM->readall();
        $resul3=$objP->readall();
       
           for($i=0;$i<count($resul1);$i++){
               if($resul1[$i]['id_admon'] == $id){
                   $direccionador1=1;//es admin    
               }
           }
       
           for($i=0;$i<count($resul2);$i++){
               if($resul2[$i]['id_medico'] == $id){
                   $direccionador1=2;//es medico 
               }
           }
       
           for($i=0;$i<count($resul3);$i++){
               if($resul3[$i]['id_paciente'] == $id){
                   $direccionador1=3;//es paciente
               }
           }
       
    return $direccionador1;
    }
    public function readUserById($id){
        $objP=new pacienteDAO();
        $resul3=$objP->readOneById($id);
        return $resul3;
    }
    public function readOneFullById($id){
        $objP=new pacienteDAO();
        $resul3=$objP->readOneFullById($id);
        return $resul3;
    }
    
    public function validarPass($clave){//FUNCION PARA VERIFICAR QUE UNA CLAVE CUMPLA CON LAS CONDICIONES
        $error_clave =  " ";
        if(strlen($clave) < 6){
            $error_clave ='a';// "La clave debe tener al menos 6 caracteres";
         }
         if(strlen($clave) > 16){
            $error_clave ='b';// "La clave no puede tener más de 16 caracteres";
         }
         if (!preg_match('`[a-z]`',$clave)){
            $error_clave ='c';// "La clave debe tener al menos una letra minúscula";
         }
         if (!preg_match('`[A-Z]`',$clave)){
            $error_clave = 'd';// "La clave debe tener al menos una letra mayúscula";
         }
         if (!preg_match('`[0-9]`',$clave)){
            $error_clave ='e';// "La clave debe tener al menos un caracter numérico";
         }
         
         return $error_clave;
    }
  //Busca y retorna el id de una especialidad
  public function getIdByNameEspecialidad($name){//FUNCION PARA VERIFICAR LA EXISTENCIA DE UN CORREO EN TABLA MEDICO
    $objT=new especialidadDAO();
    $resul=$objT->readall();
    $act=0;
    for($i=0;$i<count($resul);$i++){
        if(strtoupper($resul[$i]['nombre']) == strtoupper($name)){
            $act=$resul[$i]['id_especialidad'];
        }
    }
    return $act;  
  }
  //llama insert y valida que se haya inseretado la especialidad
  public function insertEspecialidad($name,$desc){//FUNCION PARA insertar en tb especialidad
    $objT=new especialidadDAO();
    if($objT->insert($name,$desc) == true){
     return true;
    }else{
        return false;
    }
  }
  //leer citas de un medico en orden descendente
  public function readOneByMedicoInOrden($id,$fecha){
    $objC=new citaDAO();
    $resul=$objC->readOneByMedicoInOrden($id,$fecha);
    return $resul;
  }
  public function readOneByMedicoAnteriores($id,$fecha){
    $objC=new citaDAO();
    $resul=$objC->readOneByMedicoAnteriores($id,$fecha);
    return $resul;
  }
  public function readOneByPacienteInOrden($id,$fecha){
    $objC=new citaDAO();
    $resul=$objC->readOneByPacienteInOrden($id,$fecha);
    return $resul;
  }
  //insertar medico
  public function insertMedico($id,$esp,$name,$ape,$tel,$fecha,$sexo,$clave1,$correo,$ask,$ans){ //FUNCION PARA insertar en tb medico
    $objM=new medicoDAO();
    $clave=$this->encriptarClave($clave1);
    if($objM->insert($id,$esp,$name,$ape,$tel,$fecha,$sexo,$clave,$correo,$ask,$ans)==true){
        return true;
    }
    else 
    return false;
  }
  //actualziar telefono del medico
  public function updateTelMedById($id,$tel){
    $objM=new medicoDAO();
    $feedback=false;
    $feedback=$objM->updateTel($id,$tel);
    return $feedback;
  }
  //ingresar datos de una nuva consulta medica
  public function insertHistoryById($id,$peso,$altura,$moti,$enfe,$antep,$alerg,$antef,$med){
    $objH=new historiaDAO();  
    $resul=$objH->insert($id,$peso,$altura,$moti,$enfe,$antep,$alerg,$antef,$med);
    return $resul;
  }
  //leer expediente por id del paciente
  public function readOneExpByIdPaciente($id){
    $objH=new historiaDAO();  
    $resul=$objH->readOneByIdPaciente($id);
    return $resul;
  }
  //actauzalizar estado de cita para cuando haya sido atendida
  public function updateStatusInactive($id){
    $objC=new citaDAO();
    $resul=$objC->updateStatusInactive($id);
    return $resul;
  }
  //El administrador actualiza la contraseña del medico
  public function updatePassMedicoByAdmon($id,$pass1,$pass2){
    $objM=new medicoDAO();
    $feedback='';
    if($pass1 == $pass2){
         if($this->validarPass($pass1) == ' '){
             $clave=$this->encriptarClave($pass1);
             if($objM->updatePass($id,$clave) == true){
                 $feedback='ok';//bien mi papacho
             }else{
                 $feedback='3';//error en el update
             }
         }else{
            $feedback='2';//las clave dadas no es valida
         }
    }else{
        $feedback='1';//las claves dadas no son iguales
    }
    return $feedback;
  }
  //Funcion actualiza la contrtaseña del administrador
  public function updatePassAdmonById($id,$pass1,$pass2){
    $objM=new admonDAO();
    $feedback='';
    if($pass1 == $pass2){
         if($this->validarPass($pass1) == ' '){
            $clave=$this->encriptarClave($pass1);
             if($objM->updatePass($id,$clave) == true){
                 $feedback='ok';//bien mi papacho
             }else{
                 $feedback='3';//error en el update
             }
         }else{
            $feedback='2';//las clave dadas no es valida
         }
    }else{
        $feedback='1';//las claves dadas no son iguales
    }
    return $feedback;
  }
  //Funcion actualiza la contraseña del paciente por el id
  public function updatePassPacienteById($id,$pass1,$pass2){
    $objP=new pacienteDAO();
    $feedback='';
    if($pass1 == $pass2){
         if($this->validarPass($pass1) == ' '){
            $clave=$this->encriptarClave($pass1);
             if($objP->updatePass($id,$clave) == true){
                 $feedback='ok1';//bien mi papacho
             }else{
                 $feedback='3';//error en el update
             }
         }else{
            $feedback='2';//las clave dadas no es valida
         }
    }else{
        $feedback='1';//las claves dadas no son iguales
    }
    return $feedback;
  }
  //Insertando pacientes
  public function insertarUser($id,$nombres,$apes,$tel,$fecha,$sexo,$pass,$correo,$ask,$ans,$tipod){
    $objP=new pacienteDAO();
    $clave=$this->encriptarClave($pass);
   $resul=$objP->insert($id,$tipod,$nombres,$apes,$tel,$fecha,$sexo,$clave,$correo,$ask,$ans);
   return $resul;
  }
  public function validarRegistroUser($id,$nombres,$apes,$tel,$fecha,$sexo,$clave1,$clave2,$correo,$ask,$ans,$tipod){//funcion que valida el estado del insert 
    $feedback="";
    if($tipod != '0'){
    if($clave1 == $clave2){
        if($this->validarPass($clave1) == ' '){
            if($this->validarCorreo($correo) == 0){//verifica validas del correo
                if($ask != '0'){
                 if($ask==1)
                    $askf="Nombre de su primer mascota";
                 if($ask==2)
                    $askf="Direccion de su primer lugar de residencia";
                 if($ask==3)
                    $askf="Nombre mejor amigo de la infancia";
                 if($ask==4)
                    $askf="Nombre de su localidad de residencia";
                 if($ask==5)
                    $askf="Color de su camisa favorita";
                    if($sexo != '0' ){
                        //error
                        if($this->verificarIdMedico($id)==0){
                            if($this->insertarUser($id,$nombres,$apes,$tel,$fecha,$sexo,$clave1,$correo,$askf,$ans,$tipod) == true){
                              $feedback='ok';
                            }else{
                                $feedback='1';//error en el insert
                            }
                        }else{
                            $feedback='2';//id existe en la bd
                        }
                    }else{
                        $feedback='3';//no selecciono sexo
                    }
                }else{
                    $feedback='4';//no selecciono pregunta
                }
            }else{
                $feedback='5';//correo existe
            }
        }else{
            $feedback=$this->validarPass($clave1);//contraseña no valida
        }
    }else{
        $feedback='6';//las claves no son iguales
    }
}else{
    $feedback='7';//no se ingreso tipo
}
     return $feedback;  
  }
public function encriptarClave($pass){
    $newPassword = hash('sha256', $pass);
    return $newPassword;
}
  public function validarRegistroMedico($id,$nombres,$apes,$tel,$fecha,$sexo,$clave1,$clave2,$correo,$ask,$ans,$id_esp){//funcion que valida el estado del insert 
    $feedback="";
         if($clave1 == $clave2 ){//verifica que las claves sean iguales
              if($this->validarPass($clave1) == ' '){//verifica que la clave sea valida
                   if($this->validarCorreo($correo) == 0){//verifica validas del correo
                      if($ask != 0){
                        if($ask==1)
                           $askf="Nombre de su primer mascota";
                        if($ask==2)
                           $askf="Direccionde su primer lugar de residencia";
                        if($ask==3)
                           $askf="Nombre mejor amigo de la infancia";
                        if($ask==4)
                           $askf="Nombre de su localidad de residencia";
                        if($ask==5)
                           $askf="Color de su camisa favorita";
                             if($sexo != '0' ){
                                if($this->verificarIdMedico($id)==0){
                                    if($this->insertMedico($id,$id_esp,$nombres,$apes,$tel,$fecha,$sexo,$clave1,$correo,$askf,$ans) == true){ 
                                    $feedback='bien';
                                    }else{
                                    $feedback='5';//no insert medico   
                                    }
                                }else{
                                    $feedback='8';
                                }
                                }else{
                                $feedback='7';//error de sexo
                             }
                      }else{
                       $feedback='6';//error de pregunta
                      }   
                    }else{
                     $feedback='3';//el mail ya esta en la bd
                     }
              }else{//envia tipos de error en clave
                $resultado=$this->validarPass($clave1);
                $feedback=$resultado;
              }
         }
         else{
             $feedback='2';//error las claves no son iguales
         }
    
    return $feedback; 
   }
   
   public function deleteFullMedico($idm,$ide){
    $objE=new especialidadDAO();//PRIMERO BORRAR CITA, LUEGO MEDICO Y LUEGO ESPECIALIDAD
    $objM=new medicoDAO();  
    $objC=new citaDAO();
    $resul=$objC->readOneByMedico($idm);
    $tam=count($resul);
    if($tam>0){//hay citas asignadas al medico
     if($objC->deleteByMedic($idm) == true){
        if($objM->delete($idm) == true){
            if($objE->delete($ide) == true){
                return true;
            }
        }
    }
    }else{//no hay citas asignadas al medico
        if($objM->delete($idm) == true){
            if($objE->delete($ide) == true){
                return true;
            }
        }
    }
    return false;  
    }
    public function deleteFullPaciente($idp){  
        $objH=new historiaDAO();       //1. borramos citas
        $objP=new pacienteDAO();       //2. Borramos historial
        $objC=new citaDAO();           //3. Borramos paciente
        $resul=$objP->readOneById($idp);
        $resul1=$objH->readOneByIdPaciente($idp);
        $tam=count($resul);//para saber si tiene citas asiganadas
        $tam1=count($resul1);//para saber si tiene historias registradas

        if($tam>0 && $tam1>0){//tiene historia y citas
         if($objC->deleteByUser($idp) == true){
            if($objH->deleteForUser($idp) == true){
               if($objP->delete($idp) == true){
                    return true;
                }
             }
           }
        }else
        if($tam==0 && $tam1>0){//tiene historia y no citas
            if($objH->deleteForUser($idp) == true){
                if($objP->delete($idp) == true){
                     return true;
                 }
              }
        }else
        if($tam>0 && $tam1==0){//tiene citas y no historia
            if($objC->deleteByUser($idp) == true){
                   if($objP->delete($idp) == true){
                        return true;
                    }
               }
        }else{
            if($objP->delete($idp) == true){
                return true;
            } 
        }
        return false;  
        }
    public function updateMedicoPersonal($id,$names,$apellidos,$fecha,$tel){
    $objM=new medicoDAO();  
    $resul=$objM->updatePersonal($id,$names,$apellidos,$fecha,$tel);
    return $resul;
    }

    public function updateMedicoEspe($id,$name,$des){
    $objE=new especialidadDAO();
    $resul=$objE->update($id,$name,$des);
    return $resul;
    }
    public function updateDatosPaciente($id,$nom,$ape,$tel,$fecha){
        $objP=new pacienteDAO();
        $resul=$objP->updatePersonal($id,$nom,$ape,$tel,$fecha);
        return $resul;
    }
    public function readAllPacienteFull(){
        $objP=new pacienteDAO();
        $resul=$objP->readAllFull();
        return $resul;
    }
    public function readAllCitas(){
    $objC=new citaDAO();
    $resul=$objC->readall();
    return $resul; 
    }
    public function readCitaById($id){
        $objC=new citaDAO();
        $resul=$objC->readOneById($id);
        return $resul; 
    }
    public function updateCitaById($id,$fecha,$dia,$hora){
    $objC=new citaDAO();  
    $resul=$objC->updateDate($id,$fecha,$dia,$hora);
    return $resul;
    }
    public function validarDisponibilidadMedicoTiempo($idm,$hora,$fecha){
    $objC=new citaDAO();  
    $resul=$objC->validarDisponibilidadMedicoTiempo($idm,$hora,$fecha);
    return $resul;
    }
    public function validar_numero_citasxdia($idm, $fecha){
    $objC=new citaDAO();  
    $resul=$objC->validar_numero_citasxdia($idm,$fecha);
    return $resul;
    }
    public function insertCita($pacie,$medico,$fecha,$dia,$hora,$estado){
    $objC=new citaDAO();  
    $resul=$objC->insert($pacie,$medico,$fecha,$dia,$hora,$estado);
    return $resul;
    }
    public function deleteCitaById($id){
        $objC=new citaDAO();  
        $resul=$objC->delete($id);
        return $resul;  
    }
}
?>
 