<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

function attay_to_string($list, $field) {
	$productlist = array ();
	$products = "";
	foreach ( $list as $clue ) {
		if (! empty ( $clue [$field] )) {
			$productlist [] = $clue [$field];
		}
	}
	if (count ( $productlist ) > 1) {
		$products = implode ( ',', $productlist );
	}
	return $products;
}

/**
 * 递归处理，将$result下的所有对象转换成数组
 * @param mixed[array|object] $result
 * @return array();
 */
function object_to_array($result) {
	$array = array ();
	$self = __FUNCTION__;
	if (is_array ( $result ) || is_object ( $result )) {
		foreach ( $result as $key => $value ) {
			if (is_object ( $value )) {
				$array [$key] = $self ( $value );
			} else if (is_array ( $value )) {
				$array [$key] = $self ( $value );
			} else {
				$array [$key] = $value;
			}
		}
	}
	
	return $array;
}

/**
 * 输出json值
 * 
 * @param $result 数据值
 * @param $code 状态码, 1000为成功, 其他为错误。
 * @param $msg 返回信息
 * 
 * @return void
 */
function response($result, $code = 1000, $msg = '', $upload = false, $url = '') {
	if ($upload) {
		header ( 'Content-type: text/html; charset=utf-8' );
	} else {
		header ( 'Content-type: application/json; charset=utf-8' );
	}
	
	echo json_encode ( array ('code' => $code, 'msg' => $result ? $result : $msg, 'url' => $url ) );
	exit ();
}

/**
 * 将获得的结果整理成合适的结果
 * 
 * @param array $result 要转化的结果
 * @param array $format 格式
 * 
 * @return array 整理好的结果
 */
function formart_entity($result, $format) {
	foreach ( $format as $key => $value ) {
		if (isset ( $result [$key] )) {
			$format [$key] = $result [$key];
			//当格式值为数字, 结果不是数字时, 采用默认值
			if (is_numeric ( $value ) && ! is_numeric ( $format [$key] )) {
				$format [$key] = $value;
			}
		}
	}
	
	return $format;
}

/**
 * 查询后台管理是否登录, 是否有权限
 * 
 * @param mixed[array|int] $page_need 页面需要的权限
 */
function check_login($page_need) {
	if (is_int ( $page_need )) {
		$page_need = array ($page_need );
	}
	
	if (! $user = get_instance ()->session->userdata ( 'user' )) {
		redirect ( domain_url () . 'login?from=' . urlencode ( current_url_param () ) );
	} else if (empty ( $user ['init'] )) {
		redirect ( domain_url () . 'init?from=' . urlencode ( current_url_param () ) );
	} else {
		//empty
	}
	
	if ($user ['lms_role'] === false || ! in_array ( $user ['lms_role'], $page_need )) {
		show_error ( '没权限' );
	}
}

/**
 * 获取当前url, 带参数
 * 
 * $return string;
 */
function current_url_param() {
	return domain_url () . substr ( $_SERVER ['REQUEST_URI'], 1 );
}

/**
 * 获取domain_url
 * 
 * $return string;
 */
function domain_url() {
	$CI = & get_instance ();
	return $CI->config->slash_item ( 'domain_url' );
}

/** 
 * 查看字符串是否为手机号
 * 
 * @param $str
 * 
 * @return bool
 */
function get_mobile($str) {
	$test = "/1(3|5|8)\d{9}/";
	preg_match ( $test, $str, $m );
	return count ( $m ) > 0;
}

/**
 * 如果是规范的电话号码, 以区号-电话号码的形式返回.
 * 
 * @param string $number
 *
 * @return string
 */
function get_format_telephone($number) {
	if (get_mobile ( $number )) {
		return $number;
	}
	//所有三位数的区号
	$arr = array ('010', '020', '021', '022', '023', '024', '025', '027', '028', '029' );
	
	$prefix = substr ( $number, 0, 3 );
	if (! in_array ( $prefix, $arr )) {
		$prefix = substr ( $number, 0, 4 );
	}
	
	if (! is_numeric ( $prefix )) {
		return $number;
	}
	
	$sub = str_replace ( $prefix, '', $number );
	
	return $prefix . '-' . $sub;
}

/**
 * 从array中查询是否包含str
 * 
 * @param array $arr
 * @param str $str
 * 
 * @return 得到的key
 */
function get_from_array($arr, $str) {
	$result = 0;
	
	if ($str) {
		foreach ( $arr as $k => $v ) {
			if (strpos ( $v, $str ) !== false) {
				$result = $k;
				break;
			}
		}
	}
	
	return $result;
}
