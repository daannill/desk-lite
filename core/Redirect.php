<?php

namespace Core;

class Redirect {

    public static function to(string $path) {
        if (preg_match('#^https?://#i', $path)) {
            header('Location: ' . $path);
        } else {
            header('Location: ' . BASEURL . $path);
        }

        exit;
    }
    
}