<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use DateTimeImmutable;

class MenuBuilder
{
    private $factory;
    private $month;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;

        $this->month = new DateTimeImmutable();
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_home']);
        $menu->addChild('Клиенты', ['route' => 'app_client_index']);
        $menu->addChild('Места', ['route' => 'app_place_index']);
        $menu->addChild('Заказы', ['route' => 'app_rent_index']);
        $menu->addChild('Типы мест', ['route' => 'app_type_of_place_index']);
        $menu->addChild('Календарь', ['route' => 'app_calendar', 'routeParameters' => ['month' => $this->month->format('Y-m')]]);

        return $menu;
    }
}
