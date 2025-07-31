<?php

$routes = [
    '/role/create' => ['GET', 'RoleController@create'],
    '/role/createRole'  => ['POST', 'RoleController@createRole'],
    '/roles/findById'   => ['GET',  'RoleController@getRoleById'],
    '/role/delete'      => ['POST', 'RoleController@deleteRole'],
    '/role/edit'        => ['GET',  'RoleController@editRole'],
    '/role/update'      => ['POST', 'RoleController@updateRole'],
];
