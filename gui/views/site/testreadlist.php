<?php


/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'TestReadList';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="TestReadList">
    <h1><?= Html::encode($this->title) ?></h1>
 
<?php
if (count($typs)) {
    // Open the table
    echo "<table border='1'><tr><td>id</td><td>title</td></tr>";
    
    // Cycle through the array
    foreach ($typs as $idx => $type) {
        
        // Output a row
        echo "<tr>";
        echo "<td>".$type->id."</td>";
        echo "<td>".$type->title."</td>";
        echo "</tr>";
    }
    
    // Close the table
    echo "</table>";
}
echo '<hr>';


//print_r($typs);
//$log=$_SESSION['logedInfo'];
//print_r($log['user']->getCompany()->getId());
//print_r(\Yii::$app->session['logedInfo']);


?>
   
</div>
