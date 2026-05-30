<?php

namespace App\Tests\Form;

use App\Form\InviteType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

class InviteTypeTest extends KernelTestCase
{
    public function testSubmitValidData(): void
    {
        self::bootKernel();
        $factory = static::getContainer()->get(FormFactoryInterface::class);

        $form = $factory->create(InviteType::class);

        $form->submit([
            'name' => 'John',
            'email' => 'john@example.com'
        ]);

        $this->assertTrue($form->isSynchronized());
    }
}
