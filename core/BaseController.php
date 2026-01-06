<?php
// Clase base para todos los controladores
// Puede contener lógica común para controladores

abstract class BaseController
{
    protected $lang;

    public function __construct()
    {
        // Inicializar el helper de idioma
        require_once __DIR__ . '/../helpers/Language.php';
        $this->lang = Language::getInstance();

        // Cargar el archivo de idioma del admin
        $this->lang->loadLanguageFile('es');

        // Si hay un cambio de idioma en la URL, actualizarlo
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'])) {
            $this->lang->setLanguage($_GET['lang']);

            // Redirigir sin el parámetro de idioma para evitar problemas con refrescos
            $url = strtok($_SERVER['REQUEST_URI'], '?');
            header('Location: ' . $url);
            exit();
        }
    }

    // Método para renderizar vistas
    protected function render($view, $data = [])
    {
        // Agregar helper de traducción a los datos de la vista
        $data['_'] = [$this->lang, 'get'];
        $data['_e'] = [$this->lang, 'e'];

        // Agregar BASE_URL a las vistas para generar URLs correctas
        $data['BASE_URL'] = BASE_URL;

        // Extraer datos para usar en la vista
        extract($data);

        // Iniciar el buffer de salida
        ob_start();

        // Incluir el archivo de vista
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            throw new Exception("View file not found: " . $view);
        }

        // Obtener el contenido del buffer y limpiarlo
        $content = ob_get_clean();

        // Mostrar el contenido
        echo $content;
    }

    // Método para cambiar el idioma
    protected function setLanguage($language)
    {
        return $this->lang->setLanguage($language);
    }

    // Método para obtener el idioma actual
    protected function getLanguage()
    {
        return $this->lang->getLanguage();
    }
}