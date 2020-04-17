<?php
/**
 * Classe responsavel por carregar as views no navegador.
 * Autor: Ronan Barros Sobrinho
 * Ano: 2020
 */
class Router
{
    private $page = null;

    /**
     * Método construtor da classe Router.
     * @var $url = url da barra de endereço.
     */
    function __construct($url)
    {
        $url[1] = (!empty($url[1]) ? $url[1] : null);

        if(file_exists($url[0].'.php')):
            $this->page = (string) $url[0].'.php';
        elseif (file_exists($url[0].'/'.$url[1].'.view.php')):
            $this->page = (string) $url[0].'/'.$url[1].'.view.php';
        else:
            $this->page = (string) '404.php';
        endif;
    }

    /** Retorna a página para a classe SEO */
    public function getPage()
    {
        require $this->page;
    }
}