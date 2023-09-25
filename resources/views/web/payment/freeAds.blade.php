@extends('web.layout.webLayout')
@section('content')
    <div id="card_container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"
        integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.directpay.lk/v3/directpayipg.min.js"></script>
    <script>
        var userData = {!! json_encode($userData, JSON_HEX_TAG) !!};
        var ad_type = @json($request->input('ad_type')); // Get the value of 'ad_type' from the request
        var ads_id = @json($request->input('ads_id')); // Get the value of 'ads_id' from the request

        var total = @json($request->total);

        payload = {
            merchant_id: "RA15505",
            amount: total,
            type: "ONE_TIME",
            order_id: Date().valueOf(),
            currency: "LKR",
            response_url: "https://test.com/response-endpoint",
            first_name: userData.first_name,
            last_name: userData.last_name,
            email: userData.email,
            phone: "",
            logo: "",
        };

        var encode_payload = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(JSON.stringify(payload)));
        var signature = CryptoJS.HmacSHA256(encode_payload,
            '4582bc7c47b366cc8acdf18c44fcfdc862d7cade01bf31214a12774293c95ba8');

        var dp = new DirectPayIpg.Init({
            signature: signature,
            dataString: encode_payload,
            stage: 'DEV',
            container: 'card_container'
        });

        //popup IPG
        dp.doInAppCheckout().then((data) => {
            passData(); // send ad package details to ajax
        }).catch(error => {
            console.log("client-error", JSON.stringify(error));
            alert(JSON.stringify(error))
        });

        //open IPG inside page component
        dp.doInContainerCheckout().then((data) => {
            console.log("client-res", JSON.stringify(data));
            alert(JSON.stringify(data))
        }).catch(error => {
            console.log("client-error", JSON.stringify(error));
            alert(JSON.stringify(error))
        });
    </script>
    <script>
        function passData() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ajax call start
            $.ajax({
                url: "{{ route('web.dashboard.successFreePay') }}",
                method: "POST",
                data: {
                    ad_type: ad_type,
                    ads_id: ads_id,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {}
            });

            // ajax call end
        }
    </script>
@endsection
