<?php
$controller_name = $this->router->fetch_class();//////fetch current controller or class name//////
$method_name = $this->router->fetch_method();//////fetch current method name//////
if($controller_name != 'index')
{
	require("header.php");
      
	echo $content;
	
	require("footer.php");
}
else{
	echo $content;
}

