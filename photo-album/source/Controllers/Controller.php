<?php

namespace Source\Controllers;

abstract class Controller 
{
    public function __construct() {

    }

    /**
     * Redireciona para view renderizada pelo Twig.
     * @param string view Nome do arquivo HTML, não é necessário informar a extenção.
     * @param array|null properties Propriedades para serem acessados por métodos Twig.
     */
    public static function View($view, $properties = [])
    {
        //Cria uma instancia do Twig.
        $loader = new \Twig\Loader\FilesystemLoader("source/Views");
        $twig = new \Twig\Environment($loader, [
                //'debug' => true
            ]
        );

        $properties = [
            "route" => $_SERVER['REQUEST_URI'],
            ... $properties
        ];

        // echo "<pre>"; print_r($properties); echo "</pre>"; exit;

        //Renderiza a página HTML.
        echo $twig->render($view.".html", $properties);
    }
}
