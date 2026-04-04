<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
            مسح رمز الحضور
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#F7F8F0] dark:bg-[#393E46] shadow-sm sm:rounded-xl p-8">

                <h3 class="text-xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-6">
                    اختر الفعالية التي تريد مسح الحضور فيها
                </h3>

                @if ($events->isEmpty())
                    <div class="text-center py-12 text-[#948979] dark:text-[#948979]">
                        <p>لا توجد فعاليات متاحة للمسح حالياً</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($events as $event)
                            <a href="{{ route('scan.event', $event->id) }}"
                                class="block p-6 bg-[#F7F8F0] dark:bg-[#393E46] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-2xl border border-[#9CD5FF] dark:border-[#948979] hover:border-[#7AAACE] transition-all">
                                <h4 class="font-bold text-lg text-[#355872] dark:text-[#DFD0B8] mb-2">
                                    {{ $event->title }}
                                </h4>
                                <p class="text-sm text-[#948979] dark:text-[#948979]">
                                    {{ $event->start_date->format('d/m/Y') }} • {{ $event->location }}
                                </p>
                                <div class="mt-4 text-[#7AAACE] dark:text-[#7AAACE] text-sm font-medium">
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
