<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/web/css/table.css');
$this->registerJsFile('@web/web/js/workflowtypes.js');

?>
<div class="site-about" ng-controller="WorkflowTypesController">
    <h2>Workflow Type List </h2><button ng-click="reload();">Reload</button>

    

    <table class="iflow-table">
    	<thead>
    		<tr>
    			<th>ID</th>
    			<th>Company</th>
    			<th>BaseType</th>
    			<th>Title</th>
    			<th>Status</th>
    			<th>SendToController</th>
    			<th>ManualAssign</th>
    			<th>IncreaseStepAutomatic</th>
    			<th>Steps</th>
    		</tr>
    	</thead>
    	<tbody>
     		<tr ng-repeat="item in items">
    			<th>{{item.ID}}</th>
    			<td>{{item.CompanyId}}</td>
    			<td>{{item.BaseTypeId}}</td>
    			<td>{{item.Title}}</td>
    			<td>{{item.Status}}</td>
    			<td>{{item.SendToController}}</td>
    			<td>{{item.ManualAssign}}</td>
    			<td>{{item.IncreaseStepAutomatic}}</td>
    			<td>{{item.Stepa}}</td>
    		</tr>
     		
    	
    	</tbody>
    </table>
    
    <script type="text/javascript">
		var loadUrl = "<?php echo Yii::getAlias("@web"). "/site/loadworkflowtypes";?>";
    </script>
    
</div>

