<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo', FileType::class, [
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new File([
                        "mimeTypes"         => [ "image/gif", "image/jpeg", "image/png" ],
                        "mimeTypesMessage"  => "Les formats autorisés sont gif, jpg, png",
                        "maxSize"           => "2048k",
                        "maxSizeMessage"    => "Le fichier ne peut pas peser plus de 2Mo"
                    ])
                ]
            ])
            ->add('titre')
            ->add('description')
            ->add('publie')
            ->add('activ')
            ->add('miseAJour')
            ->add('fichier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
