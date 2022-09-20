<?php

namespace Panda\post;

class Post_Tag_mm
{
    public int $id_post;
    public int $id_tag;

    public function __construct(array $post_tag)
    {
        $this->id_post = (int)$post_tag['id_post'];
        $this->id_tag = (int)$post_tag['id_tag'];
    }
}