<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class BreadcrumbService
{
    public function __construct(
        private RequestStack $requestStack
    ) {}

    public function getBreadcrumb(): array
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return [];
        }

        $route = $request->get('_route');


        $mapping = [
            'app_default' => 'Accueil',

            'app_jeu_video_index'  => 'Accueil:app_default > Les Jeux Vidéo',
            'app_jeu_video_new'    => 'Accueil:app_default > Les Jeux Vidéo:app_jeu_video_index > Ajouter un jeu',
            'app_jeu_video_show'   => 'Accueil:app_default > Les Jeux Vidéo:app_jeu_video_index > Fiche du jeu',
            'app_jeu_video_edit'   => 'Accueil:app_default > Les Jeux Vidéo:app_jeu_video_index > Modifier le jeu',

            'app_genre_index'      => 'Accueil:app_default > Les Genres',
            'app_genre_new'        => 'Accueil:app_default > Les Genres:app_genre_index > Créer un genre',
            'app_genre_show'       => 'Accueil:app_default > Les Genres:app_genre_index > Détail du genre',
            'app_genre_edit'       => 'Accueil:app_default > Les Genres:app_genre_index > Modifier le genre',

            'app_editeur_index'    => 'Accueil:app_default > Les Éditeurs',
            'app_editeur_new'      => 'Accueil:app_default > Les Éditeurs:app_editeur_index > Ajouter un éditeur',
            'app_editeur_show'     => 'Accueil:app_default > Les Éditeurs:app_editeur_index > Fiche éditeur',
            'app_editeur_edit'     => 'Accueil:app_default > Les Éditeurs:app_editeur_index > Modifier l\'éditeur',

            'app_collect_index'       => 'Accueil:app_default > Les Collections',
            'app_collect_collection'  => 'Accueil:app_default > Les Collections:app_collect_index > Collection Joueur',
            'app_collect_show_by_ids' => 'Accueil:app_default > Les Collections:app_collect_index > Détail Item',
            'app_collect_new'         => 'Accueil:app_default > Les Collections:app_collect_index > Ajouter à une collection',
            'app_collect_edit'        => 'Accueil:app_default > Les Collections:app_collect_index > Modifier l\'item',
        ];

        // Si la route n'est pas dans le mapping, on retourne vide
        if (!array_key_exists($route, $mapping)) {
            return [];
        }

        return $this->buildPath($mapping[$route]);
    }

    private function buildPath(string $definition): array
    {
        $steps = [];
        $parts = explode(' > ', $definition);

        foreach ($parts as $part) {
            $subParts = explode(':', $part);

            $steps[] = [
                'label' => $subParts[0],
                'route' => $subParts[1] ?? null,
            ];
        }

        return $steps;
    }
}
