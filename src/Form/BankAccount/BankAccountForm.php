<?php

namespace App\Form\BankAccount;

use App\Entity\BankAccount\BankAccount;
use App\Form\Core\DefaultForm\EditForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BankAccountForm extends EditForm
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
                'constraints' => [
                    new Length([
                        'max' => 255,
                    ]),
                    new NotBlank(),
                ],
                'required' => true,
            ])
            ->add('bankName', TextType::class, [
                'label' => 'bankName',
                'constraints' => [
                    new Length([
                        'max' => 255,
                    ]),
                    new NotBlank(),
                ],
                'required' => true,
            ])
            ->add('iban', TextType::class, [
                'label' => 'iban',
                'constraints' => [
                    new Length([
                        'max' => 255,
                    ]),
                    new NotBlank(),
                ],
                'required' => true,
            ])
            ->add('swift', TextType::class, [
                'label' => 'swift',
                'constraints' => [
                    new Length([
                        'max' => 255,
                    ]),
                    new NotBlank(),
                ],
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'address',
                'constraints' => [
                    new Length([
                        'max' => 255,
                    ]),
                    new NotBlank(),
                ],
                'required' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BankAccount::class,
            'translation_domain' => 'bank_account',
        ]);
    }

}
