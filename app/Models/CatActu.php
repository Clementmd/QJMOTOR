<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatActu extends Model
{
    use HasFactory;

    protected $table = 'cat_actus';
    protected $fillable = ['nom'];
}