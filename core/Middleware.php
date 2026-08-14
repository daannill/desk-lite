<?php

namespace Core;

class Middleware {

    private static string $handler = '';

    public static function register(string $class): void {
        self::$handler = $class;
    }

    public static function run(array $middlewares, string $method): void {
        foreach ($middlewares as $name => $options) {
            if (!method_exists(self::$handler, $name)) {
                continue;
            }

            if (isset($options['only']) && in_array($method, $options['only'], true)) {
                self::$handler::$name();
            } elseif (isset($options['except']) && !in_array($method, $options['except'], true)) {
                self::$handler::$name();
            } elseif (!isset($options['only']) && !isset($options['except'])) {
                self::$handler::$name();
            }
        }
    }
}