<x-app-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{route('processPayment')}}">
            @csrf

            <!-- Project Name -->
            <div>
                <p class="font-semibold text-xl">{{$project->name}}</p>
            </div>
            <!-- Amount -->
            <div class="mt-4">
                <x-input-label for="amount" :value="__('Hoeveel')" />

                <x-text-input min="0" id="amount" class="block mt-1 w-full"
                              type="number"
                              name="amount"/>
            </div>

            <!-- Project Message -->
{{--            <div class="mt-4">--}}
{{--                <x-input-label for="project_description" :value="__(' Omschrijving')" />--}}

{{--                <x-text-input id="project_description" class="block mt-1 w-full"--}}
{{--                              type="text"--}}
{{--                              name="project_description"/>--}}
{{--            </div>--}}

            <input type="hidden" value="{{$project->id}}"  name="project_id" >
            <div class="form-row">
                <x-input-label for="amount" :value="__('Debit or credit cart')" />
                <div id="card-element" class="form-control">   </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="stripe-errors"></div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    {{ __('Klaar') }}
                </x-primary-button>
            </div>

            <p class="text-red-600">
                @if($errors->any())
                    {{ implode('', $errors->all(':message')) }}
                @endif
            </p>

        </form>
    </x-auth-card>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {hidePostalCode: true, style: style});
        card.mount('#card-element');
        console.log(document.getElementById('card-element'));
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;    cardButton.addEventListener('click', async (e) => {
            console.log("attempting");
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );        if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            }
            else {
                paymentMethodHandler(setupIntent.payment_method);
            }
        });
        function paymentMethodHandler(payment_method) {
            var form = document.getElementById('subscribe-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', payment_method);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
</x-app-layout>
