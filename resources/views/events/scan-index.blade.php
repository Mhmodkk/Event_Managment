<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-blue-700 leading-tight">
            مسح رمز الحضور
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-xl p-8">

                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                    اختر الفعالية التي تريد مسح الحضور فيها
                </h3>

                @if ($events->isEmpty())
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <p>لا توجد فعاليات متاحة للمسح حالياً</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($events as $event)
                            <a href="{{ route('scan.event', $event->id) }}"
                                class="block p-6 bg-gray-50 dark:bg-gray-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-2xl border border-transparent hover:border-indigo-200 transition-all">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-white mb-2">
                                    {{ $event->title }}
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $event->start_date->format('d/m/Y') }} • {{ $event->location }}
                                </p>
                                <div class="mt-4 text-indigo-600 dark:text-indigo-400 text-sm font-medium">
                                    اضغط للبدء بالمسح →
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
