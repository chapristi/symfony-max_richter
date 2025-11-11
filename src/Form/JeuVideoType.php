<?php

namespace App\Form;

use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\JeuVideo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('dateSortie', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('prix', MoneyType::class,[
                'currency' => false,
                'help' => 'le prix est en €'
            ] )
            ->add('description')
            ->add('imageUrl', FileType::class,[
                'label' => 'Image',
                'mapped' => false,
                'help' => "Veuillez selectionner un type d'image valdie (JPEG,PNG)",
                'constraints' => [
                    new File(
                        maxSize: '1024k',
                        extensions: ['png, jpg', 'jpeg'],
                        extensionsMessage: "Veuillez selectionner un type d'image valdie (JPEG,PNG)",
                    )
                ],
            ])
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom',
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
            ])
            ->add('developpeur', EntityType::class, [
                'class' => Developpeur::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JeuVideo::class,
        ]);
    }
}
