<?php

namespace App\Menu;

use Knp\Menu\Attribute\AsMenuBuilder;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    #[AsMenuBuilder(name: 'main')]
    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav me-auto mb-2 mb-lg-0');

        $menuJV = $menu->addChild('Jeux vidéo', [
            'uri' => '#'
        ]);

        // Configuration du Parent (Dropdown Toggle)
        $menuJV->setAttribute('class', 'nav-item dropdown');
        $menuJV->setLinkAttribute('class', 'nav-link dropdown-toggle');
        $menuJV->setLinkAttribute('data-bs-toggle', 'dropdown');
        $menuJV->setChildrenAttribute('class', 'dropdown-menu');

        $menuJV->addChild('Liste des jeux', ['route' => 'app_jeu_video_index'])
            ->setLinkAttribute('class', 'dropdown-item');

        $menuJV->addChild("Création d'un jeu", ['route' => 'app_jeu_video_new'])
            ->setLinkAttribute('class', 'dropdown-item');


        $menuGenre = $menu->addChild('Genres', ['uri' => '#']);

        $menuGenre->setAttribute('class', 'nav-item dropdown');
        $menuGenre->setLinkAttribute('class', 'nav-link dropdown-toggle');
        $menuGenre->setLinkAttribute('data-bs-toggle', 'dropdown');
        $menuGenre->setChildrenAttribute('class', 'dropdown-menu');

        $menuGenre->addChild('Liste des genres', ['route' => 'app_genre_index'])
            ->setLinkAttribute('class', 'dropdown-item');

        $menuGenre->addChild("Création d'un genre", ['route' => 'app_genre_new'])
            ->setLinkAttribute('class', 'dropdown-item');


        $menuEditeur = $menu->addChild('Editeurs', ['uri' => '#']);

        $menuEditeur->setAttribute('class', 'nav-item dropdown');
        $menuEditeur->setLinkAttribute('class', 'nav-link dropdown-toggle');
        $menuEditeur->setLinkAttribute('data-bs-toggle', 'dropdown');
        $menuEditeur->setChildrenAttribute('class', 'dropdown-menu');

        $menuEditeur->addChild('Liste des éditeurs', ['route' => 'app_editeur_index'])
            ->setLinkAttribute('class', 'dropdown-item');

        $menuEditeur->addChild("Création d'un éditeur", ['route' => 'app_editeur_new'])
            ->setLinkAttribute('class', 'dropdown-item');

        $menuCollect = $menu->addChild('Collection', ['uri' => '#']);

        $menuCollect->setAttribute('class', 'nav-item dropdown');
        $menuCollect->setLinkAttribute('class', 'nav-link dropdown-toggle');
        $menuCollect->setLinkAttribute('data-bs-toggle', 'dropdown');
        $menuCollect->setChildrenAttribute('class', 'dropdown-menu');

        $menuCollect->addChild('Liste des collections', ['route' => 'app_collect_index'])
            ->setLinkAttribute('class', 'dropdown-item');


        return $menu;
    }
}
