<?php
$status = $this->Common->getstatus();
$user_type = $this->Common->getType();
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render() ?>
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= __('Enquery Form') ?>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="form-btn text-center">

                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $user_id]) ?>" class="btn btn-primary waves-effect">Make Payment</a>
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="btn btn-primary waves-effect">Later Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm', lang: 'fr', weekStart: 1, cancelText: 'Cancel', maxDate: new Date()});
        $('').bootstrapMaterialDatePicker({format: 'DD/MM/YYYY HH:mm', minDate: new Date()});
    });

</script>