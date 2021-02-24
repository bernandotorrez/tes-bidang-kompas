<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CreateUserController extends Controller
{
    protected $model;

    public function __construct(UserRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('pages.user.index');
    }

    public function insert(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $data = array(
            'username' => $validated['username'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'level' => $validated['level']
        );

        $where = array('username' => $data['username']);
        $checkDuplicate = $this->model->findDuplicate($where);

        if($checkDuplicate > 0) {
            return response()->json([
                'httpStatus' => 200,
                'status' => 'failed',
                'message' => '<div class="alert alert-info">Username : <strong>'.$data['username'].'</strong> Already Exist!</div>',
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
                    'message' => '<div class="alert alert-danger">Failed Add Data!</div>',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request)
    {
        $validated = $request->validated();

        if($validated['password']) {
            $data = array(
                'username' => $validated['username'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'level' => $validated['level']
            );
        } else {
            $data = array(
                'username' => $validated['username'],
                'name' => $validated['name'],
                'level' => $validated['level']
            );
        }

        $where = array(
            'username' => $validated['username']
        );

        $checkDuplicate = $this->model->findDuplicateEdit($validated['username'], $where);

        if($checkDuplicate > 0) {
            return response()->json([
                'httpStatus' => '200',
                'status' => 'failed',
                'message' => '<div class="alert alert-info">Username : <strong>'.$data['username'].'</strong> Already Exist!</div>',
                'data' => null
            ], 200);
        } else {
            $update = $this->model->update($validated['username'], $data);

            if($update) {
                return response()->json([
                    'httpStatus' => 200,
                    'status' => 'success',
                    'message' => '<div class="alert alert-success">Success Update Data!</div>',
                    'data' => $update
                ]);
            } else {
                return response()->json([
                    'httpStatus' => 200,
                    'status' => 'success',
                    'message' => '<div class="alert alert-danger">Failed Update Data!</div>',
                    'data' => null
                ]);
            }

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
        $datas = $this->model->allActive();

        return DataTables::of($datas)
        ->addIndexColumn()
        ->addColumn('action', function($data) {
            return '<div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input child-chk checkId"
            onclick="updateCheck('.$data->username.')"
            id="'.$data->username.'"
            value="'.$data->username.'">
            <label class="custom-control-label" for="'.$data->username.'"></label>
            </div>';
        })
        ->addColumn('level', function($data) {
            if($data->level == 'Rpt') {
                return 'Reporter';
            } else if($data->level == 'Edt') {
                return 'Editor';
            } else {
                return 'Admin';
            }
        })
        ->make(true);

    }
}
