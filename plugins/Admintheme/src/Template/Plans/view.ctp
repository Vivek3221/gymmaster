<section class="content">
    <div class="container-fluid">

        <style>
            .plan-view-header {
                background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
                border-radius: 14px; padding: 20px 28px; margin-bottom: 24px;
                display: flex; align-items: center; justify-content: space-between;
                box-shadow: 0 6px 24px rgba(255,152,0,0.25);
            }
            .plan-view-header h2 { color:#fff; font-size:20px; font-weight:700; margin:0; display:flex; align-items:center; gap:10px; }
            .plan-view-card {
                background: #fff; border-radius: 14px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.07);
                border: 1px solid #f0f0f0; padding: 32px 36px;
                max-width: 700px; margin: 0 auto;
            }
            .plan-view-row {
                display: flex; align-items: center;
                padding: 14px 0; border-bottom: 1px solid #f5f5f5;
            }
            .plan-view-row:last-child { border-bottom: none; }
            .plan-view-label {
                width: 200px; font-size: 12px; font-weight: 700;
                color: #999; text-transform: uppercase; letter-spacing: 0.6px;
            }
            .plan-view-value { font-size: 15px; font-weight: 600; color: #333; }
            .plan-view-actions { display: flex; gap: 10px; margin-top: 24px; }
            .btn-edit-plan {
                background: linear-gradient(135deg, #ff9800, #f57c00);
                color: #fff; border: none; border-radius: 8px; padding: 10px 22px;
                font-weight: 700; text-decoration: none !important; display: inline-flex;
                align-items: center; gap: 6px; transition: all 0.25s;
            }
            .btn-back-plan {
                background: #f5f5f5; color: #555; border: 1.5px solid #e0e0e0;
                border-radius: 8px; padding: 10px 20px; font-weight: 600;
                text-decoration: none !important; display: inline-flex; align-items: center; gap: 6px;
            }
        </style>

        <div class="plan-view-header">
            <h2><i class="material-icons">loyalty</i><?= h($plan->title) ?></h2>
        </div>

        <div class="plan-view-card">
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Plan ID') ?></div>
                <div class="plan-view-value">#<?= $plan->id ?></div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Plan Name') ?></div>
                <div class="plan-view-value"><?= h($plan->title) ?></div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Duration') ?></div>
                <div class="plan-view-value"><?= $plan->duration_months ?> Month<?= $plan->duration_months > 1 ? 's' : '' ?></div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Days') ?></div>
                <div class="plan-view-value"><?= $plan->days ?> Days</div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Price') ?></div>
                <div class="plan-view-value" style="color:#e65100;">₹<?= number_format((float)$plan->price, 2) ?></div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Description') ?></div>
                <div class="plan-view-value"><?= !empty($plan->description) ? h($plan->description) : '—' ?></div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Status') ?></div>
                <div class="plan-view-value">
                    <?php if ($plan->active): ?>
                        <span style="background:#e8f5e9;color:#2e7d32;border-radius:20px;padding:4px 14px;font-size:12px;font-weight:700;">Active</span>
                    <?php else: ?>
                        <span style="background:#ffebee;color:#c62828;border-radius:20px;padding:4px 14px;font-size:12px;font-weight:700;">Inactive</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="plan-view-row">
                <div class="plan-view-label"><?= __('Created') ?></div>
                <div class="plan-view-value"><?= $plan->created ? $plan->created->format('d M Y') : '—' ?></div>
            </div>

            <div class="plan-view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $plan->id]); ?>" class="btn-edit-plan">
                    <i class="material-icons" style="font-size:16px;">mode_edit</i><?= __('Edit') ?>
                </a>
                <a href="<?= $this->Url->build(['action' => 'index']); ?>" class="btn-back-plan">
                    <i class="material-icons" style="font-size:16px;">arrow_back</i><?= __('Back to List') ?>
                </a>
            </div>
        </div>

    </div>
</section>
