<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->controller = 'home';
        $this->load->theme('frontend');
        $this->load->model('pg/Payment_model', 'Payment');
        $this->load->model('common_methods', 'Common');
    }
    public function pgReturn()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $this->load->view('pg/cm_response');
    }
    public function pay()
    {
        if($this->input->server('REQUEST_METHOD')==='POST')
        {
            //echo '<pre>';print_r($this->input->post());exit;
            $data=$this->input->post();
            //$data[$this->security->get_csrf_token_name()]=$this->security->get_csrf_hash();
            //echo '<pre>';print_r(json_encode($data));exit;
            unset($data['submit']);
            $json_data=json_encode($data);
            $checksum = hash_hmac('sha256',$json_data,'pxK7m51pHlOp', false);
            $checksum = strtoupper($checksum);
            $data=json_decode($json_data);
            //array_push($data, $checksum);
            $data->checksum=$checksum;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://ppstaging.paymentpoint.in/payment/pgAggregator");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //$data=array("email"=>"sankar@kuhipaat.in", $this->security->get_csrf_token_name()=>$this->security->get_csrf_hash());
            //$data= json_encode($data);
            
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // in real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 
            //          http_build_query(array('postvar1' => 'value1')));

            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec ($ch);
            echo '<pre>';print_r($server_output);
            curl_close ($ch);
        }
        $this->load->view('pg/pay');
    }
    
    public function refund()
    {
        if($this->input->server('REQUEST_METHOD')==='POST')
        {
            //echo '<pre>';print_r($this->input->post());exit;
            $data=$this->input->post();
            unset($data['submit']);
            $json_data=json_encode($data);
            $checksum = hash_hmac('sha256',$json_data,'pxK7m51pHlOp', false);
            $checksum = strtoupper($checksum);
            $data=json_decode($json_data);
            //array_push($data, $checksum);
            $data->checksum=$checksum;
            //echo '<pre>';print_r(json_encode($data));exit;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://ppstaging.paymentpoint.in/payment/pgRefundQuery");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            //$data=array("email"=>"sankar@kuhipaat.in", $this->security->get_csrf_token_name()=>$this->security->get_csrf_hash());
            //$data= json_encode($data);
            
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // in real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 
            //          http_build_query(array('postvar1' => 'value1')));

            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec ($ch);
            echo '<pre>';print_r($server_output);
            curl_close ($ch);
        }
        $this->load->view('pg/refund');
    }
    /////////////////PG for Aggregator//////////////
    public function pgAggregator()
    {
//        $this->load->library('user_agent');
//        $this->agent->referrer();
        $_POST=file_get_contents("php://input");
        //echo '<pre>';print($_POST);exit;
        log_message("debug", "got transaction request from child merchant: ".$_POST);
        $data= json_decode($_POST);
        $cs_data=json_decode($_POST);
        unset($cs_data->checksum);
        $checksum = hash_hmac('sha256', json_encode($cs_data),'pxK7m51pHlOp', false);
        $checksum = strtoupper($checksum);
        //echo json_encode(array('chksum'=>$checksum, 'cm-chksum'=>$data->checksum));exit;
        $bd_merchant_id=$data->merchantId;
        $pp_customer_id=$data->customerId;
        $cm_order_id=$data->orderId;
        $merchant_ru=$data->ru;
        if($checksum==$data->checksum)
        {
            /////chcking is merchant id sent by child merchant///////////
            if($bd_merchant_id && $bd_merchant_id!="")
            {
                ////////checking is merchant id valid or not///////
                $is_merchant_exist=$this->Common->isExistRecord('child_merchant', array('bd_merchant_id'=>$bd_merchant_id, 'cm_status'=>1));
                if($is_merchant_exist)
                {
                    /////chcking is customer id sent by child merchant///////////
                    if($pp_customer_id && $pp_customer_id!="")
                    {
                        ////////checking is customer id valid or not///////
                        $is_customer_exist=$this->Common->isExistRecord('child_merchant', array('bd_merchant_id'=>$bd_merchant_id, 'pp_customer_id'=>$pp_customer_id, 'cm_status'=>1));
                        if($is_customer_exist)
                        {
                            /////chcking is order id sent by child merchant///////////
                            if($cm_order_id && $cm_order_id!="")
                            {
                                ////////checking is order id already  ready exist or not///////
                                $is_order_exist=$this->Common->isExistRecord('child_merchant_transactions', array('cm_order_id'=>$cm_order_id));
                                if($is_order_exist)
                                {
                                    $message=array('error'=>1, 'msg'=>'Order Id already exist');
                                    echo json_encode($message);
                                }
                                else
                                {
                                    if($merchant_ru && $merchant_ru!="")
                                    {
                                        ////////checking is customer id valid or not///////
                                        $is_merchant_ru_exist=$this->Common->isExistRecord('child_merchant', array('return_url'=>$merchant_ru, 'cm_status'=>1));
                                        if($is_merchant_ru_exist)
                                        {
                                            /////get child merchant details by unique merchant id/////////
                                            $child_merchant=$this->Common->getSingle('child_merchant', "id", array('pp_customer_id'=>$pp_customer_id));
                                            //$child_merchant_txn=$this->Common->getSingle('child_merchant_transactions', "id", array('pp_customer_id'=>$pp_customer_id));
                                            $payee_firstname=$data->payeeFirstname;
                                            $payee_lastname=$data->payeeLastname;
                                            $payee_email=$data->payeeEmail;
                                            $payee_mobile=$data->payeeMobile;
                                            $txn_amount=$data->txnAmount;
                                            $ru='http://ppstaging.paymentpoint.in/payment/aggregator';

                                            $txnData=array(
                                                'bd_merchant_id'=>$bd_merchant_id,
                                                'cm_id'=>$child_merchant['id'],
                                                'cm_order_id'=>$cm_order_id,
                                                'payee_firstname'=>$payee_firstname,
                                                'payee_lastname'=>$payee_lastname,
                                                'payee_email'=>$payee_email,
                                                'payee_mobile'=>$payee_mobile,
                                                'txn_amount'=>$txn_amount,
                                                'currency_type'=>'INR',
                                                'item_code'=>'Direct',
                                                //'bd_checksum'=>$checksum,
                                                'txn_payment_date'=>date('Y-m-d H:i:s')
                                            );
                                            $last_id=$this->Common->getandinsertRecord('child_merchant_transactions', $txnData);
                                            $this->load->helper('auth');
                                            $pp_cm_order_id=get_unique_session_id('ord', $last_id);//////generate unique pp order id/////

                                            $msg=$bd_merchant_id."|".$pp_cm_order_id."|NA|".$txn_amount."|IDB|NA|NA|INR|DIRECT|R|PAYMENTPO-NA|NA|NA|F|".$cm_order_id."|".$payee_email."|".$payee_mobile."|NA|NA|NA|NA|".$ru; 
                                            //$str = 'TESTME|UATTXN0001|NA|2|NA|NA|NA|INR|NA|R|NA|NA|NA|F|Andheri|Mumbai|02240920005|support@billdesk.com|NA|NA|NA|https://www.billdesk.com';
                                            $checksum = hash_hmac('sha256',$msg,'mxK7m51pHlOe', false);
                                            $checksum = strtoupper($checksum);

                                            ////////update pp unique order id and checksum in transaction table////////
                                            $this->Common->updateRecords('child_merchant_transactions', array('id'=>$last_id), array('pp_cm_order_id'=>$pp_cm_order_id));
                                            ///////////////////////////////////////////////////////

                                            $pg['msg']=$bd_merchant_id."|".$pp_cm_order_id."|NA|".$txn_amount."|IDB|NA|NA|INR|DIRECT|R|PAYMENTPO-NA|NA|NA|F|".$cm_order_id."|".$payee_email."|".$payee_mobile."|NA|NA|NA|NA|".$ru."|".$checksum;
                                            $this->load->view('pg/pg_payment', $pg);
                                        }
                                        else
                                        {
                                            $message=array('error'=>1, 'msg'=>'Return url is not valid');
                                            echo json_encode($message);
                                            exit;
                                        }
                                    }
                                    else
                                    {
                                        $message=array('error'=>1, 'msg'=>'Return url required');
                                        echo json_encode($message);
                                        exit;
                                    }
                                }
                            }
                            else
                            {
                                $message=array('error'=>1, 'msg'=>'Order Id required');
                                echo json_encode($message);
                                exit;
                            }
                        }
                        else
                        {
                            $message=array('error'=>1, 'msg'=>'Customer Id is not valid');
                            echo json_encode($message);
                            exit;
                        }
                    }
                    else
                    {
                        $message=array('error'=>1, 'msg'=>'Customer Id required');
                        echo json_encode($message);
                        exit;
                    }
                }
                else
                {
                    $message=array('error'=>1, 'msg'=>'Merchant Id is not valid');
                    echo json_encode($message);
                    exit;
                }
            }
            else
            {
                $message=array('error'=>1, 'msg'=>'Merchant Id required');
                echo json_encode($message);
                exit;
            }
        }
        else
        {
            $message=array('error'=>1, 'msg'=>'Sorry! Checksum value not matched');
            echo json_encode($message);
            exit;
        }
    }
    public function paymentProcessing()
    {
        $this->load->helper('security');
        $data['bd_url']='https://pgi.billdesk.com/pgidsk/PGIMerchantPayment';
        $data['msg']=$this->input->post('msg', true);
        log_message("debug", "send transaction request to child merchant: ".$data['msg']);
        $this->load->view('pg/pg_payment_process', $data);
    }
    public function aggregator()
    {
        //echo '<pre>';print_r($_POST);exit;
        $response=array();

        $msg=$this->input->post('msg');
        log_message("debug", "got transaction response from billdesk: ".$msg);
        //$msg="PP5TST|ord104107|LCIT6128725125|658274-zzzzzz|0.01|CIT|411111|03|INR|DIRECT|NA|PAYMENTPO-NA-0.00|00000000.00|13-03-2018 11:19:53|0399|NA|uoo2354548|sankar@kuhipaat.in|9804745792|NA|NA|NA|NA|NA|Payment not authorized|4EBF30F9818978AF06498ACBCD4AAC238F523C96AD8F72A2C33D02F0266C3DE6";

        $msg_res=explode('|', $msg);
        $res_checksum=trim(array_pop($msg_res));
        $new_msg= implode('|', $msg_res);
        $checksum = hash_hmac('sha256',$new_msg,'mxK7m51pHlOe', false);
        $checksum = strtoupper($checksum);
        /////get child merchant details by unique merchant id/////////
        $child_merchant=$this->Common->getSingle('child_merchant', "pp_customer_id, return_url", array('bd_merchant_id'=>$msg_res[0]));
        $response['r_url']=$child_merchant['return_url'];
        if($res_checksum==$checksum)
        {
            if(isset($msg_res[1]) && $msg_res[1]!="" && $msg_res[1]!="NA")
            {
                /////get child merchant order id/////////
                $child_merchant_txn=$this->Common->getSingle('child_merchant_transactions', "cm_order_id", array('bd_merchant_id'=>$msg_res[0], 'pp_cm_order_id'=>$msg_res[1]));
                ////////update transaction table////////
                $where=array('bd_merchant_id'=>$msg_res[0], 'pp_cm_order_id'=>$msg_res[1]);
                $data=array('bd_txn_reference_no'=>$msg_res[2], 'bd_status_id'=>$msg_res[14], 'bd_error_desc'=>$msg_res[24], 'bd_txn_amount'=>$msg_res[4], 'bd_txn_date'=>date('Y-m-d H:i:s', strtotime($msg_res[13])), 'txn_modified_date'=>date('Y-m-d H:i:s'));
                $data['txn_status']='p';
                $res_status='pending';
                if($msg_res[14]=='0300')
                {
                    $data['txn_status']='s';
                    $res_status='success';
                }
                elseif($msg_res[14]=='0002')
                {
                    $data['txn_status']='p';
                    $res_status='pending';
                }
                else
                {
                    $data['txn_status']='f';
                    $res_status='failure';
                }
                $this->Common->updateRecords('child_merchant_transactions', $where, $data);
                ///////////////////////////////////////////////////////
                $resp=array('merchantId'=>$msg_res[0], 'orderId'=>$child_merchant_txn['cm_order_id'], 'customerId'=>$child_merchant['pp_customer_id'], 'payeeEmail'=>$msg_res[17], 'payeeMobile'=>$msg_res[18], 'txnReference'=>$msg_res[2], 'paymentStatus'=>$res_status);

                $response['msg']= json_encode($resp);
                $this->load->view('pg/pg_response', $response);
            }
            else
            {
                $response['msg']=json_encode(array('error'=>1, 'msg'=>$msg_res[24]));
                $this->load->view('pg/pg_response', $response);
            }
        }
        else
        {
            $response['msg']=json_encode(array('error'=>1, 'msg'=>'Sorry! Something went wrong'));
            $this->load->view('pg/pg_response', $response);
        }
    }
    //////////check transaction details from billdesk/////
    public function bdQuery()
    {        
        $pendingTxn=$this->Payment->getAllPendingTxn();
        //echo '<pre>';print_r($pendingTxn);exit;
        if(!empty($pendingTxn))
        {
            foreach($pendingTxn as $row)
            {
                $curdate=date('YmdHis');
                $str="0122|".$row['bd_merchant_id']."|".$row['pp_cm_order_id']."|".$curdate;
                $checksum = hash_hmac('sha256',$str,'mxK7m51pHlOe', false);
                $checksum = strtoupper($checksum);
                $msg=$str.'|'.$checksum;
                log_message("debug", "send transaction request to billdesk for update query: ".$msg);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.billdesk.com/pgidsk/PGIQueryController");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('msg' => $msg)));
                // receive server response ...
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec ($ch);
                //echo '<pre>';print_r($server_output);
                curl_close ($ch);
                log_message("debug", "got transaction response from billdesk for update query: ".$server_output);
                //$msg="PP5TST|ord104107|LCIT6128725125|658274-zzzzzz|0.01|CIT|411111|03|INR|DIRECT|NA|PAYMENTPO-NA-0.00|00000000.00|13-03-2018 11:19:53|0399|NA|uoo2354548|sankar@kuhipaat.in|9804745792|NA|NA|NA|NA|NA|Payment not authorized|4EBF30F9818978AF06498ACBCD4AAC238F523C96AD8F72A2C33D02F0266C3DE6";

                $msg_res=explode('|', $server_output);
                $res_checksum=trim(array_pop($msg_res));
                $new_msg= implode('|', $msg_res);
                $checksum = hash_hmac('sha256',$new_msg,'mxK7m51pHlOe', false);
                $checksum = strtoupper($checksum);
                /////get child merchant details by unique merchant id/////////
                //$child_merchant=$this->Common->getSingle('child_merchant', "pp_customer_id, return_url", array('bd_merchant_id'=>$msg_res[0]));
                if($res_checksum==$checksum)
                {
                    $bd_txn_date="";
                    if($msg_res[14] && $msg_res[14]!="NA")
                        $bd_txn_date=date('Y-m-d H:i:s', strtotime($msg_res[14]));
                    $where=array('bd_merchant_id'=>$msg_res[1], 'pp_cm_order_id'=>$msg_res[2]);
                    $data=array('bd_txn_amount'=>$msg_res[5], 'bd_status_id'=>$msg_res[15], 'bd_txn_reference_no'=>$msg_res[3], 'bd_error_desc'=>$msg_res[25], 'bd_txn_amount'=>$msg_res[5], 'bd_txn_date'=>$bd_txn_date, 'txn_modified_date'=>date('Y-m-d H:i:s'));
                    $data['txn_status']='p';
                    $res_status='pending';
                    if($msg_res[14]=='0300')
                        $data['txn_status']='s';
                    elseif($msg_res[14]=='0002')
                        $data['txn_status']='p';
                    else
                        $data['txn_status']='f';
                    $this->Common->updateRecords('child_merchant_transactions', $where, $data);
                    if(!empty($row['refund']))
                    {
                        $where=array('id'=>$row['refund']['id']);
                        $data=array('bd_refund_amount'=>$msg_res[28], 'refund_modifid_date'=>date('Y-m-d H:i:s'), 'refund_status_code'=>$msg_res[27], 'error_code'=>$msg_res[24], 'bd_error_reason'=>$msg_res[25]);
                        
                        if($msg_res[27]=='0699')
                        {
                            $data['bd_status_reason']='Refund initiated';
                            $data['refund_status']='s';
                        }
                        elseif($msg_res[27]=='0799')
                        {
                            $data['bd_status_reason']='Refund initiated either partial or full';
                            $data['refund_status']='s';
                        }
                        else {
                            $data['bd_status_reason']='Refund not allowed';
                        }
                        $this->Common->updateRecords('cm_refund', $where, $data);
                    }
                }
            }
        }
        //$this->load->view('pg/pay');
    }
    //////////request for refund from billdesk/////
    public function pgRefundQuery()
    {
        $_POST=file_get_contents("php://input");
        //echo '<pre>';print($_POST);exit;
        log_message("debug", "got refund request from child merchant: ".$_POST);
        
        $data= json_decode($_POST);
        $cs_data=json_decode($_POST);
        unset($cs_data->checksum);
        $checksum = hash_hmac('sha256', json_encode($cs_data),'pxK7m51pHlOp', false);
        $checksum = strtoupper($checksum);
        
        $bd_merchant_id=$data->merchantId;
        $pp_customer_id=$data->customerId;
        $cm_order_id=$data->orderId;
        if($checksum==$data->checksum)
        {
            /////chcking is merchant id sent by child merchant///////////
            if($bd_merchant_id && $bd_merchant_id!="")
            {
                ////////checking is merchant id valid or not///////
                $is_merchant_exist=$this->Common->isExistRecord('child_merchant', array('bd_merchant_id'=>$bd_merchant_id, 'cm_status'=>1));
                if($is_merchant_exist)
                {
                    /////chcking is customer id sent by child merchant///////////
                    if($pp_customer_id && $pp_customer_id!="")
                    {
                        ////////checking is customer id valid or not///////
                        $is_customer_exist=$this->Common->isExistRecord('child_merchant', array('bd_merchant_id'=>$bd_merchant_id, 'pp_customer_id'=>$pp_customer_id, 'cm_status'=>1));
                        if($is_customer_exist)
                        {        
                            /////chcking is order id sent by child merchant///////////
                            if($cm_order_id && $cm_order_id!="")
                            {
                                ////////checking is order id already  ready exist or not///////
                                $is_order_exist=$this->Common->isExistRecord('child_merchant_transactions', array('bd_merchant_id'=>$bd_merchant_id, 'cm_order_id'=>$cm_order_id));
                                if($is_order_exist)
                                {
                                    ///////////get child merchant transactions details/////////
                                    $cm_details=$this->Common->getSingle('child_merchant_transactions', "id, pp_cm_order_id, bd_txn_reference_no, txn_amount, bd_txn_date", array('bd_merchant_id'=>$bd_merchant_id, 'cm_order_id'=>$cm_order_id));
                                    ///////////////////////////////////////////////////////////////
                                    $curdate=date('YmdHis');
                                    $txn_date=date('Ymd', strtotime($cm_details['bd_txn_date']));
                                    $refund_details=$this->Common->getSingle('cm_refund', "id, pp_reference_no", array('txn_id'=>$cm_details['id']));
                                    if($refund_details && count($refund_details)>0 && !empty($refund_details))
                                    {
                                        $pp_reference_no=$refund_details['pp_reference_no'];
                                        $last_id=$refund_details['id'];
                                    }
                                    else
                                    {
                                        ////////////inserting data to refund table/////////////
                                        $refData=array(
                                            'txn_id'=>$cm_details['id'],
                                            'refund_amount'=>$cm_details['txn_amount'],
                                            'refund_date'=>date('Y-m-d H:i:s')
                                        );
                                        $last_id=$this->Common->getandinsertRecord('cm_refund', $refData);
                                        ///////////////////////////////////////////////////////
                                        $this->load->helper('auth');
                                        $pp_reference_no=get_unique_session_id('ref', $last_id);//////generate unique refund reference id/////
                                        ///////updating reference number to refund table///////////
                                        $this->Common->updateRecords('cm_refund', array('id'=>$last_id), array('pp_reference_no'=>$pp_reference_no));
                                        ///////////////////////////////////////////////////////////
                                    }
                                    $str="0400|".$bd_merchant_id."|".$cm_details['bd_txn_reference_no']."|".$txn_date."|".$cm_details['pp_cm_order_id']."|".$cm_details['txn_amount']."|".$cm_details['txn_amount']."|".$curdate."|".$pp_reference_no."|NA|NA|NA";
                                    log_message("debug", "send refund request to Billdesk: ".$str);
                                    $checksum = hash_hmac('sha256',$str,'mxK7m51pHlOe', false);
                                    $checksum = strtoupper($checksum);
                                    $msg=$str.'|'.$checksum;
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "https://www.billdesk.com/pgidsk/PGIRefundController");
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('msg' => $msg)));

                                    // receive server response ...
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                    $server_output = curl_exec ($ch);
                                    log_message("debug", "Refund Response from Billdesk: ".$server_output);
                                    //echo '<pre>';print_r($server_output);
                                    curl_close ($ch);
                                    if($server_output && $server_output!="")
                                    {
                                        $msg_res=explode('|', $server_output);
                                        $res_checksum=trim(array_pop($msg_res));
                                        $new_msg= implode('|', $msg_res);
                                        $checksum = hash_hmac('sha256',$new_msg,'mxK7m51pHlOe', false);
                                        $checksum = strtoupper($checksum);
                                        if($res_checksum==$checksum)
                                        {
                                            ////////update refund table////////
                                            $where=array('id'=>$last_id);
                                            $data=array('refund_status_code'=>$msg_res[8], 'bd_refund_id'=>$msg_res[9], 'error_code'=>$msg_res[10], 'bd_error_reason'=>$msg_res[11]);

                                            if($msg_res[8]=='0699')
                                            {
                                                $data['bd_status_reason']='Refund initiated';
                                            }
                                            elseif($msg_res[8]=='0799')
                                            {
                                                $data['bd_status_reason']='Refund initiated either partial or full';
                                            }
                                            else {
                                                $data['bd_status_reason']='Refund not allowed';
                                            }
                                            if($msg_res[12]=='Y')
                                            {
                                                $data['bd_process_status']='Process Success';
                                            }
                                            else{
                                                $data['bd_process_status']='Process in Error';
                                            }
                                            $this->Common->updateRecords('cm_refund', $where, $data);
                                            ///////////////////////////////////////////////////////
                                            $resp=array('merchantId'=>$msg_res[1], 'orderId'=>$cm_order_id, 'customerId'=>$pp_customer_id, 'txnReference'=>$pp_reference_no, 'refundStatus'=>$data['bd_status_reason'], 'errorStatus'=>$msg_res[11]);
                                            echo json_encode($resp);
                                            exit;
                                        }
                                        else
                                        {
                                            $response['msg']=json_encode(array('error'=>1, 'msg'=>'Sorry! Something went wrong'));
                                            $this->load->view('pg/pg_response', $response);
                                        }
                                    }
                                    else
                                    {
                                        echo json_encode(array('error'=>1, 'msg'=>'Sorry! Something went wrong'));
                                        exit;
                                    }
                                    //$this->load->view('pg/pay');
                                }
                                else
                                {
                                    $message=array('error'=>1, 'msg'=>'Order Id is not valid');
                                    echo json_encode($message);
                                    exit;
                                }
                            }
                            else
                            {
                                $message=array('error'=>1, 'msg'=>'Order Id is required');
                                echo json_encode($message);
                                exit;
                            }
                        }
                        else
                        {
                            $message=array('error'=>1, 'msg'=>'Customer Id is not valid');
                            echo json_encode($message);
                            exit;
                        }
                    }
                    else
                    {
                        $message=array('error'=>1, 'msg'=>'Customer Id is required');
                        echo json_encode($message);
                        exit;
                    }
                }
                else
                {
                    $message=array('error'=>1, 'msg'=>'Merchant Id is not valid');
                    echo json_encode($message);
                    exit;
                }
            }
            else
            {
                $message=array('error'=>1, 'msg'=>'Merchant Id is required');
                echo json_encode($message);
                exit;
            }
        }
        else
        {
            $message=array('error'=>1, 'msg'=>'Sorry! Checksum value not matched');
            echo json_encode($message);
            exit;
        }
    }
}
