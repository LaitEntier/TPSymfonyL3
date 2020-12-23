<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Email (*)",
                'attr' => [
                    'placeholder' => 'ex: jadorelesvieux@gmail.com'
                ],
                'required' => true
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter nos termes.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => "Mot de passe (*)",
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un mot de passe.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'required' => true
            ])
            ->add('nom', TextType::class, [
            'label' => "Nom (*)",
            'attr' => [
                    'placeholder' => 'ex: Sreckovic'
                ],
            'required' => true
            ])
            ->add('prenom', TextType::class, [
            'label' => "Prénom (*)",
            'attr' => [
                    'placeholder' => 'ex: Thomas'
                ],
            'required' => true
            ])
            ->add('civilite', ChoiceType::class, [
            'label' => "Civilité (*)",
            'choices' => [
                'Homme' => 'M',
                'Femme' => 'Mme',
                'Non-binaire' => 'Mx',
            ],
            'required' => true
            ])
            ->add('dateofbirth', DateType::class, [
            'label' => "Date de naissance (*)",
            'years' => range(1900,2020),
            'required' => true
            ])
            ->add('telephone', TextType::class, [
            'label' => "Téléphone",
            'attr' => [
                    'placeholder' => 'ex: 0243896500'
                ],
            'required' => false
            ])
            ->add('ville', TextType::class, [
            'label' => "Ville",
            'attr' => [
                    'placeholder' => 'ex: Tours'
                ],
            'required' => false
            ])
            ->add('codepostal', TextType::class, [
            'label' => "Code Postal",
            'attr' => [
                    'placeholder' => 'ex: 37000'
                ],
            'required' => false
            ])
            ->add('pays', TextType::class, [
            'label' => "Pays",
            'attr' => [
                    'placeholder' => 'ex: France'
                ],
            'required' => false
            ])
            ->add('numsecu', TextType::class, [
            'label' => "Numéro de sécurité sociale",
            'attr' => [
                    'placeholder' => 'ex: 123456788899989'
                ],
            'required' => false
            ])
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
