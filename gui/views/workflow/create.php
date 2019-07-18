<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Create New Workflow';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/web/css/workflow-create.css');
$this->registerJsFile('@web/web/js/workflowcreate.js');
$this->registerCssFile('@web/web/css/table.css');

function findDepartment($departmenlist, $id){
    foreach($departmenlist as $depart){
        if($depart["ID"]==$id){
            return $depart["Title"];
        }
        
    }
    return "not found";
}
?>
<style>


.grid-container {
  display: grid;
  
  grid-template-columns: 5% 25% 25% 20% 20%;
  grid-gap: 2px;
  background-color:#ffccb3;
  padding: 1px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 5px ;
  font-size: 18px;
}

</style>
<div>
<form class="form-horizontal" action="">
<div class="form-group">
   <label for="wftype">Workflow type:</label>
   <select >
      <option selected="selected" value="0">Choose one</option>
  <?php
  foreach($types as  $idx => $type) { ?>
      <option value="<?= $type['ID'] ?>"><?= $type['Title'] ?></option>
  <?php
    } ?>
    </select> 
</div>

<div class="form-group">
      <label for="wftitel">Workflow:</label>
      <input type="text" class="form-control" id="wftitel">
    </div>
 
 <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea class="form-control" rows="5" id="comment"></textarea>
    </div>
 <div class="form-group">
      <label for="controller">controller :</label>
      <select >
      <option selected="selected" value="0">Choose one</option>
  <?php
  foreach($users as  $user) { ?>
      <option value="<?= $user['ID'] ?>"><?= $user['FirstName']."".$user['LastName'] ?></option>
  <?php
    } ?>
    </select>
    </div>
   
<div class="form-group">
     <label for="user"> Assigned users:</label>
      <table class="iflow-table">
    	<thead>
    		<tr>
    			<th>FullName</th>
    			<th>Department</th>
    			<th>Status</th>
    			<th>select</th>
    		</tr>
    	</thead>
    	<tbody>
    	 <?php
          foreach($users as  $user) { 
              $dep ='';
              if(isset($user['DepartmentList']['Department'])){
                 /* foreach($departments as $depart){
                      $dep .= ', ' . $depart[Title];
            
                  }*/
                  foreach($user['DepartmentList']['Department'] as $departid){
                      $dep .= ', ' . findDepartment($departments, $departid);
                      
                  }
              }
              ?>
     		<tr>
    			<td><?= $user['FirstName']."  ". $user['LastName'] ?></td>
     			<td><?= $dep ?></td>
    			<td><?= $user['Status'] ?></td>
    			<td> <input type="checkbox" name="select" value="0"> </td>
    		</tr>
    		<?php
           } ?>
     	
    	</tbody>
    </table>
    
    <script type="text/javascript">
		var loadUrl = "<?php echo Yii::getAlias("@web"). "/site/loadworkflowtypes";?>";
    </script>
  </div>

     
   
    <br>
    <button type="submit" class="btn btn-default">Submit</button>
    
</form>


