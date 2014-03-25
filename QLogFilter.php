<?php

/**
* QLogFilter
* Add controller log
* @author Lucky Vic <luckynvic@gmail.com>
*/
class QLogFilter extends CFilter
{
	public $logCategory;
	public $logLevel = 'info';

	protected function postFilter($filterChain)
	{
		Yii::log('Open Action '.$filterChain->controller->route, $this->logLevel,$this->logCategory);
	}
}

?>