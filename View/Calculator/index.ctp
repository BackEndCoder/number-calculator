<?php
echo '<p>This calculator will work out the correct denominations of coins for larger amounts of money. Please note it will assume everything is in pence, unless you use a pound sign: possible inputs include £X.Xp, Xp or even just x (in pence)</p>';
echo $this->Form->create('Calculator');
echo $this->Form->input('number', array('type'=>'input','label'=>false,'errorMessage' => false));
echo $this->Form->submit('Process');
echo $this->Form->end();
if(isset($answers)){

	foreach($answers as $key => $answer){
		echo $answer.' x '.($key==200?'£2':($key==100?'£1':$key.'p')).'<br>';
	}
}