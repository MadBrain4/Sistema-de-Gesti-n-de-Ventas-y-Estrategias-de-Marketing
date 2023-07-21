<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Throwable;

class PaymantController extends Controller
{
    private $gateaway;

    public function __construct()
    {
        $this->gateaway = Omnipay::create('PayPal_Rest');
        $this->gateaway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateaway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateaway->setTestMode(true);
    }

    public function pay(Request $request){
        $pago = 0;

        for( $i = 0; $i < count(session('carrito')); $i++){
            $cantidad = ( session('carrito')[$i]['cantidad'] != null ) ? session('carrito')[$i]['cantidad'] : 1;
            $pago += session('carrito')[$i]['precio'] * $cantidad;
        }

        try {
            $response = $this->gateaway->purchase(array(
                'amount' => $pago,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if( $response->isRedirect() ){
                $response->redirect();
            }
            else{
                return $this->getMessage();
            }
        } catch(Throwable $th){
            return $th->getMessage();
        }
    }

    public function success(Request $request){
        if( $request->input('paymentId') && $request->input('PayerID') ){
            try {
                $transaction = $this->gateaway->completePurchase(array(
                    'payer_id' => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId')
                ));

                $response = $transaction->send();

                if( $response->isSuccessful() ){
                    $arr = $response->getData();

                    $payment = new Payment();
                    $payment->payment_id = $arr['id'];
                    $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr['payer']['payer_info']['email'];
                    $payment->amount = $arr['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr['state'];

                    $payment->save();

                    session()->forget('carrito');
                    $pago_exitoso = true;
                    return view('inicio', compact('pago_exitoso') );
                }
                else{
                    $pago_fallido = true;
                    return view('inicio', compact('pago_fallido') );
                }
            }
            catch(Throwable $th){
                $pago_fallido = true;
                return redirect()->back();
            }
        }
        else{
            $pago_fallido = true;
            return redirect()->back();
        }
    }

    public function error()
    {
        $pago_cancelado = true;
        return view('inicio', compact('pago_cancelado') ); 
    }
}
