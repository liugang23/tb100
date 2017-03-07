<?php
namespace App\Service;

use JohnLui\AliyunOSS\AliyunOSS;

use Config;

class OssService 
{
	private $ossClient;

	public function __construct($isInternal = false)
	{
		$serverAddress = $isInternal ? Config::get('oss.ossServerInternal') : Config::get('oss.ossServer');
		$this->ossClient = AliyunOSS::boot(
			$serverAddress,
			Config::get('oss.AccessKeyId'),
			Config::get('oss.AccessKeySecret')
		);
	}

	public static function upload($ossKey, $filePath)
	{
		// true 使用内网   false 使用外网
		$oss = new OssService(false); // 上传文件使用内网，免流量费
		$oss->ossClient->setBucket(Config::get('oss.BucketName'));
		return $oss->ossClient->uploadFile($ossKey, $filePath);
	}

	/**
	* 直接把变量内容上传到oss
	* @param $osskey
	* @param $content
	*/
	public static function uploadContent($osskey,$content)
	{
		$oss = new OssService(true); // 上传文件使用内网，免流量费
		$oss->ossClient->setBucket('你的 bucket 名称');
		return $oss->ossClient->uploadContent($osskey,$content);
	}

	/**
	* 删除存储在oss中的文件
	*
	* @param string $ossKey 存储的key（文件路径和文件名）
	* @return
	*/
	public static function deleteObject($ossKey)
	{
		$oss = new OssService(true); // 上传文件使用内网，免流量费

		return $oss->ossClient->deleteObject('你的 bucket 名称', $ossKey);
	}

	/**
	* 复制存储在阿里云OSS中的Object
	*
	* @param string $sourceBuckt 复制的源Bucket
	* @param string $sourceKey - 复制的的源Object的Key
	* @param string $destBucket - 复制的目的Bucket
	* @param string $destKey - 复制的目的Object的Key
	* @return Models\CopyObjectResult
	*/
	public function copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
	{
		$oss = new OssService(true); // 上传文件使用内网，免流量费

		return $oss->ossClient->copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
	}

	/**
	* 移动存储在阿里云OSS中的Object
	*
	* @param string $sourceBuckt 复制的源Bucket
	* @param string $sourceKey - 复制的的源Object的Key
	* @param string $destBucket - 复制的目的Bucket
	* @param string $destKey - 复制的目的Object的Key
	* @return Models\CopyObjectResult
	*/
	public function moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
	{
		$oss = new OssService(true); // 上传文件使用内网，免流量费

		return $oss->ossClient->moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
	}

	public static function getUrl($ossKey)
	{
		$oss = new OssService();
		$oss->ossClient->setBucket('你的 bucket 名称');
		return $oss->ossClient->getUrl($ossKey, new \DateTime("+1 day"));
	}

	/*
	 * 新建存储对象容器
	 */
	public static function createBucket($bucketName)
	{
		$oss = new OssService();
		return $oss->ossClient->createBucket($bucketName);
	}

	public static function getAllObjectKey($bucketName)
	{
		$oss = new OssService();
		return $oss->ossClient->getAllObjectKey($bucketName);
	}

	/**
	* 获取指定Object的元信息
	* 
	* @param  string $bucketName 源Bucket名称
	* @param  string $key 存储的key（文件路径和文件名）
	* @return object 元信息
	*/
	public static function getObjectMeta($bucketName, $osskey)
	{
		$oss = new OssService();
		return $oss->ossClient->getObjectMeta($bucketName, $osskey);
	}
}