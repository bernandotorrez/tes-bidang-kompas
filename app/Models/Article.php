<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'tbl_article';
    protected $primaryKey = 'id_article';
    protected $guarded = ['id_article'];
}
