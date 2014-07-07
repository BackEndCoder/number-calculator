<?php
class CalculatorController extends AppController {

	public function index() {
		if($this->request->data){
			$this->Calculator->set($this->request->data);
			if($this->Calculator->validates()){
				//process input
				$answers = $this->Calculator->process($this->request->data['Calculator']['number']);
				$this->set('answers',$answers);
			}
		}
	}
}