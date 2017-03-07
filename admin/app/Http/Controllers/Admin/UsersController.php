<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\UsersService;

class UsersController extends Controller
{
    private static $usersService;   // 声明静态成员属性

    public function __construct(UsersService $usersService)
    {
        self::$usersService = $usersService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.user_list');
    }

    /**
     * Show the form for creating a new resource.
     * 添加用户表单
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.user_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $result = self::$usersService->adminAddUser($data);

        if (empty($result)) {
            // 如果不存在，返回
            // return back(); 
            return response()->json(array(
                    'status' => 1,
                    'message' => '添加失败！')); 
        } else {
            return response()->json(array(
                    'status' => 0,
                    'message' => '添加成功！'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
