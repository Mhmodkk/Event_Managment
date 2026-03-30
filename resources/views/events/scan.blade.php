<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-blue-700 leading-tight">
            سجل حضورك في - {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div id="result" class="mb-8 p-6 rounded-xl text-center text-lg font-medium hidden">
                </div>

                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        ؟ QR جاهز لمسح رمز
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        وجه الكاميرا نحو رمزك الخاص بالمشاركة
                    </p>
                </div>

                <div id="reader"
                    class="w-full max-w-md mx-auto aspect-square bg-black rounded-xl overflow-hidden shadow-2xl"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        const readerDiv = document.getElementById('reader');
        const resultDiv = document.getElementById('result');

        function showResult(status, message, details = {}) {
            resultDiv.classList.remove('hidden');
            let bgClass = 'bg-gray-100 dark:bg-gray-700';
            let textClass = 'text-gray-800 dark:text-gray-200';

            if (status === 'success') {
                bgClass = 'bg-green-100 dark:bg-green-900/40 border border-green-500';
                textClass = 'text-green-800 dark:text-green-300';
            } else if (status === 'warning') {
                bgClass = 'bg-yellow-100 dark:bg-yellow-900/40 border border-yellow-500';
                textClass = 'text-yellow-800 dark:text-yellow-300';
            } else if (status === 'error') {
                bgClass = 'bg-red-100 dark:bg-red-900/40 border border-red-500';
                textClass = 'text-red-800 dark:text-red-300';
            }

            resultDiv.className = `mb-8 p-6 rounded-xl text-center text-lg font-medium border ${bgClass}`;

            let html = `<p class="${textClass}">${message}</p>`;

            if (details.name) {
                html += `<p class="mt-3 text-xl font-bold ${textClass}">${details.name}</p>`;
            }
            if (details.type) {
                html += `<p class="mt-1 text-base ${textClass}">${details.type}</p>`;
            }
            if (details.time) {
                html += `<p class="mt-2 text-sm ${textClass}">وقت التسجيل: ${details.time}</p>`;
            }

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
                console.log("Scanner stopped");

                resultDiv.innerHTML = '<p class="text-blue-600 dark:text-blue-400">جاري التحقق...</p>';
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
                        if (error.response?.data?.message) {
                            msg = error.response.data.message;
                        }
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
                        فشل بدء الكاميرا<br>
                        <small class="block mt-3">
                            ${err.name === 'NotAllowedError' ? 'يرجى السماح بالوصول إلى الكاميرا' : ''}
                            ${err.name === 'NotFoundError' ? 'لا يوجد كاميرا متاحة' : err.message || 'حدث خطأ غير متوقع'}
                        </small>
                        <button onclick="location.reload()" class="mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            إعادة المحاولة
                        </button>
                    </div>
                `;
            });
        } catch (err) {
            console.error("فشل تهيئة الماسح:", err);
        }
    </script>
</x-app-layout>
