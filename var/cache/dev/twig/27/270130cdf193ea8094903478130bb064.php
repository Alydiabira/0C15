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

/* @Maker/resetPassword/Test.ResetPasswordController.tpl.php */
class __TwigTemplate_ea0a82b5d0574e4a190456e80a3704c7 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/Test.ResetPasswordController.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/Test.ResetPasswordController.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>
namespace App\\Tests;

<?= \$use_statements ?>

class ResetPasswordControllerTest extends WebTestCase
{
    private KernelBrowser \$client;
    private EntityManagerInterface \$em;
    private <?= \$user_repo_short_name ?> \$userRepository;

    protected function setUp(): void
    {
        \$this->client = static::createClient();

        // Ensure we have a clean database
        \$container = static::getContainer();

        /** @var EntityManagerInterface \$em */
        \$em = \$container->get(\x27doctrine\x27)->getManager();
        \$this->em = \$em;

        \$this->userRepository = \$container->get(<?= \$user_repo_short_name ?>::class);

        foreach (\$this->userRepository->findAll() as \$user) {
            \$this->em->remove(\$user);
        }

        \$this->em->flush();
    }

    public function testResetPasswordController(): void
    {
        // Create a test user
        \$user = (new <?= \$user_short_name ?>())
            ->setEmail(\x27me@example.com\x27)
            ->setPassword(\x27a-test-password-that-will-be-changed-later\x27)
        ;
        \$this->em->persist(\$user);
        \$this->em->flush();

        // Test Request reset password page
        \$this->client->request(\x27GET\x27, \x27/reset-password\x27);

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains(\x27Reset your password\x27);

        // Submit the reset password form and test email message is queued / sent
        \$this->client->submitForm(\x27Send password reset email\x27, [
            \x27reset_password_request_form[email]\x27 => \x27me@example.com\x27,
        ]);

        // Ensure the reset password email was sent
        // Use either assertQueuedEmailCount() || assertEmailCount() depending on your mailer setup
        // self::assertQueuedEmailCount(1);
        self::assertEmailCount(1);

        self::assertCount(1, \$messages = \$this->getMailerMessages());

        self::assertEmailAddressContains(\$messages[0], \x27from\x27, \x27<?= \$from_email ?>\x27);
        self::assertEmailAddressContains(\$messages[0], \x27to\x27, \x27me@example.com\x27);
        self::assertEmailTextBodyContains(\$messages[0], \x27This link will expire in 1 hour.\x27);

        self::assertResponseRedirects(\x27/reset-password/check-email\x27);

        // Test check email landing page shows correct \"expires at\" time
        \$crawler = \$this->client->followRedirect();

        self::assertPageTitleContains(\x27Password Reset Email Sent\x27);
        self::assertStringContainsString(\x27This link will expire in 1 hour\x27, \$crawler->html());

        // Test the link sent in the email is valid
        \$email = \$messages[0]->toString();
        preg_match(\x27#(/reset-password/reset/[a-zA-Z0-9]+)#\x27, \$email, \$resetLink);

        \$this->client->request(\x27GET\x27, \$resetLink[1]);

        self::assertResponseRedirects(\x27/reset-password/reset\x27);

        \$this->client->followRedirect();

        // Test we can set a new password
        \$this->client->submitForm(\x27Reset password\x27, [
            \x27change_password_form[plainPassword][first]\x27 => \x27newStrongPassword\x27,
            \x27change_password_form[plainPassword][second]\x27 => \x27newStrongPassword\x27,
        ]);

        self::assertResponseRedirects(\x27<?= \$success_route_path ?>\x27);

        \$user = \$this->userRepository->findOneBy([\x27email\x27 => \x27me@example.com\x27]);

        self::assertInstanceOf(<?= \$user_short_name ?>::class, \$user);

        /** @var UserPasswordHasherInterface \$passwordHasher */
        \$passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        self::assertTrue(\$passwordHasher->isPasswordValid(\$user, \x27newStrongPassword\x27));
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
        return "@Maker/resetPassword/Test.ResetPasswordController.tpl.php";
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

class ResetPasswordControllerTest extends WebTestCase
{
    private KernelBrowser \$client;
    private EntityManagerInterface \$em;
    private <?= \$user_repo_short_name ?> \$userRepository;

    protected function setUp(): void
    {
        \$this->client = static::createClient();

        // Ensure we have a clean database
        \$container = static::getContainer();

        /** @var EntityManagerInterface \$em */
        \$em = \$container->get(\x27doctrine\x27)->getManager();
        \$this->em = \$em;

        \$this->userRepository = \$container->get(<?= \$user_repo_short_name ?>::class);

        foreach (\$this->userRepository->findAll() as \$user) {
            \$this->em->remove(\$user);
        }

        \$this->em->flush();
    }

    public function testResetPasswordController(): void
    {
        // Create a test user
        \$user = (new <?= \$user_short_name ?>())
            ->setEmail(\x27me@example.com\x27)
            ->setPassword(\x27a-test-password-that-will-be-changed-later\x27)
        ;
        \$this->em->persist(\$user);
        \$this->em->flush();

        // Test Request reset password page
        \$this->client->request(\x27GET\x27, \x27/reset-password\x27);

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains(\x27Reset your password\x27);

        // Submit the reset password form and test email message is queued / sent
        \$this->client->submitForm(\x27Send password reset email\x27, [
            \x27reset_password_request_form[email]\x27 => \x27me@example.com\x27,
        ]);

        // Ensure the reset password email was sent
        // Use either assertQueuedEmailCount() || assertEmailCount() depending on your mailer setup
        // self::assertQueuedEmailCount(1);
        self::assertEmailCount(1);

        self::assertCount(1, \$messages = \$this->getMailerMessages());

        self::assertEmailAddressContains(\$messages[0], \x27from\x27, \x27<?= \$from_email ?>\x27);
        self::assertEmailAddressContains(\$messages[0], \x27to\x27, \x27me@example.com\x27);
        self::assertEmailTextBodyContains(\$messages[0], \x27This link will expire in 1 hour.\x27);

        self::assertResponseRedirects(\x27/reset-password/check-email\x27);

        // Test check email landing page shows correct \"expires at\" time
        \$crawler = \$this->client->followRedirect();

        self::assertPageTitleContains(\x27Password Reset Email Sent\x27);
        self::assertStringContainsString(\x27This link will expire in 1 hour\x27, \$crawler->html());

        // Test the link sent in the email is valid
        \$email = \$messages[0]->toString();
        preg_match(\x27#(/reset-password/reset/[a-zA-Z0-9]+)#\x27, \$email, \$resetLink);

        \$this->client->request(\x27GET\x27, \$resetLink[1]);

        self::assertResponseRedirects(\x27/reset-password/reset\x27);

        \$this->client->followRedirect();

        // Test we can set a new password
        \$this->client->submitForm(\x27Reset password\x27, [
            \x27change_password_form[plainPassword][first]\x27 => \x27newStrongPassword\x27,
            \x27change_password_form[plainPassword][second]\x27 => \x27newStrongPassword\x27,
        ]);

        self::assertResponseRedirects(\x27<?= \$success_route_path ?>\x27);

        \$user = \$this->userRepository->findOneBy([\x27email\x27 => \x27me@example.com\x27]);

        self::assertInstanceOf(<?= \$user_short_name ?>::class, \$user);

        /** @var UserPasswordHasherInterface \$passwordHasher */
        \$passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);
        self::assertTrue(\$passwordHasher->isPasswordValid(\$user, \x27newStrongPassword\x27));
    }
}
", "@Maker/resetPassword/Test.ResetPasswordController.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/resetPassword/Test.ResetPasswordController.tpl.php");
    }
}
