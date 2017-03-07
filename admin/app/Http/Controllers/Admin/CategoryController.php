<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    private static $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        self::$categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = self::$categoryService->adminGetClass();

        return view('admin.category.category_list')
                ->with('class', $class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.category_add');
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
        $result = self::$categoryService->adminAddClass($data);

        if($result === true) {
            return response()->json(array(
                    'status' => 0,
                    'message' => '添加成功！'));
        }else{
            return response()->json(array(
                    'status' => 1,
                    'message' => '添加失败！'));
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
        $str = explode('&', $id);
        $pater = mb_substr($str[0], 6);
        $path = mb_substr($str[1], 5);
   
        return view('admin.category.category_add')
                ->with('pater', $pater)
                ->with('path', $path);
    }

    // 查询指定分类
    public function query(Request $request, $id)
    {   
        // $data = $request->all();

        $class = self::$categoryService->adminGetClass($id);

        return view('admin.category.category_list')
                ->with('class', $class);
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
        $data = $request->all();
        $result = self::$categoryService->adminUpdateClass($data);
        return redirect('/category');
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
