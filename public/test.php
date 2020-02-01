<form method="post" action="https://api-3t.paypal.com/nvp">
    API Username: <input type="text" name="USER" value="norbert_api1.innobotics.eu">  <br>
    API Password: <input type="text" name="PWD" value="VR5NP8UKGY4AB76C">  <br>
    API Signature: <input type="text" name="SIGNATURE" value="AkcuK0s9bpo9BQaWJeI47y51PNUyAXPwOmc46UYOVj2SQm7vHYs.vh69">  <br>
    Version: <input type="text" name="VERSION" value="204"> <br>
    Paymentaction: <input type="text" name="PAYMENTREQUEST_0_PAYMENTACTION" value="sale"> <br>
    Amount: <input type="text" name="PAYMENTREQUEST_0_AMT" value="7.50"> <br>
    Item Amount: <input type="text" name="PAYMENTREQUEST_0_ITEMAMT" value="7.50"> <br>
    Currency: <input type="text" name="PAYMENTREQUEST_0_CURRENCYCODE" value="USD"> <br>
    ReturnURL: <input type="text" name="returnUrl" value="http://omnipay.dev2.innobotics.hu/omnipay/return"> <br>
    CancelURL: <input type="text" name="cancelUrl" value="http://omnipay.dev2.innobotics.hu/omnipay/cancel"> <br>
    SolutionType: <input type="text" name="solutiontype" value="Sole"> <br>
    <br>
    <input type="submit" name="METHOD" value="SetExpressCheckout"> <br>
</form>
