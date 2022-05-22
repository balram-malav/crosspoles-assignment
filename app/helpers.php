<?php

use App\Models\Role;
// Get project Is Like or Not 


if (!function_exists('getRoleName')) {

    function getRoleName($roleId){

       $roleName = '';
     $role = Role::where('id',$roleId)->first();
      if($role){
             $roleName = $role->name;
      }else{
             $roleName = '';
      }
  
        return $roleName;
       
      }
} 