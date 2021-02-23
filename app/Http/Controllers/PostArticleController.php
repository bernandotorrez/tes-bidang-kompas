<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostArticleRequest;
use App\Models\Article;
use App\Models\User;
use App\Repository\Eloquent\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function insert(PostArticleRequest $request)
    {
        $validated = $request->validated();

        $data = array(
            'title' => $validated['title'],
            'body' => $validated['body'],
            'created_by' => Auth::user()['username'],
        );

        $where = array('title' => $data['title']);
        $checkDuplicate = $this->model->findDuplicate($where);

        if($checkDuplicate > 0) {
            return response()->json([
                'httpStatus' => 200,
                'status' => 'failed',
                'message' => '<div class="alert alert-info">Judul Article : <strong>'.$data['title'].'</strong> Already Exist!</div>',
                'data' => null
            ]);
        } else {
            $insert = $this->model->create($data);

            if($insert) {
                return response()->json([
                    'httpStatus' => 200,
                    'status' => 'success',
                    'message' => '<div class="alert alert-success">Success Add Data!</div>',
                    'data' => $insert
                ]);
            } else {
                return response()->json([
                    'httpStatus' => 200,
                    'status' => 'success',
                    'message' => '<div class="alert alert-danger">Failed Add Data</div>',
                    'data' => null
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        $data = $this->model->getById($id);

        if($data) {
            return response()->json([
                'httpStatus' => '200',
                'status' => 'success',
                'message' => 'Success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'httpStatus' => '200',
                'status' => 'no_data',
                'message' => 'No Data',
                'data' => null
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $delete = $this->model->massDelete($id);

        return response()->json([
            'httpStatus' => '200',
            'status' => 'success',
            'message' => 'Berhasil Delete Data',
            'data' => null
        ], 200);
    }

    public function datatable()
    {
        $datas = $this->model->allActiveRelation(['UserCreated', 'UserPublished']);

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
        })
        ->addColumn('createdDate', function($data) {
            return ($data->created_at != '') ? date('d M Y H:i:s', strtotime($data->created_at)) : '-';
        })
        ->addColumn('publishedDate', function($data) {
            return ($data->published_date != '') ? date('d M Y H:i:s', strtotime($data->published_date)) : '-';
        })
        ->addColumn('statusPublish', function($data) {
            return ($data->published == '0') ? 'Unpublish' : 'Published';
        })
        ->make(true);

    }
}
