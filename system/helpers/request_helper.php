<?php
/**
 * 
 * @ClassName: Request
 * @Description: todo(请求参数处理)
 * @author Simon liyloong@gmail.com
 * @date 2012-8-15 下午05:32:25
 *
 */
class Request {
	
	public static $decmal = '/^([+-]?)\\d*\\.\\d+$/'; //浮点数
	public static $decmal1 = '/^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$/'; //正浮点数
	public static $decmal2 = '/^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$/'; //负浮点数
	public static $decmal3 = '/^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$/'; //浮点数
	public static $decmal4 = '/^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$/'; //非负浮点数（正浮点数 + 0）
	public static $decmal5 = '/^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$/'; //非正浮点数（负浮点数 + 0）
	public static $intege = '/^-?[1-9]\\d*$/'; //整数
	public static $intege1 = '/^[1-9]\\d*$/'; //正整数
	public static $intege2 = '/^-[1-9]\\d*$/'; //负整数
	public static $num = '/^([+-]?)\\d*\\.?\\d+$/'; //数字
	public static $num1 = '/^[1-9]\\d*|0$/'; //正数（正整数 + 0）
	public static $num2 = '/^-[1-9]\\d*|0$/'; //负数（负整数 + 0）
	public static $ascii = '/^[\\x00-\\xFF]+$/'; //仅ACSII字符
	public static $chinese = '/^[\\u4e00-\\u9fa5]+$/'; //仅中文
	public static $color = '/^[a-fA-F0-9]{6}$/'; //颜色
	public static $date = '/^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$/'; //日期
	public static $email = '/^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$/'; //邮件
	public static $idcard = '/^[1-9]([0-9]{14}|[0-9]{17})$/'; //身份证
	public static $ip4 = '/^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$/'; //ip地址
	public static $letter = '/^[A-Za-z]+$/'; //字母
	public static $letter_l = '/^[a-z]+$/'; //小写字母
	public static $letter_u = '/^[A-Z]+$/'; //大写字母
	public static $mobile = '/^0?(13|15|18)[0-9]{9}$/'; //手机
	public static $notempty = '/^\\S+$/'; //非空
	public static $password = '/^.*[A-Za-z0-9\\w_-]+.*$/'; //密码
	public static $fullNumber = '/^[0-9]+$/'; //数字
	public static $picture = '/(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/'; //图片
	public static $qq = '/^[1-9]*[1-9][0-9]*$/'; //QQ号码
	public static $rar = '/(.*)\\.(rar|zip|7zip|tgz)$/'; //压缩文件
	public static $tel = '/^[0-9\-()（）]{7,18}$/'; //电话号码的函数(包括验证国内区号,国际区号,分机号)
	public static $url = '/^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$/'; //url
	public static $username = '/^[A-Za-z0-9_\\-\\u4e00-\\u9fa5]+$/'; //用户名
	public static $deptname = '/^[A-Za-z0-9_()（）\\-\\u4e00-\\u9fa5]+$/'; //单位名
	public static $zipcode = '/^\\d{6}$/'; //邮编
	public static $realname = '/^[A-Za-z\\u4e00-\\u9fa5]+$/'; //真实姓名
	public static $companyname = '/^[A-Za-z0-9_()（）\\-\\u4e00-\\u9fa5]+$/'; //数字
	public static $companyaddr = '/^[A-Za-z0-9_()（）\\#\\-\\u4e00-\\u9fa5]+$/'; //数字
	public static $companysite = '/^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&#=]*)?$/'; //数字
	

	/**
	 * 
	 * @Title: GetClientReferer
	 * @Description: todo(获取请求地址的来源)
	 * @return return_type    返回类型
	 * @throws
	 */
	public static function GetClientReferer() {
		if (array_key_exists ( 'HTTP_REFERER', $_SERVER )) {
			return $_SERVER ['HTTP_REFERER'];
		} else {
			return "";
		}
	}
	
	/**
	 * 
	 * @Title: GetClientIP
	 * @Description: todo(获取请求端IP)
	 * @return String  请求端IP
	 * @throws
	 */
	public static function GetClientIP() {
		if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
			$ip = getenv ( "HTTP_CLIENT_IP" );
		else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
			$ip = getenv ( "REMOTE_ADDR" );
		else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
			$ip = $_SERVER ['REMOTE_ADDR'];
		else
			$ip = "127.0.0.1";
		return ($ip);
	}
	
	/**
	 * 
	 * @Title: GetQueryString
	 * @Description: todo(获得指定Url参数的值)
	 * @param @param String $strName Url参数
	 * @param @param String $defValue 默认值
	 * @param @param Integer $verify  1:不验证，2：是否为空
	 * @return String   返回类型
	 * @throws
	 */
	public static function GetQueryString($strName, $defValue = NULL, $verify = 1) {
		if (array_key_exists ( $strName, $_GET )) {
			$result = ($_GET [$strName] == null || $_GET [$strName] == "") ? $defValue : $_GET [$strName];
			return self::VerifyString ( $result, $verify );
		} else {
			return $defValue;
		}
	
	}
	
	public static function GetFormArray(){
		return $_POST;
	}
	
	public static function GetQueryArray(){
		return $_GET;
	}
	
	/**
	 * 
	 * @Title: GetFormString
	 * @Description: todo(获得指定表单参数的值)
	 * @param @param String $strName Url参数
	 * @param @param String $defValue 默认值
	 * @param @param Integer $verify  1:不验证，2：是否为空
	 * @return String    返回类型
	 * @throws
	 */
	public static function GetFormString($strName, $defValue = NULL, $verify = 1) {
		
		if (array_key_exists ( $strName, $_POST )) {
			$result = ($_POST [$strName] == null || $_POST [$strName] == "") ? $defValue : $_POST [$strName];
			return self::VerifyString ( $result, $verify );
		} else {
			return $defValue;
		}
	}
	
	/**
	 * 
	 * @Title: GetQueryInt
	 * @Description: todo(获得指定Url参数的int类型值)
	 * @param @param String $strName Url参数
	 * @param @param Integer $defValue 默认值
	 * @param @param array $validate 字段验证逻辑所需要的定义
	 * @return String    返回类型
	 * @throws
	 */
	public static function GetQueryInt($strName, $defValue=NULL, $validate = NULL) {
	    //$result = $defValue;
	    //if(!empty($validate)){
	    //}
		if (array_key_exists ( $strName, $_GET )) {
			return self::StrToInt ( $_GET [$strName], $defValue );
		} else {
			return $defValue;
		}
	
	}
	
	/**
	 * 
	 * @Title: GetFormInt
	 * @Description: todo(获得指定表单参数的int类型值)
	 * @param @param String $strName Url参数
	 * @param @param Integer $defValue 默认值
	 * @return String    返回类型
	 * @throws
	 */
	public static function GetFormInt($strName, $defValue=NULL) {
		if (array_key_exists ( $strName, $_POST )) {
			return self::StrToInt ( $_POST [$strName], $defValue );
		} else {
			return $defValue;
		}
	
	}
	
	/**
	 * 
	 * @Title: VerifyString
	 * @Description: todo(对传入的值进行验证)
	 * @param @param String $str 值
	 * @param @param Integer $verify  1:不验证，2：是否为空
	 * @return String    返回类型
	 * @throws
	 */
	public static function VerifyString($str, $verify) {
		$result = $str;
		if ($verify == 2) {
			$result = empty ( $result ) ? false : true;
		} else if ($verify != 1) {
			$result = preg_match ( $verify, $str );
		}
		return $result;
	}
	
	/**
	 * 
	 * @Title: StrToInt
	 * @Description: todo(将对象转换为Int32类型)
	 * @param @param String $Expression 要转换的字符串
	 * @param @param Integer $defValue   缺省值
	 * @return Integer   转换后的int类型结果
	 * @throws
	 */
	public static function StrToInt($Expression, $defValue) {
		if ($Expression != null || $Expression != "") {
			return intval ( $Expression );
		}
		return $defValue;
	}

}