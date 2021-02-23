<?php

namespace App\Repository\Eloquent;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleRepository extends BaseRepository
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    /**
     * Get All Data Active (Status = 1)
     * @param array $with
     * @return Collection
     */
    public function allActiveRelation(array $with)
    {
        return $this->model->select('*')->where('status', '1')->where('created_by', Auth::user()['username'])->orderBy($this->orderBy['by'], $this->orderBy['order'])->with($with)->get();
    }
}
