<?php

class SensitiveWordFilter
{
	private static $instance = NULL;

	/**
	 * 替换符号
	 * @var string
	 */
	private static $replaceSymbol = "*";

	/**
	 * 敏感词树
	 * @var array
	 */
	private static $sensitiveWordTree = [];

	private function __construct()
	{
	}

	/**
	 * 获取实例
	 *
	 * @return SensitiveWordFilter|null
	 */
	public static function getInstance()
	{
		if (!(self::$instance instanceof SensitiveWordFilter)) {
			return self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * 添加敏感词，组成树结构。
	 * 例如敏感词为：傻子是傻帽，白痴，傻蛋 这组词组成如下结构。
	 * [
	 *     [傻] => [
	 *           [子]=>[
	 *               [是]=>[
	 *                  [傻]=>[
	 *                      [帽]=>[false]
	 *                  ]
	 *              ]
	 *          ],
	 *          [蛋]=>[false]
	 *      ],
	 *      [白]=>[
	 *          [痴]=>[false]
	 *      ]
	 *  ]
	 *
	 * @param string $file_path 敏感词库文件路径
	 */
	public static function addSensitiveWords( string $file_path )
	: void
	{
		foreach ( self::readFile($file_path) as $words ) {
			$len     = mb_strlen($words);
			$treeArr = &self::$sensitiveWordTree;

			for ( $i = 0; $i < $len; $i++ ) {
				$word = mb_substr($words, $i, 1);
				// 敏感词树结尾记录状态为false；
				$treeArr = &$treeArr[$word] ?? $treeArr = FALSE;
			}
		}
	}

	/**
	 * 执行过滤
	 *
	 * @param string $txt
	 *
	 * @return string
	 */
	public static function execFilter( string $txt )
	: string
	{
		var_dump('敏感词汇树:', self::$sensitiveWordTree);
		$wordList = self::searchWords($txt);
		if (empty($wordList))
			return $txt;

		return strtr($txt, $wordList);
	}

	/**
	 * 搜索敏感词
	 *
	 * @param string $txt
	 *
	 * @return array
	 */
	private static function searchWords( string $txt )
	: array
	{
		$txtLength = mb_strlen($txt);
		$wordList  = [];
		for ( $i = 0; $i < $txtLength; $i++ ) {
			//检查字符是否存在敏感词树内,传入检查文本、搜索开始位置、文本长度
			$len = self::checkWordTree($txt, $i, $txtLength);

			//存在敏感词，进行字符替换。
			if ($len > 0) {
				//搜索出来的敏感词
				$word            = mb_substr($txt, $i, $len);
				$wordList[$word] = str_repeat(self::$replaceSymbol, $len);
				$i = $len - 1 + $i;
			}
		}
		var_dump($wordList);
		return $wordList;
	}

	/**
	 * 检查敏感词树是否合法
	 *
	 * @param string $txt       检查文本
	 * @param int    $index     搜索文本位置索引
	 * @param int    $txtLength 文本长度
	 *
	 * @return int 返回不合法字符个数
	 */
	private static function checkWordTree( string $txt, int $index, int $txtLength )
	: int
	{
		$treeArr    = &self::$sensitiveWordTree;
		//敏感字符个数
		$wordLength = 0;

		for ( $i = $index; $i < $txtLength; $i++ ) {
			//截取需要检测的文本，和词库进行比对
			$txtWord = mb_substr($txt, $i, 1);

			//如果搜索字不存在词库中直接停止循环
			if (!isset($treeArr[$txtWord])){
				if($wordLength > 0){
					$wordLength = 0;
				}
				break;
			}

			//检测还未到底
			if ($treeArr[$txtWord] !== FALSE) {
				//继续搜索下一层tree
				$treeArr = &$treeArr[$txtWord];
				$wordLength++;
			} else if($treeArr[$txtWord] === FALSE) {
				$wordLength++;
				break;
			}

		}

		return $wordLength;
	}


	/**
	 * 读取文件内容
	 *
	 * @param string $file_path
	 *
	 * @return Generator
	 */
	private static function readFile( string $file_path )
	: Generator
	{
		$handle = fopen($file_path, 'r');
		while (!feof($handle)) {
			yield trim(fgets($handle));
		}
		fclose($handle);
	}

	/**
	 * @throws Exception
	 */
	private function __clone()
	{
		throw new \Exception("clone instance failed!");
	}

	/**
	 * @throws Exception
	 */
	private function __wakeup()
	{
		throw new \Exception("unserialize instance failed!");
	}

}

$instance = SensitiveWordFilter::getInstance();

//引入你的敏感词库文件
$instance->addSensitiveWords('./SensitiveWords_copy.txt');

#$instance->addSensitiveWords('./SensitiveWords.txt');//引入你的敏感词库文件
$txt = "相信，花木深处，不管记忆如何零落，不管擦肩为何转瞬即空，相遇的时光就是一卷铺衬的秋词，我慢慢写，你静静读。在秋的眉眼固执的开，提笔描绘枫红的流年，渲染一抹思念，泅渡着素简岁月的牵牵念念。";//需要过滤的文本
#$txt = "念念。";//需要过滤的文本
echo $instance->execFilter($txt);

