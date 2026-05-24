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

/* admin/invite/index.html.twig */
class __TwigTemplate_434169650039e450ac9a49cb566ba7ab extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/invite/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/invite/index.html.twig"));

        // line 1
        yield "<h1>Invités</h1>

<a href=\"";
        // line 3
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_invite_new");
        yield "\">Ajouter un invité</a>

<table>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Bloqué</th>
        <th>Actions</th>
    </tr>

    ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["invites"]) || array_key_exists("invites", $context) ? $context["invites"] : (function () { throw new RuntimeError('Variable "invites" does not exist.', 13, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["invite"]) {
            // line 14
            yield "        <tr>
            <td>";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "name", [], "any", false, false, false, 15), "html", null, true);
            yield "</td>
            <td>";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "email", [], "any", false, false, false, 16), "html", null, true);
            yield "</td>
            <td>";
            // line 17
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "isBlocked", [], "any", false, false, false, 17)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Oui") : ("Non"));
            yield "</td>
            <td>
                ";
            // line 19
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "isBlocked", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 20
                yield "                    <form method=\"post\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_invite_block", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "id", [], "any", false, false, false, 20)]), "html", null, true);
                yield "\">
                        <button type=\"submit\">Bloquer</button>
                    </form>
                ";
            }
            // line 24
            yield "
                <form method=\"post\" action=\"";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_invite_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "id", [], "any", false, false, false, 25)]), "html", null, true);
            yield "\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_invite_" . CoreExtension::getAttribute($this->env, $this->source, $context["invite"], "id", [], "any", false, false, false, 26))), "html", null, true);
            yield "\">
                    <button type=\"submit\">Supprimer</button>
                </form>
            </td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['invite'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        yield "</table>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/invite/index.html.twig";
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
        return array (  114 => 32,  102 => 26,  98 => 25,  95 => 24,  87 => 20,  85 => 19,  80 => 17,  76 => 16,  72 => 15,  69 => 14,  65 => 13,  52 => 3,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<h1>Invités</h1>

<a href=\"{{ path(\x27admin_invite_new\x27) }}\">Ajouter un invité</a>

<table>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Bloqué</th>
        <th>Actions</th>
    </tr>

    {% for invite in invites %}
        <tr>
            <td>{{ invite.name }}</td>
            <td>{{ invite.email }}</td>
            <td>{{ invite.isBlocked ? \x27Oui\x27 : \x27Non\x27 }}</td>
            <td>
                {% if not invite.isBlocked %}
                    <form method=\"post\" action=\"{{ path(\x27admin_invite_block\x27, {id: invite.id}) }}\">
                        <button type=\"submit\">Bloquer</button>
                    </form>
                {% endif %}

                <form method=\"post\" action=\"{{ path(\x27admin_invite_delete\x27, {id: invite.id}) }}\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token(\x27delete_invite_\x27 ~ invite.id) }}\">
                    <button type=\"submit\">Supprimer</button>
                </form>
            </td>
        </tr>
    {% endfor %}
</table>
", "admin/invite/index.html.twig", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/templates/admin/invite/index.html.twig");
    }
}
