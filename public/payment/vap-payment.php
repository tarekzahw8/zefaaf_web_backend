<!DOCTYPE html>
<html>
<head>
    <title>Zefaaf Payment</title>
    <link rel="icon" href="https://www.vapulus.com/favicon.ico" type="image/x-icon"/>
    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://api.vapulus.com:1338/app/session/script?appId=80c799cf-95f4-4a27-a442-9e65d7a36e09"></script>
    <style id="antiClickjack">
        body {
            display: none !important;
        }
    </style>
</head>
<body>
    <section class="text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Zefaaf Payment</h1>
        </div>
    </section>
    <div class="container" id="myPage">
        <div class="row">
            <div class="contents col-12">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="cardNumber">Card number:</label>
                        <div class="col-md-8">
                            <input type="text" id="cardNumber" class="form-control input-md" value="" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="cardMonth">Expiry month:</label>
                        <div class="col-md-8">
                            <input type="text" id="cardMonth" class="form-control input-md" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="cardYear">Expiry year:</label>
                        <div class="col-md-8">
                            <input type="text" id="cardYear" class="form-control input-md" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label" for="cardCVC">Security code:</label>
                        <div class="col-md-8">
                            <input type="text" id="cardCVC" class="form-control input-md" value="" readonly />
                        </div>
                    </div>
                </fieldset>
                <button class="btn btn-primary pull-right" id="payButton" onclick="pay();">Pay</button>
            </div>
        </div>
        <script type="text/javascript">
            if(window.PaymentSession){
                PaymentSession.configure({
                    fields: {
                        // ATTACH HOSTED FIELDS IDS TO YOUR PAYMENT PAGE FOR A CREDIT CARD
                        card: {
                            cardNumber: "cardNumber",
                            securityCode: "cardCVC",
                            expiryMonth: "cardMonth",
                            expiryYear: "cardYear"
                        }
                    },
                    callbacks: {
                        initialized: function (err, response) {
                            console.log("init....");
                            console.log(err, response);
                            console.log("/init.....");
                            // HANDLE INITIALIZATION RESPONSE
                        },
                        formSessionUpdate: function (err,response) {
                            console.log("update callback.....");
                            console.log(err,response);
                            console.log("/update callback....");
                            if (response.statusCode) {
                                if (200 == response.statusCode) {
                                    console.log("Session updated with data: " + response.data.sessionId);
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "https://api.zefaaf.net/v1/mobile/vapPay", true);
                                    xhr.setRequestHeader('Content-Type', 'application/json');
                                    xhr.send(JSON.stringify({
                                        'sessionId': response.data.sessionId
                                    }));
                                    xhr.onload = function() {
                                    console.log("HELLO")
                                    console.log(this.responseText);
                                    var result = JSON.parse(this.responseText);
                                    console.log(result['action']);
                                    if(result['action']=='pending'){
                                        console.log(result);
                                        location.replace(result['paymentUrl']);
                                    }
                                    else(result['action']=='accepted')
                                       // console.log(result);
                                       console.log('CAPTURED');
                                       location.replace('https://api.zefaaf.net/thankyou.html');
                                    }

                                } else if (201 == response.statusCode) {
                                    console.log("Session update failed with field errors.");

                                    if (response.message) {
                                        var field = response.message.indexOf('valid')
                                        field = response.message.slice(field + 5, response.message.length);
                                        console.log(field + " is invalid or missing.");
                                    }
                                } else {
                                    console.log("Session update failed: " + response);
                                }
                            }
                        }
                    }
                });
            }else{
                alert('Fail to get app/session/script !\n\nPlease check if your appId added in session script tag in head section?')
            }
            function pay() {
                PaymentSession.updateSessionFromForm();
            }
        </script>
</body>
</html>