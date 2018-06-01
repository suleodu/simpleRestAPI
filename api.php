<?php
require_once('../path.php');

//Get incoming request methord request
$request = $_SERVER['REQUEST_METHOD'];


$url_part = '';
if(isset($_GET['action'])){
    $url_part = $_GET['action'];
}





header('Content-type:application/json');


$data = array();

//Determin the request type
switch ($request) {
    case 'GET':
        //determin the action to be perform
        switch ($url_part) {
            case 'editables':
                $sqlQuery = sprintf("SELECT * FROM ttihub_editable WHERE status = 'active'");
                $queryRS = mysql_query($sqlQuery, $tams) or die(mysql_error());
                $row_query = mysql_fetch_assoc($queryRS);
                $row_num_query = mysql_num_rows($queryRS);


                $editables = array();

                if ($row_num_query > 0) {
                    do {
                        $editables[] = $row_query;
                    } while ($row_query = mysql_fetch_assoc($queryRS));

                    $data = array(
                        'status' => 1,
                        'rs' => $editables,
                    );
                    echo json_encode($data);
                }else{
                    $data = array(
                        'status' => 0,
                        'msg' => 'No record found',
                    );
                    echo json_encode($data);
                }
            break;

            

            default :
                break;

            break;
    
    case 'POST':
        $post = json_decode(file_get_contents('php://input'), TRUE);
        break;
    
    case 'PUT':
        break;

    default:
        break;
}




        
       
}
