<?php

$routes = [
    '/role/create' => ['GET', 'RoleController@create'],
    '/role/createRole'  => ['POST', 'RoleController@createRole'],
    '/roles/findById'   => ['GET',  'RoleController@getRoleById']
];
