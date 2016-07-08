<?php

function gravatar_link($email)
{
    $email = md5($email);

    return "//www.gravatar.com/avatar/{$email}?s=22";
}

/**
 * @param $status
 * @return mixed
 */
function timeSincePublished($status)
{
    return $status->created_at->diffForHumans();
}

function pageName()
{
        $url = Request::url();
        $parts = Explode('/', $url);
        $pageName = $parts[count($parts) - 1];

        return $pageName;
}