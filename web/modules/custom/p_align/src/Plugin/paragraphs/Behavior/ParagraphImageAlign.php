<?php

namespace Drupal\p_align\Plugin\paragraphs\Behavior;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @ParagraphsBehavior(
 *   id = "paragraph_images_align",
 *   label = @Translation("Paragraph images align!!"),
 *   description = @Translation("Allows to chose when the image will be aligned to the left or to the right"),
 *   weight = 0,
 * )
 */
class ParagraphImageAlign extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type) {
    if ($paragraphs_type->id() == 'article_s_body') {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {
    $image_position = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $build['#attributes']['class'][] = 'image-position--' . str_replace('_', '-', $image_position);
  }

  /**
   * {@inheritdoc}
   */
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {

    $form['image_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Image position'),
      '#options' => $this->getImagePositionOptions(),
      '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(Paragraph $paragraph) {
    $image_position = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $image_position_options = $this->getImagePositionOptions();

    $summary = [];
    $summary[] = $this->t('Image posiion: @value', ['@value' => $image_position_options[$image_position]]);
    return $summary;
  }

  /**
   * Return options for image position.
   */
  private function getImagePositionOptions() {
    return [
      'left' => $this->t('Left'),
      'right' => $this->t('Right'),
    ];
  }

}
