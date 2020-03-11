<?php

class Controller
{
	private static $Service = 'Service';

	public static function callFunc( string $sNowClassName, string $sNowFunc , string $sCallSymbol = '::')
	{
		$iPos       = strrpos($sNowClassName, static::class);
		$sClassName = substr($sNowClassName, 0, $iPos);

		$sClassName = $sClassName . self::$Service . $sCallSymbol . $sNowFunc;

		return call_user_func($sClassName);
	}
}

class UserController
{
	public function getUserDetail()
	{
		return Controller::callFunc(self::class, __FUNCTION__);
	}

	public function getUserList()
	{
		return Controller::callFunc(self::class, __FUNCTION__);
	}
}

class DemoController
{
	public function getDemoDetail()
	{
		return Controller::callFunc(self::class, __FUNCTION__, '->');
	}

	public function getDemoList()
	{
		return Controller::callFunc(self::class, __FUNCTION__, '->');
	}
}

class UserService
{
	public static function getUserDetail()
	{
		echo '获取用户的详情~' . PHP_EOL;
	}

	public static function getUserList()
	{
		echo '获取用户的列表~' . PHP_EOL;
	}
}

class DemoService
{
	public function getDemoDetail()
	{
		echo '获取Demo的详情~' . PHP_EOL;
	}

	public function getDemoList()
	{
		echo '获取Demo的列表~' . PHP_EOL;
	}
}

(new UserController())->getUserDetail();
(new UserController())->getUserList();
(new DemoController())->getDemoDetail();
(new DemoController())->getDemoList();
