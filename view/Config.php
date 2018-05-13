<?php

	namespace View;

	require_once __DIR__.'/../vendor/autoload.php';

	use Twig_Loader_Filesystem;
	use Twig_Environment;

	class Config
	{
		const PNG_PATH = "view/static/png/";

		const TEMPLATE_PATH = __DIR__."/template";

		const CARD_VAL = array("10","9","8","7","6","5","4","3","2","ace","king","queen","jack");

		const CARD_TYPE = array("clubs.png", "diamonds.png", "hearts.png", "spades.png");

		private $loader;

		private $twig;

		public function __construct()
		{
			//if($this->loader == NULL)
			//{
			try{
				$this->loader = new Twig_Loader_Filesystem(self::TEMPLATE_PATH);
			}catch(Throwable $t){
				echo $t;
			}
			//}
			//if($this->twig == NULL)
			//{
				$this->twig = new Twig_Environment($this->loader);
			//}

		}

		public function tw()
		{
			return $this->twig;
		}
	}

?>