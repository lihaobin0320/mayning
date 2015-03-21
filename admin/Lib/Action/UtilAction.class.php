<?php
/**
 * 获取访客信息的类：语言、浏览器、操作系统、IP、地理位置、ISP。
 * 使用：
 *      $obj = new class_guest_info;
 *      $obj->GetLang();        //获取访客语言：简体中文、繁體中文、English。
 *      $obj->GetBrowser();     //获取访客浏览器：MSIE、Firefox、Chrome、Safari、Opera、Other。
 *      $obj->GetOS();          //获取访客操作系统：Windows、MAC、Linux、Unix、BSD、Other。
 *      $obj->GetIP();          //获取访客IP地址。
 *      $obj->GetAdd();         //获取访客地理位置，使用 Baidu 隐藏接口。
 *      $obj->GetIsp();         //获取访客ISP，使用 Baidu 隐藏接口。
 */
class UtilAction {
	
	/**
	 * 随机生成六个字符串作为密钥
	 * @param number $len
	 * @return string
	 */
	function randstr($len=6) {
		$chars='abcdefghijklmnopqrstuvwxyz0123456789';
		// characters to build the password from
		mt_srand((double)microtime()*1000000*getmypid());
		// seed the random number generater (must be done)
		$password='';
		while(strlen($password)<$len)
			$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}
	
	/**
	 * 加密算法
	 * @param unknown $data
	 * @param unknown $key
	 * @return string
	 */
	function encrypt($data, $key)
	{
		$key    =   md5($key);
		$x      =   0;
		$len    =   strlen($data);
		$l      =   strlen($key);
		for ($i = 0; $i < $len; $i++)
		{
			if ($x == $l)
			{
				$x = 0;
			}
			$char .= $key{$x};
			$x++;
		}
		for ($i = 0; $i < $len; $i++)
		{
			$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
	}
	return base64_encode($str);
	}
	/**
	* 解密算法
	* @param unknown $data
	* @param unknown $key
	* @return string
	*/
	function decrypt($data, $key)
		{
		$key = md5($key);
		$x = 0;
		$data = base64_decode($data);
		$len = strlen($data);
		$l = strlen($key);
		for ($i = 0; $i < $len; $i++)
		{
		if ($x == $l)
		{
		$x = 0;
		}
		$char .= substr($key, $x, 1);
		$x++;
	}
		for ($i = 0; $i < $len; $i++)
		{
		if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
		{
		$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
		}
		else
		{
		$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
	}
	}
	return $str;
	}
	
	//取访客语言：简体中文、繁體中文、English。
	function GetLang() {
		$Lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
		//使用substr()截取字符串，从 0 位开始，截取4个字符
		if (preg_match('/zh-c/i',$Lang)) {
			//preg_match()正则表达式匹配函数
			$Lang = '简体中文';
		}
		elseif (preg_match('/zh/i',$Lang)) {
			$Lang = '繁體中文';
		}
		else {
			$Lang = 'English';
		}
		return $Lang;
	}
	//获取访客浏览器：MSIE、Firefox、Chrome、Safari、Opera、Other。
	function GetBrowser() {
		$Browser = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/MSIE/i',$Browser)) {
			$Browser = 'MSIE';
		}
		elseif (preg_match('/Firefox/i',$Browser)) {
			$Browser = 'Firefox';
		}
		elseif (preg_match('/Chrome/i',$Browser)) {
			$Browser = 'Chrome';
		}
		elseif (preg_match('/Safari/i',$Browser)) {
			$Browser = 'Safari';
		}
		elseif (preg_match('/Opera/i',$Browser)) {
			$Browser = 'Opera';
		}
		else {
			$Browser = 'Other';
		}
		return $Browser;
	}
	//获取操作系统
	function GetOS() {
		$OS = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/win/i',$OS)) {
			$OS = 'Windows';
		}
		elseif (preg_match('/mac/i',$OS)) {
			$OS = 'MAC';
		}
		elseif (preg_match('/linux/i',$OS)) {
			$OS = 'Linux';
		}
		elseif (preg_match('/unix/i',$OS)) {
			$OS = 'Unix';
		}
		elseif (preg_match('/bsd/i',$OS)) {
			$OS = 'BSD';
		}
		else {
			$OS = 'Other';
		}
		return $OS;
	}

	/**
	 * 获取 IP  地理位置
	 * 淘宝IP接口
	 * @Return: array
	 */
	function getCity($ip)
	{
		$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
		$ip=json_decode(file_get_contents($url));
		if((string)$ip->code=='1'){
			return false;
		}
		$data = (array)$ip->data;
		return $data;
	}
	
	
	function GetIpLookup($ip = ''){
		if(empty($ip)){
			$ip = get_client_ip();
		}
		$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
		if(empty($res)){ return false; }
		$jsonMatches = array();
		preg_match('#\{.+?\}#', $res, $jsonMatches);
		if(!isset($jsonMatches[0])){ return false; }
		$json = json_decode($jsonMatches[0], true);
		if(isset($json['ret']) && $json['ret'] == 1){
			$json['ip'] = $ip;
			unset($json['ret']);
		}else{
			return false;
		}
		return $json;
	}
	
}

?>