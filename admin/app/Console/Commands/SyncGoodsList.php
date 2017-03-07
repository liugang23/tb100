<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Redis;

class SyncGoodsList extends Command
{
    private $goodslist = HASH_GOODS_LIST_;// 定义商品列表键名
    private $goodsinfo = HASH_GOODS_INFO_;// 定义商品详情键名
    private $goodsid = LIST_GOODS_ID_LIST_;// 定义商品列表ID键名
    /**
     * The name and signature of the console command.
     * 任务调度的名称和签名
     * @var string
     */
    protected $signature = 'GoodsList:list';

    /**
     * The console command description.
     * 命令描述
     * @var string
     */
    protected $description = 'GoodsList:list';

    /**
     * Create a new command instance.
     * 创建一个新的命令实例
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * 执行调度任务
     * @return mixed
     */
    public function handle()
    {
        for ($id = 1; $id <= 3; $id++) {// $id 商品类别
            // 获取商品列表信息
            $result = \DB::table('data_goods')
                    ->where(['status'=> 0, 'class_id'=>$id])
                    ->get();

            // 判断获取数据是否存在
            if($result) {
                for ($n = 0; $n < count($result); $n++) {
                    $key = $this->goodsid.$id;// 获取商品id 键名
                    $goodsId = Redis::RPUSH($key, $result[$n]->guid);

                    if($goodsId) {
                        Log::info('redis 商品ID分类:'.$id.'写入成功');
                    }

                    $listkey = $this->goodslist.$id.':'.$result[$n]->guid;// 获取商品列表 键名
                    $list = ['guid'=>$result[$n]->guid, 'name'=>$result[$n]->name, 'subtitle'=>$result[$n]->subtitle, 'stock'=>$result[$n]->stock, 'price'=>$result[$n]->price, 'spec'=>$result[$n]->spec, 'class_id'=>$result[$n]->class_id, 'pic'=>$result[$n]->pic, 'describe'=>$result[$n]->describe, 'sales'=>$result[$n]->sales, 'new'=>$result[$n]->new];

                    $goodslist = Redis::HMSET($listkey, $list);

                    if($goodslist) {
                        Log::info('redis 商品列表:'.$id.'写入成功');
                    } 
                }

            }else{
                Log::error('SyncGoodsList redis 商品类别:'.$id.'查询失败');
            }
        }
        
    }
}
