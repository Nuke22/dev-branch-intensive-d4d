<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\Client;

/**
 * Class MyController.
 *
 * @package Drupal\mymodule\Controller
 */
class APIHandler extends ControllerBase
{

  /**
   * Guzzle\Client instance.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * {@inheritdoc}
   */
  public function __construct(ClientInterface $http_client)
  {
    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('http_client')
    );
  }

  /**
   * Posts route callback.
   *
   * @param int $limit
   *   The total number of posts we want to fetch.
   * @param string $sort
   *   The sorting order.
   *
   * @return array
   *   A render array used to show the Posts list.
   */
  public function posts($limit, $sort)
  {
    $build = [
      '#theme' => 'mymodule_posts_list',
      '#posts' => [],
    ];

    $request = $this->httpClient->request('GET', 'http://api.example.com/posts', [
      'limit' => $limit,
      'sort' => $sort,
    ]);

    if ($request->getStatusCode() != 200) {
      return $build;
    }

    $posts = $request->getBody()->getContents();
    foreach ($posts as $post) {
      $build['#posts'][] = [
        'id' => $post['id'],
        'title' => $post['title'],
        'text' => $post['text'],
      ];
    }
    return $build;
  }

  /**
   * Post Comments route callback.
   *
   * @param int $postId
   *   The ID of the Post.
   *
   * @return array
   *   A render array used to show the Comments list.
   */
  public function postComments($postId)
  {
    $build = [
      '#theme' => 'mymodule_post_comments_list',
      '#comments' => [],
    ];

    $request = $this->httpClient->request('GET', 'http://api.example.com/posts/' . $postId . '/comments');

    if ($request->getStatusCode() != 200) {
      return $build;
    }

    $comments = $request->getBody()->getContents();
    foreach ($comments as $comment) {
      $build['#comments'][] = [
        'id' => $comment['id'],
        'title' => $comment['title'],
        'text' => $comment['text'],
      ];
    }
    return $build;
  }

}
