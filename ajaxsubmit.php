<?php
	require_once('session.php');
	require_once('class.user.php');
	$user = new USER();
	
	if(isset($_POST['btn-signup']) || true)
	{
		$uname = strip_tags($_POST['txt_uname']);
		$umail = strip_tags($_POST['txt_umail']);
		$upass = strip_tags($_POST['txt_upass']);	
		
		if($uname=="")	{
			print "provide username !";	
		}
		else if($umail=="")	{
			print "provide email id !";	
		}
		else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
		    print 'Please enter a valid email address !';
		}
		else if($upass=="")	{
			print "provide password !";
		}
		else if(strlen($upass) < 6){
			print "Password must be atleast 6 characters";	
		}
		else
		{
			try
			{
				$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
				$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
					
				if($row['user_name']==$uname) {
					print "sorry username already taken !";
				}
				else if($row['user_email']==$umail) {
					print "sorry email id already taken !";
				}
				else
				{
					if($user->register($uname,$umail,$upass)){	
						//$user->redirect('sign-up.php?joined');
						print 'done';
					}
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}	
	}
