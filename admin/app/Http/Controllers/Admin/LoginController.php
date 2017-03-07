<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\AdminService;
use Session;

class LoginController extends Controller
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
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $result = self::$adminService->login($data);

        if (empty($result)) {
            // 如果不存在，返回
            // return back(); 
            return response()->json(array(
                    'status' => 1,
                    'message' => '登录失败！'));
        } else {
            return response()->json(array(
                    'status' => 0,
                    'message' => '登录成功！'));
        }
        
    }

    /**
     * Display the specified resource.
     * 退出登录
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uid = session('admin')->id;

        if ($uid == $id) {
            //删除session值 
            Session::forget('admin');
            //跳转
            return redirect("/login");
        }

        return response()->json(array(
                'status' => 1,
                'msg' => '退出有误'));
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
        
    }
}
