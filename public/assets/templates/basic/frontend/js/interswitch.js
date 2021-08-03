  var submitForm = document.getElementById("wrapped");
  submitForm.addEventListener("submit", submitHandler);
  function submitHandler(event) {
  event.preventDefault();
    function randomReference() {
      var length = 10;
      var price = 200;
      var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var result = '';
      for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
      return result;
    }
  var merchantCode = 'MX34111';
  var payItemId = 'Default_Payable_MX34111';
  var transRef = randomReference();
 
  var test = document.getElementById("duration_cost").value;
  console.log(test)
  var mode = 'TEST';
  var redirectUrl = location.href;
  var paymentRequest = {
    merchant_code: merchantCode,
    pay_item_id: payItemId,
    txn_ref: transRef,
    amount: test,
    currency: 566,
    site_redirect_url: redirectUrl,
    onComplete: paymentCallback,
    mode:mode
  };
  window.webpayCheckout(paymentRequest);
  }

function paymentCallback(response) {
  console.log(response);
  if(response != null){
            alert(response.desc);
            var successResponce = response.desc;
            var tref = response.txnref;
            var successPass = 'Approved by Financial Institution';
            //alert(response.desc);
            //window.location.href = "http://example.com";

             if (successResponce = successPass) {

              paymentCode = document.getElementsByName('PaymentCode')[0].value,
              customerEmail = document.getElementsByName('emailAdress')[0].value,
              customerMobile = document.getElementsByName('phoneNumber')[0].value,
              TransactionAmt = document.getElementsByName('TransactionAmt')[0].value,
              
             
     myJsonString = [paymentCode,customerEmail,customerMobile,TransactionAmt,successResponce,tref];
    myJsonString1 = JSON.stringify(myJsonString);
    var xmlhttp = new XMLHttpRequest(response);
        xmlhttp.onreadystatechange = respond;
        xmlhttp.open("POST", "../hashindex/ajax-test.php", true);
        xmlhttp.send(myJsonString1);
    function respond() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('result').innerHTML = xmlhttp.responseText;
        }
    }
 $("#hide").hide("fast",function(){

                      })
  } }
}
