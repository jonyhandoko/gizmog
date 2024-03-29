<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']	= "cart";

//this for the admininstration console
$route['admin']					= 'admin/dashboard';



//get routes from database
include('database.php');

$link = mysqli_connect($db[$active_group]['hostname'],$db[$active_group]['username'],$db[$active_group]['password'],$db[$active_group]['database']);

$routes	= mysqli_query($link, 'SELECT * FROM '.$db[$active_group]['dbprefix'].'routes');

while($row = mysqli_fetch_array($routes))
{
	//if "category" is in the route, then add some stuff for pagination
	if(strpos($row['route'], 'category'))
	{
		$route[$row['slug']] = $row['route'];

		$row['slug'] 	.= '/(:any)';
		$row['route'] 	.= '/$1';
	}
	if(strpos($row['route'], 'new'))
	{
		$route[$row['slug']] = $row['route'];

		$row['slug'] 	.= '/(:any)';
		$row['route'] 	.= '/$1';
	}
	if(strpos($row['route'], 'sale'))
	{
		$route[$row['slug']] = $row['route'];

		$row['slug'] 	.= '/(:any)';
		$row['route'] 	.= '/$1';
	}
        if(strpos($row['route'], 'collection'))
	{
		$route[$row['slug']] = $row['route'];

		$row['slug'] 	.= '/(:any)';
		$row['route'] 	.= '/$1';
	}

	$route[$row['slug']] = $row['route'];
}

mysqli_free_result($routes);


//in case we're using pconnect
mysqli_close($link);$route[''] = '';
