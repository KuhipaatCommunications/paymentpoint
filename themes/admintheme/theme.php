<?php
$func_name = $this->router->fetch_method();
$class_name = $this->router->fetch_class();
if($class_name == 'login')
{
	//include("login_header.php");
}
else {
    include("header.php");
    include("leftpanel.php");
    
}
/* if($class_name == 'category')
{
	include("tab_cat.php");
} */
echo $content;

if($class_name == 'login')
{
	//include("login_footer.php");
}
else
{
	include("footer.php");
}
?>

