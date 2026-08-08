<?php

use Core\View;

if (!function_exists('extend')) {
    function extend(string $layout): void {
        View::getInstance()->setLayout($layout);
    }
}

if (!function_exists('section')) {
    function section(string $name): void {
        View::getInstance()->startSection($name);
    }
}

if (!function_exists('endSection')) {
    function endSection(): void {
        View::getInstance()->stopSection();
    }
}

if (!function_exists('show')) {
    function show(string $name): void {
        View::getInstance()->getSection($name);
    }
}

if (!function_exists('component')) {
    function component(string $path, array $data = []): void {
        View::getInstance()->renderComponent($path, $data);
    }
}
