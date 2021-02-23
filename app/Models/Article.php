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

    protected $orderBy = [
        'by' => 'published_date',
        'order' => 'asc'
    ];

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function UserCreated()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function UserPublished()
    {
        return $this->belongsTo(User::class, 'published_by');
    }
}
