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


