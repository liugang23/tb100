<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\AdminService;

class MemberController extends Controller
{
    private static $adminService;

    public function __construct(AdminService $adminService)
    {
        self::$adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/member.admin_list');
    }

    /**
     * Show the form for creating a new resource.
     * 创建管理员页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/member.admin_add');
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加新管理员
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = self::$adminService->create($data);

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
