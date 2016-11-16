<?php

function username_import($email) {
    $email_array = explode("@", $email);
    $base_username = $email_array[0];
    $created_username = '';
    $i = 0;
    do {
        $created_username = $base_username;
        if ($i > 0) {
            $created_username .= $i;
        }
        $i++;
    } while (username_exists($created_username));

    return $created_username;
}
