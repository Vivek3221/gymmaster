<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>           <div id="remove<?= $get_exrcisedirectories->id ?>">
    <p><?= $get_exrcisedirectories->name ?>  </p>
    <button type="button" class="btn btn-default btn-sm" id="<?= $get_exrcisedirectories->id ?>" onclick="removeExcercise(this.id,<?= $get_exrcisedirectories->id ?> )">
          <span class="glyphicon glyphicon-remove"></span> Remove 
        </button>
            <div class="col-md-3"> 
                        <div class="form-group form-float">
                             <label class="form-label"><?= $get_exrcisedirectories->tecnical1 ?></label>
                            <div class="form-line">
                   <?= $this->Form->control($get_exrcisedirectories->name.'['.$get_exrcisedirectories->tecnical1.']', ['class' => 'form-control', 'type' => 'text', 'label' => false ,'required']) ?> 
                       </div>
                           
                        </div>
                        </div>
                         <div class="col-md-3"> 
                        <div class="form-group form-float">
                                  <label class="form-label"><?= $get_exrcisedirectories->tecnical2 ?></label>
                            <div class="form-line">
                   <?= $this->Form->control($get_exrcisedirectories->name.'['.$get_exrcisedirectories->tecnical2.']', ['class' => 'form-control', 'type' => 'text', 'label' => false ,'required']) ?> 
                       </div>
                      
                        </div>
                        </div>
                         <div class="col-md-3"> 
                        <div class="form-group form-float">
                                       <label class="form-label"><?= $get_exrcisedirectories->tecnical3 ?></label>
                            <div class="form-line">
                   <?= $this->Form->control($get_exrcisedirectories->name.'['.$get_exrcisedirectories->tecnical3.']', ['class' => 'form-control', 'type' => 'text', 'label' => false ,'required']) ?> 
                       </div>
                 
                        </div>
                        </div>
                         <div class="col-md-3"> 
                        <div class="form-group form-float">
                    <label class="form-label"><?= $get_exrcisedirectories->tecnical4 ?></label>
                            <div class="form-line">
                   <?= $this->Form->control($get_exrcisedirectories->name.'['.$get_exrcisedirectories->tecnical4.']', ['class' => 'form-control', 'type' => 'text', 'label' => false ,'required']) ?> 
                       </div>
                        </div>
                        </div>
                        </div>
            