<?php
	//等式验证码具体类，实现了抽象方法createCaptchaString和setCaptchaStringStyle;
	include_once('AbstractCaptcha.php');
	class EquationCaptcha extends AbstractCaptcha
	{
		protected function createCaptchaString()//返回验证码内容（一个等式）
		{
			$captchaCode="";
			$operatorArray=['+','-','x'];
			$value1=mt_rand(0,10);
			$value2=mt_rand(0,10);

			$operatorKey=array_rand($operatorArray,1);

			switch($operatorKey)
			{
				case 0:$result=$value1+$value2;break;
				case 1:$result=$value1-$value2;break;
				case 2:$result=$value1*$value2;break;
			}

			$captchaCode=$value1.$operatorArray[$operatorKey].$value2.'= ?';
			
			return $captchaCode;
				
				

			
		}

		protected function setCaptchaStringStyle($captchaString,$image,$imageWidth,$imageHeight)//设置验证码字符的显示风格
		{
			$stringSize=intval($imageHeight* 0.8);

			$stringX=mt_rand(intval($imageWidth*0.1),intval($imageWidth*0.3));
			$stringY=mt_rand(intval($imageHeight*0.1),intval($imageHeight*0.3));
			$stringColor=imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));

			imagestring($image,$stringSize,$stringX,$stringY,$captchaString,$stringColor);

			return $image;
			
			

		}
	}
?>

