<?php
$posts['meta'] = $this->renderPaginator($this->posts);
$posts['data'] = [];

foreach ($this->posts as $post) {
    $posts['data'][] = $this->renderResource('blog/post', ['post' => $post]);
}

return $posts;
