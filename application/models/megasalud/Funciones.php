<?php

/**
 * 
 */
class Funciones extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    
   function genera_clave($estado, $id, $tipo ){
        $prefijo = 0;
            switch ($estado) {
                case "Aguascalientes":
                        $clave = "AG";
                        $prefijo = 17;
                        break;
                case "Baja California":
                        $clave="BC";
                        $prefijo = 23;
                        break;
                case "Baja California Sur":
                        $clave="BS";
                        $prefijo = 22;
                        break;
                case "Campeche":
                        $clave="CC";
                        $prefijo = 33;
                        break;
                case "Chiapas":
                        $clave="CS";
                        $prefijo = 32;
                        break;
                case "Chihuahua":
                        $clave="CH";
                        $prefijo = 38;
                        break;
                case "Coahuila":
                        $clave="CL";
                        $prefijo = 33;
                        break;
                case "Colima":
                        $clave="CM";
                        $prefijo = 34;
                        break;
                case "Distrito Federal":
                        $clave="DF";
                        $prefijo = 46;
                        break;
                case "Durango":
                        $clave="DR";
                        $prefijo = 49;
                        break;
                case "Guanajuato":
                        $clave="GN";
                        $prefijo = 75;
                        break;
                case "Guerrero":
                        $clave="GR";
                        $prefijo = 79;
                        break;
                case "Hidalgo":
                        $clave="HD";
                        $prefijo = 84;
                        break;
                case "Jalisco":
                        $clave="JL";
                        $prefijo = 13;
                        break;
                case "Mexico":
                case "México":
                        $clave="MX";
                        $prefijo = 47;
                        break;
                case "Michoacan":
                case "Michoacán":
                        $clave="MC";
                        $prefijo = 43;
                        break;
                case "Morelos":
                        $clave="MR";
                        $prefijo = 49;
                        break;
                case "Nayarit":
                        $clave="NY";
                        $prefijo = 58;
                        break;
                case "Nuevo Leon":
                case "Nuevo León":
                        $clave="NL";
                        $prefijo = 53;
                        break;
                case "Oaxaca":
                        $clave="OX";
                        $prefijo = 67;
                        break;
                case "Puebla":
                        $clave="PB";
                        $prefijo = 72;
                        break;
                case "Queretaro":
                case "Querétaro":
                        $clave="QU";
                        $prefijo = 84;
                        break;
                case "Quintana Roo":
                        $clave="QR";
                        $prefijo = 89;
                        break;
                case "San Luis Potosi":
                case "San Luis Potosí":
                        $clave="SL";
                        $prefijo = 23;
                        break;
                case "Sinaloa":
                        $clave="SN";
                        $prefijo = 25;
                        break;
                case "Sonora":
                        $clave="SR";
                        $prefijo = 29;
                        break;
                case "Tabasco":
                        $clave="TB";
                        $prefijo = 32;
                        break;
                case "Tamaulipas":
                        $clave="TM";
                        $prefijo = 34;
                        break;
                case "Tlaxcala":
                        $clave="TX";
                        $prefijo = 37;
                        break;
                case "Veracruz":
                        $clave="VR";
                        $prefijo = 59;
                        break;
                case "Yucatan":
                case "Yucatán":
                        $clave="YC";
                        $prefijo = 83;
                        break;
                case "Zacatecas":
                        $clave="ZC";
                        $prefijo = 93;
                        break;
                default:
                        $clave="EX";
                        $prefijo = 57;
                        break;
            }
            switch ($tipo) {
                case "D":
                        $posfijo = 4;
                        break;
                case "P":
                        $posfijo = 7;
                        break;
                case "R":
                        $posfijo = 9;
                        break;
                case "S":
                        $posfijo = 2;
                        break;
            }
            $num="";
            for($x=0; $x < 6-strlen($id); $x++){
                $clave = $clave."0";
                $num = $num."0";
            }		
            $clave = $clave.$id;
            $referencia = $prefijo.$num.$id.$posfijo;
            $ref = str_split ($referencia);
            $alg = str_split ("2121212121");
            $mult = array();
            $ver = 0; 
       
            //echo $clave ." " . " " . $referencia . " ". $ref . " " . $alg;
       
            for ($x = 0; $x < count($ref); $x++)//cambien el 9 por 8, no entraba en el array "offset 9"
                {
                $mult[$x] = $ref[$x] * $alg[$x];
                if ($mult[$x] > 9)//cambien el 8 por 7, no entraba en el array "offset 9"
                    {
                    $dig = str_split($mult[$x]);
                    $mult[$x] = $dig[0] + $dig[1];
                    }
                $ver += $mult[$x];
                }
            //$dver = str_split ($ver);
            //(string)(10 - $dver[1]);
            $Y = fmod($ver, 10);
            if($Y>0)
                $Y=10-$Y;
            $clave = $clave.$tipo.$Y;
            return $clave;
            }
    
    
    function agregar_calendario($id_calendario, $nombre, $fecha2,$tipo){
        
        $m = ''; //Mensajes de error
        $id_cita=''; //si se creo la cita
        
        $link_cita;
        
        date_default_timezone_set('America/Mexico_City');
        include_once APPPATH.'libraries/google-api-php-client-2.4.1/vendor/autoload.php';
        
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.APPPATH.'libraries/megasalud-fa2bbb2407df.json');
        
        $client= new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(['https://www.googleapis.com/auth/calendar']);
        
        
        //aumenta una hora a la hora inicial
        
        $fecha = new DateTime($fecha2);
        $fecha_ends = new DateTime($fecha2);
        
        $fecha_end = $fecha_ends->add(new DateInterval('PT1H'));
        //$fecha_end = strtotime ( '+1 hour' , strtotime ($fecha)); 
        
        //cambiamos formato de fecha
        
        $fecha_start = $fecha->format(\DateTime::RFC3339);
        $fecha_end2 = $fecha_end->format(\DateTime::RFC3339);
        
        try{
            //se inicia el servicio
            $calendarService = new Google_Service_Calendar($client);
            
            //buscamos si no hay un servicio en el rango de cita
            
            $optParams = array(
                'orderBy' => 'startTime',
                'maxResults' => 20,
                'singleEvents' => TRUE,
                'timeMin' => $fecha_start,
                'timeMax' => $fecha_end2,
                
            );
            
            //obteneros citas
            
            $events = $calendarService->events->listEvents($id_calendario,$optParams);
            
            //obtener numero de eventos
            
            $cont_events = count($events->getItems());
            
            //se crea el evento si no hay eventos
            
            if ($cont_events == 0){
                
                $event = new Google_Service_Calendar_Event();
                $event->setSummary('Cita con: ' .$nombre);
                $event->setDescription($tipo);
                
                //fecha
                
                $start = new Google_Service_Calendar_EventDateTime();
                $start->setDateTime($fecha_start);
                $event->setStart($start);
                
                
                //fecha Fin
                
                $end = new Google_Service_Calendar_EventDateTime();
                $end->setDateTime($fecha_end2);
                $event->setEnd($end);
                
                $createdEvent = $calendarService->events->insert($id_calendario, $event);
                $id_event = $createdEvent->getId();
                $link_event = $createdEvent->gethtmlLink();
                
                
                $m = "Cita creada";
                
            }else{
                $m = "Ya";
            }
            
        }
        
        catch(Google_Service_Exception $gs)
        {
        
            $m = json_decode($gs->getMessage());
            
        }
        
        catch(Exception $e){
            
            $m = $e->getMessage();
            
        }
        
        return $m;
        
    }

	
}