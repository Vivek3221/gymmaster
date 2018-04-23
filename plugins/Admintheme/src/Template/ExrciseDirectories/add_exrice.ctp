<div class="body">
<div class="form-group row" id="remove<?= $get_exrcisedirectories->id ?>">
  <div>
    <div class="col-xs-6">
    <span class="pull-left"> <?= ucfirst($get_exrcisedirectories->name) ?></span>
    </div>
    <div class="col-xs-6">
 <span class="pull-right">
     <button type="button" class="btn btn-default btn-sm" id="<?= $get_exrcisedirectories->id ?>" onclick="removeExcercise(this.id,<?= $get_exrcisedirectories->id ?>)">
        <i class="material-icons">clear</i> 
    </button></span>
    </div>
    </div> 
    
    
    
    <div class="col-md-3"> 
        <div class="form-group form-float">
            <label class="form-label"><?= ucfirst($get_exrcisedirectories->tecnical1) ?></label>
            <div class="form-line">
                <?= $this->Form->control($get_exrcisedirectories->name . '[' . $get_exrcisedirectories->tecnical1 . ']', ['class' => 'form-control', 'type' => 'text', 'label' => false, 'required']) ?> 
            </div>

        </div>
    </div>
    <div class="col-md-3"> 
        <div class="form-group form-float">
            <label class="form-label"><?= ucfirst($get_exrcisedirectories->tecnical2) ?></label>
            <div class="form-line">
                <?= $this->Form->control($get_exrcisedirectories->name . '[' . $get_exrcisedirectories->tecnical2 . ']', ['class' => 'form-control', 'type' => 'text', 'label' => false, 'required']) ?> 
            </div>

        </div>
    </div>
    <div class="col-md-3"> 
        <div class="form-group form-float">
            <label class="form-label"><?= ucfirst($get_exrcisedirectories->tecnical3) ?></label>
            <div class="form-line">
                <?= $this->Form->control($get_exrcisedirectories->name . '[' . $get_exrcisedirectories->tecnical3 . ']', ['class' => 'form-control', 'type' => 'text', 'label' => false, 'required']) ?> 
            </div>

        </div>
    </div>
    <div class="col-md-3"> 
        <div class="form-group form-float">
            <label class="form-label"><?= ucfirst($get_exrcisedirectories->tecnical4) ?></label>
            <div class="form-line">
                <?= $this->Form->control($get_exrcisedirectories->name . '[' . $get_exrcisedirectories->tecnical4 . ']', ['class' => 'form-control', 'type' => 'text', 'label' => false, 'required']) ?> 
            </div>
        </div>
    </div>
</div>
</div>
