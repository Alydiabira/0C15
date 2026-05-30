<?php

namespace App\Tests\Form;

use App\Form\MediaType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

class MediaTypeTest extends KernelTestCase
{
    public function testSubmitValidData(): void
    {
        self::bootKernel();
        $factory = static::getContainer()->get(FormFactoryInterface::class);

        $form = $factory->create(MediaType::class);

        $form->submit([
            'title' => 'Test media'
        ]);

        $this->assertTrue($form->isSynchronized());
    }
}
