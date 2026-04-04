<x-main-layout>
    <!-- component -->
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-[#355872] capitalize lg:text-4xl dark:text-[#DFD0B8]">All Galleries
            </h1>
            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($galleries as $gallery)
                    <div class="lg:flex bg-[#393E46] rounded-md">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                            src="{{ asset('/storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}">
                    </div>
                @endforeach
            </div>
            {{ $galleries->links() }}
        </div>
    </section>
</x-main-layout>
