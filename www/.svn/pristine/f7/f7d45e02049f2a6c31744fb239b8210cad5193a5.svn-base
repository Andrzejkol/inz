<?php
class Przelewy24
{
    const PLATNOSCI24_URL = 'https://secure.przelewy24.pl/index.php';
    const SELLER_ID = '';
    private $_allowTest = false;
    private $_transactionId = '';
    private $_cost = '';
    
    public function __construct($allowTest = false)
    {
        if (!empty($allowTest))
        {
            $this->_allowTest = $allowTest;
        }
    }

    public function GetForm()
    {
        $form = new View('platnosci24/_form');
		$form->action = 'https://secure.przelewy24.pl/index.php';

		$form->p24_session_id = $this->session->data['order_id'].'|'.md5(time());
		$form->p24_id_sprzedawcy = $this->config->get('przelewy24_merchant');
		$form->p24_email = $sa_order_info['email'];
		$form->p24_kwota = $this->currency->format
								 (
									$sa_order_info['total'],
									$sa_order_info['currency'],
									$sa_order_info['value'],
									FALSE
								 ) * 100;

		$form->p24_klient = $sa_order_info['payment_firstname'].' '.$sa_order_info['payment_lastname'];
		$form->p24_adres = $sa_order_info['shipping_address_1'];
		$form->p24_kod = $sa_order_info['shipping_postcode'];
		$form->p24_miasto = $sa_order_info['shipping_city'];
		$form->p24_kraj = $sa_order_info['payment_country'];
		$form->p24_language = $sa_order_info['payment_iso_code_2'];

        switch($this->config->get('przelewy24_mode'))
		{
			case 0:
			{
				$s_p24_opis=$this->session->data['order_id'];

			break;
			}

			case 1:
			{
				$s_p24_opis='TEST_OK';

			break;
			}

			case 2:
			{
				$s_p24_opis='TEST_ERR';

			break;
			}
		}

		$this->data['p24_opis']=$s_p24_opis;
		$this->data['p24_return_url_ok']=HTTPS_SERVER.'index.php?route=payment/przelewy24/returnOk';
		$this->data['p24_return_url_error']=HTTPS_SERVER.'index.php?route=payment/przelewy24/returnErr';

		if ($this->request->get['route']!= 'checkout/guest_step_3')
		{
			$this->data['ap_cancelurl']=HTTPS_SERVER.
										'index.php?route=checkout/payment';
		}
		else
		{
			$this->data['ap_cancelurl']=HTTPS_SERVER.
										'index.php?route=checkout/guest_step_2';
		}

		if($this->request->get['route']!='checkout/guest_step_3')
		{
			$this->data['back']=HTTPS_SERVER.
								'index.php?route=checkout/payment';
		}
		else
		{
			$this->data['back']=HTTPS_SERVER.
								'index.php?route=checkout/guest_step_2';
		}

		$this->id='payment';

		if(file_exists(DIR_TEMPLATE.
							$this->config->get('config_template').
								'/template/payment/przelewy24.tpl'))
		{
			$this->template=$this->config->get('config_template').
								'/template/payment/przelewy24.tpl';
		}
		else
		{
			$this->template='default/template/payment/przelewy24.tpl';
		}
        
        $form->render(true);
    }

    public function TransactionSuccess()
    {
if(isset($this->session->data['order_id']))
		{
			$i_order_id=$this->session->data['order_id'];
		}
		else
		{
			$i_order_id=array_slice
						(explode('|',$this->request->post['p24_session_id']),0,1);
		}

		$this->load->model('checkout/order');
		$sa_order_info=$this->model_checkout_order->getOrder
							($i_order_id);
		$WYNIK=$this->_p24Weryfikuj
			   (
			   	$this->config->get('przelewy24_merchant'),
				$this->request->post['p24_session_id'],
			   	$this->request->post['p24_order_id'],
			   	//kwota
			   	$this->currency->format
			   	(
				   	$sa_order_info['total'],
				   	$sa_order_info['currency'],
				   	$sa_order_info['value'],
				   	FALSE
			   	)*100
			   );

		if($WYNIK[0]=="TRUE")
		{
			$this->model_checkout_order->confirm
				($i_order_id,$this->config->get('config_order_status_id'));
			$this->redirect(HTTPS_SERVER .'index.php?route=checkout/success');
		}
		else
		{
			$this->session->data['error']=$data['p24_error_code'];
			if($this->request->get['route']!='checkout/guest_step_3')
			{
				$this->redirect(HTTPS_SERVER.'index.php?route=checkout/payment');
			}
			else
			{
				$this->redirect(HTTPS_SERVER.'index.php?route=checkout/guest_step_2');
			}
		}
    }

    public function TransactionError()
    {
        $this->language->load('payment/przelewy24');
		$this->data['title']=$this->language->get('heading_title');
		$this->data['base']=HTTP_SERVER;
		$this->data['heading_title']=$this->language->get('heading_title');
		$this->data['text_response']=$this->language->get('text_response');
		$this->data['text_failure']=$this->language->get('text_failure');

		if(file_exists(DIR_TEMPLATE.$this->config->get('config_template').
			'/template/payment/przelewy24_failure.tpl'))
		{
			$this->template=$this->config->get('config_template').
								'/template/payment/przelewy24_failure.tpl';
		}
		else
		{
			$this->template='default/template/payment/przelewy24_failure.tpl';
		}

		$this->children = array(
			'common/column_right',
			'common/footer',
			'common/column_left',
			'common/header'
		);
    }

    public function ConfirmPayment()
    {
        $P = array(); 
        $RET = array();
        $url = "https://secure.przelewy24.pl/transakcja.php";
        $P[] = "p24_id_sprzedawcy=".$p24_id_sprzedawcy;
        $P[] = "p24_session_id=".$p24_session_id;
        $P[] = "p24_order_id=".$p24_order_id;
        $P[] = "p24_kwota=".$p24_kwota;
        $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        if(count($P)) curl_setopt($ch, CURLOPT_POSTFIELDS,join("&",$P));
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $result=curl_exec ($ch);
            curl_close ($ch);
            $T = explode(chr(13).chr(10),$result);
            $res = false;
            foreach($T as $line){
                $line = ereg_replace("[\n\r]","",$line);
                if($line != "RESULT" and !$res)
                    continue;
                if($res)
                    $RET[] = $line;
                else
                    $res = true;
            }
            return $RET;
    }

    public function CreatePayment(array $details)
    {
        
    }

    public function Save()
    {
        
    }
}