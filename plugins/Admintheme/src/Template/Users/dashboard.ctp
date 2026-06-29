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
        background: linear-gradient(135deg, var(--theme-color-start) 0%, var(--theme-color-end) 100%);
        color: #ffffff !important;
        border-radius: 14px;
        padding: 24px;
        border: none !important;
        box-shadow: 0 8px 24px var(--theme-shadow);
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
        display: none;
    }
    .modern-dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px var(--theme-shadow);
    }

    .card-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff !important;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    .modern-dashboard-card:hover .card-icon-wrapper {
        background: #ffffff;
        color: var(--theme-color-start) !important;
        transform: scale(1.08);
    }

    .card-details {
        flex: 1;
        min-width: 0;
    }
    .card-details .card-label {
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.8) !important;
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
        color: #ffffff !important;
        line-height: 1.2;
    }

    /* Color variables classes */
    .color-users {
        --theme-color-start: #00c6ff;
        --theme-color-end: #0072ff;
        --theme-shadow: rgba(0, 114, 255, 0.25);
    }
    .color-exercise {
        --theme-color-start: #f857a6;
        --theme-color-end: #ff5858;
        --theme-shadow: rgba(255, 88, 88, 0.25);
    }
    .color-body {
        --theme-color-start: #11998e;
        --theme-color-end: #38ef7d;
        --theme-shadow: rgba(56, 239, 125, 0.25);
    }
    .color-fitness {
        --theme-color-start: #fc4a1a;
        --theme-color-end: #f7b733;
        --theme-shadow: rgba(247, 183, 51, 0.25);
    }
    .color-session {
        --theme-color-start: #7F00FF;
        --theme-color-end: #E100FF;
        --theme-shadow: rgba(225, 0, 255, 0.25);
    }
    .color-trainers {
        --theme-color-start: #396afc;
        --theme-color-end: #2948ff;
        --theme-shadow: rgba(41, 72, 255, 0.25);
    }

    /* Modern Glassmorphic Modal */
    .dashboard-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dashboard-modal-backdrop.active {
        opacity: 1;
        visibility: visible;
    }
    .dashboard-modal {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
        width: 90%;
        max-width: 550px;
        transform: translateY(30px) scale(0.95);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    .dashboard-modal-backdrop.active .dashboard-modal {
        transform: translateY(0) scale(1);
    }
    .dashboard-modal-header {
        padding: 24px 28px 16px 28px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .dashboard-modal-header i {
        font-size: 28px;
    }
    .dashboard-modal-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
    }
    .dashboard-modal-body {
        padding: 24px 28px;
        max-height: 350px;
        overflow-y: auto;
    }
    .dashboard-modal-footer {
        padding: 16px 28px 24px 28px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    .dashboard-modal-btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
    }
    .btn-close-modal {
        background: #f1f5f9;
        color: #475569;
    }
    .btn-close-modal:hover {
        background: #e2e8f0;
    }
    .btn-action-modal {
        background: #ff9800;
        color: #fff;
    }
    .btn-action-modal:hover {
        background: #e68a00;
        box-shadow: 0 4px 12px rgba(255, 152, 0, 0.25);
    }

    /* Modal Lists */
    .modal-table {
        width: 100%;
        border-collapse: collapse;
    }
    .modal-table th {
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
    }
    .modal-table td {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #334155;
    }
    .modal-table tr:last-child td {
        border-bottom: none;
    }
    .expire-badge {
        background: #ffebee;
        color: #c62828;
        padding: 3px 8px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Confetti/Celebration styles for Birthday */
    .birthday-header {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
        color: #fff !important;
        border-bottom: none;
        position: relative;
    }
    .birthday-header h3 {
        color: #fff !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .birthday-header i {
        color: #fff !important;
    }
    .birthday-user-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        margin-bottom: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .birthday-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #ffe0b2;
        color: #fb8c00;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
    }
    .birthday-info h4 {
        margin: 0 0 4px 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }
    .birthday-info p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
    }
    .cake-animation {
        text-align: center;
        font-size: 64px;
        margin-bottom: 16px;
        animation: wobble 2s infinite;
    }
    @keyframes wobble {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-8deg); }
        75% { transform: rotate(8deg); }
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

        <!-- Collection Graph Row (only for Admin, Partner, Trainer) -->
        <?php if (in_array($usersdetail['users_type'], ['1', '2', '4'])): ?>
            <div class="row clearfix" style="margin-top: 10px; margin-bottom: 24px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card modern-card" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #eaeaea; overflow: hidden; background: #fff;">
                        <div class="header" style="background: #fafafa; border-bottom: 1px solid #eaeaea; padding: 20px 24px; display: flex; align-items: center; gap: 10px;">
                            <i class="material-icons" style="color: #ff9800;">insert_chart</i>
                            <h2 style="font-size: 16px; font-weight: 700; color: #333; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">
                                <?= __('Monthly Collections Trend (Last 6 Months)') ?>
                            </h2>
                        </div>
                        <div class="body" style="padding: 24px;">
                            <div style="position: relative; height: 320px; width: 100%;">
                                <canvas id="collectionTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Expired Plans Modal (For Partner) -->
    <?php if (!empty($expiredMembers)) { ?>
        <div id="expiredPlansModal" class="dashboard-modal-backdrop">
            <div class="close-backdrop" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>
            <div class="dashboard-modal">
                <div class="dashboard-modal-header" style="border-left: 6px solid #f44336;">
                    <i class="material-icons" style="color: #f44336;">warning</i>
                    <h3><?= __('Expired Plan Alerts') ?></h3>
                </div>
                <div class="dashboard-modal-body">
                    <p style="margin-top: 0; margin-bottom: 16px; color: #64748b; font-size: 14px;">
                        <?= __('The following users have expired subscription plans. Please notify them or renew their plans.') ?>
                    </p>
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th><?= __('User Name') ?></th>
                                <th><?= __('Expired Plan') ?></th>
                                <th><?= __('Expiry Date') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expiredMembers as $member) { ?>
                                <tr>
                                    <td style="font-weight: 600; color: #1e293b;"><?= h($member['user_name']) ?></td>
                                    <td><?= h($member['plan_name']) ?></td>
                                    <td><span class="expire-badge"><?= h($member['expire_date']) ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="dashboard-modal-footer">
                    <button class="dashboard-modal-btn btn-close-modal"><?= __('Dismiss') ?></button>
                    <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="dashboard-modal-btn btn-action-modal">
                        <i class="material-icons" style="font-size: 16px;">autorenew</i> <?= __('Manage Subscriptions') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Birthday Celebration Modal (For Admin, Partner, Trainer) -->
    <?php if (!empty($birthdayMembers)) { ?>
        <div id="birthdayCelebrationModal" class="dashboard-modal-backdrop">
            <div class="close-backdrop" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>
            <div class="dashboard-modal">
                <div class="dashboard-modal-header birthday-header">
                    <i class="material-icons">cake</i>
                    <h3><?= __('Today\'s Birthdays!') ?></h3>
                </div>
                <div class="dashboard-modal-body">
                    <div class="cake-animation">🎂🎉</div>
                    <p style="margin-top: 0; margin-bottom: 16px; color: #475569; font-size: 15px; font-weight: 600; text-align: center;">
                        <?= __('Wish a very Happy Birthday to our amazing gym members celebrating today!') ?>
                    </p>
                    <div style="margin-top: 15px;">
                        <?php foreach ($birthdayMembers as $bMember) { ?>
                            <div class="birthday-user-card">
                                <div class="birthday-avatar">
                                    <?= strtoupper(substr($bMember->name, 0, 1)) ?>
                                </div>
                                <div class="birthday-info">
                                    <h4><?= h($bMember->name) ?></h4>
                                    <p><i class="material-icons" style="font-size: 12px; vertical-align: middle;">phone</i> <?= h($bMember->mobile_no) ?></p>
                                </div>
                                <div style="margin-left: auto;">
                                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $bMember->mobile_no) ?>?text=Happy%20Birthday%20<?= urlencode($bMember->name) ?>!%20Have%20a%20great%20day%20ahead!%20-%20From%20Gym%20Management" target="_blank" class="btn btn-xs btn-success waves-effect" style="background-color: #25D366 !important; color: white !important; font-weight: 700; border-radius: 6px; padding: 4px 10px; display: inline-flex; align-items: center; gap: 4px; border: none; font-size: 11px; text-decoration: none;">
                                        WhatsApp
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="dashboard-modal-footer">
                    <button class="dashboard-modal-btn btn-close-modal"><?= __('Close') ?></button>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Personal Birthday Greeting (For User) -->
    <?php if ($isMyBirthday) { ?>
        <div id="userPersonalBirthdayModal" class="dashboard-modal-backdrop">
            <div class="close-backdrop" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>
            <div class="dashboard-modal">
                <div class="dashboard-modal-header birthday-header" style="background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);">
                    <i class="material-icons">star</i>
                    <h3><?= __('Happy Birthday to You!') ?></h3>
                </div>
                <div class="dashboard-modal-body" style="text-align: center;">
                    <div class="cake-animation">🎂✨🎈</div>
                    <h3 style="margin-top: 0; margin-bottom: 8px; color: #1e293b; font-weight: 800;">
                        <?= __('Happy Birthday, {0}!', h($usersdetail['users_name'])) ?>
                    </h3>
                    <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 0;">
                        <?= __('We wish you a fantastic day filled with joy, good health, and success in reaching all your fitness goals! Thank you for being a valued member of our gym.') ?>
                    </p>
                </div>
                <div class="dashboard-modal-footer">
                    <button class="dashboard-modal-btn btn-close-modal" style="background: #3f51b5; color: #fff; width: 100%; justify-content: center;"><?= __('Thank You! 😊') ?></button>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var expiredModal = $('#expiredPlansModal');
            var birthdayModal = $('#birthdayCelebrationModal');
            var userBirthdayModal = $('#userPersonalBirthdayModal');

            // Queue of modals to show
            var modalQueue = [];

            if (expiredModal.length > 0) {
                modalQueue.push(expiredModal);
            }
            if (birthdayModal.length > 0) {
                modalQueue.push(birthdayModal);
            }
            if (userBirthdayModal.length > 0) {
                modalQueue.push(userBirthdayModal);
            }

            function showNextModal() {
                if (modalQueue.length === 0) return;
                var nextModal = modalQueue.shift();
                
                // Show modal with animation class
                nextModal.addClass('active');

                nextModal.find('.btn-close-modal, .btn-action-modal, .close-backdrop').on('click', function(e) {
                    if ($(this).hasClass('btn-action-modal') && $(this).attr('href')) {
                        // Allow navigation for action button
                        return true;
                    }
                    e.preventDefault();
                    nextModal.removeClass('active');
                    // Give transition time then show next
                    setTimeout(showNextModal, 400);
                });
            }

            // Start modal sequence
            setTimeout(showNextModal, 600);

            // Render Collection Trend Chart
            var chartEl = document.getElementById('collectionTrendChart');
            if (chartEl) {
                var labels = <?php echo json_encode($chartLabels); ?>;
                var dataValues = <?php echo json_encode($chartValues); ?>;
                
                new Chart(chartEl, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '<?= __("Collection (₹)") ?>',
                            data: dataValues,
                            borderColor: '#ff9800',
                            backgroundColor: 'rgba(255, 152, 0, 0.08)',
                            borderWidth: 3,
                            pointBackgroundColor: '#ff9800',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.35,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.dataset.label + ': ' + new Intl.NumberFormat('en-IN').format(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f3f4f6'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return '₹' + new Intl.NumberFormat('en-IN').format(value);
                                    },
                                    color: '#718096',
                                    font: {
                                        weight: '600'
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#718096',
                                    font: {
                                        weight: '600'
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</section>