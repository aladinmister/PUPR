<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model {
    protected $fillable = ['judul_surat', 'jenis_surat'];
}