<?php
    if($first == 'yes') {
        $get_exrcisedirectorie_lists = $this->Common->getExrciseDirectoriesm();
        foreach ($get_exrcisedirectorie_lists as $key=>$get_exrcisedirectorie_list){
            if($key == $exrcisedirectorie_id) {
?>
<div class="row" id="getexercise<?= $key ?>" style="margin-bottom: 10px" >
    
    <span class=""> <p class="text-primary"><?=  ucfirst($get_exrcisedirectorie_list) ?></p></span>
    <span class="pull-right" id="getexercisemore">
        <button type="button" class="btn btn-default btn-sm" id="<?= $key ?>" onclick="getExcercisemore(this.id)">
            <i class="material-icons">add</i> 
        </button>
    </span>
     <button type="button" class="btn btn-default btn-sm pull-right " id="<?= $key ?>" onclick="removeExcerciseall(this.id)">
            <i class="material-icons">clear</i> 
        </button>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-highlight">
      <thead>
          <?php $ex_name = $this->Common->getExrciseDirectoriesname($key) ?>
        <th><?= ucfirst($ex_name->tecnical1) ?></th>
        <th><?= ucfirst($ex_name->tecnical2) ?></th>
        <th><?= ucfirst($ex_name->tecnical3) ?></th>
        <th><?= ucfirst($ex_name->tecnical4) ?></th>
        <th>Remove</th>
      </thead>
      <tbody id="addmore<?= $key ?>" >
          <tr id="remove<?= $get_exrcisedirectories->id.$start_id ?>" class="<?=$start_id ?>">
            <td hidden> 
                <input type="text" id="<?= $exrcisedirectorie_id ?>" value="<?= $exrcisedirectorie_id ?>" hidden>
                </td>
           <td> 
                    <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical1 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'a'.$get_exrcisedirectories->id.$start_id, 'label' => false, 'required']) ?> 

           </td>
             <td>
                    <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical2 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'b'.$get_exrcisedirectories->id.$start_id, 'onkeyup'=>'getSum2(this.id)','label' => false, 'required']) ?> 
              </td>
             <td>
                    <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' .  $get_exrcisedirectories->tecnical3 . ']', ['class' => 'form-control','id'=>'d'.$get_exrcisedirectories->id.$start_id, 'type' => 'text', 'label' => false, 'required']) ?> 
             </td>
              <td>
                    <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical4 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'c'.$get_exrcisedirectories->id.$start_id, 'label' => false, 'required', 'readonly']) ?> 
             </td>
                <td>
            <button type="button" class="btn btn-default btn-sm" id="<?= $get_exrcisedirectories->id.$start_id ?>" onclick="removeExcercise(this.id,<?= $get_exrcisedirectories->id.$start_id ?>)">
            <i class="material-icons">clear</i> 
        </button>
                 </td>
    </tr>
      </tbody>
    </table>
  </div> 
    
</div>
<?php
    }  }
    } else {
?>
<tr id="remove<?= $get_exrcisedirectories->id.$start_id ?>" class="<?=$start_id ?>">
        <td hidden> 
            <input type="text" id="<?= $exrcisedirectorie_id ?>" value="<?= $exrcisedirectorie_id ?>" hidden>
            </td>
       <td> 
                <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical1 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'a'.$get_exrcisedirectories->id.$start_id, 'label' => false, 'required']) ?> 
           
       </td>
         <td>
                <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical2 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'b'.$get_exrcisedirectories->id.$start_id, 'onkeyup'=>'getSum2(this.id)','label' => false, 'required']) ?> 
          </td>
         <td>
                <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' .  $get_exrcisedirectories->tecnical3 . ']', ['class' => 'form-control','id'=>'d'.$get_exrcisedirectories->id.$start_id, 'type' => 'text', 'label' => false, 'required']) ?> 
         </td>
          <td>
                <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical4 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'c'.$get_exrcisedirectories->id.$start_id, 'label' => false, 'required', 'readonly']) ?> 
         </td>
            <td>
        <button type="button" class="btn btn-default btn-sm" id="<?= $get_exrcisedirectories->id.$start_id ?>" onclick="removeExcercise(this.id,<?= $get_exrcisedirectories->id.$start_id ?>)">
        <i class="material-icons">clear</i> 
    </button>
             </td>
</tr>
<?php } ?>

