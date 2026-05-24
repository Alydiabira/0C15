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

/* @Maker/resetPassword/ChangePasswordFormType.tpl.php */
class __TwigTemplate_ed9ece639250f738c5b22bb053c99f13 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/ChangePasswordFormType.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/ChangePasswordFormType.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>

namespace <?= \$namespace ?>;

<?= \$use_statements ?>

class <?= \$class_name ?> extends AbstractType
{
    public function buildForm(FormBuilderInterface \$builder, array \$options): void
    {
        \$builder
            ->add(\x27plainPassword\x27, RepeatedType::class, [
                \x27type\x27 => PasswordType::class,
                \x27options\x27 => [
                    \x27attr\x27 => [
                        \x27autocomplete\x27 => \x27new-password\x27,
                    ],
                ],
                \x27first_options\x27 => [
                    \x27constraints\x27 => [
                        new NotBlank(
                            message: \x27Please enter a password\x27,
                        ),
                        new Length(
                            min: 12,
                            minMessage: \x27Your password should be at least ";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 26, $this->source); })()), "html", null, true);
        yield " characters\x27,
                            // max length allowed by Symfony for security reasons
                            max: 4096,
                        ),
                        new PasswordStrength(),
                        new NotCompromisedPassword(),
                    ],
                    \x27label\x27 => \x27New password\x27,
                ],
                \x27second_options\x27 => [
                    \x27label\x27 => \x27Repeat Password\x27,
                ],
                \x27invalid_message\x27 => \x27The password fields must match.\x27,
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                \x27mapped\x27 => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver \$resolver): void
    {
        \$resolver->setDefaults([]);
    }
}
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
        return "@Maker/resetPassword/ChangePasswordFormType.tpl.php";
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
        return array (  75 => 26,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<?= \"<?php\\n\" ?>

namespace <?= \$namespace ?>;

<?= \$use_statements ?>

class <?= \$class_name ?> extends AbstractType
{
    public function buildForm(FormBuilderInterface \$builder, array \$options): void
    {
        \$builder
            ->add(\x27plainPassword\x27, RepeatedType::class, [
                \x27type\x27 => PasswordType::class,
                \x27options\x27 => [
                    \x27attr\x27 => [
                        \x27autocomplete\x27 => \x27new-password\x27,
                    ],
                ],
                \x27first_options\x27 => [
                    \x27constraints\x27 => [
                        new NotBlank(
                            message: \x27Please enter a password\x27,
                        ),
                        new Length(
                            min: 12,
                            minMessage: \x27Your password should be at least {{ limit }} characters\x27,
                            // max length allowed by Symfony for security reasons
                            max: 4096,
                        ),
                        new PasswordStrength(),
                        new NotCompromisedPassword(),
                    ],
                    \x27label\x27 => \x27New password\x27,
                ],
                \x27second_options\x27 => [
                    \x27label\x27 => \x27Repeat Password\x27,
                ],
                \x27invalid_message\x27 => \x27The password fields must match.\x27,
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                \x27mapped\x27 => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver \$resolver): void
    {
        \$resolver->setDefaults([]);
    }
}
", "@Maker/resetPassword/ChangePasswordFormType.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/resetPassword/ChangePasswordFormType.tpl.php");
    }
}
