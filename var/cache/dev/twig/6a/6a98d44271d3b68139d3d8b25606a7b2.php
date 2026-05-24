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

/* @Maker/security/formLogin/Test.LoginController.tpl.php */
class __TwigTemplate_ee7641094660fdc30e16f16f6d7eacaa extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/security/formLogin/Test.LoginController.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/security/formLogin/Test.LoginController.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>
namespace App\\Tests;

<?= \$use_statements ?>

class LoginControllerTest extends WebTestCase
{
    private KernelBrowser \$client;

    protected function setUp(): void
    {
        \$this->client = static::createClient();
        \$container = static::getContainer();
        \$em = \$container->get(\x27doctrine.orm.entity_manager\x27);
        \$userRepository = \$em->getRepository(<?= \$user_short_name ?>::class);

        // Remove any existing users from the test database
        foreach (\$userRepository->findAll() as \$user) {
            \$em->remove(\$user);
        }

        \$em->flush();

        // Create a <?= \$user_short_name ?> fixture
        /** @var UserPasswordHasherInterface \$passwordHasher */
        \$passwordHasher = \$container->get(\x27security.user_password_hasher\x27);

        \$user = (new <?= \$user_short_name ?>())->setEmail(\x27email@example.com\x27);
        \$user->setPassword(\$passwordHasher->hashPassword(\$user, \x27password\x27));

        \$em->persist(\$user);
        \$em->flush();
    }

    public function testLogin(): void
    {
        // Denied - Can\x27t login with invalid email address.
        \$this->client->request(\x27GET\x27, \x27/login\x27);
        self::assertResponseIsSuccessful();

        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27doesNotExist@example.com\x27,
            \x27_password\x27 => \x27password\x27,
        ]);

        self::assertResponseRedirects(\x27/login\x27);
        \$this->client->followRedirect();

        // Ensure we do not reveal if the user exists or not.
        self::assertSelectorTextContains(\x27.alert-danger\x27, \x27Invalid credentials.\x27);

        // Denied - Can\x27t login with invalid password.
        \$this->client->request(\x27GET\x27, \x27/login\x27);
        self::assertResponseIsSuccessful();

        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27email@example.com\x27,
            \x27_password\x27 => \x27bad-password\x27,
        ]);

        self::assertResponseRedirects(\x27/login\x27);
        \$this->client->followRedirect();

        // Ensure we do not reveal the user exists but the password is wrong.
        self::assertSelectorTextContains(\x27.alert-danger\x27, \x27Invalid credentials.\x27);

        // Success - Login with valid credentials is allowed.
        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27email@example.com\x27,
            \x27_password\x27 => \x27password\x27,
        ]);

        self::assertResponseRedirects(\x27/\x27);
        \$this->client->followRedirect();

        self::assertSelectorNotExists(\x27.alert-danger\x27);
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
        return "@Maker/security/formLogin/Test.LoginController.tpl.php";
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
        return new Source("<?= \"<?php\\n\" ?>
namespace App\\Tests;

<?= \$use_statements ?>

class LoginControllerTest extends WebTestCase
{
    private KernelBrowser \$client;

    protected function setUp(): void
    {
        \$this->client = static::createClient();
        \$container = static::getContainer();
        \$em = \$container->get(\x27doctrine.orm.entity_manager\x27);
        \$userRepository = \$em->getRepository(<?= \$user_short_name ?>::class);

        // Remove any existing users from the test database
        foreach (\$userRepository->findAll() as \$user) {
            \$em->remove(\$user);
        }

        \$em->flush();

        // Create a <?= \$user_short_name ?> fixture
        /** @var UserPasswordHasherInterface \$passwordHasher */
        \$passwordHasher = \$container->get(\x27security.user_password_hasher\x27);

        \$user = (new <?= \$user_short_name ?>())->setEmail(\x27email@example.com\x27);
        \$user->setPassword(\$passwordHasher->hashPassword(\$user, \x27password\x27));

        \$em->persist(\$user);
        \$em->flush();
    }

    public function testLogin(): void
    {
        // Denied - Can\x27t login with invalid email address.
        \$this->client->request(\x27GET\x27, \x27/login\x27);
        self::assertResponseIsSuccessful();

        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27doesNotExist@example.com\x27,
            \x27_password\x27 => \x27password\x27,
        ]);

        self::assertResponseRedirects(\x27/login\x27);
        \$this->client->followRedirect();

        // Ensure we do not reveal if the user exists or not.
        self::assertSelectorTextContains(\x27.alert-danger\x27, \x27Invalid credentials.\x27);

        // Denied - Can\x27t login with invalid password.
        \$this->client->request(\x27GET\x27, \x27/login\x27);
        self::assertResponseIsSuccessful();

        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27email@example.com\x27,
            \x27_password\x27 => \x27bad-password\x27,
        ]);

        self::assertResponseRedirects(\x27/login\x27);
        \$this->client->followRedirect();

        // Ensure we do not reveal the user exists but the password is wrong.
        self::assertSelectorTextContains(\x27.alert-danger\x27, \x27Invalid credentials.\x27);

        // Success - Login with valid credentials is allowed.
        \$this->client->submitForm(\x27Sign in\x27, [
            \x27_username\x27 => \x27email@example.com\x27,
            \x27_password\x27 => \x27password\x27,
        ]);

        self::assertResponseRedirects(\x27/\x27);
        \$this->client->followRedirect();

        self::assertSelectorNotExists(\x27.alert-danger\x27);
    }
}
", "@Maker/security/formLogin/Test.LoginController.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/security/formLogin/Test.LoginController.tpl.php");
    }
}
