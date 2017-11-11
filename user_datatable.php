<?php
	require_once('session.php');
	require_once('class.user.php');
	$user = new USER();
	/*$user = new USER();
	
	$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
	$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	*/

	
	// storing  request (ie, get/post) global array to a variable  
	$requestData = $_REQUEST;


	$columns = array(
	// datatable column index  => database column name
	    0 => 'user_id',
	    1 => 'user_id',
	    2 => 'user_name',
	    3 => 'user_email',
	);

	//$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
	$row = $user->simpleQuery("SELECT user_id, user_name, user_email FROM users");
	
	$sql = "SELECT user_id, user_name, user_email FROM users";

	// getting records as per search parameters
	if (!empty($requestData['columns'][2]['search']['value'])) {   //name
	    $sql .= " AND user_name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
	    $sql_count .= " AND user_name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
	}
	if (!empty($requestData['columns'][3]['search']['value'])) {  //email
	    $sql .= " AND user_email LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
	    $sql_count .= " AND user_email LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
	}
	if (!empty($requestData['columns'][1]['search']['value'])) { //id
	    $sql .= " AND user_id LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
	    $sql_count .= " AND user_id LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
	}
	$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

	/*$query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

	//Count of the query
	$result_count = mysqli_query($conn, $sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$totalFiltered = $row_count['user_id'];

	
	$query = mysqli_query($conn, $sql) or die("user_datatable.php: get employees");*/

	//$row = $stmt->execute();
	//$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//
	/*

	$sql = "SELECT user_id,user_name, employee_salary, employee_age  ";

	//To show the count we dont need all the field
	$sql_count = "SELECT count(user_id) as user_id  ";


	$sql .= " FROM employee WHERE 1 = 1";
	$sql_count .= " FROM employee WHERE 1 = 1";

	// getting records as per search parameters
	if (!empty($requestData['columns'][0]['search']['value'])) {   //name
	    $sql .= " AND user_name LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
	    $sql_count .= " AND user_name LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
	}
	if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
	    $sql .= " AND employee_salary LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
	    $sql_count .= " AND employee_salary LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
	}
	if (!empty($requestData['columns'][2]['search']['value'])) { //age
	    $rangeArray = explode("-", $requestData['columns'][2]['search']['value']);
	    $minRange = $rangeArray[0];
	    $maxRange = $rangeArray[1];
	    $sql .= " AND ( employee_age >= '" . $minRange . "' AND  employee_age <= '" . $maxRange . "' ) ";
	    $sql_count .= " AND ( employee_age >= '" . $minRange . "' AND  employee_age <= '" . $maxRange . "' ) ";
	}
	$query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

	//Count of the query
	$result_count = mysqli_query($conn, $sql_count);
	$row_count = mysqli_fetch_array($result_count);
	$totalFiltered = $row_count['user_id'];

	$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
	$query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	*/

	$row = $user->simpleQuery($sql);

	$data = array();
	$slno = 1;
	foreach ($row as $rows) {  // preparing an array
		
		//exit;
	    $actions = "";
	    $actions .= '<button class="edt_data" data-id=' . $rows['user_id'] . '>Edit</button>';
	    $actions .= '<button class="dlt_data" data-id=' . $rows['user_id'] . '>Delete</button>';
	//checks whether the transaction is checked or not
	    $checked = "";
	    
	    //if whole transaction is selected then set as checked
	    if ($requestData['columns'][3]['search']['value']) {
	        $checked = "checked";
	    }
	    
	    $check_box = '<input type="checkbox" ' . $checked . ' class="bulk_checkbox" value="' . $rows['user_id'] . '">';


	    $nestedData = array();

	    $nestedData[] = $check_box;
	    $nestedData[] = $slno;
	    $nestedData[] = $rows["user_name"];
	    $nestedData[] = $rows["user_email"];
	    $nestedData[] = $actions;

	    $data[] = $nestedData;
	    $slno++;
	}



	$json_data = array(
	    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	    "recordsTotal" => intval($slno), // total number of records
	    "recordsFiltered" => intval($slno), // total number of records after searching, if there is no searching then totalFiltered = totalData
	    "data" => $data   // total data array
	);

	echo json_encode($json_data);  // send data as json format
?>

