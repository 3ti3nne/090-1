<?php

namespace Panda\post;

class Post
{
    public $id;
    public $blog_id;
    public $title;
    public $date_post;
    public $author;
    public $content;

    public function __construct(array $post)
    {
        $this->id = NULL;
        $this->blog_id = (int)$post['blog_id'];
        $this->title = (string)$post['title'];
        $this->date_post = (int)time();
        $this->author = (int)$post['author'];
        $this->content = (string)$post['content'];
    }
}