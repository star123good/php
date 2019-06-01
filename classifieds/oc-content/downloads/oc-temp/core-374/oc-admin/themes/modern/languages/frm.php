<?php if ( ! defined('OC_ADMIN')) exit('Direct access is not allowed.');

/*
 * Copyright 2014 Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

    osc_enqueue_script('jquery-validate');

    function customPageHeader() { ?>
        <h1><?php _e('Settings'); ?></h1>
<?php
    }
    osc_add_hook('admin_page_header','customPageHeader');

    function customPageTitle($string) {
        return sprintf(__('Edit language &raquo; %s'), $string);
    }
    osc_add_filter('admin_title', 'customPageTitle');

    //customize Head
    function customHead() {
        LanguageForm::js_validation();
    }
    osc_add_hook('admin_header','customHead', 10);

    $aLocale = __get('aLocale');

    osc_current_admin_theme_path( 'parts/header.php' ); ?>
<h2 class="render-title"><?php _e('Edit language'); ?></h2>
<div id="language-form">
    <ul id="error_list"></ul>
    <form name="language_form" action="<?php echo osc_admin_base_url(true); ?>" method="post">
        <input type="hidden" name="page" value="languages" />
        <input type="hidden" name="action" value="edit_post" />
        <?php LanguageForm::primary_input_hidden($aLocale); ?>

        <div class="form-horizontal">
            <div class="form-row">
                <div class="form-label"><?php _e('Name'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::name_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Short name'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::short_name_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Description'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::description_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Currency format'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::currency_format_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Number of decimals'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::num_dec_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Decimal point'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::dec_point_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Thousands separator'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::thousands_sep_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Date format'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::date_format_input_text($aLocale); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"><?php _e('Stopwords'); ?></div>
                <div class="form-controls">
                    <?php LanguageForm::description_textarea(
�  T                                                   2           7           Y           Y   �  �'Z     �       Z�     T�    ��t8�  ț�    GM    ���    ���     �              7�    GM     7�    F�     XY�    GM    HY�    Y��     0                     GM    @�t8�  �R�            XY�    ��t8�  ��            hD�>            ���    ׸    hD�>c  �D�>c  �D�>c   ?�    �>�    XY�           ��t8�  ��                    �t8�  ��     �:W                          ��t8�  ø�            ���           GM     T�     �t8�  ���     ��t8�����Xc�N�����     (Y�+         ����    �D�>c   +�          ��t8�  ��t8�  0              �GM    �W�    ��t8�  F�     ����   H:�>c   E�>c  ���     �t8�  ���     H   