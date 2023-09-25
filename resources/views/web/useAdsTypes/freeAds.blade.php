@extends('web.layout.webLayout')
@section('content')
    <div class="container mb-2">
        <div class="row">
            <div class="col-md-5">
                <div class="m-1 jumbotron">
                    <h2 style="color: #333; font-weight: bold;">Make your ad stand out!</h2>
                    <p>Get up to 10 times more responses by applying Ad Promotions.</p>
                    <p>Select one or more options (Optional).</p>
                    <hr class="my-4">
                    <ul>
                        @foreach ($packages as $item)
                            <div>
                                <li>
                                    <h4 class="mt-4">{{ $item->package_name }}</h4>
                                    <ul>
                                        @foreach ($item->getAdsTypes as $types)
                                            <div style="padding: 10px !important;" class="card">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>{{ $types->name }}</strong>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <span>Rs {{ $types->price }} <span
                                                                onclick="passValues('{{ $types->price }}','{{ $types->name }}','{{ $types->id }}')"><i
                                                                    style="color: rgb(2, 110, 2) !important;  cursor: pointer !important;"
                                                                    class="fa fa-plus-circle"
                                                                    aria-hidden="true"></i></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                </li>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="m-1 jumbotron">
                    <!-- Your content for the right column goes here -->
                    <div class="text-center">
                        <i style="color:green !important; font-size:24px !important;" class="fa fa-check"
                            aria-hidden="true"></i>
                        <p style="color: black !important;" class="text-center mt-1">Your ad is under review!</p>
                        <p class="mt-2">Please note that it can take up to 4 hours for your ad to be published. Keep track
                            of your ad
                            through <a href="">My Ads.</a> </p>
                        <p class="mt-2">We will contact you shortly if payment is required to publish your ad.</p>
                    </div>
                    <div class="row" style="border: #333 1px solid !important;">
                        <div class="col-md-4 p-2">
                            <img src="{{ asset('ad_image/main_image/' . $current_ad->ads_main_image) }}"
                                style="height: 100px !important; width:100px !important; object-fit:cover !important;">
                        </div>
                        <div class="col-md-8 p-2">
                            <p>{{ $current_ad->ads_title }}</p>
                            <p>{{ $current_ad->ads_location }} , {{ $current_ad->ads_sub_cat_name }}</p>
                            <h6>Rs. {{ $current_ad->ads_price }}</h6>
                        </div>
                    </div>
                </div>

                <div id="append_form" class="m-1 ">
                </div>

            </div>
        </div>
    </div>
    <script>
        // Function to check if the form exists
        function doesFormExist() {
            return !!document.getElementById('paymentForm');
        }

        // Function to update the form values
        function updateFormValues(price, name, id) {
            if (doesFormExist()) {
                var insertedAdInput = document.querySelector('#paymentForm input[type="text"]');
                var paymentSummary = document.querySelector('#paymentForm p:nth-of-type(1)');
                var totalBalance = document.querySelector('#paymentForm p:nth-of-type(2)');
                var totalInput = document.querySelector('#paymentForm input[name="total"]');

                insertedAdInput.value = id;
                paymentSummary.textContent = 'Payment Summary: ' + name;
                totalBalance.textContent = 'Total Balance: ' + price;
                totalInput.value = price;
            }
        }

        // Function to create or update the form
        function passValues(price, name, id) {
            // Check if the form already exists
            if (doesFormExist()) {
                updateFormValues(price, name, id);
            } else {
                // Create a new form element
                var form = document.createElement('form');
                form.setAttribute('id', 'paymentForm');
                form.classList.add('jumbotron'); // Add 'jumbotron' class to the form
                form.setAttribute('action',
                    '{{ route('freeads.payment') }}'); // Replace 'your-route-name' with your actual route name
                form.setAttribute('method', 'POST');

                // Add CSRF token field
                var csrfToken = document.createElement('input');
                csrfToken.setAttribute('type', 'hidden');
                csrfToken.setAttribute('name', '_token');
                csrfToken.setAttribute('value', '{{ csrf_token() }}');

                var insertedAdInput = document.createElement('input');
                insertedAdInput.setAttribute('type', 'text');
                insertedAdInput.setAttribute('name', 'ad_type'); // Set the name attribute
                insertedAdInput.value = id;

                var priceInput = document.createElement('input');
                priceInput.setAttribute('type', 'text');
                priceInput.setAttribute('name', 'total'); // Set the name attribute
                priceInput.value = price;

                let finalAdsId = {!! json_encode($inserted_ad, JSON_HEX_TAG) !!}
                var insertedAdsId = document.createElement('input');
                insertedAdsId.setAttribute('type', 'text');
                insertedAdsId.setAttribute('name', 'ads_id'); // Set the name attribute
                insertedAdsId.value = finalAdsId;

                var paymentSummary = document.createElement('p');
                paymentSummary.textContent = 'Ad Type: ' + name;

                var totalBalance = document.createElement('p');
                totalBalance.textContent = 'Total Balance: ' + price;

                var button = document.createElement('button');
                button.setAttribute('type', 'submit');
                button.setAttribute('class', 'btn btn-success payment');
                button.textContent = 'Pay';

                // Append the input elements and div to the form
                form.appendChild(insertedAdInput);
                form.appendChild(insertedAdsId);
                form.appendChild(paymentSummary);
                form.appendChild(totalBalance);
                form.appendChild(priceInput);
                form.appendChild(csrfToken);

                var div = document.createElement('div');
                div.setAttribute('class', 'text-center mt-3 ');
                div.appendChild(button);

                form.appendChild(div);

                // Append the form to the element with id 'append_form'
                var appendForm = document.getElementById('append_form');
                appendForm.appendChild(form);

            }
        }
    </script>
@endsection
