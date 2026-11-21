<?php

use App\Models\Footer;
use App\Models\InformasiUmum;
use App\Models\Navbar;
use Illuminate\Support\Facades\Cache;

if (!function_exists('informasi_umum')) {
    function informasi_umum($field = null)
    {
        $data = InformasiUmum::first();

        if (!$data) {
            return null;
        }

        return $field ? $data->$field : $data;
    }
}

if (!function_exists('footer')) {
    function footer($field = null)
    {
        $data = Footer::first();

        if (!$data) {
            return null;
        }

        return $field ? $data->$field : $data;
    }
}

if (!function_exists('navbar')) {
    function navbar($field = null)
    {
        $data = Navbar::first();

        if (!$data) {
            return null;
        }

        return $field ? $data->$field : $data;
    }
}
