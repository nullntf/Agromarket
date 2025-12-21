<?php

class Language {
    private static $instance = null;
    private $language = 'es'; // Default language
    private $translations = [];
    private $loadedFiles = [];

    private function __construct() {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function init() {
        // Set language from session or use default
        if (isset($_SESSION['language']) && in_array($_SESSION['language'], ['es', 'en'])) {
            $this->language = $_SESSION['language'];
        }

        // Load common language file
        $this->loadLanguageFile('common');
    }

    public function setLanguage($language) {
        if (in_array($language, ['es', 'en'])) {
            $this->language = $language;
            $_SESSION['language'] = $language;
            return true;
        }
        return false;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function loadLanguageFile($file) {
        $filePath = __DIR__ . "/../config/languages/{$this->language}.php";
        
        // If already loaded, return
        if (in_array($filePath, $this->loadedFiles)) {
            return true;
        }

        if (file_exists($filePath)) {
            $translations = require $filePath;
            $this->translations = array_merge($this->translations, $translations);
            $this->loadedFiles[] = $filePath;
            return true;
        }
        
        return false;
    }

    public function get($key, $default = null) {
        $keys = explode('.', $key);
        $value = $this->translations;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default !== null ? $default : $key;
            }
            $value = $value[$k];
        }

        return $value;
    }

    public function e($key, $default = null) {
        echo htmlspecialchars($this->get($key, $default), ENT_QUOTES, 'UTF-8');
    }
}

// Helper function for easy access
trans('key', 'default');
function trans($key, $default = null) {
    return Language::getInstance()->get($key, $default);
}

// Helper function for echoing translated text
function _e($key, $default = null) {
    Language::getInstance()->e($key, $default);
}
