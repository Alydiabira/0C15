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

/* @Maker/command/Command.tpl.php */
class __TwigTemplate_0a527e0e0ffad963b07b033e0e14d6f1 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/command/Command.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/command/Command.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\"; ?>

namespace <?= \$namespace; ?>;

<?= \$use_statements; ?>

#[AsCommand(
    name: \x27<?= \$command_name; ?>\x27,
    description: \x27Add a short description for your command\x27,
)]
class <?= \$class_name; ?> extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        \$this
<?= \$set_description ? \"            ->setDescription(self::\\\$defaultDescription)\\n\" : \x27\x27 ?>
            ->addArgument(\x27arg1\x27, InputArgument::OPTIONAL, \x27Argument description\x27)
            ->addOption(\x27option1\x27, null, InputOption::VALUE_NONE, \x27Option description\x27)
        ;
    }

    protected function execute(InputInterface \$input, OutputInterface \$output): int
    {
        \$io = new SymfonyStyle(\$input, \$output);
        \$arg1 = \$input->getArgument(\x27arg1\x27);

        if (\$arg1) {
            \$io->note(sprintf(\x27You passed an argument: %s\x27, \$arg1));
        }

        if (\$input->getOption(\x27option1\x27)) {
            // ...
        }

        \$io->success(\x27You have a new command! Now make it your own! Pass --help to see your options.\x27);

        return Command::SUCCESS;
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
        return "@Maker/command/Command.tpl.php";
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
        return new Source("<?= \"<?php\\n\"; ?>

namespace <?= \$namespace; ?>;

<?= \$use_statements; ?>

#[AsCommand(
    name: \x27<?= \$command_name; ?>\x27,
    description: \x27Add a short description for your command\x27,
)]
class <?= \$class_name; ?> extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        \$this
<?= \$set_description ? \"            ->setDescription(self::\\\$defaultDescription)\\n\" : \x27\x27 ?>
            ->addArgument(\x27arg1\x27, InputArgument::OPTIONAL, \x27Argument description\x27)
            ->addOption(\x27option1\x27, null, InputOption::VALUE_NONE, \x27Option description\x27)
        ;
    }

    protected function execute(InputInterface \$input, OutputInterface \$output): int
    {
        \$io = new SymfonyStyle(\$input, \$output);
        \$arg1 = \$input->getArgument(\x27arg1\x27);

        if (\$arg1) {
            \$io->note(sprintf(\x27You passed an argument: %s\x27, \$arg1));
        }

        if (\$input->getOption(\x27option1\x27)) {
            // ...
        }

        \$io->success(\x27You have a new command! Now make it your own! Pass --help to see your options.\x27);

        return Command::SUCCESS;
    }
}
", "@Maker/command/Command.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/command/Command.tpl.php");
    }
}
