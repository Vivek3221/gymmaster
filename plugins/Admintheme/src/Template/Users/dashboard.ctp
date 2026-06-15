<style>
    /* Modern Dashboard Styling */
    .dashboard-header {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 35px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border: 1px solid #eaeaea;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    .dashboard-header-left h1 {
        font-size: 26px;
        font-weight: 800;
        color: #1a202c;
        margin: 0 0 6px 0;
        letter-spacing: -0.5px;
    }
    .dashboard-header-left p {
        color: #718096;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }
    .dashboard-header-right {
        background: #f7fafc;
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid #edf2f7;
        font-size: 13px;
        font-weight: 600;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .dashboard-header-right i {
        color: #ff9800;
        font-size: 18px;
    }

    .modern-card-link {
        text-decoration: none !important;
        display: block;
        height: 100%;
        margin-bottom: 24px;
    }

    .modern-dashboard-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        overflow: hidden;
        height: 100%;
        min-height: 112px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .modern-dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--theme-color);
        opacity: 0.85;
    }
    .modern-dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px var(--theme-shadow);
        border-color: var(--theme-color);
    }

    .card-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        background: var(--theme-light);
        color: var(--theme-color);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    .modern-dashboard-card:hover .card-icon-wrapper {
        background: var(--theme-color);
        color: #ffffff;
        transform: scale(1.08);
    }

    .card-details {
        flex: 1;
        min-width: 0; /* Enables text truncation if needed */
    }
    .card-details .card-label {
        font-size: 11px;
        font-weight: 700;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-details .card-val {
        font-size: 20px;
        font-weight: 800;
        color: #2d3748;
        line-height: 1.2;
    }

    /* Color variables classes */
    .color-users {
        --theme-color: #00bcd4;
        --theme-light: #e0f7fa;
        --theme-shadow: rgba(0, 188, 212, 0.15);
    }
    .color-exercise {
        --theme-color: #e91e63;
        --theme-light: #fce4ec;
        --theme-shadow: rgba(233, 30, 99, 0.15);
    }
    .color-body {
        --theme-color: #8bc34a;
        --theme-light: #f1f8e9;
        --theme-shadow: rgba(139, 195, 74, 0.15);
    }
    .color-fitness {
        --theme-color: #ff9800;
        --theme-light: #fff3e0;
        --theme-shadow: rgba(255, 152, 0, 0.15);
    }
    .color-session {
        --theme-color: #9c27b0;
        --theme-light: #f3e5f5;
        --theme-shadow: rgba(156, 39, 176, 0.15);
    }
    .color-trainers {
        --theme-color: #3f51b5;
        --theme-light: #e8eaf6;
        --theme-shadow: rgba(63, 81, 181, 0.15);
    }
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Modern Header -->
        <div class="dashboard-header">
            <div class="dashboard-header-left">
                <h1><?= __('Dashboard') ?></h1>
                <p><?= __('Welcome back,') ?> <span style="color: #ff9800; font-weight: 700;"><?= h($usersdetail['users_name']) ?></span>! <?= __('Here is a summary of your gym administration.') ?></p>
            </div>
            <div class="dashboard-header-right">
                <i class="material-icons">query_builder</i>
                <span><?= date('l, d M Y') ?></span>
            </div>
        </div>

        <!-- Widgets Row -->
        <div class="row clearfix">
            
            <!-- Users Card -->
            <?php if (($usersdetail['users_type'] != 3) && ($usersdetail['users_type'] != 4)) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>" class="modern-card-link">
                        <div class="modern-dashboard-card color-users">
                            <div class="card-icon-wrapper">
                                <i class="material-icons">people</i>
                            </div>
                            <div class="card-details">
                                <div class="card-label"><?= __('Users') ?></div>
                                <div class="card-val count-to" data-from="0" data-to="<?= $users_count ?>" data-speed="1000" data-fresh-interval="20"><?= $users_count ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

            <!-- Exercise Directory Card -->
            <?php if (($usersdetail['users_type'] != 3) && ($usersdetail['users_type'] != 4)) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="<?= $this->Url->build(['controller' => 'ExrciseDirectories', 'action' => 'index']); ?>" class="modern-card-link">
                        <div class="modern-dashboard-card color-exercise">
                            <div class="card-icon-wrapper">
                                <i class="material-icons">fitness_center</i>
                            </div>
                            <div class="card-details">
                                <div class="card-label"><?= __('Exercises') ?></div>
                                <div class="card-val"><?= __('View Directory') ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

            <!-- Body Measurement Card -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="<?= $this->Url->build(['controller' => 'FitnessMeserments', 'action' => 'index']); ?>" class="modern-card-link">
                    <div class="modern-dashboard-card color-body">
                        <div class="card-icon-wrapper">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="card-details">
                            <div class="card-label"><?= __('Measurements') ?></div>
                            <div class="card-val"><?= __('Body Stats') ?></div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Fitness Test Card -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="<?= $this->Url->build(['controller' => 'FitnessTests', 'action' => 'index']); ?>" class="modern-card-link">
                    <div class="modern-dashboard-card color-fitness">
                        <div class="card-icon-wrapper">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-details">
                            <div class="card-label"><?= __('Fitness Tests') ?></div>
                            <div class="card-val"><?= __('Track Performance') ?></div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Session Card -->
            <?php if ($usersdetail['users_type'] != 3) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>" class="modern-card-link">
                        <div class="modern-dashboard-card color-session">
                            <div class="card-icon-wrapper">
                                <i class="material-icons">schedule</i>
                            </div>
                            <div class="card-details">
                                <div class="card-label"><?= __('Sessions') ?></div>
                                <div class="card-val"><?= __('Manage Sessions') ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

            <!-- Report Session Card (for User Type 3) -->
            <?php if ($usersdetail['users_type'] == 3) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="<?= $this->Url->build(['controller' => 'Sessions', 'action' => 'index']); ?>" class="modern-card-link">
                        <div class="modern-dashboard-card color-session">
                            <div class="card-icon-wrapper">
                                <i class="material-icons">assessment</i>
                            </div>
                            <div class="card-details">
                                <div class="card-label"><?= __('Report Session') ?></div>
                                <div class="card-val"><?= __('View Reports') ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

            <!-- Trainers Card (for User Type 2) -->
            <?php if ($usersdetail['users_type'] == 2) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'trainerList']); ?>" class="modern-card-link">
                        <div class="modern-dashboard-card color-trainers">
                            <div class="card-icon-wrapper">
                                <i class="material-icons">supervisor_account</i>
                            </div>
                            <div class="card-details">
                                <div class="card-label"><?= __('Trainers') ?></div>
                                <div class="card-val"><?= __('View List') ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</section>