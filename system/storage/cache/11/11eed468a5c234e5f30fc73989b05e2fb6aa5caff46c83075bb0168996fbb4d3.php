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

/* x.html.twig */
class __TwigTemplate_947502fbf8d4e7220d45fdd0cef658cfb0477aace82a2cc6fde891309c49bfc7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        echo ($context["title_x"] ?? null);
        echo "</title>
</head>
<body>
<div id=\"content\">
    <div class=\"border: 1px\">
        <!--E:\\openserver\\domains\\x.app.loc\\app\\view\\default\\template -->
        <a href=\"http://x.app.loc/app/view/default/template/blank_ru.html\">";
        // line 11
        echo ($context["linkBlank_ru"] ?? null);
        echo "</a>
        <a href=\"http://x.app.loc/app/view/default/template/blank.html\">";
        // line 12
        echo ($context["linkBlank_en"] ?? null);
        echo "</a>
        <a href=\"http://x.app.loc/app/view/default/blank.html\">";
        // line 13
        echo ($context["linkBlank_en"] ?? null);
        echo "</a>
    </div>

</div>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "x.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 13,  56 => 12,  52 => 11,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "x.html.twig", "E:\\openserver\\domains\\x.app.loc\\app\\view\\theme\\x.html.twig");
    }
}
