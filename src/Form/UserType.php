<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
            'label' => "Nom (*)",
            'required' => true
            ])
            ->add('prenom', TextType::class, [
            'label' => "Prénom (*)",
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
            'constraints' => [
                new Regex(
                    [
                        'pattern' => '/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'
                    ])
            ],
            'required' => false
            ])
            ->add('ville', TextType::class, [
            'label' => "Ville",
            'required' => false
            ])
            ->add('codepostal', TextType::class, [
            'label' => "Code Postal",
            'constraints' => [
                new Regex(
                    [
                        'pattern' => '/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/'
                    ])
            ],
            'required' => false
            ])
            ->add('pays', TextType::class, [
            'label' => "Pays",
            'required' => false
            ])
            ->add('numsecu', TextType::class, [
            'label' => "Numéro de sécurité sociale",
            'constraints' => [
                new Regex(
                    [
                        'pattern' => '/^[12][0-9]{2}[0-1][0-9](2[AB]|[0-9]{2})[0-9]{3}[0-9]{3}[0-9]{2}$/'
                    ])
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
