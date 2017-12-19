<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User Groups'), ['controller' => 'UserGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Group'), ['controller' => 'UserGroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Industries'), ['controller' => 'Industries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Industry'), ['controller' => 'Industries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ads'), ['controller' => 'Ads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ad'), ['controller' => 'Ads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comment Likes'), ['controller' => 'CommentLikes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment Like'), ['controller' => 'CommentLikes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lang Manage Messages'), ['controller' => 'LangManageMessages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lang Manage Message'), ['controller' => 'LangManageMessages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lang Messages'), ['controller' => 'LangMessages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lang Message'), ['controller' => 'LangMessages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Login Tokens'), ['controller' => 'LoginTokens', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Login Token'), ['controller' => 'LoginTokens', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List News'), ['controller' => 'News', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New News'), ['controller' => 'News', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List News Likes'), ['controller' => 'NewsLikes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New News Like'), ['controller' => 'NewsLikes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List News Report Abuses'), ['controller' => 'NewsReportAbuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New News Report Abus'), ['controller' => 'NewsReportAbuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Otps'), ['controller' => 'Otps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Otp'), ['controller' => 'Otps', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scheduled Email Recipients'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scheduled Email Recipient'), ['controller' => 'ScheduledEmailRecipients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subscribers'), ['controller' => 'Subscribers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subscriber'), ['controller' => 'Subscribers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tokens'), ['controller' => 'Tokens', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Token'), ['controller' => 'Tokens', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Activities'), ['controller' => 'UserActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Activity'), ['controller' => 'UserActivities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Contacts'), ['controller' => 'UserContacts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Contact'), ['controller' => 'UserContacts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Details'), ['controller' => 'UserDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Detail'), ['controller' => 'UserDetails', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Email Recipients'), ['controller' => 'UserEmailRecipients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Email Recipient'), ['controller' => 'UserEmailRecipients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Email Signatures'), ['controller' => 'UserEmailSignatures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Email Signature'), ['controller' => 'UserEmailSignatures', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Email Templates'), ['controller' => 'UserEmailTemplates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Email Template'), ['controller' => 'UserEmailTemplates', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Settings'), ['controller' => 'UserSettings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Setting'), ['controller' => 'UserSettings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Socials'), ['controller' => 'UserSocials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Social'), ['controller' => 'UserSocials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('guestid');
            echo $this->Form->control('user_group_id', ['options' => $userGroups]);
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            echo $this->Form->control('secondry_email');
            echo $this->Form->control('phone_prefix');
            echo $this->Form->control('mobile_no');
            echo $this->Form->control('name_prefix');
            echo $this->Form->control('name');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('gender');
            echo $this->Form->control('photo');
            echo $this->Form->control('bday', ['empty' => true]);
            echo $this->Form->control('active');
            echo $this->Form->control('email_verified');
            echo $this->Form->control('api_key');
            echo $this->Form->control('heard_us');
            echo $this->Form->control('about_me');
            echo $this->Form->control('source');
            echo $this->Form->control('address');
            echo $this->Form->control('website_url');
            echo $this->Form->control('merital_status');
            echo $this->Form->control('nationality');
            echo $this->Form->control('utm_source');
            echo $this->Form->control('utm_medium');
            echo $this->Form->control('utm_campaign');
            echo $this->Form->control('country_id', ['options' => $countries, 'empty' => true]);
            echo $this->Form->control('state_id', ['options' => $states, 'empty' => true]);
            echo $this->Form->control('industry_id', ['options' => $industries, 'empty' => true]);
            echo $this->Form->control('skill_id');
            echo $this->Form->control('language_id', ['options' => $languages, 'empty' => true]);
            echo $this->Form->control('city');
            echo $this->Form->control('tag_id', ['options' => $tags, 'empty' => true]);
            echo $this->Form->control('registration_date', ['empty' => true]);
            echo $this->Form->control('last_login', ['empty' => true]);
            echo $this->Form->control('ip_address');
            echo $this->Form->control('follewer_count');
            echo $this->Form->control('following_count');
            echo $this->Form->control('recomandation_count');
            echo $this->Form->control('login_count');
            echo $this->Form->control('redis');
            echo $this->Form->control('mongo');
            echo $this->Form->control('elastic');
            echo $this->Form->control('earned_points');
            echo $this->Form->control('change_password');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
