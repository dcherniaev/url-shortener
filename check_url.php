<?php
function checkURL(string $url) : bool{
    $post_data = htmlentities(trim($url));
    if (filter_var($post_data, FILTER_VALIDATE_URL)) {
        return true;
    }
    return false;
}