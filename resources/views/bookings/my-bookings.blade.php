<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">تذاكري وحجوزاتي</h2>
    </x-slot>

    <div class="py-12 bg-[#F7F8F0] dark:bg-[#222831] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($bookings->isEmpty())
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-xl rounded-3xl p-12 text-center border border-[#9CD5FF] dark:border-[#948979]">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-[#9CD5FF] dark:bg-[#948979] rounded-full mb-6">
                        <svg class="w-10 h-10 text-[#7AAACE] dark:text-[#DFD0B8]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-3">لا توجد حجوزات نشطة</h3>
                    <p class="text-[#948979] dark:text-[#948979] mb-8 max-w-md mx-auto">يبدو أنك لم تقم بحجز مقعد في أي
                        فعالية بعد. استكشف الفعاليات القادمة الآن!</p>
                    <a href="{{ route('eventIndex') }}"
                        class="inline-flex items-center px-6 py-3 bg-[#7AAACE] border border-transparent rounded-xl font-bold text-white hover:bg-[#9CD5FF] transition ease-in-out duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                        استكشف الفعاليات
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($bookings as $booking)
                        <div
                            class="group bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-[#9CD5FF] dark:border-[#948979] transform hover:-translate-y-1">
                            <div
                                class="relative h-40 bg-gradient-to-br from-[#7AAACE] to-[#355872] p-6 flex flex-col justify-end">
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $booking->attended_at ? 'bg-[#7AAACE]/30 text-white border border-white/40' : 'bg-white/20 text-white border border-white/30' }}">
                                        {{ $booking->attended_at ? '✓ تم الحضور' : 'حجزت' }}
                                    </span>
                                </div>
                                <h3
                                    class="text-xl font-black text-white leading-tight group-hover:translate-x-1 transition-transform duration-300 drop-shadow-md">
                                    {{ $booking->event->title }}
                                </h3>
                            </div>

                            <div class="p-6">
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-[#948979] dark:text-[#948979] text-sm">
                                        <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        {{ $booking->event->faculty->name ?? 'كلية عامة' }}
                                    </div>
                                    <div class="flex items-center text-[#948979] dark:text-[#948979] text-sm">
                                        <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $booking->event->start_date->format('d M, Y') }}
                                    </div>
                                    <div class="flex items-center text-[#948979] dark:text-[#948979] text-sm">
                                        <span class="font-medium">عدد التذاكر:</span>
                                        <span
                                            class="ml-2 font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $booking->num_tickets }}</span>
                                    </div>
                                </div>

                                @if ($booking->qr_path)
                                    <button
                                        onclick="openQrModal('{{ asset('storage/' . ltrim($booking->qr_path, '/')) }}', '{{ addslashes($booking->event->title) }}')"
                                        class="w-full py-3 bg-[#222831] dark:bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#393E46] dark:hover:bg-[#9CD5FF] transition-colors flex items-center justify-center gap-2 shadow-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                            </path>
                                        </svg>
                                        عرض التذكرة الرقمية
                                    </button>
                                @endif

                                @if (!$booking->attended_at)
                                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST"
                                        class="mt-4 inline-block w-full cancel-form">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-full py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition-colors shadow-md">إلغاء
                                            الحجز</button>
                                    </form>
                                @endif

                                @if (
                                    $booking->attended_at &&
                                        now()->gt($booking->event->end_date) &&
                                        !$booking->event->ratings()->where('user_id', auth()->id())->exists())
                                    <button
                                        onclick="openRatingModal({{ $booking->event->id }}, '{{ addslashes($booking->event->title) }}')"
                                        class="mt-3 w-full py-2.5 bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#9CD5FF] transition shadow-md">
                                        قيّم الفعالية
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- مودال QR Code -->
    <div id="qr-modal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl max-w-sm w-full mx-4 overflow-hidden shadow-2xl border border-[#9CD5FF] dark:border-[#948979] transform scale-95 transition-transform duration-300"
            id="qr-modal-content">
            <div class="p-8 text-center">
                <h3 id="modal-title" class="text-xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-2">تذكرة الدخول</h3>
                <p class="text-[#948979] dark:text-[#948979] mb-6 text-sm">امسح الرمز عند بوابة الفعالية</p>
                <div
                    class="bg-white dark:bg-[#222831] p-6 rounded-2xl mb-6 border-4 border-[#7AAACE] shadow-inner inline-block">
                    <img id="qr-image" src="" alt="QR Code" class="w-48 h-48 mx-auto object-contain">
                </div>
                <button onclick="closeQrModal()"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold transition shadow-md">إغلاق</button>
            </div>
        </div>
    </div>

    <!-- مودال التقييم -->
    <div id="rating-modal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div
            class="bg-[#F7F8F0] dark:bg-[#393E46] p-8 rounded-3xl max-w-md w-full mx-4 shadow-2xl border border-[#9CD5FF] dark:border-[#948979]">
            <h3 id="rating-title" class="text-xl font-bold mb-6 text-center text-[#355872] dark:text-[#DFD0B8]"></h3>
            <form id="rating-form" method="POST" action="">
                @csrf
                <input type="hidden" name="event_id" id="rating-event-id">
                <div class="flex justify-center gap-3 mb-6">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button"
                            class="star-btn text-4xl text-[#948979] hover:text-amber-400 transition-colors"
                            data-value="{{ $i }}">★</button>
                    @endfor
                </div>
                <input type="hidden" name="stars" id="rating-stars" value="5">
                <textarea name="comment" rows="4"
                    class="w-full p-4 border border-[#9CD5FF] dark:border-[#948979] rounded-xl bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition"
                    placeholder="اكتب تعليقك (اختياري)"></textarea>
                <div class="mt-6 flex justify-center gap-4">
                    <button type="button" onclick="closeRatingModal()"
                        class="px-6 py-3 bg-[#948979] text-white rounded-xl font-bold hover:bg-[#355872] transition">إلغاء</button>
                    <button type="submit"
                        class="px-6 py-3 bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#9CD5FF] transition shadow-md">إرسال
                        التقييم</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // إلغاء الحجز AJAX
        document.querySelectorAll('.cancel-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                if (!confirm('هل أنت متأكد من إلغاء الحجز؟')) return;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: new FormData(form)
                    });
                    const data = await response.json();
                    if (data.status === 'success') {
                        alert(data.message);
                        form.closest('.group').remove();
                        if (document.querySelectorAll('.group').length === 0) {
                            location.reload();
                        }
                    } else {
                        alert(data.error || 'حدث خطأ أثناء الإلغاء');
                    }
                } catch (err) {
                    alert('فشل في الاتصال بالخادم');
                }
            });
        });

        // مودال QR Code
        function openQrModal(qrUrl, eventTitle) {
            document.getElementById('modal-title').textContent = eventTitle || 'تذكرة الدخول';
            document.getElementById('qr-image').src = qrUrl;
            const modal = document.getElementById('qr-modal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.querySelector('#qr-modal-content').classList.replace('scale-95', 'scale-100'), 10);
        }

        function closeQrModal() {
            const modal = document.getElementById('qr-modal');
            modal.querySelector('#qr-modal-content').classList.replace('scale-100', 'scale-95');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        // مودال التقييم
        function openRatingModal(eventId, title) {
            document.getElementById('rating-title').innerText = title;
            document.getElementById('rating-event-id').value = eventId;
            document.getElementById('rating-form').action = '/events/' + eventId + '/rate';
            document.getElementById('rating-modal').classList.remove('hidden');
        }

        function closeRatingModal() {
            document.getElementById('rating-modal').classList.add('hidden');
        }

        document.querySelectorAll('.star-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const value = btn.dataset.value;
                document.getElementById('rating-stars').value = value;
                document.querySelectorAll('.star-btn').forEach(b => {
                    b.classList.toggle('text-amber-400', b.dataset.value <= value);
                    b.classList.toggle('text-[#948979]', b.dataset.value > value);
                });
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeQrModal();
                closeRatingModal();
            }
        });
    </script>
</x-main-layout>
