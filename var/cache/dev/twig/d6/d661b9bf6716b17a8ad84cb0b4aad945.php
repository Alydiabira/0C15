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

/* @Maker/stimulus/Controller.tpl.php */
class __TwigTemplate_6342dc66017718a3a3faa061d72b7d41 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/stimulus/Controller.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/stimulus/Controller.tpl.php"));

        // line 1
        yield "import { Controller } from \x27@hotwired/stimulus\x27;

/*
* The following line makes this controller \"lazy\": it won\x27t be downloaded until needed
* See https://symfony.com/bundles/StimulusBundle/current/index.html#lazy-stimulus-controllers
*/

/* stimulusFetch: \x27lazy\x27 */
export default class extends Controller {
<?= \$targets ? \"    static targets = \$targets\\n\" : \"\" ?>
<?php if (\$values) { ?>
    static values = {
<?php foreach (\$values as \$value): ?>
        <?= \$value[\x27name\x27] ?>: <?= \$value[\x27type\x27] ?>,
<?php endforeach; ?>
    }
<?php } ?>
<?= \$classes ? \"    static classes = \$classes\\n\" : \x27\x27 ?>

    initialize() {
        // Called once when the controller is first instantiated (per element)

        // Here you can initialize variables, create scoped callables for event
        // listeners, instantiate external libraries, etc.
        // this._fooBar = this.fooBar.bind(this)
    }

    connect() {
        // Called every time the controller is connected to the DOM
        // (on page load, when it\x27s added to the DOM, moved in the DOM, etc.)

        // Here you can add event listeners on the element or target elements,
        // add or remove classes, attributes, dispatch custom events, etc.
        // this.fooTarget.addEventListener(\x27click\x27, this._fooBar)
    }

    // Add custom controller actions here
    // fooBar() { this.fooTarget.classList.toggle(this.bazClass) }

    disconnect() {
        // Called anytime its element is disconnected from the DOM
        // (on page change, when it\x27s removed from or moved in the DOM, etc.)

        // Here you should remove all event listeners added in \"connect()\" 
        // this.fooTarget.removeEventListener(\x27click\x27, this._fooBar)
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
        return "@Maker/stimulus/Controller.tpl.php";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("import { Controller } from \x27@hotwired/stimulus\x27;

/*
* The following line makes this controller \"lazy\": it won\x27t be downloaded until needed
* See https://symfony.com/bundles/StimulusBundle/current/index.html#lazy-stimulus-controllers
*/

/* stimulusFetch: \x27lazy\x27 */
export default class extends Controller {
<?= \$targets ? \"    static targets = \$targets\\n\" : \"\" ?>
<?php if (\$values) { ?>
    static values = {
<?php foreach (\$values as \$value): ?>
        <?= \$value[\x27name\x27] ?>: <?= \$value[\x27type\x27] ?>,
<?php endforeach; ?>
    }
<?php } ?>
<?= \$classes ? \"    static classes = \$classes\\n\" : \x27\x27 ?>

    initialize() {
        // Called once when the controller is first instantiated (per element)

        // Here you can initialize variables, create scoped callables for event
        // listeners, instantiate external libraries, etc.
        // this._fooBar = this.fooBar.bind(this)
    }

    connect() {
        // Called every time the controller is connected to the DOM
        // (on page load, when it\x27s added to the DOM, moved in the DOM, etc.)

        // Here you can add event listeners on the element or target elements,
        // add or remove classes, attributes, dispatch custom events, etc.
        // this.fooTarget.addEventListener(\x27click\x27, this._fooBar)
    }

    // Add custom controller actions here
    // fooBar() { this.fooTarget.classList.toggle(this.bazClass) }

    disconnect() {
        // Called anytime its element is disconnected from the DOM
        // (on page change, when it\x27s removed from or moved in the DOM, etc.)

        // Here you should remove all event listeners added in \"connect()\" 
        // this.fooTarget.removeEventListener(\x27click\x27, this._fooBar)
    }
}
", "@Maker/stimulus/Controller.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/stimulus/Controller.tpl.php");
    }
}
