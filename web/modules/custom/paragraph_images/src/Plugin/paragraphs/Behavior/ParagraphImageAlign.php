<?php

namespace

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @ParagraphsBehavior(
 *   id = "dummy_paragraph_title",
 *   label = @Translation("Paragraph title element"),
 *   description = @Translation("Allows to select HTML wrapper for title."),
 *   weight = 0,
 * )
 */
class ParagraphImageAlign extends ParagraphsBehaviorBase {

  /**
   * {@inheritDoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {
    // TODO: Implement view() method.
  }
}
