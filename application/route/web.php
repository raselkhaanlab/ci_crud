<?php
$route['login']['get']='Auth/login_form';
$route['login']['post']='auth/login';
$route['registration']['get']='Auth/registration_form';
$route['registration']['post']='Auth/registration';
$route['logout']['post']='auth/logout';
$route['edit/me']['get']='auth/edit';
$route['edit/me']['post']='auth/edit_post';
$route['author/(:num)']['get']='author/index/$1';
$route['edit/author/(:num)']['get']='author/edit/$1';
$route['edit/author/(:num)']['post']='author/edit_author/$1';
$route['delete/author/(:num)']['post']='author/delete/$1';