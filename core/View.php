<?php

namespace Core;

class View {

    private static ?View $instance = null;

    private string $layout = '';
    private array $sections = [];
    private string $currentSection = '';

    public static function getInstance(): View {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    public function setLayout(string $layout): void {
        $this->layout = $layout;
    }

    public function startSection(string $name): void {
        $this->currentSection = $name;
        ob_start();
    }

    public function stopSection(): void {
        $this->sections[$this->currentSection] = ob_get_clean();
    }

    public function getSection(string $name): void {
        echo $this->sections[$name] ?? '';
    }

    public function renderComponent(string $path, array $data = []): void {
        $componentView = new self();
        
        foreach (get_object_vars($this) as $key => $value) {
            if (!in_array($key, ['layout', 'sections', 'currentSection'])) {
                $componentView->{$key} = $value;
            }
        }
        
        foreach ($data as $key => $value) {
            $componentView->{$key} = $value;
        }
        
        $oldInstance = self::$instance;
        self::$instance = $componentView;
        
        // As per rule, $this->nama_var inside the view.
        // Wait, if it's a global function calling this, how does the view file access the variables?
        // Ah! If the view file is `require`d inside this method, `$this` refers to $componentView.
        // So the user can still use `$this->nama_var`!
        require APP_PATH . "/app/views/$path.php";
        
        self::$instance = $oldInstance;
    }

    public function render(string $view, array $data = []): void {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
        
        self::$instance = $this;

        ob_start();
        require APP_PATH . "/app/views/$view.php";
        $content = ob_get_clean();

        if ($this->layout !== '') {
            $this->sections['content'] = $content;
            require APP_PATH . "/app/views/{$this->layout}.php";
        } else {
            echo $content;
        }
    }
}
