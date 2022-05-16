<?php



class Food{
	
	
	public function RandomFood($bot) {
		$index = rand(0,sizeof($this->_array)-1);
        $bot->reply($this->_array[$index]);
    }
	
	public $_array = array(
	"麥當勞",
	"嚕嚕米");

}

?>