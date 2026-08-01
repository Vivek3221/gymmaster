# Implementation Plan - User-Centric PT Plan & Payroll System

This implementation plan outlines the architecture for a **User-Centric Personal Training (PT) Plan & Payroll System**, providing full transparency into PT plan assignment, client per-class costs, trainer payouts, and gym profit sharing.

---

## Technical Concept & Math Formula

1. **PT Master Plan Definition (`pt_plans`)**:
   - Standard 1 Month = 12 Classes, 2 Months = 24 Classes, 3 Months = 36 Classes.
   - Admin/Partner sets total price (e.g. ₹12,000 for 1 Month / 12 classes).
   - **Client Per Class Rate** = `Total Price / Total Classes` (e.g. ₹12,000 / 12 = **₹1,000 / class**).

2. **Client PT Subscription (`user_pt_subscriptions`)**:
   - Assigns a PT Plan to a specific Member/User and links an Assigned Trainer (`trainer_id`).
   - Tracks total classes allocated, completed classes, and remaining balance.

3. **User-Wise PT Payroll Entry (`pt_class_entries` / `pt_payrolls`)**:
   - Trainer conducts $N$ classes for a Client (e.g. 4 classes).
   - **Total Client Revenue** = $N \times \text{Client Per Class Rate}$ (e.g. $4 \times ₹1,000 = ₹4,000$).
   - **Trainer Payout** = $N \times \text{Trainer Per Class Rate}$ (e.g. $4 \times ₹400 = ₹1,600$).
   - **Gym Share / Profit** = $\text{Client Revenue} - \text{Trainer Payout}$ (e.g. $₹4,000 - ₹1,600 = \mathbf{₹2,400}$ profit, i.e. ₹600/class).

4. **Client-Wise PT Financial Report**:
   - Displays a breakdown of Client Paid Amount, Trainer Payout, Gym Profit, and Remaining Class Balance.

---

## User Review Required

> [!IMPORTANT]
> **Database Migration Required**: Running `setup_pt_plan_payroll.sql` on the MySQL database is required to create `pt_plans` and `user_pt_subscriptions` tables and update `pt_class_entries` with `user_id` and `user_pt_subscription_id`.

---

## Open Questions

None at present. Requirements are clear.

---

## Proposed System & Component Architecture

### 1. Database Schema (`setup_pt_plan_payroll.sql`)

```sql
-- 1. PT Master Plans Table
CREATE TABLE IF NOT EXISTS `pt_plans` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `duration_months` INT(11) NOT NULL DEFAULT 1,
    `total_classes` INT(11) NOT NULL DEFAULT 12,
    `price` DECIMAL(10,2) NOT NULL,
    `per_class_rate` DECIMAL(10,2) NOT NULL,
    `status` TINYINT(1) DEFAULT 1,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Client PT Subscriptions Table
CREATE TABLE IF NOT EXISTS `user_pt_subscriptions` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `partner_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `trainer_id` INT(11) NOT NULL,
    `pt_plan_id` INT(11) NOT NULL,
    `plan_name` VARCHAR(255) NOT NULL,
    `total_classes` INT(11) NOT NULL,
    `completed_classes` INT(11) NOT NULL DEFAULT 0,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `client_per_class_rate` DECIMAL(10,2) NOT NULL,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'Active',
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Add client fields to pt_class_entries
ALTER TABLE `pt_class_entries`
ADD COLUMN `user_id` INT(11) NULL AFTER `trainer_id`,
ADD COLUMN `user_pt_subscription_id` INT(11) NULL AFTER `user_id`,
ADD COLUMN `client_per_class_rate` DECIMAL(10,2) DEFAULT 0.00 AFTER `rate_per_class`,
ADD COLUMN `gym_profit` DECIMAL(10,2) DEFAULT 0.00 AFTER `client_per_class_rate`;
```

---

### 2. Complete List of Code Files Included

#### Controllers:
1. `src/Controller/PtPlansController.php` (CRUD for PT Master Plans & Assigning PT Plan to Member)
2. `src/Controller/PtPayrollsController.php` (User-wise PT Class Entry, Payroll Calculation & Financial Report)

#### Models & Entities:
1. `src/Model/Table/PtPlansTable.php`
2. `src/Model/Entity/PtPlan.php`
3. `src/Model/Table/UserPtSubscriptionsTable.php`
4. `src/Model/Entity/UserPtSubscription.php`
5. `src/Model/Table/PtClassEntriesTable.php` (Updated associations)
6. `src/Model/Table/PtPayrollsTable.php`

#### Views / Templates (`plugins/Admintheme/src/Template/`):
1. `plugins/Admintheme/src/Template/PtPlans/index.ctp` (List PT Plans)
2. `plugins/Admintheme/src/Template/PtPlans/add.ctp` (Create PT Master Plan)
3. `plugins/Admintheme/src/Template/PtPlans/edit.ctp` (Edit PT Master Plan)
4. `plugins/Admintheme/src/Template/PtPlans/assign.ctp` (Assign PT Plan to Member with Trainer)
5. `plugins/Admintheme/src/Template/PtPlans/subscriptions.ctp` (View Active Client PT Subscriptions)
6. `plugins/Admintheme/src/Template/PtPayrolls/index.ctp` (Trainer Payroll Overview)
7. `plugins/Admintheme/src/Template/PtPayrolls/add_class_entry.ctp` (User-Wise PT Class Entry with Auto Calculation)
8. `plugins/Admintheme/src/Template/PtPayrolls/client_report.ctp` (Client & Trainer Profit Share Report)
9. `plugins/Admintheme/src/Template/Element/left_nav.ctp` (Updated navigation links)

---

## Verification Plan

### Automated Checks
- Validate PHP syntax (`php -l`) on all new and modified controller and model files.

### Manual Verification
1. Create a Standard PT Master Plan (e.g. 1 Month, 12 Classes, ₹12,000). Verify Per Class Rate auto-calculates to ₹1,000.
2. Assign PT Plan to Client A with Trainer Vivek.
3. Log PT Class Entry for Trainer Vivek & Client A (4 classes done @ ₹400 trainer rate).
4. Verify Payroll Calculation:
   - Client Paid: $4 \times ₹1,000 = ₹4,000$
   - Trainer Payout: $4 \times ₹400 = ₹1,600$
   - Gym Profit: $₹4,000 - ₹1,600 = ₹2,400$
   - Client Remaining Classes: $12 - 4 = 8$ classes.
5. Check Client PT Financial Report for accurate breakdown.
