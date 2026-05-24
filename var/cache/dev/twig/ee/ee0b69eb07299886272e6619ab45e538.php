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

/* @Maker/crud/test/Test.EntityManager.tpl.php */
class __TwigTemplate_97effc8d1943fea3b5fbcc8436f0c698 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/crud/test/Test.EntityManager.tpl.php"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@Maker/crud/test/Test.EntityManager.tpl.php"));

        // line 1
        yield "<?= \"<?php\\n\" ?>
<?php use Symfony\\Bundle\\MakerBundle\\Str; ?>

namespace <?= \$namespace ?>;

<?= \$class_data->getUseStatements(); ?>

<?= \$class_data->getClassDeclaration() ?>

{
    private KernelBrowser \$client;
    private EntityManagerInterface \$manager;
    /** @var EntityRepository<<?= \$entity_class_name; ?>> \$<?= lcfirst(\$entity_var_singular); ?>Repository */
    private EntityRepository \$<?= lcfirst(\$entity_var_singular); ?>Repository;
    private string \$path = \x27<?= \$route_path; ?>/\x27;

    protected function setUp(): void
    {
        \$this->client = static::createClient();
        \$this->manager = static::getContainer()->get(\x27doctrine\x27)->getManager();
        \$this-><?= lcfirst(\$entity_var_singular); ?>Repository = \$this->manager->getRepository(<?= \$entity_class_name; ?>::class);

        foreach (\$this-><?= lcfirst(\$entity_var_singular); ?>Repository->findAll() as \$object) {
            \$this->manager->remove(\$object);
        }

        \$this->manager->flush();
    }

    public function testIndex(): void
    {
        \$this->client->followRedirects();
        \$crawler = \$this->client->request(\x27GET\x27, \$this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains(\x27<?= ucfirst(\$entity_var_singular); ?> index\x27);

        // Use the \$crawler to perform additional assertions e.g.
        // self::assertSame(\x27Some text on the page\x27, \$crawler->filter(\x27.p\x27)->first()->text());
    }

    public function testNew(): void
    {
        \$this->client->request(\x27GET\x27, sprintf(\x27%snew\x27, \$this->path));

        self::assertResponseStatusCodeSame(200);

        \$this->client->submitForm(\x27Save\x27, [
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
            \x27<?= \$form_field_prefix; ?>[<?= \$form_field; ?>]\x27 => \x27Testing\x27,
<?php endforeach; ?>
        ]);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);

        self::assertSame(1, \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->count([]));

        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testShow(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27My Title\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s\x27, \$this->path, \$fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains(\x27<?= ucfirst(\$entity_var_singular); ?>\x27);

        // Use assertions to check that the properties are properly displayed.
        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testEdit(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27Value\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s/edit\x27, \$this->path, \$fixture->getId()));

        \$this->client->submitForm(\x27Update\x27, [
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
            \x27<?= \$form_field_prefix; ?>[<?= \$form_field; ?>]\x27 => \x27Something New\x27,
<?php endforeach; ?>
        ]);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);

        \$fixture = \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->findAll();

<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        self::assertSame(\x27Something New\x27, \$fixture[0]->get<?= Str::asCamelCase(\$form_field); ?>());
<?php endforeach; ?>

        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testRemove(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27Value\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s\x27, \$this->path, \$fixture->getId()));
        \$this->client->submitForm(\x27Delete\x27);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);
        self::assertSame(0, \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->count([]));

        \$this->markTestIncomplete(\x27This test was generated\x27);
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
        return "@Maker/crud/test/Test.EntityManager.tpl.php";
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
<?php use Symfony\\Bundle\\MakerBundle\\Str; ?>

namespace <?= \$namespace ?>;

<?= \$class_data->getUseStatements(); ?>

<?= \$class_data->getClassDeclaration() ?>

{
    private KernelBrowser \$client;
    private EntityManagerInterface \$manager;
    /** @var EntityRepository<<?= \$entity_class_name; ?>> \$<?= lcfirst(\$entity_var_singular); ?>Repository */
    private EntityRepository \$<?= lcfirst(\$entity_var_singular); ?>Repository;
    private string \$path = \x27<?= \$route_path; ?>/\x27;

    protected function setUp(): void
    {
        \$this->client = static::createClient();
        \$this->manager = static::getContainer()->get(\x27doctrine\x27)->getManager();
        \$this-><?= lcfirst(\$entity_var_singular); ?>Repository = \$this->manager->getRepository(<?= \$entity_class_name; ?>::class);

        foreach (\$this-><?= lcfirst(\$entity_var_singular); ?>Repository->findAll() as \$object) {
            \$this->manager->remove(\$object);
        }

        \$this->manager->flush();
    }

    public function testIndex(): void
    {
        \$this->client->followRedirects();
        \$crawler = \$this->client->request(\x27GET\x27, \$this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains(\x27<?= ucfirst(\$entity_var_singular); ?> index\x27);

        // Use the \$crawler to perform additional assertions e.g.
        // self::assertSame(\x27Some text on the page\x27, \$crawler->filter(\x27.p\x27)->first()->text());
    }

    public function testNew(): void
    {
        \$this->client->request(\x27GET\x27, sprintf(\x27%snew\x27, \$this->path));

        self::assertResponseStatusCodeSame(200);

        \$this->client->submitForm(\x27Save\x27, [
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
            \x27<?= \$form_field_prefix; ?>[<?= \$form_field; ?>]\x27 => \x27Testing\x27,
<?php endforeach; ?>
        ]);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);

        self::assertSame(1, \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->count([]));

        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testShow(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27My Title\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s\x27, \$this->path, \$fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains(\x27<?= ucfirst(\$entity_var_singular); ?>\x27);

        // Use assertions to check that the properties are properly displayed.
        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testEdit(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27Value\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s/edit\x27, \$this->path, \$fixture->getId()));

        \$this->client->submitForm(\x27Update\x27, [
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
            \x27<?= \$form_field_prefix; ?>[<?= \$form_field; ?>]\x27 => \x27Something New\x27,
<?php endforeach; ?>
        ]);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);

        \$fixture = \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->findAll();

<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        self::assertSame(\x27Something New\x27, \$fixture[0]->get<?= Str::asCamelCase(\$form_field); ?>());
<?php endforeach; ?>

        \$this->markTestIncomplete(\x27This test was generated\x27);
    }

    public function testRemove(): void
    {
        \$fixture = new <?= \$entity_class_name; ?>();
<?php foreach (\$form_fields as \$form_field => \$typeOptions): ?>
        \$fixture->set<?= Str::asCamelCase(\$form_field); ?>(\x27Value\x27);
<?php endforeach; ?>

        \$this->manager->persist(\$fixture);
        \$this->manager->flush();

        \$this->client->request(\x27GET\x27, sprintf(\x27%s%s\x27, \$this->path, \$fixture->getId()));
        \$this->client->submitForm(\x27Delete\x27);

        self::assertResponseRedirects(\x27<?= \$route_path; ?>\x27);
        self::assertSame(0, \$this-><?= lcfirst(\$entity_var_singular); ?>Repository->count([]));

        \$this->markTestIncomplete(\x27This test was generated\x27);
    }
}
", "@Maker/crud/test/Test.EntityManager.tpl.php", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/maker-bundle/templates/crud/test/Test.EntityManager.tpl.php");
    }
}
