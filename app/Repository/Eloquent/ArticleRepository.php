<?php

namespace App\Repository\Eloquent;

use App\Models\Article;

class ArticleRepository extends BaseRepository
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }
}
