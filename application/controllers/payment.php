<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function i($token) {
        $this->load->model('project_model');
        
        $param['project'] = $this->project_model->detailByToken($token);
        
        $this->load->view('vwPayment', $param);
    }
    
    public function async_process() {
        
        $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        
        if ($project_id == '' || $phone == '' || $amount == '') {
            return ['result' => 'failed', 'msg' => 'Invalid Paramters', ];
        }
        
        if (substr($phone, 0, 1) == '0') {
            $phone = substr($phone, 1);
        }        
        $client_id = $project_id.":".$phone;
        
        $this->load->model('project_model');
        $this->load->model('country_model');
        $project = $this->project_model->detail($project_id);
        $country = $this->country_model->detail($project->country_id);
        
        $data = array("apikey" => CENTILI_APIKEY, "msisdn" => $country->prefix.$phone, "price" => $amount, "paymenttype" => "mobile", "clientid" => $client_id);
        $data_string = json_encode($data);
        
        $ch = curl_init('https://api.centili.com/api/payment/1_3/transaction');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Host: api.centili.com:443' )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $obj = json_decode($result);
        if ($obj->status == 'ACCEPTED') {
            $transactionid = $obj->transactionid;
            
            $ch = curl_init("https://api.centili.com/api/payment/1_3/transaction/".$transactionid);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Host: api.centili.com:443' )
            );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($result);
            if ($data->status == 'ACCEPTED') {
                $return['result'] = 'success';
                $return['msg'] = 'Check your phone';
                       
                $this->load->model('common_model');
                $this->common_model->sendSMS($data->shortCode, $country->prefix.$phone, "Reply on here '".$data->smsBody."'");
            
            } else {
                $return['result'] = 'failed';
                $return['msg'] = 'Failed';
            }            
        } else {
            $return['result'] = 'failed';
            $return['msg'] = 'Failed';
        }

        die(json_encode($return));
    }
    
    public function notification() {
        $clientid = isset($_GET['clientid']) ? $_GET['clientid'] : '';
        if ($clientid != '') {
            $arr = explode(":", $clientid);
            $project_id = $arr[0];
            $phone = $arr[1];
            $amount = $_GET['amount'];
            $data = var_export($_GET, true);
            $this->load->model('transaction_model');
            $this->transaction_model->add($project_id, $phone, $amount, $data);
        }
    }
}
