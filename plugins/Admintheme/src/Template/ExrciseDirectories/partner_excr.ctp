<?= $this->Form->control('exrcisedirectorie_id', ['class' => 'form-control select2', 'type' => 'select', 'empty' => __('Select Excercise'), 'options' => $get_exrcisedirectorie_lists , 'label'=>FALSE]) ?>
<script>
$(document).ready(function () {
        $('#exrcisedirectorie-id').select2();
    });
</script>                            