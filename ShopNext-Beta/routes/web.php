<?php

$routes = [
    '/role/create' => ['GET', 'RoleController@create'],
    '/role/createRole'  => ['POST', 'RoleController@createRole'],
    '/roles/findById'   => ['GET',  'RoleController@getRoleById'],
    '/role/delete'      => ['POST', 'RoleController@deleteRole'],
    '/role/edit'        => ['GET',  'RoleController@editRole'],
    '/role/update'      => ['POST', 'RoleController@updateRole'],
    '/roles'              => ['GET',  'RoleController@listRoles'],


    '/user/create' => ['GET', 'UserController@create'],
    '/user/createUser'  => ['POST', 'UserController@createUser'],
    '/user/findById'   => ['GET',  'UserController@getUserById'],
    '/user/edit'        => ['GET',  'UserController@editUser'],
    '/user/delete'      => ['POST', 'UserController@deleteUser'],
    '/user/update'  => ['POST', 'UserController@updateUser'],
];
