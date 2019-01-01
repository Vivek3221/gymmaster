<?php
    if($first == 'yes') {
        $get_dietdirectories_lists = $this->Common->getDietsDirectoriesm();
        foreach ($get_dietdirectories_lists as $key=>$get_dietdirectories_list){
            if($key == $dietdirectories_id) {
?>
<div class="row" id="getdiets<?= $key ?>" style="margin-bottom: 10px" >
    
    <span class=""> <p class="text-primary"><?=  ucfirst($get_dietdirectories_list) ?></p></span>
    <span class="pull-right" id="getdietsmore">
        <button type="button" class="btn btn-default btn-sm" id="<?= $key ?>" onclick="get_Dietsmore(this.id)">
            <i class="material-icons">add</i> 
        </button>
    </span>
     <button type="button" class="btn btn-default btn-sm pull-right " id="<?= $key ?>" onclick="removeExcerciseall(this.id)">
            <i class="material-icons">clear</i> 
        </button>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-highlight">
      <thead>
          <?php $ex_name = $this->Common->getDietDirectoriesname($key) ?>
        <th><?= ucfirst($ex_name->technical1) ?></th>
        <th><?= ucfirst($ex_name->technical2) ?></th>
        <th><?= ucfirst($ex_name->technical3) ?></th>
        <th><?= ucfirst($ex_name->technical4) ?></th>
          <th><?= ucfirst($ex_name->technical5) ?></th>
        <th>Remove</th>
      </thead>
      <tbody id="addmore<?= $key ?>" >
          <tr id="remove<?= $get_dietdirectories->id.$start_id ?>" class="<?=$start_id ?>">
            <td hidden> 
                <input type="text" id="<?= $dietdirectories_id ?>" value="<?= $dietdirectories_id ?>" hidden>
                </td>
           <td> 
                    <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical1 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'a'.$get_dietdirectories->id.$start_id, 'label' => false, 'required']) ?> 

           </td>
             <td>
                    <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical2 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'b'.$get_dietdirectories->id.$start_id,'label' => false, 'required']) ?> 
              </td>
             <td>
                    <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' .  $get_dietdirectories->technical3 . ']', ['class' => 'form-control','id'=>'d'.$get_dietdirectories->id.$start_id, 'type' => 'text', 'label' => false, 'required']) ?> 
             </td>
              <td>
                    <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical4 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'c'.$get_dietdirectories->id.$start_id, 'label' => false, 'required', '']) ?> 
             </td>
             <td>
                    <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical5 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'e'.$get_dietdirectories->id.$start_id, 'label' => false, 'required', '']) ?> 
             </td>
                <td>
            <button type="button" class="btn btn-default btn-sm" id="<?= $get_dietdirectories->id.$start_id ?>" onclick="removeExcercise(this.id,<?= $get_dietdirectories->id.$start_id ?>)">
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
<tr id="remove<?= $get_dietdirectories->id.$start_id ?>" class="<?=$start_id ?>">
        <td hidden> 
            <input type="text" id="<?= $dietdirectories_id ?>" value="<?= $dietdirectories_id ?>" hidden>
            </td>
       <td> 
                <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical1 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'a'.$get_dietdirectories->id.$start_id, 'label' => false, 'required']) ?> 
           
       </td>
         <td>
                <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical2 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'b'.$get_dietdirectories->id.$start_id,'label' => false, 'required']) ?> 
          </td>
         <td>
                <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' .  $get_dietdirectories->technical3 . ']', ['class' => 'form-control','id'=>'d'.$get_dietdirectories->id.$start_id, 'type' => 'text', 'label' => false, 'required']) ?> 
         </td>
          <td>
                <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical4 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'c'.$get_dietdirectories->id.$start_id, 'label' => false, 'required', '']) ?> 
         </td>
         <td>
                <?= $this->Form->control('excrcise['.$get_dietdirectories->id . '][' . $new_id . '][' . $get_dietdirectories->technical5 . ']', ['class' => 'form-control', 'type' => 'text','id'=>'e'.$get_dietdirectories->id.$start_id, 'label' => false, 'required', '']) ?> 
         </td>
            <td>
        <button type="button" class="btn btn-default btn-sm" id="<?= $get_dietdirectories->id.$start_id ?>" onclick="removeExcercise(this.id,<?= $get_dietdirectories->id.$start_id ?>)">
        <i class="material-icons">clear</i> 
    </button>
             </td>
</tr>
<?php } ?>

