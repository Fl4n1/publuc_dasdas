<x-admin-layout>
    <div class="p-6 bg-white border-b border-gray-200 flex-col flex">
        <h1 class="text-lg text-gray-900">Панель управления</h1>

        <p class="text-lg text-gray-900">Имя: {{ Auth::user()->name }}</p>
        <p class="text-lg text-gray-900">
            Роль:
            @role('admin')
            Администратор
            @endrole
            @role('user')
            Как вы сюда попали?
            @endrole
            @role('manage')
            Контент-менеджер
            @endrole
        </p>
    </div>
</x-admin-layout>