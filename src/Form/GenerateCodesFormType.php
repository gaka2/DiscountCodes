<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


/**
 * @author Karol Gancarczyk
 */
class GenerateCodesFormType extends AbstractType {

    private const NUMBER_OF_CODES_LABEL = 'Liczba kodów';
    private const LENGTH_OF_CODE_LABEL = 'Długość pojedynczego kodu';
    private const FILE_NAME_LABEL = 'Nazwa pliku';

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('numberOfCodes', IntegerType::class, [
                'label' => self::NUMBER_OF_CODES_LABEL,
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('lengthOfCode', IntegerType::class, [
                'label' => self::LENGTH_OF_CODE_LABEL,
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('fileName', TextType::class, [
                'label' => self::FILE_NAME_LABEL,
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
        ;
    }
}
