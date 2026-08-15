<?php

declare(strict_types=1);

namespace Core;

use Support\Csrf;
use Support\Flash;
use Support\Old;
use Support\Abort;

class Controller {

    protected array $middleware = [];

    public function runMiddleware(string $method): void {
        if (Request::isPost()) {
            $token = Request::post('_token');

            if (!$token || !Csrf::validate((string) $token)) {
                Abort::error(403);
            }
        }

        Middleware::run($this->middleware, $method);
    }
    
    protected function view(string $view, array $data = []): void {
        View::getInstance()->render($view, $data);

        Old::clear();
        Flash::clear();
    }

    protected function failIf(
        mixed $condition, 
        string $redirect, 
        string|array $errors, 
        ?string $message = null
    ): void {
        if (!$condition) {
            return;
        }

        Old::set();

        if (is_array($errors)) {
            Flash::set('errors', $errors);
        } else {
            Flash::set($errors, (string) $message);
        }

        Redirect::to($redirect);
    }

    protected function redirectIf(
        mixed $condition,
        string $redirect,
        ?string $flashKey = null,
        ?string $flashMessage = null
    ): void {
        if (!$condition) {
            return;
        }

        if ($flashKey !== null) {
            Flash::set($flashKey, (string) $flashMessage);
        }

        Redirect::to($redirect);
    }

    protected function abortIf(mixed $condition, int $code = 404): void {
        if (!$condition) {
            return;
        }

        Abort::error($code);
    }
}