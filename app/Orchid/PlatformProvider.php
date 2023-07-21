<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Models\Message;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
//            Menu::make('Example screen')
//                ->icon('monitor')
//                ->route('platform.example')
//                ->title('Navigation')
//                ->badge(fn () => 6),

            Menu::make('Чаты')
                ->permission('platform.operation.chats')
                ->title('Телеграм')
                ->icon('bubbles')
                ->badge(fn () => Message::query()->where('read', 0)->count())
                ->route('chat.index'),

//            Menu::make('Advanced Elements')
//                ->icon('briefcase')
//                ->route('platform.example.advanced'),

//            Menu::make('Text Editors')
//                ->icon('list')
//                ->route('platform.example.editors'),
//
//            Menu::make('Overview layouts')
//                ->title('Layouts')
//                ->icon('layers')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Chart tools')
//                ->icon('bar-chart')
//                ->route('platform.example.charts'),

//            Menu::make('Cards')
//                ->icon('grid')
//                ->route('platform.example.cards')
//                ->divider(),

            Menu::make('Documentation')
                ->title('Docs')
                ->icon('docs')
                ->url('https://orchid.software/en/docs'),

            Menu::make('Changelog')
                ->icon('shuffle')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),

            ItemPermission::group(__('Эвакуаторы'))
                ->addPermission('platform.trucks.history', __('История'))
                ->addPermission('platform.trucks.contacts', __('Управления контактами'))
                ->addPermission('platform.trucks.events', __('События')),

            ItemPermission::group(__('Оперирование'))
                ->addPermission('platform.operation.truck-view', __('Просмотр эвакуаторов'))
                ->addPermission('platform.operation.truck-control', __('Редактирование эвакуаторов'))
                ->addPermission('platform.operation.orders', __('Управление заказами'))
                ->addPermission('platform.operation.chats', __('Доступ к чатам'))
                ->addPermission('platform.operation.events', __('Просмотр событий')),
        ];
    }
}
