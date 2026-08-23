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

    /* Today's Follow-ups Modal Styles */
    .followup-modal-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: #fff !important;
        border-bottom: none;
        position: relative;
    }
    .followup-modal-header h3 {
        color: #fff !important;
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .followup-modal-header p {
        color: rgba(255, 255, 255, 0.8) !important;
        margin: 4px 0 0 0;
        font-size: 13px;
        font-weight: 500;
    }
    .followup-modal-header i {
        color: #fff !important;
    }
    .followup-modal-container {
        display: flex;
        height: 400px;
        background: #f8fafc;
        border-radius: 0 0 14px 14px;
        overflow: hidden;
    }
    .followup-sidebar {
        width: 200px;
        border-right: 1px solid #e2e8f0;
        background: #fff;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
    }
    .followup-sidebar-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
    }
    .followup-sidebar-item:hover {
        background: #f8fafc;
    }
    .followup-sidebar-item.active {
        background: #eff6ff;
        border-left: 4px solid #4f46e5;
    }
    .followup-sidebar-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0284c7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }
    .followup-sidebar-item.active .followup-sidebar-avatar {
        background: #dbeafe;
        color: #1e40af;
    }
    .followup-sidebar-info {
        min-width: 0;
    }
    .followup-sidebar-name {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .followup-sidebar-time {
        font-size: 11px;
        color: #64748b;
        margin-top: 2px;
    }
    .followup-detail-pane {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #f8fafc;
    }
    .followup-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        padding: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        margin-bottom: 0;
    }
    .followup-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 10px;
    }
    .followup-user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .followup-user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0284c7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
    }
    .followup-user-details h4 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }
    .followup-user-details p {
        margin: 2px 0 0 0;
        font-size: 12px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .followup-user-details p a {
        color: #64748b;
        text-decoration: none;
    }
    .followup-user-details p a:hover {
        color: #3b82f6;
    }
    .followup-status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 30px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .status-active {
        background-color: #ecfdf5;
        color: #047857;
    }
    .status-inactive {
        background-color: #fef2f2;
        color: #b91c1c;
    }
    .status-enquiry {
        background-color: #fffbeb;
        color: #b45309;
    }
    .followup-card-body {
        font-size: 13.5px;
        color: #334155;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .followup-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #475569;
    }
    .followup-meta-item i {
        font-size: 18px;
        color: #64748b;
    }
    .followup-remark-box {
        background-color: #f8fafc;
        border-left: 3px solid #cbd5e1;
        padding: 12px;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #475569;
        margin-top: 4px;
        line-height: 1.5;
    }
    .followup-empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    .followup-empty-icon {
        font-size: 64px;
        color: #94a3b8;
        margin-bottom: 16px;
    }
    .followup-empty-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 6px 0;
    }
    .followup-empty-text {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Front Desk Dashboard Styling */
    .frontdesk-dashboard-container {
        margin-bottom: 30px;
    }
    .fd-hero-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 18px;
        padding: 28px 32px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .fd-badge {
        display: inline-block;
        background: rgba(255, 152, 0, 0.2);
        color: #ff9800;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 6px 14px;
        border-radius: 30px;
        border: 1px solid rgba(255, 152, 0, 0.4);
        margin-bottom: 12px;
    }
    .fd-hero-content h2 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 8px 0;
        color: #fff;
    }
    .fd-hero-content p {
        font-size: 14px;
        color: #94a3b8;
        margin: 0;
        max-width: 600px;
    }
    .fd-hero-date {
        background: rgba(255, 255, 255, 0.08);
        padding: 10px 18px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #cbd5e1;
    }
    .fd-hero-date i {
        color: #ff9800;
    }
    .fd-section-title {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .fd-section-title i {
        color: #ff9800;
    }
    .fd-shortcut-card {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #fff;
        padding: 20px;
        border-radius: 14px;
        text-decoration: none !important;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
        margin-bottom: 20px;
    }
    .fd-shortcut-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.08);
    }
    .fd-shortcut-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        flex-shrink: 0;
    }
    .fd-card-blue .fd-shortcut-icon { background: linear-gradient(135deg, #00c6ff, #0072ff); }
    .fd-card-green .fd-shortcut-icon { background: linear-gradient(135deg, #11998e, #38ef7d); }
    .fd-card-orange .fd-shortcut-icon { background: linear-gradient(135deg, #ff9800, #f57c00); }
    .fd-card-purple .fd-shortcut-icon { background: linear-gradient(135deg, #7F00FF, #E100FF); }
    .fd-shortcut-info h4 {
        margin: 0 0 3px 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }
    .fd-shortcut-info p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
    }
    .fd-arrow {
        margin-left: auto;
        color: #cbd5e1;
        transition: all 0.3s ease;
    }
    .fd-shortcut-card:hover .fd-arrow {
        color: #1e293b;
        transform: translateX(4px);
    }
    .fd-matrix-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        height: 100%;
    }
    .fd-card-allowed { border-top: 4px solid #10b981; }
    .fd-card-restricted { border-top: 4px solid #ef4444; }
    .fd-matrix-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .fd-card-allowed .fd-matrix-header i { color: #10b981; font-size: 24px; }
    .fd-card-restricted .fd-matrix-header i { color: #ef4444; font-size: 24px; }
    .fd-matrix-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }
    .fd-matrix-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .fd-matrix-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .fd-card-allowed .fd-matrix-list li i { color: #10b981; font-size: 18px; margin-top: 2px; }
    .fd-card-restricted .fd-matrix-list li i { color: #ef4444; font-size: 18px; margin-top: 2px; }
    .fd-matrix-list li strong {
        display: block;
        font-size: 14px;
        color: #1e293b;
        margin-bottom: 2px;
    }
    .fd-matrix-list li span {
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
    }
</style>

<section class="content">
    <div class="container-fluid">

        <?php if (isset($usersdetail['users_type']) && $usersdetail['users_type'] == 5): ?>
            <!-- Front Desk Custom Command Center Dashboard Portal -->
            <div class="frontdesk-dashboard-container" style="margin-bottom: 30px;">
                <!-- Hero Welcome Header -->
                <div class="fd-hero-card" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-radius: 18px; padding: 28px 32px; color: #fff; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15); margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
                    <div class="fd-hero-content">
                        <div class="fd-badge" style="display: inline-block; background: rgba(255, 152, 0, 0.2); color: #ff9800; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; padding: 6px 14px; border-radius: 30px; border: 1px solid rgba(255, 152, 0, 0.4); margin-bottom: 12px;">
                            <i class="material-icons" style="font-size: 14px; vertical-align: middle;">badge</i> <?= __('Front Desk Portal') ?>
                        </div>
                        <h2 style="font-size: 24px; font-weight: 800; margin: 0 0 8px 0; color: #fff;"><?= __('Welcome Back,') ?> <?= h($usersdetail['users_name']) ?>! 👋</h2>
                        <p style="font-size: 14px; color: #94a3b8; margin: 0; max-width: 600px;"><?= __('Manage member inquiries, add new walk-in leads, process gym plan payments, and view membership records.') ?></p>
                    </div>
                    <div class="fd-hero-date" style="background: rgba(255, 255, 255, 0.08); padding: 10px 18px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.1); display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #cbd5e1;">
                        <i class="material-icons" style="color: #ff9800;">event</i>
                        <span><?= date('l, d F Y') ?></span>
                    </div>
                </div>

                <!-- Quick Access Shortcuts Grid -->
                <div class="fd-section-title" style="font-size: 15px; font-weight: 800; color: #1e293b; margin-bottom: 15px; display: flex; align-items: center; gap: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="material-icons" style="color: #ff9800;">bolt</i> <?= __('Quick Action Shortcuts') ?>
                </div>
                <div class="row clearfix fd-actions-grid">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="fd-shortcut-card fd-card-blue" style="display: flex; align-items: center; gap: 16px; background: #fff; padding: 20px; border-radius: 14px; text-decoration: none !important; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 20px; transition: all 0.3s ease;">
                            <div class="fd-shortcut-icon" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; flex-shrink: 0; background: linear-gradient(135deg, #00c6ff, #0072ff);"><i class="material-icons" style="color:#fff;">people</i></div>
                            <div class="fd-shortcut-info">
                                <h4 style="margin: 0 0 3px 0; font-size: 15px; font-weight: 700; color: #1e293b;"><?= __('Users List') ?></h4>
                                <p style="margin: 0; font-size: 12px; color: #64748b;"><?= __('Search & view members list') ?></p>
                            </div>
                            <i class="material-icons fd-arrow" style="margin-left: auto; color: #cbd5e1;">arrow_forward</i>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="fd-shortcut-card fd-card-green" style="display: flex; align-items: center; gap: 16px; background: #fff; padding: 20px; border-radius: 14px; text-decoration: none !important; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 20px; transition: all 0.3s ease;">
                            <div class="fd-shortcut-icon" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; flex-shrink: 0; background: linear-gradient(135deg, #11998e, #38ef7d);"><i class="material-icons" style="color:#fff;">person_add</i></div>
                            <div class="fd-shortcut-info">
                                <h4 style="margin: 0 0 3px 0; font-size: 15px; font-weight: 700; color: #1e293b;"><?= __('Add Enquiry') ?></h4>
                                <p style="margin: 0; font-size: 12px; color: #64748b;"><?= __('Register new lead or client') ?></p>
                            </div>
                            <i class="material-icons fd-arrow" style="margin-left: auto; color: #cbd5e1;">arrow_forward</i>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="fd-shortcut-card fd-card-orange" style="display: flex; align-items: center; gap: 16px; background: #fff; padding: 20px; border-radius: 14px; text-decoration: none !important; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 20px; transition: all 0.3s ease;">
                            <div class="fd-shortcut-icon" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; flex-shrink: 0; background: linear-gradient(135deg, #ff9800, #f57c00);"><i class="material-icons" style="color:#fff;">loyalty</i></div>
                            <div class="fd-shortcut-info">
                                <h4 style="margin: 0 0 3px 0; font-size: 15px; font-weight: 700; color: #1e293b;"><?= __('Plan Subscribe') ?></h4>
                                <p style="margin: 0; font-size: 12px; color: #64748b;"><?= __('View active member plans') ?></p>
                            </div>
                            <i class="material-icons fd-arrow" style="margin-left: auto; color: #cbd5e1;">arrow_forward</i>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= $this->Url->build(['controller' => 'Payments', 'action' => 'index']) ?>" class="fd-shortcut-card fd-card-purple" style="display: flex; align-items: center; gap: 16px; background: #fff; padding: 20px; border-radius: 14px; text-decoration: none !important; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 20px; transition: all 0.3s ease;">
                            <div class="fd-shortcut-icon" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; flex-shrink: 0; background: linear-gradient(135deg, #7F00FF, #E100FF);"><i class="material-icons" style="color:#fff;">payment</i></div>
                            <div class="fd-shortcut-info">
                                <h4 style="margin: 0 0 3px 0; font-size: 15px; font-weight: 700; color: #1e293b;"><?= __('Payments List') ?></h4>
                                <p style="margin: 0; font-size: 12px; color: #64748b;"><?= __('View payment transactions') ?></p>
                            </div>
                            <i class="material-icons fd-arrow" style="margin-left: auto; color: #cbd5e1;">arrow_forward</i>
                        </a>
                    </div>
                </div>

                <!-- Role Overview & Capability Matrix -->
                <div class="row clearfix fd-matrix-row" style="margin-top: 15px;">
                    <!-- Permitted Operations -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="fd-matrix-card fd-card-allowed" style="background: #fff; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-top: 4px solid #10b981; height: 100%;">
                            <div class="fd-matrix-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                                <i class="material-icons" style="color: #10b981; font-size: 24px;">check_circle</i>
                                <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #1e293b;"><?= __('Permitted Front Desk Actions') ?></h3>
                            </div>
                            <ul class="fd-matrix-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #10b981; font-size: 18px; margin-top: 2px;">done</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('Search & View Members List') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Look up existing members, search by name/mobile, and check profile information.') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #10b981; font-size: 18px; margin-top: 2px;">done</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('Register New Walk-in Enquiries') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Capture new lead registrations and walk-in client details (`Users/add`).') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #10b981; font-size: 18px; margin-top: 2px;">done</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('Add Payment & Assign Plans') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Process payments (`Users/payment/{id}`) and subscribe members to active gym plans.') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #10b981; font-size: 18px; margin-top: 2px;">done</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('View Payment & Subscription Logs') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Access read-only lists for plan subscribers and past payment records.') ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Restricted Operations -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="fd-matrix-card fd-card-restricted" style="background: #fff; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-top: 4px solid #ef4444; height: 100%;">
                            <div class="fd-matrix-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                                <i class="material-icons" style="color: #ef4444; font-size: 24px;">lock</i>
                                <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #1e293b;"><?= __('Restricted Actions (Protected)') ?></h3>
                            </div>
                            <ul class="fd-matrix-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px;">
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #ef4444; font-size: 18px; margin-top: 2px;">block</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('No Edit or Delete Permissions') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Front desk users cannot edit or delete user accounts, payment history, or plan records.') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #ef4444; font-size: 18px; margin-top: 2px;">block</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('No Data Exports & Financial Reports') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Exporting client contacts, CSV data, and financial reporting views are hidden & blocked.') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #ef4444; font-size: 18px; margin-top: 2px;">block</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('No Plan Creation or Pricing Edits') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Adding or modifying gym membership plans, pricing, or durations is locked.') ?></span>
                                    </div>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="material-icons" style="color: #ef4444; font-size: 18px; margin-top: 2px;">block</i>
                                    <div>
                                        <strong style="display: block; font-size: 14px; color: #1e293b; margin-bottom: 2px;"><?= __('No Trainer & Workout Management') ?></strong>
                                        <span style="font-size: 12px; color: #64748b; line-height: 1.4;"><?= __('Access to trainer lists, workout directories, body measurements, and sessions is restricted.') ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Modern Header for Admin / Partner / Trainer / Client -->
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
                <?php if (!in_array($usersdetail['users_type'], [3, 4, 5])) { ?>
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
                <?php if (!in_array($usersdetail['users_type'], [5])) { ?>
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
                <?php } ?>

                <!-- Fitness Test Card -->
                <?php if (!in_array($usersdetail['users_type'], [5])) { ?>
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
                <?php } ?>

                <!-- Session Card -->
                <?php if (!in_array($usersdetail['users_type'], [3, 5])) { ?>
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

    <?php
    $showFollowupsModal = (!empty($usersdetail['users_type']) && in_array($usersdetail['users_type'], ['1', '2', '4']));
    ?>

    <!-- Today's Follow-ups Modal (For Admin, Partner, Trainer) -->
    <?php if ($showFollowupsModal) { ?>
        <div id="todayFollowupsModal" class="dashboard-modal-backdrop">
            <div class="close-backdrop" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>
            <div class="dashboard-modal" style="max-width: 680px; width: 90%;">
                <div class="dashboard-modal-header followup-modal-header" style="padding-bottom: 12px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="material-icons" style="font-size: 28px;">assignment_turned_in</i>
                            <div>
                                <h3 style="margin: 0; font-size: 18px;"><?= __('Today\'s Follow-ups') ?></h3>
                                <p style="margin: 0; opacity: 0.85; font-size: 12px;"><?= date('d M Y') ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- 2-Tab Navigation Bar -->
                    <div class="followup-modal-tabs" style="display: flex; gap: 8px; margin-top: 12px;">
                        <button class="followup-modal-tab active" id="tabTakenToday" data-tab="taken" style="padding: 6px 14px; border-radius: 20px; border: none; font-size: 12px; font-weight: 600; cursor: pointer; background: #ffffff; color: #4f46e5; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <i class="material-icons" style="font-size: 15px;">call</i> <?= __('Taken Today') ?> <span id="takenCountBadge" class="badge" style="background: #4f46e5; color: #fff; border-radius: 10px; padding: 2px 6px; font-size: 11px;">0</span>
                        </button>
                        <button class="followup-modal-tab" id="tabScheduledToday" data-tab="scheduled" style="padding: 6px 14px; border-radius: 20px; border: none; font-size: 12px; font-weight: 600; cursor: pointer; background: rgba(255,255,255,0.25); color: #ffffff; display: flex; align-items: center; gap: 6px;">
                            <i class="material-icons" style="font-size: 15px;">event</i> <?= __('Scheduled Today') ?> <span id="scheduledCountBadge" class="badge" style="background: rgba(255,255,255,0.4); color: #fff; border-radius: 10px; padding: 2px 6px; font-size: 11px;">0</span>
                        </button>
                    </div>
                </div>
                <div class="dashboard-modal-body" id="followupModalBody" style="background-color: #f8fafc; padding: 0;">
                    <div class="text-center" style="padding: 50px 20px;">
                        <div class="preloader pl-size-xs" style="display: inline-block;">
                            <div class="spinner-layer pl-amber">
                                <div class="circle-clipper left"><div class="circle"></div></div>
                                <div class="circle-clipper right"><div class="circle"></div></div>
                            </div>
                        </div>
                        <p style="margin-top: 10px; color: #64748b; font-size: 13px; font-weight: 500;"><?= __('Loading today\'s follow-ups...') ?></p>
                    </div>
                </div>
                <div class="dashboard-modal-footer">
                    <button class="dashboard-modal-btn btn-close-modal"><?= __('Close') ?></button>
                    <?php
                    $viewAllUrlParams = ['date_type' => 'followup', 'start_date' => date('Y-m-d'), 'end_date' => date('Y-m-d')];
                    if (!empty($usersdetail['users_type']) && $usersdetail['users_type'] == 2) {
                        $viewAllUrlParams['partners'] = $usersdetail['users_id'];
                    }
                    ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index', '?' => $viewAllUrlParams]) ?>" class="dashboard-modal-btn btn-action-modal" style="background-color: #4f46e5 !important;">
                        <i class="material-icons" style="font-size: 16px;">list</i> <?= __('View All') ?>
                    </a>
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

            var todayFollowupsModal = $('#todayFollowupsModal');
            if (todayFollowupsModal.length > 0) {
                // Fetch follow-ups completed today via AJAX
                $.ajax({
                    url: '<?= $this->Url->build(['controller' => 'Users', 'action' => 'getTodayFollowups']) ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var takenData = response.taken_today || [];
                            var scheduledData = response.scheduled_today || [];

                            $('#takenCountBadge').text(takenData.length);
                            $('#scheduledCountBadge').text(scheduledData.length);

                            var defaultTab = (takenData.length === 0 && scheduledData.length > 0) ? 'scheduled' : 'taken';

                            function setTabHeaderStyle(activeTabName) {
                                $('.followup-modal-tab').css({ 'background': 'rgba(255,255,255,0.25)', 'color': '#ffffff', 'box-shadow': 'none' });
                                if (activeTabName === 'taken') {
                                    $('#tabTakenToday').css({ 'background': '#ffffff', 'color': '#4f46e5', 'box-shadow': '0 2px 4px rgba(0,0,0,0.1)' });
                                } else {
                                    $('#tabScheduledToday').css({ 'background': '#ffffff', 'color': '#4f46e5', 'box-shadow': '0 2px 4px rgba(0,0,0,0.1)' });
                                }
                            }

                            function renderTabContent(tabName) {
                                currentTab = tabName;
                                var list = (tabName === 'taken') ? takenData : scheduledData;

                                if (list.length === 0) {
                                    var emptyMsg = (tabName === 'taken') ? '<?= __('No follow-ups logged today.') ?>' : '<?= __('No follow-ups scheduled for today.') ?>';
                                    var html = `
                                        <div class="followup-empty-state" style="padding: 50px 20px; text-align: center;">
                                            <div class="followup-empty-icon">
                                                <i class="material-icons" style="font-size: 64px; color: #94a3b8;">check_circle_outline</i>
                                            </div>
                                            <h4 class="followup-empty-title" style="margin-top: 10px; color: #334155; font-size: 16px; font-weight: 600;"><?= __('All Caught Up!') ?></h4>
                                            <p class="followup-empty-text" style="color: #64748b; font-size: 13px;">${emptyMsg}</p>
                                        </div>
                                    `;
                                    $('#followupModalBody').html(html);
                                } else {
                                    var containerHtml = '<div class="followup-modal-container">';
                                    
                                    var sidebarHtml = '<div class="followup-sidebar">';
                                    $.each(list, function(index, item) {
                                        var timeStr = (tabName === 'taken') ? (item.followup_date.split('•')[1] || item.followup_date) : (item.scheduled_date.indexOf('•') !== -1 ? item.scheduled_date.split('•')[1] : item.scheduled_date);
                                        var activeClass = (index === 0) ? 'active' : '';
                                        sidebarHtml += `
                                            <div class="followup-sidebar-item ${activeClass}" data-index="${index}">
                                                <div class="followup-sidebar-avatar">
                                                    ${item.customer_name.substring(0, 1).toUpperCase()}
                                                </div>
                                                <div class="followup-sidebar-info">
                                                    <div class="followup-sidebar-name">${item.customer_name}</div>
                                                    <div class="followup-sidebar-time">${timeStr}</div>
                                                </div>
                                            </div>
                                        `;
                                    });
                                    sidebarHtml += '</div>';
                                    
                                    var detailHtml = '<div class="followup-detail-pane" id="followupDetailPane"></div>';
                                    containerHtml += sidebarHtml + detailHtml + '</div>';
                                    $('#followupModalBody').html(containerHtml);

                                    function renderFollowupDetail(index) {
                                        var item = list[index];
                                        if (!item) return;
                                        var statusClass = (item.status === 'Active') ? 'status-active' : ((item.status === 'Enquiry') ? 'status-enquiry' : 'status-inactive');
                                        var statusIcon = (item.status === 'Active') ? '🟢' : ((item.status === 'Enquiry') ? '🟡' : '🔴');
                                        
                                        var emailHtml = item.email ? `
                                            <a href="mailto:${item.email}" title="${item.email}">
                                                <i class="material-icons" style="font-size: 14px; vertical-align: middle;">email</i> ${item.email}
                                            </a>
                                        ` : '';

                                        var dateLabel = (tabName === 'taken') ? '<?= __('Logged At:') ?>' : '<?= __('Scheduled For:') ?>';
                                        var displayDate = (tabName === 'taken') ? item.followup_date : item.scheduled_date;

                                        var nextFollowupHtml = item.next_followup_date ? `
                                            <div class="followup-meta-item" style="margin-top: 4px; font-weight: 600; color: #4f46e5;">
                                                <i class="material-icons" style="color: #4f46e5; font-size: 16px;">event_repeat</i>
                                                <span><?= __('Next Follow-up:') ?> ${item.next_followup_date}</span>
                                            </div>
                                        ` : '';

                                        var detailCard = `
                                            <div class="followup-card">
                                                <div class="followup-card-header">
                                                    <div class="followup-user-info">
                                                        <div class="followup-user-avatar">
                                                            ${item.customer_name.substring(0, 1).toUpperCase()}
                                                        </div>
                                                        <div class="followup-user-details">
                                                            <h4>${item.customer_name}</h4>
                                                            <p>
                                                                <a href="tel:${item.mobile_no}">
                                                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle;">phone</i> ${item.mobile_no}
                                                                </a>
                                                                ${emailHtml ? ' | ' + emailHtml : ''}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span class="followup-status-badge ${statusClass}">
                                                        ${statusIcon} ${item.status}
                                                    </span>
                                                </div>
                                                <div class="followup-card-body">
                                                    <div class="followup-meta-item">
                                                        <i class="material-icons">account_circle</i>
                                                        <span><strong><?= __('Staff:') ?></strong> ${item.staff_name}</span>
                                                    </div>
                                                    <div class="followup-meta-item">
                                                        <i class="material-icons">schedule</i>
                                                        <span><strong>${dateLabel}</strong> ${displayDate}</span>
                                                    </div>
                                                    <div class="followup-remark-box">
                                                        ${item.remark}
                                                    </div>
                                                    ${nextFollowupHtml}
                                                </div>
                                            </div>
                                        `;
                                        $('#followupDetailPane').html(detailCard);
                                    }

                                    renderFollowupDetail(0);
                                }
                            }

                            setTabHeaderStyle(defaultTab);
                            renderTabContent(defaultTab);

                            $(document).off('click', '.followup-modal-tab').on('click', '.followup-modal-tab', function() {
                                var tab = $(this).data('tab');
                                setTabHeaderStyle(tab);
                                renderTabContent(tab);
                            });

                            $(document).off('click', '.followup-sidebar-item').on('click', '.followup-sidebar-item', function() {
                                $('.followup-sidebar-item').removeClass('active');
                                $(this).addClass('active');
                                var idx = $(this).data('index');
                                var list = (currentTab === 'taken') ? takenData : scheduledData;
                                if (list[idx]) {
                                    var item = list[idx];
                                    var statusClass = (item.status === 'Active') ? 'status-active' : ((item.status === 'Enquiry') ? 'status-enquiry' : 'status-inactive');
                                    var statusIcon = (item.status === 'Active') ? '🟢' : ((item.status === 'Enquiry') ? '🟡' : '🔴');
                                    var emailHtml = item.email ? `<a href="mailto:${item.email}" title="${item.email}"><i class="material-icons" style="font-size: 14px; vertical-align: middle;">email</i> ${item.email}</a>` : '';
                                    var dateLabel = (currentTab === 'taken') ? '<?= __('Logged At:') ?>' : '<?= __('Scheduled For:') ?>';
                                    var displayDate = (currentTab === 'taken') ? item.followup_date : item.scheduled_date;
                                    var nextFollowupHtml = item.next_followup_date ? `<div class="followup-meta-item" style="margin-top: 4px; font-weight: 600; color: #4f46e5;"><i class="material-icons" style="color: #4f46e5; font-size: 16px;">event_repeat</i><span><?= __('Next Follow-up:') ?> ${item.next_followup_date}</span></div>` : '';
                                    var detailCard = `
                                        <div class="followup-card">
                                            <div class="followup-card-header">
                                                <div class="followup-user-info">
                                                    <div class="followup-user-avatar">
                                                        ${item.customer_name.substring(0, 1).toUpperCase()}
                                                    </div>
                                                    <div class="followup-user-details">
                                                        <h4>${item.customer_name}</h4>
                                                        <p>
                                                            <a href="tel:${item.mobile_no}">
                                                                <i class="material-icons" style="font-size: 14px; vertical-align: middle;">phone</i> ${item.mobile_no}
                                                            </a>
                                                            ${emailHtml ? ' | ' + emailHtml : ''}
                                                        </p>
                                                    </div>
                                                </div>
                                                <span class="followup-status-badge ${statusClass}">
                                                    ${statusIcon} ${item.status}
                                                </span>
                                            </div>
                                            <div class="followup-card-body">
                                                <div class="followup-meta-item">
                                                    <i class="material-icons">account_circle</i>
                                                    <span><strong><?= __('Staff:') ?></strong> ${item.staff_name}</span>
                                                </div>
                                                <div class="followup-meta-item">
                                                    <i class="material-icons">schedule</i>
                                                    <span><strong>${dateLabel}</strong> ${displayDate}</span>
                                                </div>
                                                <div class="followup-remark-box">
                                                    ${item.remark}
                                                </div>
                                                ${nextFollowupHtml}
                                            </div>
                                        </div>
                                    `;
                                    $('#followupDetailPane').html(detailCard);
                                }
                            });
                        }

                        modalQueue.push(todayFollowupsModal);
                        if ($('.dashboard-modal-backdrop.active').length === 0) {
                            showNextModal();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load today followups:', error);
                    }
                });
            }

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