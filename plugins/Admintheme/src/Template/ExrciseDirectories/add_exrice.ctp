
<span  id="remove<?= $get_exrcisedirectories->id.$start_id ?>">
   

    <input type="text" id="<?= $exrcisedirectorie_id ?>" value="<?= $exrcisedirectorie_id ?>" hidden>
   
<?php if($start_id == "100"){ ?>
<tr>
    
    <th><?= ucfirst($get_exrcisedirectories->tecnical1); ?> </th>
    <th><?= ucfirst($get_exrcisedirectories->tecnical2); ?></th>
    <th><?= ucfirst($get_exrcisedirectories->tecnical3); ?></th>
    <th><?= ucfirst($get_exrcisedirectories->tecnical4); ?> </th>
    <th><?= ucfirst('action') ?></th>
  
 </tr>
<?php } ?>
    <tr>
        <td> 

            <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical1 . ']', [ 'type' => 'text','id'=>'a'.$get_exrcisedirectories->id.$start_id, 'templates' => [
                    'inputContainer' => '{{content}}'
                ], 'label' => false, 'required']) ?> 
        <td/>
        <td>
             <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical2 . ']', [ 'type' => 'text','id'=>'b'.$get_exrcisedirectories->id.$start_id, 'templates' => [
            'inputContainer' => '{{content}}'
        ], 'onkeyup'=>'getSum2(this.id)','label' => false, 'required']) ?> 
        </td>
        <td>
             
                    <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' .  $get_exrcisedirectories->tecnical3 . ']', [ 'type' => 'text','id'=>'d'.$get_exrcisedirectories->id.$start_id, 'label' => false, 'templates' => [
            'inputContainer' => '{{content}}'
        ], 'required']) ?> 
              
        </td>
        <td>
               <?= $this->Form->control('excrcise['.$get_exrcisedirectories->id . '][' . $new_id . '][' . $get_exrcisedirectories->tecnical4 . ']', [ 'type' => 'text','id'=>'c'.$get_exrcisedirectories->id.$start_id, 'templates' => [
            'inputContainer' => '{{content}}'
        ], 'label' => false, 'required', 'readonly']) ?> 
        </td>
        <td >
        <button type="button" class="btn btn-default btn-sm" id="<?= $get_exrcisedirectories->id.$start_id ?>" onclick="removeExcercise(this.id,<?= $get_exrcisedirectories->id.$start_id ?>)">
            <i class="material-icons">clear</i> 
        </button>
        </td>
    </tr>
    

</span>

