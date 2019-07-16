<?php
	//字符验证码具体类，实现了抽象方法createCaptchaString和setCaptchaStringStyle;
	include_once('AbstractCaptcha.php');
	class StringCaptcha extends AbstractCaptcha
	{
		protected function createCaptchaString()//返回验证码内容（6个字符）
		{
			$captchaCode="";
			for($i=0;$i<6;$i++)
			{
				$stringData='abcdefghijklmnopqrstuvwxyz';
				$stringData.=strtoupper($stringData);
				$stringData.='1234567890';
				
				$charData=substr($stringData,mt_rand(0,strlen($stringData)-1),1);
				$captchaCode.=$charData;
			}
			return $captchaCode;
				
				

			
		}

		protected function setCaptchaStringStyle($captchaString,$image,$imageWidth,$imageHeight)//设置验证码字符的显示风格
		{
			$stringSize=intval($imageHeight* 0.6);

			$stringX=mt_rand(intval($imageWidth*0.2),intval($imageWidth*0.3));
			$stringY=mt_rand(intval($imageHeight*0.2),intval($imageHeight*0.3));
			$stringColor=imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));

			imagestring($image,$stringSize,$stringX,$stringY,$captchaString,$stringColor);

			return $image;
			
			

		}
	}
?>

