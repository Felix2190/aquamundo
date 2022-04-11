<?php
		$ar=array(array('ffelix','Felix'));
		$i=1;
		//$ar=array('ricardo@planetucc.com_2017');
		foreach ($ar as $v=>$pass){
		    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		    $passwordSalt = hash('sha512', $pass[0]. $random_salt);
		    
		    echo '<br />'.$passwordSalt.'<br /><br />'.$random_salt.'<br /><br /><br />';
		$i++;
		}
		
		foreach ($ar as $v=>$pass){
		    echo $pass[1].'/'.$pass[0].'<br />';
		}
		
?>