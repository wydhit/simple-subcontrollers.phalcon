<?php

namespace MyApp\Controllers\Test;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Phalcon\Http\Client\Provider\Exception;

class PaypalController extends ControllerBase
{

    public function indexAction()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_ID'),     // ClientID
                env('PAYPAL_SECRET')      // ClientSecret
            )
        );

        // After Step 2
        $creditCard = new \PayPal\Api\CreditCard();
        $creditCard->setType("visa")
            ->setNumber("4417119669820331")
            ->setExpireMonth("11")
            ->setExpireYear("2019")
            ->setCvv2("012")
            ->setFirstName("Joe")
            ->setLastName("Shopper");

        // Step 2.1 : Between Step 2 and Step 3
        $log_path = BASE_PATH . '/storage/log/' . date("Ymd") . '/PayPal.log';
        $apiContext->setConfig(
            [
                'log.LogEnabled' => true,
                'log.FileName' => $log_path,
                'log.LogLevel' => 'DEBUG'
            ]
        );

        // After Step 3
        try {
            $creditCard->create($apiContext);
            echo $creditCard;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    public function createPaymentAction()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_ID'),     // ClientID
                env('PAYPAL_SECRET')      // ClientSecret
            )
        );

        // Step 2.1 : Between Step 2 and Step 3
        $log_path = BASE_PATH . '/storage/log/' . date("Ymd") . '/PayPal.log';
        $apiContext->setConfig(
            [
                'log.LogEnabled' => true,
                'log.FileName' => $log_path,
                'log.LogLevel' => 'DEBUG'
            ]
        );

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName('商品名称')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123")
            ->setPrice(1);
        $itemList = new ItemList();
        $itemList->setItems([$item1]);

        $detail = new Details();
        $detail->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(1);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($detail);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("描述")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://baidu.com")
            ->setCancelUrl("http://baidu.com/1");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        $request = clone $payment;
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }
        $approvalUrl = $payment->getApprovalLink();
        ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

        return $payment;

    }

}

