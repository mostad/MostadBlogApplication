<?php
/** @var \Blog\Entity\Post $post */
$post = $this->post;

return [
    'id'      => $post->getId(),
    'created' => $post->getCreated(),
    'updated' => $post->getUpdated(),
    'header'  => $post->getHeader(),
    'body'    => $post->getBody(),
];
