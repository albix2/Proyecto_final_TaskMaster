<?php                
require 'database_connection.php'; 
$display_query = "select id,evento,fecha_inicio,fecha_fin,descripcion,id_usuario,id_estado,id_etiquetas,archivos,color_evento
 from eventoscalendar";             
$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results);  
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
	$data_arr[$i]['event_id'] = $data_row['id'];
	$data_arr[$i]['title'] = $data_row['evento'];
	$data_arr[$i]['start'] = date("Y-m-d  H:i:s", strtotime($data_row['fecha_inicio']));
	$data_arr[$i]['end'] = date("Y-m-d  H:i:s", strtotime($data_row['fecha_fin']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
	$data_arr[$i]['url'] = 'https://www.shinerweb.com';
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>