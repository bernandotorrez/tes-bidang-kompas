<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\ArticleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostArticleController extends Controller
{
    protected $model;

    public function __construct(ArticleRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('pages.post-article.index');
    }

    public function datatable()
    {
        $datas = $this->model->allActive();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('action', function($data) {
            return '<label class="new-control new-checkbox checkbox-outline-primary">
            <input type="checkbox" class="new-control-input child-chk checkId"
            onclick="updateCheck(' . $data->id_article . ')"
            id="' . $data->id_article . '"
            value="' . $data->id_article . '">
            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
            </label>
            ';

            // return '<div class="custom-control custom-checkbox">
            // <input type="checkbox" class="new-control-input child-chk checkId"
            // onclick="updateCheck(' . $data->id_article . ')"
            // id="' . $data->id_article . '"
            // value="' . $data->id_article . '">
            // <span class="new-control-indicator">
            //     <label class="custom-control-label" for="customCheck1">Checkbox Static State</label>
            // </div>';
        })
        ->addColumn('publishedDate', function($data) {
            return ($data->published_date != '') ? date('d M Y H:i:s', strtotime($data->published_date)) : '-';
        })
        ->make(true);

    }
}
