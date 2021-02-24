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
        $level = Auth::user()['level'];
        $username = Auth::user()['username'];

        if($level == 'Rpt') {
            return $this->model->select('*')->where('status', '1')->where('created_by', $username)->orderBy($this->orderBy['by'], $this->orderBy['order'])->with($with)->get();
        } else {
            return $this->model->select('*')->where('status', '1')->orderBy($this->orderBy['by'], $this->orderBy['order'])->with($with)->get();
        }

    }
}
