<?php 

/**
* QDbLogRoute
* Log user activity to database
* @author Lucky Vic <luckynvic@gmail.com>
*/
class QDbLogRoute extends CDbLogRoute
{
	public $collectMessage=true;

	protected function createLogTable($db,$tableName)
	{
    $db->createCommand()->createTable($tableName, array(
        'id'=>'pk',
        'level'=>'varchar(128)',
        'category'=>'varchar(128)',
        'logtime'=>'datetime',
        'message'=>'text',
        'user_id'=>'varchar(30)',
        'ip_address'=>'varchar(30)',
        'user_agent'=>'varchar(255)',
        'request_url'=>'varchar(255)',
    ));
	}

	protected function processLogs($logs)
	{

	if(!Yii::app()->user->isGuest) {
	    $command=$this->getDbConnection()->createCommand();
	    $request=Yii::app()->request;
	    $id=Yii::app()->user->id;
	    	    
	    foreach($logs as $log)
	    {
	    	$message=($this->collectMessage?$log[0]:'');
	        $command->insert($this->logTableName,array(
	            'level'=>$log[1],
	            'category'=>$log[2],
	            'logtime'=>date('Y-m-d H:i:s',(int)$log[3]),
	            'message'=>$message,
	            'user_id'=>$id,
	            'ip_address'=>$request->userHostAddress,
	            'user_agent'=>$request->userAgent,
	            'request_url'=>$request->url
	        ));
	    }
	}
}

}
