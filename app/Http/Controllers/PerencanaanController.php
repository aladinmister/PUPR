<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerencanaanController extends Controller
{
    public function DokumenPengadaan()
    {
        return view('Perencanaan.DokumenPengadaan');
    }

    public function DokumenKontrak()
    {
        return view('Perencanaan.DokumenKontrak');
    }

    public function Rekapan()
    {
        return view('Perencanaan.Rekapan');
    }
}
