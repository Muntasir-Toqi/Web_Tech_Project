<?php
class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/' . $view;
        include __DIR__ . '/../views/layouts/footer.php';
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}
