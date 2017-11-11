<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	$userRow=$auth_user->userRow;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_email']); ?></title>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp;</li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
      <!-- -Datatable-->
      <table id="user-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">             
          <thead>
              <tr>
                  <th><input type="checkbox" class="search-input-check" id="all_check" data-column="3" value="1"></th>
                  <th>#</th>
                  <th>User name</th>
                  <th>Email ID</th>
                  <th>Actions</th>
              </tr>
          </thead>
      </table>
      <!-- Datatable end-->
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add User</button>
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Create User</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="form-signin">
                <h2 class="form-signin-heading">User</h2><hr /><?php
                if(isset($error))
                {
                  foreach($error as $error)
                  {
                     ?><div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div><?php
                  }
                }
                else if(isset($_GET['joined']))
                {
                   ?><div class="alert alert-info">
                        <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                   </div><?php
                }
                ?>
                <div class="form-group">
                <input type="text" class="form-control" name="txt_uname" id="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
                </div>
                <div class="form-group">
                <input type="text" class="form-control" name="txt_umail" id="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="txt_upass" id="txt_upass" placeholder="Enter Password" />
                </div>
                <div class="clearfix"></div><hr />
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="btn-signup" id="submit">
                      <i class="glyphicon glyphicon-open-file"></i>&nbsp;Insert
                    </button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

        

    </div>
</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();
    });
    $("#submit").click(function(){
      
      var name = $("#txt_uname").val();
      var email = $("#txt_umail").val();
      var password = $("#txt_upass").val();
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'txt_uname='+ name + '&txt_umail='+ email + '&txt_upass='+ password;
      if(name==''||email==''||password=='')
      {
        alert("Please Fill All Fields");
      }
      else
      {
        // AJAX Code To Submit Form.
        $.ajax({
          type: "POST",
          url: "ajaxsubmit.php",
          data: dataString,
          cache: false,
          success: function(result){
            if(result != 'done'){
              alert(result);  
            }
            else {
              alert('Successfully inserted...');
              location.reload();
            }
            
          }
        });
      }
      return false;
    });
  });
</script>

<!-- Datatable inclussion-->
<link rel="stylesheet" type="text/css" href="datatables/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" >
    $(document).ready(function() {
        $(document).ready(function () {
            //datatable initializing
            var dataTable = $('#user-grid').DataTable({
                "processing": true,
                "serverSide": true,
                'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': ['nosort']//hide the sorting functionality
                    }],
                "ajax": {
                    url: "user_datatable.php", // json datasource
                    type: "post", // method  , by default get
                    error: function () {  // error handling
                        $(".employee-grid-error").html("");
                        $("#user-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display", "none");
                    }

                }
            });
            $("#employee-grid_filter").css("display", "none"); // hiding global search box
            $('.search-input-text').on('keyup click', function () {   // for text boxes
                    var i = $(this).attr('data-column'); // getting column index
                    var v = $(this).val(); // getting search input value
                    dataTable.columns(i).search(v).draw();
                });
                $('.search-input-select').on('change', function () {   // for select box
                    var i = $(this).attr('data-column');
                    var v = $(this).val();
                    dataTable.columns(i).search(v).draw();
                });
            $(document).on('click', '.dlt_data', function () { // Deleting
                var str = $(this).data("id");
                alert(str);
            });
            $(document).on('click', '.edt_data', function () { // Editing
                var str = $(this).data("id");
                alert(str);
            });
            $("body").on("click", "#all_check", function () {
                if ($('#all_check').prop('checked')) {
                    $('#all_check').val(1);
                } else {
                    $('#all_check').val(0);
                }
                var i = $(this).attr('data-column'); // getting column index
                var v = $(this).val(); // getting search input value
                dataTable.columns(i).search(v).draw();
            });
        });
    } );
</script>