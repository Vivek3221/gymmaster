# Makeover Data Monitoring --- Antigravity Implementation Plan

## Purpose

This file is intended for **Antigravity** to first analyze the existing
Makeover application and prepare a safe, implementation-ready plan for
the requested changes.

**Important:** Do not start coding immediately. First inspect the
existing project structure, database schema, models,
controllers/services, routes/APIs, frontend pages/components,
authentication/authorization, reports, payment logic, trainer assignment
logic, and existing filters. Then produce a detailed implementation plan
and explain the impact of every proposed change.

## Primary Instructions for Antigravity

1.  Analyze the current codebase before making changes.
2.  Reuse existing architecture, components, helpers, permissions, and
    patterns wherever possible.
3.  Do not introduce breaking database/API changes without clearly
    identifying them first.
4.  For every requirement below, identify:
    -   Existing relevant files/modules.
    -   Current behavior.
    -   Required behavior.
    -   Backend changes.
    -   Frontend/UI changes.
    -   Database/migration changes, if any.
    -   Permission/role changes.
    -   Validation/business rules.
    -   Existing-data/backward-compatibility impact.
    -   Testing/QA cases.
5.  Identify dependencies between requirements.
6.  Identify ambiguous requirements or business rules that require
    confirmation.
7.  Before implementation, provide a phased execution plan with
    estimated complexity: Low / Medium / High.
8.  Do not hardcode business logic unnecessarily. Existing privileged
    email IDs may currently be used as requirements, but first inspect
    whether the project already has a permission/role system that should
    own this behavior.
9.  Preserve existing data and existing production behavior unless a
    requirement explicitly changes it.
10. For financial calculations, do not assume formulas. Trace the
    current plan, collection, pending amount, discount, trainer payout,
    and revenue calculations and document the exact proposed formula
    before changing code.

------------------------------------------------------------------------

# Requirements

## 1. User List --- Front Desk & Inquiry Information

### Required Behavior

-   Show the **Front Desk user name** in the user/client list.
-   Show the **Added By** user/front-desk name for each inquiry/client.
-   A Front Desk user must only be able to see clients/inquiries added
    by that Front Desk user.
-   Main/admin users must have a **Front Desk filter** to filter the
    list.

### Antigravity Analysis

Determine how users, clients/inquiries, and Front Desk users are
currently related. Check whether an `added_by`, `created_by`, front-desk
ID, owner ID, or equivalent field already exists before proposing a
migration.

------------------------------------------------------------------------

## 2. Manual Collection Report

### Required Behavior

-   Fix Month and Year selection/scroll/filter behavior.
-   Financial year must run **April through March**.
-   Every month in the selected financial year must appear even when
    there is no collection; show **0** for such months.
-   While adding a collection, ask for and save the **Collection Date**.
-   All report calculations must follow the financial year.
-   Calculate/display **Pending Amount** according to the applicable
    amount up to the current date/month.

### Antigravity Analysis

Trace the existing collection and pending-amount calculation. Document
the current formula and propose the exact new formula. Explicitly
explain how partial/current months, future months, plan start dates,
expiry dates, and zero-collection months will be handled. Do not invent
these rules if they are not present in the existing application.

------------------------------------------------------------------------

## 3. Discount System --- New

### Required Behavior

-   While receiving payment, show/accept a **Discount Percentage**.
-   A **Discount Remark/Reason** is mandatory when a discount is
    applied.
-   Examples include promotional offer, special approval, referral, etc.
-   Save the remark at the time the discount is given.
-   Show discount details and remark in payment details.

### Antigravity Analysis

Inspect whether payments already contain discount fields. Define
validation, storage, calculation impact, reporting impact, and whether
historical payments need default values.

------------------------------------------------------------------------

## 4. Payment Delete Permission

### Privileged IDs

-   `mukeshkr3221@gmail.com`
-   `ad1234@yopmail.com`

### Required Behavior

-   Payment delete is initially available only to the two privileged IDs
    above.
-   Show a confirmation popup before deletion.
-   These privileged users must be able to grant payment-delete
    permission to another user.
-   The delegation mechanism must not be used to alter/remove the
    original privileged users' own protected access.
-   A **Deletion Reason** is mandatory when deleting a payment.
-   If the plan is changed while editing a payment, provide an option to
    update/recalculate the payment/amount according to the new plan.

### Antigravity Analysis

Inspect the existing roles/permissions implementation. Prefer a
permission-based implementation over scattered email checks if the
architecture supports it. Determine whether deletion is hard-delete or
soft-delete and propose an audit-safe approach without changing existing
behavior silently.

------------------------------------------------------------------------

## 5. Trainer Payout

### Required Behavior

-   Add payment delete capability to the Trainer Payout list.
-   Delete permission follows the same privileged/delegated permission
    model described above.
-   Fix cases where Client Name appears as `N/A`.
-   When trainer payment is marked **Paid**, require/select/save the
    **Payment Date**.

### Antigravity Analysis

Trace trainer payout relations to clients and identify why `N/A` occurs
before proposing a fix.

------------------------------------------------------------------------

## 6. Client Revenue

### Required Behavior

-   Add **Month + Year** filters.
-   Calculate and display total revenue according to the selected
    filters.

### Antigravity Analysis

Identify the authoritative revenue source and whether discounts, deleted
payments, refunds, or payment dates affect revenue.

------------------------------------------------------------------------

## 7. Follow-up List

### Required Behavior

-   Add **Follow-up List** to the sidebar.
-   Add a **Date Range** filter for follow-ups.

### Antigravity Analysis

Check whether a follow-up module/page/API already exists and should
simply be exposed in navigation or requires a new listing flow.

------------------------------------------------------------------------

## 8. Expired Users

### Required Behavior

-   Add a **Date Range** filter.
-   Filter results according to the user's **Expiry Date**.

------------------------------------------------------------------------

## 9. Add User --- Trainer

### Required Behavior

-   Add a **Trainer dropdown** while creating a user/client.
-   Allow direct trainer assignment during creation.

### Antigravity Analysis

Reuse the existing trainer assignment relationship and validation if one
exists.

------------------------------------------------------------------------

## 10. Session --- Duplicate Button

### Allowed Users

The Duplicate button must only be visible/usable by: - Partner users. -
`mukeshkr3221@gmail.com` - `ad1234@yopmail.com`

### Required Behavior

-   Add or maintain the Session **Duplicate** button.
-   Other users must not see the option.

### Security Requirement

Do not rely only on frontend visibility. Enforce the same authorization
on the backend/API action.

------------------------------------------------------------------------

## 11. Body Measurement --- Pagination

### Required Entries Per Page

-   10
-   25
-   50
-   100
-   All

### Antigravity Analysis

Inspect existing pagination implementation and ensure `All` is handled
safely for expected dataset size.

------------------------------------------------------------------------

## 12. Session Filters

### Required Behavior

-   Add Session list filters, especially **Reps**.
-   Include existing/relevant session-related fields where appropriate.
-   Support filtering using multiple filters together.

### Antigravity Analysis

List the existing session fields and recommend which existing fields are
technically suitable for filters. Do not add unrelated filters without
explaining them.

------------------------------------------------------------------------

## 13. Trainer Dashboard --- Client Birthday

### Required Behavior

-   On trainer login, show birthdays only for clients assigned to that
    trainer.
-   Do not expose other trainers' client birthday information.

### Security Requirement

Filtering must be enforced in the backend query/API, not only in the UI.

------------------------------------------------------------------------

## 14. Trainer Dashboard --- Client Expiry

### Required Behavior

-   Trainer can only view expiry information for assigned clients.
-   Show **Client Name + Expiry Date**.

### Security Requirement

Backend authorization/query scoping must prevent access to other
trainers' clients.

------------------------------------------------------------------------

## 15. Add Payment --- Payment Date

### Required Behavior

-   Add **Payment Date** to the Add Payment form.
-   Allow the user to select the actual payment date.
-   Save the selected date with the payment record.
-   Show/use the saved payment date in relevant payment lists/reports.

### Antigravity Analysis

Check whether reports currently use `created_at` as the effective
payment date. Identify every report/query that must switch to or
intentionally retain its current date source.

------------------------------------------------------------------------

# Cross-Cutting Technical Review

Before implementation, inspect and report on the following:

## Authentication & Authorization

-   Existing roles.
-   Partner role handling.
-   Front Desk role handling.
-   Trainer role handling.
-   Main/admin user handling.
-   Existing permission tables/packages/middleware/policies.
-   Best location for payment-delete and session-duplicate
    authorization.

## Database

Identify existing tables/columns/relations relevant to: -
Users/clients. - Front Desk ownership / added-by. - Trainers and trainer
assignments. - Payments. - Discounts. - Payment deletion/audit. - Manual
collections. - Trainer payouts. - Sessions. - Body measurements. -
Follow-ups. - Expiry dates.

Only propose migrations for data that is genuinely missing.

## Financial Logic

Document the current and proposed behavior for: - Financial year
April--March. - Manual collection totals. - Pending amount. -
Discounts. - Client revenue. - Payment dates. - Plan changes during
payment editing. - Trainer payout payment dates.

## Auditability

For sensitive financial actions, determine how the application should
retain: - Who performed the action. - When it happened. - Deletion
reason. - Discount reason. - Payment date. - Permission/delegation
information.

Reuse any existing audit/activity-log mechanism if available.

## Performance

Review query performance for: - Front Desk scoped client lists. -
Trainer-scoped dashboard data. - Date-range filters. - Month/year
reports. - Multi-filter sessions. - `All` body-measurement pagination.

Recommend indexes only after checking existing indexes and query
patterns.

------------------------------------------------------------------------

# Required Planning Output From Antigravity

Before changing code, return a report using this structure:

## A. Current System Findings

Explain the relevant current implementation discovered in the
repository.

## B. Requirement-by-Requirement Plan

For each of the 15 requirements provide: - Current behavior. -
Files/modules involved. - Proposed change. - Database impact. -
API/backend impact. - Frontend impact. - Permission/security impact. -
Edge cases. - Tests. - Complexity.

## C. Proposed Database Changes

Provide proposed migrations/schema changes only where necessary,
including rollback considerations.

## D. Permission Matrix

Create a matrix covering at least: - Main/Admin. - Front Desk. -
Trainer. - Partner. - The two original privileged payment-delete
users. - Users who are delegated payment-delete permission.

Show access for client visibility, payment deletion, trainer payout
deletion, session duplication, birthday visibility, and expiry
visibility.

## E. Financial Calculation Specification

Write the exact formulas/rules Antigravity believes should be
implemented. Clearly mark anything that cannot be confirmed from the
code or requirements as **Needs Confirmation**.

## F. Implementation Phases

Suggested order: 1. Codebase/database discovery. 2. Permission and
data-model foundation. 3. Payment/collection/financial changes. 4.
User/front-desk/trainer scoping. 5. Reports and filters. 6.
Session/body-measurement changes. 7. Dashboard changes. 8.
Automated/manual QA. 9. Regression/security review.

Adjust this order if repository dependencies indicate a safer sequence.

## G. Risks & Questions

List unclear requirements, migration risks, authorization risks,
financial-calculation risks, and backwards-compatibility concerns.

## H. Test Plan

Include: - Unit/business-logic tests. - Permission/authorization
tests. - API/integration tests. - UI tests. - Financial calculation test
cases. - Date/financial-year boundary tests. - Regression tests.

------------------------------------------------------------------------

# Definition of Done

The planning stage is complete only when Antigravity has:

-   Inspected the actual existing implementation.
-   Mapped all 15 requirements to relevant code.
-   Identified required database changes.
-   Defined permission behavior.
-   Defined or flagged financial formulas.
-   Identified security/data-visibility risks.
-   Listed edge cases.
-   Produced an implementation sequence.
-   Produced a test plan.
-   Clearly listed all **Needs Confirmation** items.

**Do not implement until this planning output has been
reviewed/approved.**
