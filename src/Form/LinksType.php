<?php

namespace App\Form;

use App\Entity\Links;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LinksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        dump(Links::$icons );
        $builder
            ->add('href')
            ->add('alt')
            ->add('name')
            ->add('icon' , ChoiceType::class ,[
                "choices" =>  array_flip(Links::$icons),
                'choice_label' => function ($choice, $key, $value) {         
            
                    return "<i class=\"fas ".strtolower($key)."\" ></i>"; 
                },
            ])
            ->add('enable')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Links::class,
        ]);
    }
}
