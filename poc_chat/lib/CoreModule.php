<?php 

class CoreModule{

	private $_template = "";

	public function setTemplate($template){
		$this->template = $template;
	}

	public function renderTemplate(){
		ob_start();
		require $this->template;
		echo ob_get_clean();
	}
}



?>