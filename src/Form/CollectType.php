<?php

namespace App\Form;

use App\Entity\Collect;
use App\Enum\StatutJeuEnum;
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
            // Le champ Utilisateur et JeuVideo sont généralement gérés par des EntityType
            // et ne sont pas modifiés directement ici, mais je les ajoute pour l'exhaustivité
            // si ce formulaire était utilisé pour une administration complète.
            // On peut aussi les omettre s'ils sont gérés par le contrôleur (ex: utilisateur actuel).
            // Pour l'instant, on les omet car ils sont souvent définis par le contexte.

            ->add('statut', ChoiceType::class, [
                'choices' => StatutJeuEnum::cases(), // Récupère tous les cas de l'Enum
                'choice_label' => fn (StatutJeuEnum $choice) => $choice->getLabel(), // Utilise la méthode getLabel() pour l'affichage (nécessite la méthode dans l'Enum)
                'choice_value' => 'value', // Utilise la valeur string réelle de l'Enum pour la BDD
                'label' => 'Statut du jeu dans votre collection',
                'placeholder' => 'Choisir un statut',
                'required' => true,
            ])
            // La dateModifStatut est souvent gérée automatiquement, mais on l'ajoute si nécessaire
            // Je l'omets car elle est généralement mise à jour dans l'entité ou le service.

            ->add('prixAchat', NumberType::class, [
                'label' => "Prix d'achat (€)",
                'required' => false,
                'html5' => true,
                'scale' => 2, // Pour gérer les centimes
            ])

            ->add('dateAchat', DateType::class, [
                'label' => "Date d'achat",
                'widget' => 'single_text', // Affiche un champ de date simple (HTML5)
                'input' => 'datetime', // Type d'entrée correspondant à \DateTime
                'required' => false,
            ])

            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire personnel',
                'required' => false,
                'attr' => ['rows' => 4],
            ])

            // Les champs createdAt et updatedAt sont généralement gérés automatiquement par Doctrine ou des Timestamps
            // et ne sont pas inclus dans un formulaire destiné à l'utilisateur final.
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collect::class,
        ]);
    }
}
