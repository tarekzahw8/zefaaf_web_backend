
<div id="root"></div>

@push('script')
<script>

    goSell.config({
    containerID:"root",
    gateway:{
        publicKey:"pk_test_CiX4sZg3Jf5MBnuN2oaeSjUH",
        merchantId: null,
        language:"ar",
        contactInfo:true,
        supportedCurrencies:"all",
        supportedPaymentMethods: "all",
        saveCardOption:false,
        customerCards: true,
        notifications:"standard",
        callback:(response) => {
         console.log(response.callback.status);
        },
        onClose: () => {
            console.log("closeFailed");
        },
        onLoad:() => {
            console.log("onLoad");
             goSell.openLightBox();
            },
        backgroundImg: {
        url: "imgURL",
        opacity: "0.5"
        },
        labels:{
            cardNumber:"Card Number",
            expirationDate:"MM/YY",
            cvv:"CVV",
            cardHolder:"Name on Card",
            actionButton:"Pay"
        },
        style: {
            base: {
            color: "#535353",
            lineHeight: "18px",
            fontFamily: "sans-serif",
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "rgba(0, 0, 0, 0.26)",
                fontSize:"15px"
            }
            },
            invalid: {
            color: "red",
            iconColor: "#fa755a "
            }
        }
    },
    customer:{
        id:null,
        first_name: "First Name",
        middle_name: "Middle Name",
        last_name: "Last Name",
        email: "demo@email.com",
        phone: {
            country_code: "965",
            number: "99999999"
        }
    },
    order:{
        amount: '{{ $item["usdValue"] }}',
        currency:"USD",
        items:[{
        id:1,
        name:"'.$title.'",
        quantity: "1",
        amount_per_unit:"{{ $item['usdValue'] }}",
        
        total_amount: "{{ $item['usdValue'] }}"
        }],
        shipping:null,
        taxes: null
    },
    transaction:{
    mode: "charge",
    charge:{
        saveCard: false,
        threeDSecure: true,
        description: "{{ $item['title'] }}",
        reference:{
            transaction: "txn_0001",
            order: "ord_0001"
        },
        metadata:{
            "paymentToken":"{{ Session::get('token') }}"
        },
        receipt:{
            email: false,
            sms: true
        },
        redirect: "{{ url('thankyou') }}",
        post: "https://zefaaf.net/api/v1/mobile/confirmPayment",
        }
    }
    });

    </script>
@endpush
