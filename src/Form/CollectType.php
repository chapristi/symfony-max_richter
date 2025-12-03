<?php

namespace App\Form;

use App\Entity\Collect;
use App\Entity\JeuVideo;
use App\Entity\Utilisateur;
use App\Enum\StatutJeuEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('statut', ChoiceType::class, [
                'choices' => StatutJeuEnum::cases(),
                'choice_label' => fn (StatutJeuEnum $choice) => $choice->getLabel(),
                'choice_value' => 'value',
                'label' => 'Statut du jeu dans votre collection',
                'placeholder' => 'Choisir un statut',
                'required' => true,
            ])

            ->add('jeuvideo', EntityType::class, [
                'class' => JeuVideo::class,
                'choice_label' => 'titre',
                'label' => 'Jeu Vidéo',
                'required' => true,
            ])

            ->add('prixAchat', NumberType::class, [
                'label' => "Prix d'achat (€)",
                'required' => false,
                'html5' => true,
                'scale' => 2,
            ])

            ->add('dateAchat', DateType::class, [
                'label' => "Date d'achat",
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => false,
            ])

            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire personnel',
                'required' => false,
                'attr' => ['rows' => 4],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collect::class,
        ]);
    }
}
