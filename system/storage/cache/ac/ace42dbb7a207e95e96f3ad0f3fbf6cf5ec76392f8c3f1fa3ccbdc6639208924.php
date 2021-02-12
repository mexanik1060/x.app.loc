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

/* test.html.twig */
class __TwigTemplate_4415f64330f8a6825e134bc1de03707e5729d0e0ef09a7af3de780980ceddd23 extends Template
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
        echo ($context["title"] ?? null);
        echo "</title>
</head>
<body>
<div>
    <pre>
    <a href=\"http://x.app.loc/x.php\">";
        // line 10
        echo ($context["linkX"] ?? null);
        echo "</a>
    </pre>
</div>
<div>
    <form action=\"";
        // line 14
        echo ($context["urlController"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
    <fieldset>
        <legend>";
        // line 16
        echo ($context["formLegend"] ?? null);
        echo "</legend>
        <label>";
        // line 17
        echo ($context["loginTitle"] ?? null);
        echo "</label>
        <label>
            <input type=\"text\" name=\"login\" placeholder=\"\">
        </label>
        <label>";
        // line 21
        echo ($context["passwordTitle"] ?? null);
        echo "</label>
        <label>
            <input type=\"password\" name=\"password\" placeholder=\"\">
        </label>
        <button name=\"submit\">";
        // line 25
        echo ($context["buttonTitle"] ?? null);
        echo "</button>
    </fieldset>
    </form>
</div>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "test.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 25,  74 => 21,  67 => 17,  63 => 16,  58 => 14,  51 => 10,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "test.html.twig", "E:\\openserver\\domains\\x.app.loc\\app\\view\\theme\\test.html.twig");
    }
}
