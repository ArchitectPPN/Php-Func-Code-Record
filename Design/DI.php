<?php


class Boss
{

	private $staff;

	/**
	 * 招聘员工
	 *
	 * @param Standard $standard
	 */
	public function findStaff( Standard $standard )
	{
		$this->staff = $standard;
	}

	/**
	 * 开始工作
	 */
	public function work()
	{
		$this->staff->work();
	}
}


// 招聘标准
interface Standard
{
	public function work();
}

// 应聘者
class StaffA implements Standard
{
	public function work()
	{
		echo "A Can do work~";
	}
}

class StaffB
{
	public function work()
	{
		echo "B ";
	}
}

$staffA = new StaffA();
$staffB = new StaffB();
$oBoss  = new Boss();

$oBoss->findStaff($staffA);
// 这里B 不符合标准, 抛出错误
#$oBoss->findStaff($staffB);

$oBoss->work();

