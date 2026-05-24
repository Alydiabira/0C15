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

/* @Maker/resetPassword/ResetPasswordController.tpl.php */
class __TwigTemplate_e028010ae6444239f873f424b0664569 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/ResetPasswordController.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/resetPassword/ResetPasswordController.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>

namespace <?= \$namespace ?>;

<?= \$use_statements; ?>

#[Route(\x27/reset-password\x27)]
class <?= \$class_name ?> extends AbstractController
{
    use ResetPasswordControllerTrait;

    public function __construct(
        private ResetPasswordHelperInterface \$resetPasswordHelper,
        private EntityManagerInterface \$entityManager
    ) {
    }

    /**
     * Display & process form to request a password reset.
     */
    #[Route(\x27\x27, name: \x27app_forgot_password_request\x27)]
    public function request(Request \$request, MailerInterface \$mailer<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>): Response
    {
        \$form = \$this->createForm(<?= \$request_form_type_class_name ?>::class);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            /** @var string \$email */
            \$email = \$form->get(\x27<?= \$email_field ?>\x27)->getData();

            return \$this->processSendingPasswordResetEmail(\$email, \$mailer<?php if (\$translator_available): ?>, \$translator<?php endif ?><?= \"\\n\" ?>);
        }

        return \$this->render(\x27reset_password/request.html.twig\x27, [
            \x27requestForm\x27 => \$form,
        ]);
    }

    /**
     * Confirmation page after a user has requested a password reset.
     */
    #[Route(\x27/check-email\x27, name: \x27app_check_email\x27)]
    public function checkEmail(): Response
    {
        // Generate a fake token if the user does not exist or someone hit this page directly.
        // This prevents exposing whether or not a user was found with the given email address or not
        if (null === (\$resetToken = \$this->getTokenObjectFromSession())) {
            \$resetToken = \$this->resetPasswordHelper->generateFakeResetToken();
        }

        return \$this->render(\x27reset_password/check_email.html.twig\x27, [
            \x27resetToken\x27 => \$resetToken,
        ]);
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     */
    #[Route(\x27/reset/{token}\x27, name: \x27app_reset_password\x27)]
    public function reset(Request \$request, UserPasswordHasherInterface \$passwordHasher<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>, ?string \$token = null): Response
    {
        if (\$token) {
            // We store the token in session and remove it from the URL, to avoid the URL being
            // loaded in a browser and potentially leaking the token to 3rd party JavaScript.
            \$this->storeTokenInSession(\$token);

            return \$this->redirectToRoute(\x27app_reset_password\x27);
        }

        \$token = \$this->getTokenFromSession();
        if (null === \$token) {
            throw \$this->createNotFoundException(\x27No reset password token found in the URL or in the session.\x27);
        }

        try {
            /** @var <?= \$user_class_name ?> \$user */
            \$user = \$this->resetPasswordHelper->validateTokenAndFetchUser(\$token);
        } catch (ResetPasswordExceptionInterface \$e) {
            \$this->addFlash(\x27reset_password_error\x27, sprintf(
                \x27%s - %s\x27,
                <?php if (\$translator_available): ?>\$translator->trans(<?= \$problem_validate_message_or_constant ?>, [], \x27ResetPasswordBundle\x27)<?php else: ?><?= \$problem_validate_message_or_constant ?><?php endif ?>,
                <?php if (\$translator_available): ?>\$translator->trans(\$e->getReason(), [], \x27ResetPasswordBundle\x27)<?php else: ?>\$e->getReason()<?php endif ?><?= \"\\n\" ?>
            ));

            return \$this->redirectToRoute(\x27app_forgot_password_request\x27);
        }

        // The token is valid; allow the user to change their password.
        \$form = \$this->createForm(<?= \$reset_form_type_class_name ?>::class);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            // A password reset token should be used only once, remove it.
            \$this->resetPasswordHelper->removeResetRequest(\$token);

            /** @var string \$plainPassword */
            \$plainPassword = \$form->get(\x27plainPassword\x27)->getData();

            // Encode(hash) the plain password, and set it.
            \$user-><?= \$password_setter ?>(\$passwordHasher->hashPassword(\$user, \$plainPassword));
            \$this->entityManager->flush();

            // The session is cleaned up after the password has been changed.
            \$this->cleanSessionAfterReset();

            return \$this->redirectToRoute(\x27<?= \$success_redirect_route ?>\x27);
        }

        return \$this->render(\x27reset_password/reset.html.twig\x27, [
            \x27resetForm\x27 => \$form,
        ]);
    }

    private function processSendingPasswordResetEmail(string \$emailFormData, MailerInterface \$mailer<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>): RedirectResponse
    {
        \$user = \$this->entityManager->getRepository(<?= \$user_class_name ?>::class)->findOneBy([
            \x27<?= \$email_field ?>\x27 => \$emailFormData,
        ]);

        // Do not reveal whether a user account was found or not.
        if (!\$user) {
            return \$this->redirectToRoute(\x27app_check_email\x27);
        }

        try {
            \$resetToken = \$this->resetPasswordHelper->generateResetToken(\$user);
        } catch (ResetPasswordExceptionInterface \$e) {
            // If you want to tell the user why a reset email was not sent, uncomment
            // the lines below and change the redirect to \x27app_forgot_password_request\x27.
            // Caution: This may reveal if a user is registered or not.
            //
            // \$this->addFlash(\x27reset_password_error\x27, sprintf(
            //     \x27%s - %s\x27,
            //     <?php if (\$translator_available): ?>\$translator->trans(<?= \$problem_handle_message_or_constant ?>, [], \x27ResetPasswordBundle\x27)<?php else: ?><?= \$problem_handle_message_or_constant ?><?php endif ?>,
            //     <?php if (\$translator_available): ?>\$translator->trans(\$e->getReason(), [], \x27ResetPasswordBundle\x27)<?php else: ?>\$e->getReason()<?php endif ?><?= \"\\n\" ?>
            // ));

            return \$this->redirectToRoute(\x27app_check_email\x27);
        }

        \$email = (new TemplatedEmail())
            ->from(new Address(\x27<?= \$from_email ?>\x27, \x27<?= \$from_email_name ?>\x27))
            ->to((string) \$user-><?= \$email_getter ?>())
            ->subject(\x27Your password reset request\x27)
            ->htmlTemplate(\x27reset_password/email.html.twig\x27)
            ->context([
                \x27resetToken\x27 => \$resetToken,
            ])
        ;

        \$mailer->send(\$email);

        // Store the token object in session for retrieval in check-email route.
        \$this->setTokenObjectInSession(\$resetToken);

        return \$this->redirectToRoute(\x27app_check_email\x27);
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
        return "@Maker/resetPassword/ResetPasswordController.tpl.php";
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

namespace <?= \$namespace ?>;

<?= \$use_statements; ?>

#[Route(\x27/reset-password\x27)]
class <?= \$class_name ?> extends AbstractController
{
    use ResetPasswordControllerTrait;

    public function __construct(
        private ResetPasswordHelperInterface \$resetPasswordHelper,
        private EntityManagerInterface \$entityManager
    ) {
    }

    /**
     * Display & process form to request a password reset.
     */
    #[Route(\x27\x27, name: \x27app_forgot_password_request\x27)]
    public function request(Request \$request, MailerInterface \$mailer<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>): Response
    {
        \$form = \$this->createForm(<?= \$request_form_type_class_name ?>::class);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            /** @var string \$email */
            \$email = \$form->get(\x27<?= \$email_field ?>\x27)->getData();

            return \$this->processSendingPasswordResetEmail(\$email, \$mailer<?php if (\$translator_available): ?>, \$translator<?php endif ?><?= \"\\n\" ?>);
        }

        return \$this->render(\x27reset_password/request.html.twig\x27, [
            \x27requestForm\x27 => \$form,
        ]);
    }

    /**
     * Confirmation page after a user has requested a password reset.
     */
    #[Route(\x27/check-email\x27, name: \x27app_check_email\x27)]
    public function checkEmail(): Response
    {
        // Generate a fake token if the user does not exist or someone hit this page directly.
        // This prevents exposing whether or not a user was found with the given email address or not
        if (null === (\$resetToken = \$this->getTokenObjectFromSession())) {
            \$resetToken = \$this->resetPasswordHelper->generateFakeResetToken();
        }

        return \$this->render(\x27reset_password/check_email.html.twig\x27, [
            \x27resetToken\x27 => \$resetToken,
        ]);
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     */
    #[Route(\x27/reset/{token}\x27, name: \x27app_reset_password\x27)]
    public function reset(Request \$request, UserPasswordHasherInterface \$passwordHasher<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>, ?string \$token = null): Response
    {
        if (\$token) {
            // We store the token in session and remove it from the URL, to avoid the URL being
            // loaded in a browser and potentially leaking the token to 3rd party JavaScript.
            \$this->storeTokenInSession(\$token);

            return \$this->redirectToRoute(\x27app_reset_password\x27);
        }

        \$token = \$this->getTokenFromSession();
        if (null === \$token) {
            throw \$this->createNotFoundException(\x27No reset password token found in the URL or in the session.\x27);
        }

        try {
            /** @var <?= \$user_class_name ?> \$user */
            \$user = \$this->resetPasswordHelper->validateTokenAndFetchUser(\$token);
        } catch (ResetPasswordExceptionInterface \$e) {
            \$this->addFlash(\x27reset_password_error\x27, sprintf(
                \x27%s - %s\x27,
                <?php if (\$translator_available): ?>\$translator->trans(<?= \$problem_validate_message_or_constant ?>, [], \x27ResetPasswordBundle\x27)<?php else: ?><?= \$problem_validate_message_or_constant ?><?php endif ?>,
                <?php if (\$translator_available): ?>\$translator->trans(\$e->getReason(), [], \x27ResetPasswordBundle\x27)<?php else: ?>\$e->getReason()<?php endif ?><?= \"\\n\" ?>
            ));

            return \$this->redirectToRoute(\x27app_forgot_password_request\x27);
        }

        // The token is valid; allow the user to change their password.
        \$form = \$this->createForm(<?= \$reset_form_type_class_name ?>::class);
        \$form->handleRequest(\$request);

        if (\$form->isSubmitted() && \$form->isValid()) {
            // A password reset token should be used only once, remove it.
            \$this->resetPasswordHelper->removeResetRequest(\$token);

            /** @var string \$plainPassword */
            \$plainPassword = \$form->get(\x27plainPassword\x27)->getData();

            // Encode(hash) the plain password, and set it.
            \$user-><?= \$password_setter ?>(\$passwordHasher->hashPassword(\$user, \$plainPassword));
            \$this->entityManager->flush();

            // The session is cleaned up after the password has been changed.
            \$this->cleanSessionAfterReset();

            return \$this->redirectToRoute(\x27<?= \$success_redirect_route ?>\x27);
        }

        return \$this->render(\x27reset_password/reset.html.twig\x27, [
            \x27resetForm\x27 => \$form,
        ]);
    }

    private function processSendingPasswordResetEmail(string \$emailFormData, MailerInterface \$mailer<?php if (\$translator_available): ?>, TranslatorInterface \$translator<?php endif ?>): RedirectResponse
    {
        \$user = \$this->entityManager->getRepository(<?= \$user_class_name ?>::class)->findOneBy([
            \x27<?= \$email_field ?>\x27 => \$emailFormData,
        ]);

        // Do not reveal whether a user account was found or not.
        if (!\$user) {
            return \$this->redirectToRoute(\x27app_check_email\x27);
        }

        try {
            \$resetToken = \$this->resetPasswordHelper->generateResetToken(\$user);
        } catch (ResetPasswordExceptionInterface \$e) {
            // If you want to tell the user why a reset email was not sent, uncomment
            // the lines below and change the redirect to \x27app_forgot_password_request\x27.
            // Caution: This may reveal if a user is registered or not.
            //
            // \$this->addFlash(\x27reset_password_error\x27, sprintf(
            //     \x27%s - %s\x27,
            //     <?php if (\$translator_available): ?>\$translator->trans(<?= \$problem_handle_message_or_constant ?>, [], \x27ResetPasswordBundle\x27)<?php else: ?><?= \$problem_handle_message_or_constant ?><?php endif ?>,
            //     <?php if (\$translator_available): ?>\$translator->trans(\$e->getReason(), [], \x27ResetPasswordBundle\x27)<?php else: ?>\$e->getReason()<?php endif ?><?= \"\\n\" ?>
            // ));

            return \$this->redirectToRoute(\x27app_check_email\x27);
        }

        \$email = (new TemplatedEmail())
            ->from(new Address(\x27<?= \$from_email ?>\x27, \x27<?= \$from_email_name ?>\x27))
            ->to((string) \$user-><?= \$email_getter ?>())
            ->subject(\x27Your password reset request\x27)
            ->htmlTemplate(\x27reset_password/email.html.twig\x27)
            ->context([
                \x27resetToken\x27 => \$resetToken,
            ])
        ;

        \$mailer->send(\$email);

        // Store the token object in session for retrieval in check-email route.
        \$this->setTokenObjectInSession(\$resetToken);

        return \$this->redirectToRoute(\x27app_check_email\x27);
    }
}
", "@Maker/resetPassword/ResetPasswordController.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/resetPassword/ResetPasswordController.tpl.php");
    }
}
