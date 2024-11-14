<?php

namespace Drupal\user_register_form_override\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for the User Register Form Override module.
 */
class UserRegisterOverrideSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['user_register_form_override.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_register_override_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('user_register_form_override.settings');

    $form['email_help_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Email Help Text'),
      '#default_value' => $config->get('email_help_text') ?: 'The email address is not made public. It will only be used if you need to be contacted about your account or for opted-in notifications.',
      '#description' => $this->t('Customize the help text for the email address field.'),
    ];

    $form['username_help_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Username Help Text'),
      '#default_value' => $config->get('username_help_text') ?: 'Several special characters are allowed, including space, period (.), hyphen (-), apostrophe (\'), underscore (_), and the @ sign.',
      '#description' => $this->t('Customize the help text for the username field.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('user_register_form_override.settings')
      ->set('email_help_text', $form_state->getValue('email_help_text'))
      ->set('username_help_text', $form_state->getValue('username_help_text'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
