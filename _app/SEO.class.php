<?php
/**
 * Classe responsavel administrar os dados das páginas.
 * Autor: Ronan Barros Sobrinho
 * Ano: 2020
 */
class SEO
{
    private $script = '';
    private $link = '';
    private $url = '';

    function __construct($url)
    {
        $this->url = $url;
        $page = (!empty($url[1])) ? $url[1] : $url[0];

        switch($page)
        {
            case 'home':
                self::setScriptJs($page);
                self::Home();
            break;

            case 'funcionario':
                self::setScriptJs($page);
                self::Funcionario();
            break;

            default:
                self::Erro404();
            break;
        }
    }

    /**
     * Instancia um objeto da classe Router para invocar a View.
     * @var $url = url da barra de endereço.
     */
    public function Show()
    {
        $router = new Router($this->url);
        $router->getPage();
    }

    function Home()
    {
        $this->link = '
        <meta name="description" content="Início"/>
        <meta name="keywords" content="Início" />
        <title>Início | Página inicial do site</title>
        ';
    }

    function Funcionario()
    {
        $this->link = '
        <meta name="description" content="Cadastro de funcionário"/>
        <meta name="keywords" content="Funcionário" />
        <title>Cadastro de funcionário | Previsa</title>
        ';
    }

    function Erro404()
    {
        $this->link = '
        <title>Erro 404 | página não encontrada!</title>
        ';
    }

    /** 
     * Define o script do arquivo js da view selecionada.
     * @var $page = nome da view.
     */
    private function setScriptJs($page)
    {
        $this->script = "<script src ='".SITE_URL."/js/{$page}.js'></script>";
    }

    //Retorna as meta tags e title da página.
    public function getLink()
    {
        return $this->link;
    }

    /** Retorna a tag script do aquivo js. */
    public function getScriptJs()
    {
        return $this->script;
    }
}