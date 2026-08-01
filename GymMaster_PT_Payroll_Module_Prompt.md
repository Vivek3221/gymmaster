# GymMaster -- PT (Personal Trainer) Payroll & Class Management Module (CakePHP)

## Objective

Develop a **new Personal Trainer Payroll Module** in the existing
**GymMaster CakePHP project**.

The purpose of this module is to manage **Personal Training (PT)
classes**, calculate trainer payouts automatically, and provide a
complete payroll dashboard.

**Important:** Currently there is **no mobile application** to mark
completed PT classes, therefore the admin/partner will manually enter
the number of classes completed by each trainer.

The module should be fully integrated with the existing GymMaster
project and follow the current coding standards, UI, authentication,
authorization, and database structure.

------------------------------------------------------------------------

# Module Name

**PT Payroll Management**

## User Roles

### Super Admin

Can: - View all partners - View all trainers - Add/Edit/Delete PT
rates - View payroll of every trainer - Generate reports

### Partner

Can: - View only trainers assigned to their own gym/partner account. -
Cannot view trainers of other partners. - Add PT class entries only for
their own trainers. - View payroll only for their own trainers.

Data must always be filtered using the logged-in partner.

------------------------------------------------------------------------

# Main Dashboard

Create a new menu:

`PT Payroll`

### Dashboard Summary Cards

-   Total Trainers
-   Total PT Classes (Current Month)
-   Total Payroll Amount
-   Average Classes Per Trainer
-   Pending Payroll

### Dashboard Table

  Column
  -----------------------
  Trainer Name
  Partner
  Month
  Classes Completed
  Rate Per Class
  Total Amount
  Status (Pending/Paid)
  Action

Actions: - View - Edit - Mark Paid - History

------------------------------------------------------------------------

# Trainer PT Rate Management

Each trainer should have one active PT rate.

Fields: - Trainer - Rate Per Class - Effective From - Status - Updated
By - Updated At

Historical payroll should retain old rates.

------------------------------------------------------------------------

# Manual PT Class Entry

Until the mobile application is available, allow manual entry.

Fields: - Partner (Auto-selected) - Trainer - Month - Year - Number Of
Classes - Notes (Optional)

Validation: - Trainer required - Month required - Year required -
Classes cannot be negative - One record per Trainer + Month + Year
(update if exists)

------------------------------------------------------------------------

# Payroll Calculation

Formula:

Total Amount = Classes Completed × Rate Per Class

Example:

-   Classes: 35
-   Rate: ₹600
-   Total: ₹21,000

Recalculate automatically when classes change.

Changing PT rates should affect only future payroll.

------------------------------------------------------------------------

# Payroll Details

Show: - Trainer Details - Partner - Month - Classes - Rate - Calculated
Amount - Status - Created By - Updated By - Created Date - Updated Date

------------------------------------------------------------------------

# Payroll History

Columns: - Month - Classes - Rate - Amount - Status

Filters: - Month - Year - Trainer

------------------------------------------------------------------------

# Reports

Filters: - Partner - Trainer - Month - Year - Status

Exports: - Excel - PDF - Print

------------------------------------------------------------------------

# Database Design

## Table: pt_rates

  Column
  ------------------------------
  id
  partner_id
  trainer_id
  rate_per_class DECIMAL(10,2)
  effective_from DATE
  status TINYINT DEFAULT 1
  created_by
  updated_by
  created
  modified

------------------------------------------------------------------------

## Table: pt_class_entries

  Column
  -------------------
  id
  partner_id
  trainer_id
  month
  year
  total_classes INT
  notes TEXT NULL
  created_by
  updated_by
  created
  modified

Unique Index: - trainer_id - month - year

------------------------------------------------------------------------

## Table: pt_payrolls

  Column
  ------------------------------
  id
  partner_id
  trainer_id
  class_entry_id
  rate_per_class DECIMAL(10,2)
  total_classes
  total_amount DECIMAL(10,2)
  status (Pending/Paid)
  payment_date
  paid_by
  created
  modified

------------------------------------------------------------------------

# Business Logic

Whenever PT classes are added or updated:

1.  Fetch trainer PT rate.
2.  Calculate payroll.
3.  Create or update payroll record automatically.

Formula:

`Total Amount = Rate Per Class × Classes Completed`

------------------------------------------------------------------------

# Security

Partners must never access: - Other partner trainers - Other partner
payroll - Other partner PT rates

Always filter by:

`partner_id = logged_in_partner`

Super Admin has full access.

------------------------------------------------------------------------

# UI Requirements

-   Existing GymMaster Admin Theme
-   Responsive Layout
-   DataTables
-   Search
-   Pagination
-   Sorting
-   Export
-   AJAX Forms

------------------------------------------------------------------------

# Notifications

-   PT Classes saved successfully.
-   Payroll calculated successfully.
-   PT rate updated successfully.

------------------------------------------------------------------------

# Audit Trail

Store: - Created By - Updated By - Created Date - Updated Date

------------------------------------------------------------------------

# Future Ready

The architecture must support future mobile app integration.

Currently class counts are entered manually.

Later, class counts should come from the mobile application without
requiring database redesign.

------------------------------------------------------------------------

# CakePHP Standards

-   CakePHP MVC
-   Migration Files
-   Models & Associations
-   Controllers
-   Views
-   Validation
-   ORM
-   Existing Authentication & Authorization
-   Follow existing GymMaster coding standards

------------------------------------------------------------------------

# Deliverables

1.  Database Migrations
2.  Models & Associations
3.  Controllers
4.  Views
5.  Dashboard
6.  PT Rate Management
7.  Manual PT Class Entry
8.  Automatic Payroll Calculation
9.  Payroll History
10. Reports (Excel/PDF)
11. Partner-wise Access Control
12. Validation
13. Audit Trail
14. Responsive Production-Ready UI
