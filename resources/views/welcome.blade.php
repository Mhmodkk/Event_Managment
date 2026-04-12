    <x-main-layout>
        <section class="bg-[#F7F8F0] dark:bg-[#222831] min-h-screen" dir="rtl">
            <div class="container px-6 py-10 mx-auto">
                <div class="text-center mb-12">
                    <h1 class="text-3xl font-bold text-[#355872] lg:text-5xl dark:text-[#DFD0B8] mb-4">
                        آخر الفعاليات والأنشطة الجامعية
                    </h1>
                    <p class="text-[#948979] text-lg max-w-2xl mx-auto">
                        ابقَ على اطلاع دائم بكافة المؤتمرات، الندوات، والأنشطة الطلابية في جامعة الحواش الخاصة.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($events as $event)
                        <div
                            class="flex flex-col bg-white dark:bg-[#393E46] rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-[1.02]">
                            <img class="object-cover w-full h-56" src="{{ asset('/storage/' . $event->image) }}"
                                alt="{{ $event->title }}">

                            <div class="flex flex-col justify-between p-6 flex-grow">
                                <div>
                                    <span class="text-xs font-bold text-[#7AAACE] uppercase tracking-wider">
                                        {{ $event->faculty->name }}
                                    </span>
                                    <a href="{{ route('eventShow', $event->id) }}"
                                        class="block mt-2 text-xl font-bold text-[#355872] hover:underline dark:text-[#DFD0B8]">
                                        {{ $event->title }}
                                    </a>
                                    <p class="mt-3 text-sm text-[#948979] line-clamp-2">
                                        {{ $event->description }}
                                    </p>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('eventShow', $event->id) }}"
                                        class="inline-block w-full text-center py-2 bg-[#7AAACE] text-white rounded-lg hover:bg-[#355872] transition font-semibold">
                                        تفاصيل الفعالية
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </x-main-layout>
