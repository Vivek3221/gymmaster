<?= $this->Form->control('dietdirectories_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Diets'), 'options' => $get_exrcisedirectorie_lists , 'label'=>FALSE]) ?>
<script>
$(document).ready(function () {
        $('#exrcisedirectorie-id').select2();
    });
</script>                            