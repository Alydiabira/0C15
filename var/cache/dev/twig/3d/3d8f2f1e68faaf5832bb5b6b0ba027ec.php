<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* front/about.html.twig */
class __TwigTemplate_83d1b77672f81ac5c143a96a1f383ac5 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'front' => [$this, 'block_front'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "front.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/about.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/about.html.twig"));

        $this->parent = $this->loadTemplate("front.html.twig", "front/about.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_front($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "front"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "front"));

        // line 4
        yield "    <div class=\"row align-items-stretch justify-content-center\">
        <div class=\"col-4\">
            <img src=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/ina.png"), "html", null, true);
        yield "\" alt=\"Ina Zaoui\" class=\"about-img w-100\">
        </div>
        <div class=\"col-4\">
            <div class=\"d-flex flex-column justify-content-center align-items-start h-100 gap-3 ps-5\">
                <h2 class=\"about-title\">Qui suis-je ?</h2>
                <p class=\"about-description\">
                    Ina Zaoui est une photographe globe-trotteuse, réputée pour son engagement à explorer les paysages du monde entier en utilisant exclusivement des moyens non motorisés tels que la marche, le vélo ou la voile.
                    <br>
                    <br>
                    Son approche artistique transcende les frontières conventionnelles de la photographie, capturant l'essence même de la nature dans ses images, où la majesté des paysages se mêle à une profonde réflexion sur l'harmonie entre l'homme et son environnement.
                    <br>
                    <br>
                    Sa démarche est imprégnée d'un respect profond pour la Terre, embrassant la simplicité et la pureté des modes de déplacement traditionnels pour mieux se fondre dans les décors qu'elle immortalise.
                    <br>
                    <br>
                    Chaque cliché d'Ina Zaoui est une ode à la beauté brute et à la fragilité de notre planète, invitant le spectateur à contempler, avec émerveillement et conscience, la richesse infinie des paysages terrestres.
                </p>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "front/about.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  73 => 6,  69 => 4,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'front.html.twig' %}

{% block front %}
    <div class=\"row align-items-stretch justify-content-center\">
        <div class=\"col-4\">
            <img src=\"{{ asset('images/ina.png') }}\" alt=\"Ina Zaoui\" class=\"about-img w-100\">
        </div>
        <div class=\"col-4\">
            <div class=\"d-flex flex-column justify-content-center align-items-start h-100 gap-3 ps-5\">
                <h2 class=\"about-title\">Qui suis-je ?</h2>
                <p class=\"about-description\">
                    Ina Zaoui est une photographe globe-trotteuse, réputée pour son engagement à explorer les paysages du monde entier en utilisant exclusivement des moyens non motorisés tels que la marche, le vélo ou la voile.
                    <br>
                    <br>
                    Son approche artistique transcende les frontières conventionnelles de la photographie, capturant l'essence même de la nature dans ses images, où la majesté des paysages se mêle à une profonde réflexion sur l'harmonie entre l'homme et son environnement.
                    <br>
                    <br>
                    Sa démarche est imprégnée d'un respect profond pour la Terre, embrassant la simplicité et la pureté des modes de déplacement traditionnels pour mieux se fondre dans les décors qu'elle immortalise.
                    <br>
                    <br>
                    Chaque cliché d'Ina Zaoui est une ode à la beauté brute et à la fragilité de notre planète, invitant le spectateur à contempler, avec émerveillement et conscience, la richesse infinie des paysages terrestres.
                </p>
            </div>
        </div>
    </div>
{% endblock %}
", "front/about.html.twig", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/templates/front/about.html.twig");
    }
}
