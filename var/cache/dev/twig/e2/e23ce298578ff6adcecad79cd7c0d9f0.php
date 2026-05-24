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

/* @Maker/registration/RegistrationController.tpl.php */
class __TwigTemplate_61f16f033dbfc683bc5ab799b2735854 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/registration/RegistrationController.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/registration/RegistrationController.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>

namespace <?= \$namespace; ?>;

<?= \$use_statements; ?>

class <?= \$class_name; ?> extends AbstractController
{
<?php if (\$will_verify_email): ?>
    public function __construct(private <?= \$generator->getPropertyType(\$email_verifier_class_details) ?>\$emailVerifier)
    {
    }

<?php endif; ?>
<?= \$generator->generateRouteForControllerMethod(\$route_path, \$route_name) ?>
    public function register(Request \$request, UserPasswordHasherInterface \$userPasswordHasher<?= \$login_after_registration ? \x27, Security \$security\x27: \x27\x27 ?>, EntityManagerInterface \$entityManager): Response
    {
        \$user = new <?= \$user_class_name ?>();
        \$form = \$this->createForm(<?= \$form_class_name ?>::class, \$user);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            /** @var string \$plainPassword */
            \$plainPassword = \$form->get(\x27plainPassword\x27)->getData();

            // encode the plain password
            \$user->set<?= ucfirst(\$password_field) ?>(\$userPasswordHasher->hashPassword(\$user, \$plainPassword));

            \$entityManager->persist(\$user);
            \$entityManager->flush();
<?php if (\$will_verify_email): ?>

            // generate a signed url and email it to the user
            \$this->emailVerifier->sendEmailConfirmation(\x27app_verify_email\x27, \$user,
                (new TemplatedEmail())
                    ->from(new Address(\x27<?= \$from_email ?>\x27, \x27<?= \$from_email_name ?>\x27))
                    ->to((string) \$user-><?= \$email_getter ?>())
                    ->subject(\x27Please Confirm your Email\x27)
                    ->htmlTemplate(\x27registration/confirmation_email.html.twig\x27)
            );
<?php endif; ?>

            // do anything else you need here, like send an email

<?php if (\$login_after_registration): ?>
            return \$security->login(\$user, <?= \$authenticator ?>, \x27<?= \$firewall ?>\x27);
<?php else: ?>
            return \$this->redirectToRoute(\x27<?= \$redirect_route_name ?>\x27);
<?php endif; ?>
        }

        return \$this->render(\x27registration/register.html.twig\x27, [
            \x27registrationForm\x27 => \$form,
        ]);
    }
<?php if (\$will_verify_email): ?>

<?= \$generator->generateRouteForControllerMethod(\x27/verify/email\x27, \x27app_verify_email\x27) ?>
    public function verifyUserEmail(Request \$request<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?><?= \$verify_email_anonymously ? sprintf(\x27, %s %s\x27, \$repository_class_name, \$repository_var) : null ?>): Response
    {
<?php if (!\$verify_email_anonymously): ?>
        \$this->denyAccessUnlessGranted(\x27IS_AUTHENTICATED_FULLY\x27);
<?php else: ?>
        \$id = \$request->query->get(\x27id\x27);

        if (null === \$id) {
            return \$this->redirectToRoute(\x27app_register\x27);
        }
<?php if (\x27\$manager\x27 === \$repository_var): ?>

        \$repository = \$manager->getRepository(<?= \$user_class_name ?>::class);
        \$user = \$repository->find(\$id);
<?php else: ?>

        \$user = <?= \$repository_var; ?>->find(\$id);
<?php endif; ?>

        if (null === \$user) {
            return \$this->redirectToRoute(\x27app_register\x27);
        }
<?php endif; ?>

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
<?php if (!\$verify_email_anonymously): ?>
            /** @var <?= \$user_class_name ?> \$user */
            \$user = \$this->getUser();
<?php endif; ?>
            \$this->emailVerifier->handleEmailConfirmation(\$request, \$user);
        } catch (VerifyEmailExceptionInterface \$exception) {
            \$this->addFlash(\x27verify_email_error\x27, <?php if (\$translator_available): ?>\$translator->trans(\$exception->getReason(), [], \x27VerifyEmailBundle\x27)<?php else: ?>\$exception->getReason()<?php endif ?>);

            return \$this->redirectToRoute(\x27<?= \$route_name ?>\x27);
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        \$this->addFlash(\x27success\x27, \x27Your email address has been verified.\x27);

        return \$this->redirectToRoute(\x27app_register\x27);
    }
<?php endif; ?>
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
        return "@Maker/registration/RegistrationController.tpl.php";
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

namespace <?= \$namespace; ?>;

<?= \$use_statements; ?>

class <?= \$class_name; ?> extends AbstractController
{
<?php if (\$will_verify_email): ?>
    public function __construct(private <?= \$generator->getPropertyType(\$email_verifier_class_details) ?>\$emailVerifier)
    {
    }

<?php endif; ?>
<?= \$generator->generateRouteForControllerMethod(\$route_path, \$route_name) ?>
    public function register(Request \$request, UserPasswordHasherInterface \$userPasswordHasher<?= \$login_after_registration ? \x27, Security \$security\x27: \x27\x27 ?>, EntityManagerInterface \$entityManager): Response
    {
        \$user = new <?= \$user_class_name ?>();
        \$form = \$this->createForm(<?= \$form_class_name ?>::class, \$user);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            /** @var string \$plainPassword */
            \$plainPassword = \$form->get(\x27plainPassword\x27)->getData();

            // encode the plain password
            \$user->set<?= ucfirst(\$password_field) ?>(\$userPasswordHasher->hashPassword(\$user, \$plainPassword));

            \$entityManager->persist(\$user);
            \$entityManager->flush();
<?php if (\$will_verify_email): ?>

            // generate a signed url and email it to the user
            \$this->emailVerifier->sendEmailConfirmation(\x27app_verify_email\x27, \$user,
                (new TemplatedEmail())
                    ->from(new Address(\x27<?= \$from_email ?>\x27, \x27<?= \$from_email_name ?>\x27))
                    ->to((string) \$user-><?= \$email_getter ?>())
                    ->subject(\x27Please Confirm your Email\x27)
                    ->htmlTemplate(\x27registration/confirmation_email.html.twig\x27)
            );
<?php endif; ?>

            // do anything else you need here, like send an email

<?php if (\$login_after_registration): ?>
            return \$security->login(\$user, <?= \$authenticator ?>, \x27<?= \$firewall ?>\x27);
<?php else: ?>
            return \$this->redirectToRoute(\x27<?= \$redirect_route_name ?>\x27);
<?php endif; ?>
        }

        return \$this->render(\x27registration/register.html.twig\x27, [
            \x27registrationForm\x27 => \$form,
        ]);
    }
<?php if (\$will_verify_email): ?>

<?= \$generator->generateRouteForControllerMethod(\x27/verify/email\x27, \x27app_verify_email\x27) ?>
    public function verifyUserEmail(Request \$request<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?><?= \$verify_email_anonymously ? sprintf(\x27, %s %s\x27, \$repository_class_name, \$repository_var) : null ?>): Response
    {
<?php if (!\$verify_email_anonymously): ?>
        \$this->denyAccessUnlessGranted(\x27IS_AUTHENTICATED_FULLY\x27);
<?php else: ?>
        \$id = \$request->query->get(\x27id\x27);

        if (null === \$id) {
            return \$this->redirectToRoute(\x27app_register\x27);
        }
<?php if (\x27\$manager\x27 === \$repository_var): ?>

        \$repository = \$manager->getRepository(<?= \$user_class_name ?>::class);
        \$user = \$repository->find(\$id);
<?php else: ?>

        \$user = <?= \$repository_var; ?>->find(\$id);
<?php endif; ?>

        if (null === \$user) {
            return \$this->redirectToRoute(\x27app_register\x27);
        }
<?php endif; ?>

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
<?php if (!\$verify_email_anonymously): ?>
            /** @var <?= \$user_class_name ?> \$user */
            \$user = \$this->getUser();
<?php endif; ?>
            \$this->emailVerifier->handleEmailConfirmation(\$request, \$user);
        } catch (VerifyEmailExceptionInterface \$exception) {
            \$this->addFlash(\x27verify_email_error\x27, <?php if (\$translator_available): ?>\$translator->trans(\$exception->getReason(), [], \x27VerifyEmailBundle\x27)<?php else: ?>\$exception->getReason()<?php endif ?>);

            return \$this->redirectToRoute(\x27<?= \$route_name ?>\x27);
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        \$this->addFlash(\x27success\x27, \x27Your email address has been verified.\x27);

        return \$this->redirectToRoute(\x27app_register\x27);
    }
<?php endif; ?>
}
", "@Maker/registration/RegistrationController.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/registration/RegistrationController.tpl.php");
    }
}
