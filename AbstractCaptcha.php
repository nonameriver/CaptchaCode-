<?php
	//抽象类，整合具体方法流程
	abstract class AbstractCaptcha
	{
		protected $captchaString;//验证码字符内容
		protected $image;//验证码图片
		protected $imageWidth;//验证码宽
		protected $imageHeight;//验证码高
		

		public function createCaptchaImage($imageWidthNow,$imageHeightNow)//模板方法(具体方法，接受不同形式的验证码并输出验证码图片)
		{
			$this->imageWidth=$imageWidthNow;
			$this->imageHeight=$imageHeightNow;
			
			
			$this->image=$this->createBasicImage($this->imageWidth,$this->imageHeight);
			

			$this->captchaString=$this->createCaptchaString();

			$this->image=$this->setCaptchaStringStyle($this->captchaString,$this->image,$this->imageWidth,$this->imageHeight);

			$this->image=$this->addInterference($this->image,$this->imageWidth,$this->imageHeight);

			header('content-type:image/png');
			

			imagepng($this->image);

			imagedestroy($this->image);
			
			
			

			
		}
		public function createBasicImage($width,$height)//创建最基础的验证码背景图片
		{
			$image=imagecreatetruecolor($width,$height);
			$bgcolor=imagecolorallocate($image,255,255,255);
			imagefill($image,0,0,$bgcolor);
			return $image;
		}
		public function addInterference($image,$width,$height)//添加干扰，这里使用了【像素点】和【线条】,可自行修改
		{
			for($i=0;$i<=500;$i++)
			{
				$x1=mt_rand(1,$width-1);
				$y1=mt_rand(1,$height-1);
				$pointColor=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
				imagesetpixel($image,$x1,$y1,$pointColor);
			}
			for($j=0;$j<=4;$j++)
			{
				$x1=mt_rand(0,$width-1);
				$y1=mt_rand(0,$height-1);

				$x2=mt_rand(0,$width-1);
				$y2=mt_rand(0,$height-1);

				$lineColor=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
				imageline($image,$x1,$y1,$x2,$y2,$lineColor);
			}

			return $image;
		}
		abstract protected function createCaptchaString();//创建验证码内容的抽象方法
		abstract protected function setCaptchaStringStyle($captchaString,$image,$imageWidth,$imageHeight);//设置验证码内容的显示风格，比如位置，字体大小等
	}
?>
