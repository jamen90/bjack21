<?php

	require_once '../vendor/autoload.php';

	namespace View;

	class Config
	{
		const PNG_PATH = __DIR__."/static/png/";

		const TEMPLATE_PATH = __DIR__."/template";

		const CARD_VAL = array("10","9","8","7","6","5","4","3","2","ace","king","queen","jack");

		const CARD_TYPE = array("clubs.png", "diamonds.png", "hearts.png", "spades.png");

		private $loader;

		private $twig;

		public function __construct()
		{
			if($this->loader == NULL)
			{
				$this->loader = new Twig_Loader_Filesystem(TEMPLATE_PATH);
			}
			if($this->twig == NULL)
			{
				$this->twig = new Twig_Environment($this->loader);
			}

		}

		public function twig()
		{
			return $this->twig;
		}
	}

?>