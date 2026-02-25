<?php

namespace App\Http\Controllers;

// ! dipanggil agar semua controller bisa memanggil method authorize policy
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    // ? ini digunakan agar semua Controller terhubung dengan plicy
    use AuthorizesRequests;
}
