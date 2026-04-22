<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">سجل حضورك في - {{ $event->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-[#9CD5FF] dark:border-[#948979]">
                <div id="result" class="mb-8 p-6 rounded-xl text-center text-lg font-medium hidden"></div>

                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">جاهز لمسح رمز QR؟</h3>
                    <p class="mt-2 text-[#948979] dark:text-[#948979]">وجه الكاميرا نحو رمز الحضور الخاص بك</p>
                </div>

                <div id="reader"
                    class="w-full max-w-md mx-auto aspect-square bg-black rounded-xl overflow-hidden shadow-2xl border-4 border-[#9CD5FF]">
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        const readerDiv = document.getElementById('reader');
        const resultDiv = document.getElementById('result');

        function showResult(status, message, details = {}) {
            resultDiv.classList.remove('hidden');
            let bgClass = 'bg-[#F7F8F0] dark:bg-[#393E46]';
            let textClass = 'text-[#948979] dark:text-[#948979]';

            if (status === 'success') {
                bgClass = 'bg-[#7AAACE]/10 dark:bg-[#7AAACE]/20 border border-[#7AAACE]';
                textClass = 'text-[#355872] dark:text-[#DFD0B8]';
            } else if (status === 'warning') {
                bgClass = 'bg-yellow-100 dark:bg-yellow-900/40 border border-yellow-500';
                textClass = 'text-yellow-800 dark:text-yellow-300';
            } else if (status === 'error') {
                bgClass = 'bg-red-100 dark:bg-red-900/40 border border-red-500';
                textClass = 'text-red-800 dark:text-red-300';
            }

            resultDiv.className = `mb-8 p-6 rounded-xl text-center text-lg font-medium border ${bgClass}`;

            let html = `<p class="${textClass}">${message}</p>`;

            if (details.name) html += `<p class="mt-3 text-xl font-bold ${textClass}">${details.name}</p>`;
            if (details.type) html += `<p class="mt-1 text-base ${textClass}">${details.type}</p>`;
            if (details.time) html += `<p class="mt-2 text-sm ${textClass}">وقت التسجيل: ${details.time}</p>`;

            resultDiv.innerHTML = html;

            if (status === 'success') {
                setTimeout(() => {
                    resultDiv.classList.add('hidden');
                    html5QrCode.start({
                            facingMode: "environment"
                        }, {
                            fps: 10,
                            qrbox: {
                                width: 250,
                                height: 250
                            }
                        },
                        onScanSuccess,
                        onScanFailure
                    );
                }, 4000);
            }
        }

        const onScanSuccess = async (decodedText) => {
            html5QrCode.stop().then(() => {
                resultDiv.innerHTML = '<p class="text-[#7AAACE] dark:text-[#7AAACE]">جاري التحقق...</p>';
                resultDiv.classList.remove('hidden');

                axios.post('{{ route('scan.ticket', $event->id) }}', {
                        code: decodedText
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        const data = response.data;
                        showResult(data.status, data.message, {
                            name: data.attendee_name,
                            type: data.attendee_type,
                            time: data.time
                        });

                        if (data.status === 'success') {
                            const audio = new Audio(
                                'https://assets.mixkit.co/sfx/preview/mixkit-confirmation-tone-2864.mp3'
                            );
                            audio.volume = 0.4;
                            audio.play().catch(() => {});
                        }
                    })
                    .catch(error => {
                        let msg = 'حدث خطأ أثناء التحقق';
                        if (error.response?.data?.message) msg = error.response.data.message;
                        showResult('error', msg);
                    })
                    .finally(() => {
                        if (response?.data?.status !== 'success') {
                            setTimeout(() => {
                                html5QrCode.start({
                                        facingMode: "environment"
                                    }, {
                                        fps: 10,
                                        qrbox: {
                                            width: 250,
                                            height: 250
                                        }
                                    },
                                    onScanSuccess,
                                    onScanFailure
                                );
                            }, 1500);
                        }
                    });
            });
        };

        const onScanFailure = (err) => {};

        let html5QrCode;

        try {
            html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: {
                        width: 500,
                        height: 250
                    }
                },
                onScanSuccess,
                onScanFailure
            ).catch(err => {
                readerDiv.innerHTML = `
                    <div class="p-8 text-center text-red-600 dark:text-red-400 text-lg">
                        فشل بدء الكاميرا <br>
                        <small class="block mt-3">
                            ${err.name === 'NotAllowedError' ? 'يرجى السماح بالوصول إلى الكاميرا' : ''}
                            ${err.name === 'NotFoundError' ? 'لا يوجد كاميرا متاحة' : err.message || 'حدث خطأ غير متوقع'}
                        </small>
                        <button onclick="location.reload()" class="mt-6 px-6 py-3 bg-[#7AAACE] text-white rounded-lg hover:bg-[#9CD5FF] transition">
                            إعادة المحاولة
                        </button>
                    </div>
                `;
            });
        } catch (err) {
            console.error("فشل تهيئة الماسح: ", err);
        }
    </script>
</x-main-layout>
