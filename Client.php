<?php
		
		//自动加载类文件
	 function __autoload($class_name)
	 {
		 include $class_name.'.php';
	 }
	
	
	
	class Client
	{
		
		function __construct()
		{
			$value=mt_rand(1,2);//通过随机数，随机选择不同形式的验证码
			switch($value)
			{
				case 1:$caption=new StringCaptcha();break;//选择字符验证码
				case 2:$caption=new EquationCaptcha();break;//选择等式验证码
			}
			
			$caption->createCaptchaImage(100,30);//继承自抽象类中的模板方法（相当灵活，方便^_^）
		}
	}
	
	$newCaptcha=new Client();
	
?>
