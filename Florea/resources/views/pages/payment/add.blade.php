@extends('layout.app')

@section('title')
    Spécifier un moyen de paiement
@endsection

@section('content')
    <div class="container">
        <input type="text" class="form-control" name="card-holder" id="card-holder-name" placeholder="Titulaire de la carte" value={{Auth::user()->name}}>
        <div class="my-3">
            <div id="card-element"></div>
        </div>
        <button id="card-button" class="btn btn-success">Valider le paiement</button>
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe('pk_test_51JXPrlJeXSN44sNG3TBBScBWUcPmsDX47sKyNqRCuCJXvO8uF8I0YsQYfWnWq8aHlfHjC6R8wwMXvWh2EFrnR1td008mP92Mnx');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');

            cardButton.addEventListener('click', async (e) => {
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                } else {
                    axios.post(route('payment.store_card', {paymentMethod}))
                    .then((data) => {
                        window.location.href = route('payment.success');
                    })
                    .catch((error) => {
                        alert(error.response.data.message);
                    })
                }
            });
        </script>
    </div>
@endsection