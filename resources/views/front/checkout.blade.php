<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('css/output.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>
<body class="text-black font-poppins pt-10">
    <div id="checkout-section" class="max-w-[1200px] mx-auto w-full min-h-[calc(100vh-40px)] flex flex-col gap-[30px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-t-[32px] overflow-hidden relative pb-6">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="index.html">
                <img src="assets/logo/logo.svg" alt="logo">
            </a>
            <ul class="flex items-center gap-[30px] text-white">
                <li>
                    <a href="" class="font-semibold">Home</a>
                </li>
                <li>
                    <a href="pricing.html" class="font-semibold">Pricing</a>
                </li>
                <li>
                    <a href="" class="font-semibold">Benefits</a>
                </li>
                <li>
                    <a href="" class="font-semibold">Stories</a>
                </li>
            </ul>
            <div class="flex gap-[10px] items-center">
                <div class="flex flex-col items-end justify-center">
                    <p class="font-semibold text-white">Hi, Annasia</p>
                    <!-- <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">PRO</p> -->
                </div>
                <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                    <img src="assets/photo/photo5.png" class="w-full h-full object-cover" alt="photo">
                </div>
            </div>
        </nav>
        <div class="flex flex-col gap-[10px] items-center">
            <div class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="assets/icon/medal-star.svg" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Invest In Yourself Today</p>
            </div>
            <h2 class="font-bold text-[40px] leading-[60px] text-white">Checkout Subscription</h2>
        </div>
        <div class="flex gap-10 px-[100px] relative z-10">
            <!-- Detail Kursus -->
            <div class="w-[400px] flex shrink-0 flex-col bg-white rounded-2xl p-5 gap-4 h-fit">
                <p class="font-bold text-lg">Course Details</p>
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                            <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $course->name }}">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <p class="font-semibold">{{ $course->name }}</p>
                            <p class="text-sm text-[#6D7786]">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Detail Pembayaran -->
            <div class="w-full bg-white rounded-2xl p-5">
                <!-- Metode Pembayaran -->
                <div class="flex flex-col mb-5">
                    <p class="text-[#475466] font-semibold mb-2">Metode Pembayaran</p>
                    <button class="bg-[#4A5568] text-black py-2 px-4 rounded-full">Otomatis</button>
                </div>
            
                <!-- Payment Details -->
                <div class="flex flex-col mb-5">
                    <p class="text-[#475466] font-semibold mb-3">Payment details</p>
            
            
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-[#475466]">Harga Kelas <span class="bg-[#4299E1] text-white text-xs py-1 px-2 rounded-full">Discount</span></p>
                        <p class="text-[#475466] font-semibold">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                    </div>
            
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-[#475466]">Service fee per student <span class="text-[#475466] cursor-pointer" title="Biaya tambahan untuk setiap siswa">?</span></p>
                        <p class="text-[#38A169] font-semibold">+ Rp 10.000</p>
                    </div>
            
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-[#475466]">Pajak 10%</p>
                        <p class="text-[#38A169] font-semibold">+ Rp {{ number_format($course->price * 0.1, 0, ',', '.') }}</p>
                    </div>
            
                    <div class="flex justify-between items-center">
                        <p class="text-[#475466] font-semibold">Total</p>
                        <p class="text-[#38A169] font-semibold">Rp {{ number_format($course->price + 10000 + ($course->price * 0.1), 0, ',', '.') }}</p>
                    </div>
                </div>
            
                <!-- Terms and Conditions -->
                <div class="flex items-start mb-5">
                    <input type="checkbox" class="mr-2">
                    <p class="text-[#475466]">Saya setuju dengan <a href="#" class="text-[#4299E1] font-semibold">Terms & Conditions</a></p>
                </div>
            
                <!-- Button Bayar -->
                <button id="pay-button" class="w-full bg-[#4A5568] text-black py-3 rounded-full font-bold">
                    Bayar & gabung kelas
                </button>
                
                <!-- Midtrans Snap JS -->
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                
                <script type="text/javascript">
                document.getElementById('pay-button').onclick = function() {
                    fetch('{{ route('payment.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            amount: {{ $course->price + 10000 + ($course->price * 0.1) }},
                            first_name: '{{ Auth::user()->name }}',
                            email: '{{ Auth::user()->email }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snap_token) {
                            snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    // Memanggil updatePaymentStatus setelah pembayaran berhasil
                                    fetch('{{ route('course.updatePaymentStatus', $course->slug) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            status: 'success',
                                            user_id: {{ Auth::user()->id }},
                                            course_id: {{ $course->id }}
                                        })
                                    })
                                    .then(() => {
                                        window.location.href = '{{ route('front.details', $course->slug) }}';
                                    })
                                    .catch(error => {
                                        console.error('Error updating payment status:', error);
                                    });
                                },
                                onPending: function(result) {
                                    console.log('Payment pending:', result);
                                },
                                onError: function(result) {
                                    console.error('Payment error:', result);
                                },
                                onClose: function() {
                                    console.log('Payment popup closed without finishing the payment.');
                                }
                            });
                        } else {
                            console.error('Snap Token is missing:', data);
                            alert('Terjadi kesalahan saat mendapatkan token pembayaran. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                    });
                };
                </script>                
            </div> 
        </div>
        <div class="flex justify-center absolute transform -translate-x-1/2 left-1/2 bottom-0 w-full">
            <img src="assets/background/alqowy.svg" alt="background">
        </div>
        
    
    <!-- JavaScript -->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
    <script src="{{asset('js/main.js')}}"></script>
    
</body>
</html>