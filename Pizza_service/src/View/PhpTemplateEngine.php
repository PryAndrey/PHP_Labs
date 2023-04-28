<?php

namespace App\View;

class PhpTemplateEngine
{
    private const TEMPLATES_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates';
    
    public static function render(string $templateName, array $vars = []): string
    {
        $templatePath = self::TEMPLATES_DIR . DIRECTORY_SEPARATOR . $templateName;
        if (!ob_start())
        {
            throw new \RuntimeException("Failed to render '$templateName': ob_start() failed");
        }
        try
        {
            extract($vars, EXTR_SKIP);
            require($templatePath);
            $contents = ob_get_contents();
        }
        finally
        {
            ob_end_clean();
        }
        return $contents;
    }
}