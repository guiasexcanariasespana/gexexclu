<x-registro-layout>

    <!-- Container for demo purpose -->
    <div class="container my-24 px-6 mx-auto">

        <!-- Section: Design Block -->
        <section class="mb-32 text-gray-800">

            <!-- Jumbotron -->
            <div class="container mx-auto xl:px-32 text-center lg:text-left">
                <div class="grid lg:grid-cols-2 flex items-center">
                    <div class="mb-12 lg:mb-0">
                        <div class="block rounded-lg shadow-lg px-6 py-12 md:px-12 lg:-mr-14"
                            style="background: hsla(0, 0%, 100%, 0.55); backdrop-filter: blur(30px)">

                            <h2 class="text-4xl font-extrabold mb-6 pb-2 text-purple-900">{{ $plan->nombre }}</h2>
                            <div class="card-actions justify-start">
                                <h3 class="text-lg">
                                    Nombre
                                    <span class="badge badge-md ">{{ $anuncio->nombre }}</span>
                                </h3>
                                {{-- <h3 class="text-lg">
            Título
           <span class="badge badge-md ">{{ $anuncio->titulo}}</span>
            </h3> --}}
                                <h3 class="text-lg">
                                    Categoría
                                    <span
                                        class="badge badge-md badge-secondary  ">{{ $anuncio->categoria->nombre }}</span>
                                </h3>
                            </div>

                            <div class="stats shadow mt-5 mb-5">

                                <div class="stat place-items-center bg-purple-700">
                                    <div class="stat-title text-white font-bold">Precio</div>
                                    <div class="stat-value text-white font-extrabold">€ {{ number_format($precio, 2, '.', ' ') }}</div>

                                </div>

                                <div class="stat place-items-center bg-purple-200">
                                    <div class="stat-title text-pink-700">Días</div>
                                    <div class="stat-value text-secondary">{{ $plan->dias }}</div>

                                </div>

                                <div class="stat place-items-center bg-purple-100">
                                    <div class="stat-title">Clase de anuncio</div>
                                    <div class="stat-value"> {{ $plan->clase->nombre }}</div>

                                </div>

                            </div>
                            <div class="card-actions justify-start mb-5">
                                <h3 class="text-lg">

                                    <span class="badge badge-md bg-purple-600">{{ $anuncio->provincia->nombre }}</span>
                                </h3>
                                <h3 class="text-lg">

                                    <span class="badge badge-md">{{ $anuncio->municipio->nombre }}</span>
                                </h3>
                                <h3 class="text-lg">

                                    <span class="badge badge-md "> {{ $anuncio->localidad }}</span>
                                </h3>
                            </div>
                            @if (is_null($precio) or $precio <= 0)
                                <a class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                                    href="{{ route('registrar_cambio_plan_gratis', [ $anuncio, $plan]) }}">
                                    {{ __('Continuar, Tu anuncio no tiene costo') }}
                                </a>
                                <div class=" text-center mt-10">
                                    <a href="{{ URL::previous() }}"
                                    class="underline text-sm  hover:text-pink-700  ">Volver atrás</a>
                                    
                                    </div>
                            @else
                                <script
                                    src="https://www.paypal.com/sdk/js?client-id={{ config('app.paypal_client_id') }}&currency={{ config('app.paypal_currency') }}">
                                </script>
                                <!-- Set up a container element for the button -->
                                <div id="paypal-button-container"></div>
                                <script>
                                    paypal.Buttons({
                                        // Order is created on the server and the order id is returned
                                        createOrder: (data, actions) => {
                                            return actions.order.create({
                                                application_context: {
                                                    shipping_preference: "NO_SHIPPING"
                                                },
                                                payer: {
                                                    email_address: '{{ $anuncio->user->email }}',
                                                    name: {
                                                        given_name: '',
                                                        surname: ''
                                                    },
                                                    address: {
                                                        country_code: "ES"
                                                    }
                                                },
                                                purchase_units: [{
                                                    amount: {
                                                        value: '{{ number_format($precio, 2, ".", " ") }}'
                                                    }
                                                }],
                                            });
                                        },
                                        // Call your server to finalize the transaction
                                        onApprove: function(data, actions) {
                                            return fetch('{{config('app.url')}}/paypal/process_cambio/' + data.orderID +
                                                    '?anuncio_id={{ $anuncio->id }}&plan_id={{ $plan->id }}&precio={{ number_format($precio, 2, ".", " ") }}')
                                                .then(res => res.json())
                                                .then(function(response) {
                                                    // Three cases to handle:
                                                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                                                    //   (2) Other non-recoverable errors -> Show a failure message
                                                    //   (3) Successful transaction -> Show confirmation or thank you

                                                    // This example reads a v2/checkout/orders capture response, propagated from the server
                                                    // You could use a different API or structure for your 'orderData'
                                                    // var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                                                    // if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                                                    //     return actions.restart(); // Recoverable state, per:
                                                    //     // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                                                    // }

                                                    // if (errorDetail) {
                                                    //     var msg = 'Sorry, your transaction could not be processed.';
                                                    //     if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                                                    //     if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                                                    //     return alert(
                                                    //         msg
                                                    //         ); // Show a failure message (try to avoid alerts in production environments)
                                                    // }
                                                    if (!response.success) {
                                                        const failureMessage = 'Disculpa, no hemos podido procesar tu pago.';
                                                        alert(failureMessage);
                                                        return;
                                                    }

                                                    // // Successful capture! For demo purposes:
                                                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                                                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                                                    document.getElementById('paypal-button-container').classList.add('hidden');
                                                    location.href = response.url;

                                                    // Replace the above to show a success message within this page, e.g.
                                                    // const element = document.getElementById('paypal-button-container');
                                                    // element.innerHTML = '';
                                                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                                    // Or go to another URL:  actions.redirect('thank_you.html');
                                                });
                                            // return fetch('/paypal/process/' + data.orderID + '?solution_id=' +
                                            //         {{ '1' }})
                                            //     .then(res => res.json())
                                            //     .then(function(response) {

                                            //         // Show a failure message
                                            //         if (!response.success) {
                                            //             const failureMessage =
                                            //                 'Sorry, your transaction could not be processed.';
                                            //             alert(failureMessage);
                                            //             return;
                                            //         }

                                            //         processSuccessfulPayment(response);
                                            //     });
                                        },
                                        onError: function(err) {
                                            // For example, redirect to a specific error page
                                            window.location.href = "{{config('app.url')}}/your-error-page-here";
                                        }

                                    }).render('#paypal-button-container');
                                </script>
                                {{-- <button class="btn btn-primary">{!! App\Http\Controllers\RedsysController::index($anuncio->precio,true,'Compra de Anuncios',$anuncio->id)!!}</button>
                       <button class="btn btn-primary">{!! App\Http\Controllers\RedsysController::index_bizum($anuncio->precio,true,'Compra de Anuncios',$anuncio->id)!!}</button> --}}
                            @endif
                            @php
                                $option = 'cambio_plan';
                            @endphp    
                            @include('anuncios.partial.pagar_tpv')
                        </div>
                    </div>

                    <div>
                        <img src="{{config('app.url')}}/img/card-pagar.jpeg" class="w-full rounded-lg shadow-lg" alt="" />
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->

        </section>
        <!-- Section: Design Block -->

    </div>
    <!-- Container for demo purpose -->
   
</x-registro-layout>
