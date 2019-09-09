<?php
namespace app\api\controller;

use think\Controller;
use app\api\model\Review;


/**
 * 
 */
class Index extends Controller
{
	public function opt()
	{
		$data = input();
		$res = $this->request_post_json("127.0.0.1:5000/opt",$data);
		$res = json_decode($res,true);

		return [
			"code" => 0,
			"info" => $res
		];
	}
	function request_post($url = '', $param = '') {
		if (empty($url) || empty($param)) {
            return false;
        }
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header        	
   
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, true);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));




        $data = curl_exec($ch);//运行curl
        if($data === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		}

        // if (!$data) {
        // 	var_dump(curl_error($ch));
        // }
        curl_close($ch);
        return $data;
    }
    function request_post_json($url = '', $param = '') {
		if (empty($url) || empty($param)) {
            return false;
        }
        $param = json_encode($param);

        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header        	
   
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($param)
	        )
	    );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, true);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));




        $data = curl_exec($ch);//运行curl
        if($data === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		}

        // if (!$data) {
        // 	var_dump(curl_error($ch));
        // }
        curl_close($ch);
        return $data;
    }
    public function review()
    {
    	$data = input();
    	foreach($data["data"] as $line){
    		Review::create($line);
    	}
    	return ["code" => 0, "msg" => "success","data" => $data];
    }
}