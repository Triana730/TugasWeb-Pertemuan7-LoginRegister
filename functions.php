<?php

// Lokasi file penyimpanan user
define('USER_FILE', __DIR__ . '/data/users.json');


// Membaca data user dari JSON
function getUsers()
{
    if (!file_exists(USER_FILE)) {
        return [];
    }

    $data = file_get_contents(USER_FILE);

    if (empty($data)) {
        return [];
    }

    $users = json_decode($data, true);

    return is_array($users) ? $users : [];
}


// Menyimpan data user ke JSON
function saveUsers($users)
{
    $data = json_encode($users, JSON_PRETTY_PRINT);

    return file_put_contents(
        USER_FILE,
        $data,
        LOCK_EX
    );
}

?>