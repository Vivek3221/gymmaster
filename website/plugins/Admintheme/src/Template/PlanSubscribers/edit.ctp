<?php
$userTypeVal = (int)($usersdetail['users_type'] ?? 0);
$isAuthorized = in_array($userTypeVal, [1, 2]) || $this->Common->isAdminUser($usersdetail['users_type'] ?? 0, $usersdetail['users_email'] ?? '');

$memberName = !empty($planSubscriber->user->name) 
    ? $planSubscriber->user->name 
    : ($users[$planSubscriber->user_id] ?? 'Member #' . $planSubscriber->user_id);

$memberMobile = !empty($planSubscriber->user->mobile_no) ? $planSubscriber->user->mobile_no : '';
$memberEmail  = !empty($planSubscriber->user->email) ? $planSubscriber->user->email : '';
$memberInitial = !empty($memberName) ? strtoupper(substr(trim($memberName), 0, 1)) : 'M';

$currentPlanName = $planSubscriber['plan_name'] ?? '';
$currentFee = (float)($planSubscriber['fee'] ?? 0);

$startDateVal = !empty($planSubscriber['subscription_start_date']) 
    ? date('Y-m-d', strtotime($planSubscriber['subscription_start_date'])) 
    : (!empty($planSubscriber['created']) ? date('Y-m-d', strtotime($planSubscriber['created'])) : date('Y-m-d'));

$expireDateVal = !empty($planSubscriber['plan_expire_date']) 
    ? date('Y-m-d', strtotime($planSubscriber['plan_expire_date'])) 
    : '';

$dueDateVal = !empty($planSubscriber['payment_due_date']) 
    ? date('Y-m-d', strtotime($planSubscriber['payment_due_date'])) 
    : '';

// Calculate initial duration days
$initialDays = 365;
if (!empty($startDateVal) && !empty($expireDateVal)) {
    $diffSec = strtotime($expireDateVal) - strtotime($startDateVal);
    $calcDays = (int)round($diffSec / 86400);
    if ($calcDays > 0) {
        $initialDays = $calcDays;
    }
}

// Check plan name keywords for standard duration if diff is slightly off
if (stripos($currentPlanName, '24 MONTH') !== false) {
    $initialDays = 730;
} elseif (stripos($currentPlanName, '12 MONTH') !== false || stripos($currentPlanName, '1 YEAR') !== false) {
    $initialDays = 365;
} elseif (stripos($currentPlanName, '6 MONTH') !== false) {
    $initialDays = 180;
} elseif (stripos($currentPlanName, '3 MONTH') !== false) {
    $initialDays = 90;
} elseif (stripos($currentPlanName, '1 MONTH') !== false) {
    $initialDays = 30;
}
?>
<section class="content" style="padding-top: 15px;">
    <div class="container-fluid" style="max-width: 900px; margin: 0 auto;">
        
        <?= $this->Flash->render() ?>

        <style>
            .plan-edit-card {
                background: #ffffff;
                border-radius: 16px;
                box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
                border: 1px solid #edf2f7;
                overflow: hidden;
                margin-bottom: 30px;
            }
            .plan-edit-header {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
                padding: 24px 30px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 15px;
                border-bottom: 3px solid #ff9800;
            }
            .plan-edit-header .header-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }
            .plan-edit-header .header-icon {
                width: 48px;
                height: 48px;
                background: rgba(255, 152, 0, 0.18);
                border: 1.5px solid rgba(255, 152, 0, 0.4);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ff9800;
            }
            .plan-edit-header h2 {
                color: #ffffff;
                font-size: 20px;
                font-weight: 700;
                margin: 0 0 3px 0;
                letter-spacing: -0.3px;
            }
            .plan-edit-header p {
                color: #94a3b8;
                font-size: 13px;
                margin: 0;
            }
            .plan-edit-body {
                padding: 30px;
            }
            .section-label {
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                color: #ff9800;
                margin-bottom: 16px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            /* Readonly Info Cards */
            .info-cards-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 18px;
                margin-bottom: 26px;
            }
            @media (max-width: 650px) {
                .info-cards-grid {
                    grid-template-columns: 1fr;
                }
            }
            .readonly-info-card {
                background: #f8fafc;
                border: 1.5px solid #e2e8f0;
                border-radius: 12px;
                padding: 18px 20px;
                display: flex;
                align-items: center;
                gap: 16px;
            }
            .member-avatar-badge {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 20px;
                flex-shrink: 0;
                box-shadow: 0 4px 12px rgba(255, 152, 0, 0.25);
            }
            .plan-icon-badge {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                background: #e0f2fe;
                color: #0284c7;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
            .readonly-info-card .card-meta {
                flex: 1;
                min-width: 0;
            }
            .readonly-info-card .card-meta .meta-label {
                font-size: 11px;
                font-weight: 700;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 3px;
            }
            .readonly-info-card .card-meta .meta-val {
                font-size: 16px;
                font-weight: 800;
                color: #1e293b;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .readonly-info-card .card-meta .meta-sub {
                font-size: 12px;
                color: #64748b;
                margin-top: 2px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            /* Form Fields */
            .form-grid-3 {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 18px;
                margin-bottom: 22px;
            }
            @media (max-width: 800px) {
                .form-grid-3 {
                    grid-template-columns: 1fr;
                    gap: 16px;
                }
            }
            .modern-field {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }
            .modern-field label {
                font-size: 13px;
                font-weight: 600;
                color: #334155;
                margin: 0;
            }
            .modern-field .input-wrapper {
                position: relative;
                display: flex;
                align-items: center;
            }
            .modern-field .input-wrapper .field-icon {
                position: absolute;
                left: 14px;
                color: #94a3b8;
                font-size: 18px;
                pointer-events: none;
            }
            .modern-field .form-control {
                height: 46px !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 10px !important;
                padding: 8px 14px 8px 42px !important;
                font-size: 14px !important;
                color: #1e293b !important;
                background: #f8fafc !important;
                transition: all 0.2s ease !important;
                width: 100% !important;
                box-shadow: none !important;
            }
            .modern-field .form-control:focus {
                border-color: #ff9800 !important;
                background: #ffffff !important;
                box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.15) !important;
            }
            .modern-field .form-control[readonly] {
                background: #f1f5f9 !important;
                color: #64748b !important;
                cursor: not-allowed !important;
            }

            /* Live Duration Info */
            .plan-calc-info {
                background: #f0fdf4;
                border: 1.5px solid #bbf7d0;
                border-radius: 10px;
                padding: 14px 18px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                gap: 12px;
                color: #166534;
                font-size: 13.5px;
                font-weight: 500;
            }
            .plan-calc-info i {
                font-size: 22px;
                color: #16a34a;
            }

            /* Action Buttons */
            .action-buttons-wrap {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 12px;
                padding-top: 20px;
                border-top: 1px solid #f1f5f9;
            }
            .btn-update-plan {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%) !important;
                color: #ffffff !important;
                border: none !important;
                border-radius: 10px !important;
                padding: 12px 28px !important;
                font-size: 14px !important;
                font-weight: 700 !important;
                cursor: pointer !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 8px !important;
                box-shadow: 0 4px 14px rgba(255, 152, 0, 0.35) !important;
                transition: all 0.2s ease !important;
            }
            .btn-update-plan:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 152, 0, 0.45) !important;
            }
            .btn-cancel-plan {
                background: #f8fafc !important;
                color: #64748b !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 10px !important;
                padding: 11px 22px !important;
                font-size: 14px !important;
                font-weight: 600 !important;
                text-decoration: none !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 6px !important;
                transition: all 0.2s ease !important;
            }
            .btn-cancel-plan:hover {
                background: #f1f5f9 !important;
                color: #334155 !important;
            }

            /* Dedicated Flatpickr Header Fix */
            .flatpickr-calendar {
                font-family: 'Roboto', -apple-system, BlinkMacSystemFont, sans-serif !important;
                border-radius: 12px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
                border: 1px solid #e2e8f0 !important;
                z-index: 99999 !important;
                overflow: visible !important;
            }
            .flatpickr-months {
                background: #1e293b !important;
                border-radius: 12px 12px 0 0 !important;
                position: relative !important;
                height: 42px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                padding: 0 8px !important;
                box-sizing: border-box !important;
            }
            .flatpickr-months .flatpickr-month {
                background: #1e293b !important;
                color: #ffffff !important;
                fill: #ffffff !important;
                border-radius: 12px 12px 0 0 !important;
                height: 42px !important;
                flex: 1 !important;
                position: relative !important;
                overflow: visible !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .flatpickr-months .flatpickr-prev-month, 
            .flatpickr-months .flatpickr-next-month {
                color: #ffffff !important;
                fill: #ffffff !important;
                height: 28px !important;
                width: 28px !important;
                padding: 4px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                position: relative !important;
                top: auto !important;
                z-index: 9999 !important;
                cursor: pointer !important;
                border-radius: 6px !important;
                background: rgba(255, 255, 255, 0.22) !important;
                transition: all 0.2s ease !important;
                flex-shrink: 0 !important;
            }
            .flatpickr-months .flatpickr-prev-month:hover, 
            .flatpickr-months .flatpickr-next-month:hover {
                background: #ff9800 !important;
            }
            .flatpickr-months .flatpickr-prev-month svg, 
            .flatpickr-months .flatpickr-next-month svg,
            .flatpickr-months .flatpickr-prev-month svg path, 
            .flatpickr-months .flatpickr-next-month svg path {
                fill: #ffffff !important;
                stroke: #ffffff !important;
                width: 14px !important;
                height: 14px !important;
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
            .flatpickr-current-month {
                position: static !important;
                width: 100% !important;
                height: 42px !important;
                padding: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 6px !important;
                transform: none !important;
                white-space: nowrap !important;
                font-size: 14px !important;
                line-height: normal !important;
                box-sizing: border-box !important;
            }
            .flatpickr-current-month span.cur-month {
                font-weight: 700 !important;
                color: #ffffff !important;
                font-size: 14px !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .flatpickr-current-month .flatpickr-monthDropdown-months {
                width: auto !important;
                max-width: 120px !important;
                height: 28px !important;
                line-height: 28px !important;
                font-size: 13.5px !important;
                font-weight: 700 !important;
                background: #1e293b !important;
                color: #ffffff !important;
                padding: 2px 6px !important;
                border: 1px solid rgba(255, 255, 255, 0.3) !important;
                border-radius: 6px !important;
                display: inline-block !important;
                cursor: pointer !important;
                vertical-align: middle !important;
                outline: none !important;
                margin: 0 !important;
            }
            .flatpickr-current-month .flatpickr-monthDropdown-months option {
                background: #1e293b !important;
                color: #ffffff !important;
            }
            .flatpickr-current-month .numInputWrapper {
                width: 70px !important;
                height: 28px !important;
                display: inline-flex !important;
                align-items: center !important;
                border: 1px solid rgba(255, 255, 255, 0.3) !important;
                border-radius: 6px !important;
                background: rgba(255, 255, 255, 0.1) !important;
                vertical-align: middle !important;
                margin: 0 !important;
                position: relative !important;
            }
            .flatpickr-current-month input.cur-year {
                width: 100% !important;
                height: 26px !important;
                line-height: 26px !important;
                font-size: 13.5px !important;
                font-weight: 700 !important;
                color: #ffffff !important;
                background: transparent !important;
                border: none !important;
                padding: 0 4px !important;
                text-align: center !important;
                display: inline-block !important;
                box-sizing: border-box !important;
                outline: none !important;
                margin: 0 !important;
                -moz-appearance: textfield !important;
            }
            .flatpickr-current-month .numInputWrapper span.arrowUp,
            .flatpickr-current-month .numInputWrapper span.arrowDown {
                padding: 0 !important;
                border: none !important;
                height: 50% !important;
                width: 14px !important;
                opacity: 0.8 !important;
            }
            .flatpickr-current-month .numInputWrapper span.arrowUp:after {
                border-bottom-color: #ffffff !important;
            }
            .flatpickr-current-month .numInputWrapper span.arrowDown:after {
                border-top-color: #ffffff !important;
            }
            .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange {
                background: #ff9800 !important;
                border-color: #ff9800 !important;
            }
        </style>

        <div class="plan-edit-card">
            <!-- Header -->
            <div class="plan-edit-header">
                <div class="header-left">
                    <div class="header-icon">
                        <i class="material-icons" style="font-size: 26px;">edit_calendar</i>
                    </div>
                    <div>
                        <h2><?= __('Update Exercise Plan for User') ?></h2>
                        <p><?= __('Change subscription start, expiration, and payment due dates') ?></p>
                    </div>
                </div>
                <div>
                    <span class="badge" style="background: rgba(255,255,255,0.15); color: #fff; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1px solid rgba(255,255,255,0.25);">
                        ID #<?= h($planSubscriber['id']) ?>
                    </span>
                </div>
            </div>

            <div class="plan-edit-body">
                <?= $this->Form->create($planSubscriber, [
                    'id' => 'planEditForm',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>

                <!-- Hidden inputs to preserve entity attributes -->
                <?= $this->Form->hidden('user_id', ['value' => $planSubscriber->user_id]) ?>
                <?= $this->Form->hidden('plan_name', ['id' => 'planNameInput', 'value' => $currentPlanName]) ?>
                <?= $this->Form->hidden('fee', ['id' => 'planFeeInput', 'value' => $currentFee]) ?>

                <!-- SECTION 1: Member & Plan Information (Readonly Display) -->
                <div class="section-label">
                    <i class="material-icons" style="font-size: 15px;">verified_user</i>
                    <?= __('1. Member & Subscribed Plan (Fixed)') ?>
                </div>

                <div class="info-cards-grid">
                    <!-- Member Card -->
                    <div class="readonly-info-card">
                        <div class="member-avatar-badge"><?= $memberInitial ?></div>
                        <div class="card-meta">
                            <div class="meta-label"><?= __('Member Name') ?></div>
                            <div class="meta-val" title="<?= h($memberName) ?>"><?= h($memberName) ?></div>
                            <div class="meta-sub">
                                <?php if (!empty($memberMobile)): ?>
                                    <span><i class="material-icons" style="font-size: 13px; vertical-align: middle;">phone</i> <?= h($memberMobile) ?></span>
                                <?php endif; ?>
                                <span>ID: #<?= h($planSubscriber->user_id) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Card -->
                    <div class="readonly-info-card">
                        <div class="plan-icon-badge">
                            <i class="material-icons" style="font-size: 26px;">loyalty</i>
                        </div>
                        <div class="card-meta">
                            <div class="meta-label"><?= __('Subscribed Plan & Fee') ?></div>
                            <div class="meta-val" title="<?= h($currentPlanName) ?>"><?= h($currentPlanName) ?></div>
                            <div class="meta-sub">
                                <span style="font-weight: 700; color: #16a34a;">Fee: ₹<?= number_format($currentFee) ?></span>
                                <span>• <?= $initialDays ?> Days Plan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Dates Modification (Editable) -->
                <div class="section-label">
                    <i class="material-icons" style="font-size: 15px;">date_range</i>
                    <?= __('2. Subscription Dates & Auto-Calculation') ?>
                </div>

                <div class="form-grid-3">
                    <!-- Start Date -->
                    <div class="modern-field">
                        <label>
                            <?= __('Subscription Start Date') ?> <span style="color:red">*</span>
                            <?php if (!$isAuthorized): ?>
                                <small class="text-danger">(Admin only)</small>
                            <?php endif; ?>
                        </label>
                        <div class="input-wrapper">
                            <i class="material-icons field-icon">event</i>
                            <input type="text" name="subscription_start_date" id="subscription_start_date" 
                                class="form-control" 
                                value="<?= h($startDateVal) ?>" 
                                <?= !$isAuthorized ? 'readonly' : '' ?> 
                                placeholder="YYYY-MM-DD" autocomplete="off" required>
                        </div>
                    </div>

                    <!-- Expire Date -->
                    <div class="modern-field">
                        <label>
                            <?= __('Plan Expire Date') ?> <span style="color:red">*</span>
                            <span id="autoCalcBadge" style="font-size: 11px; background: #e0f2fe; color: #0284c7; padding: 2px 8px; border-radius: 12px; margin-left: 4px; font-weight: 600;">
                                Auto-calculated
                            </span>
                        </label>
                        <div class="input-wrapper">
                            <i class="material-icons field-icon">event_busy</i>
                            <input type="text" name="plan_expire_date" id="plan_expire_date" 
                                class="form-control" 
                                value="<?= h($expireDateVal) ?>" 
                                <?= !$isAuthorized ? 'readonly' : '' ?> 
                                placeholder="YYYY-MM-DD" autocomplete="off" required>
                        </div>
                    </div>

                    <!-- Payment Due Date -->
                    <div class="modern-field">
                        <label><?= __('Payment Due Date') ?></label>
                        <div class="input-wrapper">
                            <i class="material-icons field-icon">payment</i>
                            <input type="text" name="payment_due_date" id="payment_due_date" 
                                class="form-control" 
                                value="<?= h($dueDateVal) ?>" 
                                <?= !$isAuthorized ? 'readonly' : '' ?> 
                                placeholder="YYYY-MM-DD" autocomplete="off">
                        </div>
                    </div>
                </div>

                <!-- Live Duration Info Box -->
                <div class="plan-calc-info" id="planDurationInfoBox">
                    <i class="material-icons">info</i>
                    <span id="durationInfoText">Loading plan schedule...</span>
                </div>

                <!-- Footer Actions -->
                <div class="action-buttons-wrap">
                    <a href="<?= $this->Url->build(['controller' => 'PlanSubscribers', 'action' => 'index']) ?>" class="btn-cancel-plan">
                        <i class="material-icons" style="font-size: 16px;">arrow_back</i>
                        <?= __('Back to List') ?>
                    </a>
                    <button type="submit" class="btn-update-plan waves-effect">
                        <i class="material-icons" style="font-size: 18px;">save</i>
                        <?= __('Update Plan Dates') ?>
                    </button>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
var planDurationDays = <?= (int)$initialDays ?>;
var fpStartDate = null;
var fpExpireDate = null;
var fpDueDate = null;

// Helper: Add days to date string (YYYY-MM-DD)
function addDaysToDateStr(dateStr, days) {
    if (!dateStr) return '';
    var parts = dateStr.split('-');
    if (parts.length === 3) {
        var y = parseInt(parts[0], 10);
        var m = parseInt(parts[1], 10) - 1;
        var d = parseInt(parts[2], 10);
        var dateObj = new Date(y, m, d);
        dateObj.setDate(dateObj.getDate() + parseInt(days, 10));
        
        var resY = dateObj.getFullYear();
        var resM = String(dateObj.getMonth() + 1).padStart(2, '0');
        var resD = String(dateObj.getDate()).padStart(2, '0');
        return resY + '-' + resM + '-' + resD;
    }
    return dateStr;
}

// Helper: Get difference between two dates in days
function getDaysDiff(startStr, endStr) {
    if (!startStr || !endStr) return 0;
    var s = new Date(startStr);
    var e = new Date(endStr);
    var diff = Math.round((e - s) / (1000 * 60 * 60 * 24));
    return diff > 0 ? diff : 0;
}

// Update the live info banner
function updateDurationInfo() {
    var startVal = $('#subscription_start_date').val();
    var expireVal = $('#plan_expire_date').val();

    if (startVal && expireVal) {
        var diff = getDaysDiff(startVal, expireVal);
        var monthsApprox = (diff / 30.4).toFixed(1);
        $('#durationInfoText').html('Plan active for <strong>' + diff + ' days</strong> (~' + monthsApprox + ' months) from <strong>' + startVal + '</strong> to <strong>' + expireVal + '</strong>');
    } else {
        $('#durationInfoText').text('Select a valid start date to view schedule.');
    }
}

// Recalculate and prefill expire date when start date changes
function onStartDateChanged() {
    var startVal = $('#subscription_start_date').val();
    if (!startVal) return;

    var newExpire = addDaysToDateStr(startVal, planDurationDays);
    $('#plan_expire_date').val(newExpire);

    if (fpExpireDate) {
        fpExpireDate.setDate(newExpire, false);
    }

    // Also update payment due date if empty or was matching previous start date
    var dueVal = $('#payment_due_date').val();
    if (!dueVal) {
        $('#payment_due_date').val(startVal);
        if (fpDueDate) {
            fpDueDate.setDate(startVal, false);
        }
    }

    updateDurationInfo();
}

$(document).ready(function () {
    // 1. Destroy any existing flatpickr or old datetimepickers on these inputs
    ['#subscription_start_date', '#plan_expire_date', '#payment_due_date'].forEach(function(sel) {
        var el = document.querySelector(sel);
        if (el && el._flatpickr) {
            try { el._flatpickr.destroy(); } catch(e) {}
        }
        $(sel).off('.dtp').removeAttr('data-dtp');
    });
    $('.dtp').remove();

    // 2. Initialize fresh, dedicated Flatpickr instances
    if (typeof flatpickr !== 'undefined') {
        fpStartDate = flatpickr('#subscription_start_date', {
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'dropdown',
            static: false,
            onChange: function(selectedDates, dateStr) {
                $('#subscription_start_date').val(dateStr);
                onStartDateChanged();
            },
            onClose: function(selectedDates, dateStr) {
                if (dateStr) {
                    $('#subscription_start_date').val(dateStr);
                    onStartDateChanged();
                }
            }
        });

        fpExpireDate = flatpickr('#plan_expire_date', {
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'dropdown',
            static: false,
            onChange: function(selectedDates, dateStr) {
                var startVal = $('#subscription_start_date').val();
                if (startVal && dateStr) {
                    planDurationDays = getDaysDiff(startVal, dateStr);
                }
                updateDurationInfo();
            }
        });

        fpDueDate = flatpickr('#payment_due_date', {
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'dropdown',
            static: false
        });
    }

    // 3. Fallback standard DOM change/input event listeners
    $('#subscription_start_date').on('change input blur', function() {
        onStartDateChanged();
    });

    $('#plan_expire_date').on('change input blur', function() {
        var startVal = $('#subscription_start_date').val();
        var dateStr = $(this).val();
        if (startVal && dateStr) {
            planDurationDays = getDaysDiff(startVal, dateStr);
        }
        updateDurationInfo();
    });

    $('#autoCalcBadge').css('cursor', 'pointer').attr('title', 'Click to recalculate using standard plan duration (<?= (int)$initialDays ?> days)').on('click', function() {
        planDurationDays = <?= (int)$initialDays ?>;
        onStartDateChanged();
    });

    // 4. Initial calculation
    updateDurationInfo();
});
</script>
