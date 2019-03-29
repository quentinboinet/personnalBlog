<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* homeView.php */
class __TwigTemplate_92599baba2256d1785faec1d9417358823e5614dcbe514b151bac05b47111e41 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = [])
    {
        // line 2
        echo "<h1>Hello World!</h1>
";
    }

    public function getTemplateName()
    {
        return "homeView.php";
    }

    public function getDebugInfo()
    {
        return array (  42 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "homeView.php", "D:\\wamp64\\www\\projet5_OC\\templates\\homeView.php");
    }
}
