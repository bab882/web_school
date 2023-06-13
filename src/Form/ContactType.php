<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                    'attr'=> [
                        'class'=> 'form-control text-center',
                        'placeholder'=> 'Entrez votre nom'
                    ],
                    'label'=> ' ',
                ])
                ->add('prenom', TextType::class, [
                    'attr'=> [
                        'class'=> 'form-control text-center',
                        'placeholder'=> 'Entrez votre prenom'
                    ],
                    'label'=> ' ',
                ])
                ->add('email', EmailType::class, [
                    'attr'=> [
                        'class'=> 'form-control text-center',
                        'placeholder'=> 'Entrez votre email'
                    ],
                    'label'=> ' ',
                ])
                ->add('message', TextareaType::class, [
                    'attr'=> [
                        'class'=> 'form-control text-center',
                        'placeholder'=> 'Écrivez votre message',
                        'rows'=> '10'
                    ],
                    'label'=> ' ',
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}