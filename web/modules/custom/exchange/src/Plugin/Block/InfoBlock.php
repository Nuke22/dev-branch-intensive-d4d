<?php

namespace Drupal\exchange\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "my_block_example_block",
 *   admin_label = @Translation("Exchange rate"),
 * )
 */
class InfoBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $client = new Client(['headers' => ["Content-Type" => "text/plain",
      "apikey" => "nLLb5KOToJRW5BrWJIdn7Ssy49Ca4iEA"]]);
    try {
      $response = $client->get('https://api.apilayer.com/exchangerates_data/convert?to=UAH&from=USD&amount=1');
      $result = json_decode($response->getBody(), TRUE);
      $raw_course = $result["info"]["rate"];
    }
    catch (RequestException $e) {
      $boo = 1;// log exception
    }
    $rounded_course = round($raw_course, 2);
    return [
      '#markup' => $this->t("$rounded_course UAH for 1 USD today"),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form = parent::blockForm($form, $form_state);

    $form['hello_block_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => $config['hello_block_name'] ?? '', ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
    $this->configuration["hello_block_name"] = $form_state->getValue('hello_block_name');
  }

  /**
   * @return int
   * this part disables cache in order to update info automatically
   */
  public function getCacheMaxAge() {
    return 0;
  }
}
