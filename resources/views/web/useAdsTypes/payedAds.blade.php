@extends('web.layout.webLayout')
@section('content')
    <style>
        /* Style for the form */
        #paymentForm {
            background-color: #f9f9f9 !important;
            padding: 20px !important;
            border-radius: 5px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2) !important;
            max-width: 400px !important;
            margin: 0 auto !important;
        }

        /* Style for the input elements */
        input[type="hidden"] {
            display: none !important;
        }

        p {
            font-size: 18px !important;
            margin: 10px 0 !important;
        }

        /* Style for the submit button */
        .btn-success {
            background-color: #28a745 !important;
            color: white !important;
            border: none !important;
            padding: 10px 20px !important;
            border-radius: 5px !important;
            cursor: pointer !important;
        }

        .btn-success:hover {
            background-color: #218838 !important;
        }

        /* Style for the left column */
        .left-column {
            background-color: #fff !important;
            padding: 20px !important;
            border-radius: 5px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2) !important;
        }

        /* Style for the right column */
        .right-column {
            background-color: #fff !important;
            padding: 20px !important;
            border-radius: 5px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2) !important;
        }

        /* Style for the package list */
        .package-list {
            list-style: none !important;
            padding: 0 !important;
        }

        .package-item {
            margin-top: 20px !important;
        }

        /* Style for the plus icon */
        .plus-icon {
            color: rgb(2, 110, 2) !important;
            cursor: pointer !important;
        }
    </style>

    <div class="container mb-2">
        <div class="row">
            <div class="col-md-5">
                <div class="left-column">
                    <h2 style="color: #333; font-weight: bold;">Make your ad stand out!</h2>
                    <p>Get up to 10 times more responses by applying Ad Promotions.</p>
                    <p>Select one or more options (Optional).</p>
                    <hr class="my-4">
                    <ul class="package-list">
                        @foreach ($packages as $item)
                            <li class="package-item">
                                <h4 class="mt-4">{{ $item->package_name }}</h4>
                                <ul>
                                    @foreach ($item->getAdsTypes as $types)
                                        <li class="card" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>{{ $types->name }}</strong>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <span>Rs {{ $types->price }} <span
                                                            onclick="passValues('{{ $types->price }}','{{ $types->name }}','{{ $types->id }}')"
                                                            class="plus-icon"><i class="fa fa-plus-circle"
                                                                aria-hidden="true"></i></span></span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="right-column">
                    <div class="text-center">
                        <i class="fa fa-spinner fa-spin" style="color: green; font-size: 24px;"></i>
                        <p style="color: black;" class="text-center mt-1">Your ad is ready to be published!</p>
                        <p class="mt-2">Your free ad count is over; you can publish an ad with payment</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12 p-2 text-center">
                            <img src="{{ asset('temp_ad_images/' . $data['main_image']) }}"
                                style="max-width: 100%; height: auto; object-fit: cover; border-radius: 10px;">

                        </div>
                        <div class="col-md-8 col-12 p-2">
                            <p>{{ $data['request_data']['title'] }}</p>
                            <p>{{ $data['request_data']['ads_location'] }} {{ $data['request_data']['ads_sublocation'] }}
                            </p>
                            <h6>Rs. {{ $data['request_data']['price'] }}</h6>
                        </div>
                    </div>
                    <div id="append_form" class="m-1"></div>
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
                var insertedAdInput = document.querySelector('#paymentForm input[name="ad_type"]');
                var paymentSummary = document.querySelector('#paymentForm p:nth-of-type(1)');
                var totalBalance = document.querySelector('#paymentForm p:nth-of-type(2)');
                var totalInput = document.querySelector('#paymentForm input[name="total"]');

                insertedAdInput.value = id;
                paymentSummary.textContent = 'Ad Type : ' + name;
                totalBalance.textContent = 'Total Balance: Rs. ' + price + ' + Rs.200';
                totalInput.value = parseFloat(price) + 200;
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
                form.setAttribute('action', '{{ route('payed.ads.directpay') }}'); // Replace with your route
                form.setAttribute('method', 'POST');

                // Add CSRF token field (replace with your CSRF token)
                var csrfToken = document.createElement('input');
                csrfToken.setAttribute('type', 'hidden');
                csrfToken.setAttribute('name', '_token');
                csrfToken.setAttribute('value', '{{ csrf_token() }}');

                var insertedAdInput = document.createElement('input');
                insertedAdInput.setAttribute('type', 'hidden');
                insertedAdInput.setAttribute('name', 'ad_type');
                insertedAdInput.value = id;

                var priceInput = document.createElement('input');
                priceInput.setAttribute('type', 'hidden');
                priceInput.setAttribute('name', 'total');
                priceInput.value = parseFloat(price) + 200;

                var old_data_form = {!! json_encode($data) !!}; // old form data
                var form_data = document.createElement('input');
                form_data.setAttribute('type', 'hidden');
                form_data.setAttribute('name', 'form_data');
                form_data.value = JSON.stringify(old_data_form);


                var paymentSummary = document.createElement('p');
                paymentSummary.textContent = 'Ad Type: ' + name;

                var totalBalance = document.createElement('p');
                totalBalance.textContent = 'Total Balance: Rs.' + price + ' + Rs. 200';

                var button = document.createElement('button');
                button.setAttribute('type', 'submit');
                button.setAttribute('class', 'btn btn-success payment');
                button.textContent = 'Pay';

                // Append the input elements and div to the form
                form.appendChild(insertedAdInput);
                form.appendChild(paymentSummary);
                form.appendChild(totalBalance);
                form.appendChild(priceInput);
                form.appendChild(csrfToken);
                form.appendChild(form_data);

                var div = document.createElement('div');
                div.setAttribute('class', 'text-center mt-3');
                div.appendChild(button);

                form.appendChild(div);

                // Append the form to the element with id 'append_form'
                var appendForm = document.getElementById('append_form');
                appendForm.appendChild(form);
            }
        }
    </script>
@endsection
