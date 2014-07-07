<?php
class Calculator extends AppModel {

	public $validate = array(
	    'number' => array(
	        'rule'    => '/^£?([0-9]+)\.?([0-9]+)?p?$/u',
	        'message' => 'Your input doesn\'t follow the guidelines'
	    )
	);

	public function process($random){

		// had problems working with £, so i hacked it
		$random = utf8_decode($random);
		if(!is_numeric($random[0])){
			//strip £ if its there (floor will strip p for us) and then devide by 100 to make it into pence
			$random = substr($random, 1);
			$random = $random * 100;
		}
		//round the number for long 0.1234455678
		$random = round($random);
		//strip the decial point if its there
		$random = str_replace('.', '', $random);
		list($random,$return[200]) = $this->internal_process($random,200);
		list($random,$return[100]) = $this->internal_process($random,100);
		list($random,$return[50]) = $this->internal_process($random,50);
		list($random,$return[20]) = $this->internal_process($random,20);
		list($random,$return[10]) = $this->internal_process($random,10);
		list($random,$return[5]) = $this->internal_process($random,5);
		list($random,$return[2]) = $this->internal_process($random,2);
		list($random,$return[1]) = $this->internal_process($random,1);
		return $return;
	}

	// repeating function for DRY code
	public function internal_process($random,$key){
		$number = $random / $key;
		if($number > 0){
			$return = floor($number);
			$random = $random - (floor($number)*$key);
		}
		else {
			$return = 0;
		}
		return array($random,$return);
	}
}