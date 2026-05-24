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
use Twig\TemplateWrapper;

/* front/about.html.twig */
class __TwigTemplate_c411387bf17e0fa3f5761894b6fc7bbb extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'front' => [$this, 'block_front'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "front.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/about.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/about.html.twig"));

        $this->parent = $this->load("front.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_front(array $context, array $blocks = []): iterable
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
                    Son approche artistique transcende les frontières conventionnelles de la photographie, capturant l\x27essence même de la nature dans ses images, où la majesté des paysages se mêle à une profonde réflexion sur l\x27harmonie entre l\x27homme et son environnement.
                    <br>
                    <br>
                    Sa démarche est imprégnée d\x27un respect profond pour la Terre, embrassant la simplicité et la pureté des modes de déplacement traditionnels pour mieux se fondre dans les décors qu\x27elle immortalise.
                    <br>
                    <br>
                    Chaque cliché d\x27Ina Zaoui est une ode à la beauté brute et à la fragilité de notre planète, invitant le spectateur à contempler, avec émerveillement et conscience, la richesse infinie des paysages terrestres.
                </p>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/about.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  80 => 6,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \x27front.html.twig\x27 %}

{% block front %}
    <div class=\"row align-items-stretch justify-content-center\">
        <div class=\"col-4\">
            <img src=\"{{ asset(\x27images/ina.png\x27) }}\" alt=\"Ina Zaoui\" class=\"about-img w-100\">
        </div>
        <div class=\"col-4\">
            <div class=\"d-flex flex-column justify-content-center align-items-start h-100 gap-3 ps-5\">
                <h2 class=\"about-title\">Qui suis-je ?</h2>
                <p class=\"about-description\">
                    Ina Zaoui est une photographe globe-trotteuse, réputée pour son engagement à explorer les paysages du monde entier en utilisant exclusivement des moyens non motorisés tels que la marche, le vélo ou la voile.
                    <br>
                    <br>
                    Son approche artistique transcende les frontières conventionnelles de la photographie, capturant l\x27essence même de la nature dans ses images, où la majesté des paysages se mêle à une profonde réflexion sur l\x27harmonie entre l\x27homme et son environnement.
                    <br>
                    <br>
                    Sa démarche est imprégnée d\x27un respect profond pour la Terre, embrassant la simplicité et la pureté des modes de déplacement traditionnels pour mieux se fondre dans les décors qu\x27elle immortalise.
                    <br>
                    <br>
                    Chaque cliché d\x27Ina Zaoui est une ode à la beauté brute et à la fragilité de notre planète, invitant le spectateur à contempler, avec émerveillement et conscience, la richesse infinie des paysages terrestres.
                </p>
            </div>
        </div>
    </div>
{% endblock %}
", "front/about.html.twig", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/templates/front/about.html.twig");
    }
}
