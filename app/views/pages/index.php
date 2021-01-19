<?php

    foreach($data['users'] as $user){
        "<h1>Personal Information: </h1>";
        echo 'name: '.$user->name .'<br>';
        echo 'email: '.$user->email;
    }
?>