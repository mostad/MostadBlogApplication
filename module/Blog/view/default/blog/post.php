<?php
/** @var \Blog\Entity\Post $post */
$post = $this->post;

return [
    'id'     => $post->getId(),
    'header' => $post->getHeader(),
    'body'   => $post->getBody(),
];
