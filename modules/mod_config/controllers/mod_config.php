<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_config extends KIP_Controller {

	/*public function __construct(){
		parent::__construct();
		$this->load->model('data_config');
	}*/
	
	public function index(){
		$this->load->model('data_config');
		
		$id_user = 1;
		
		$action = to_data(@$_POST['action']);
		
		switch($action){
			case 'save':
				$data['situs'] = to_data(@$_POST['situs']);
				$data['instansi'] = to_data(@$_POST['instansi']);
				$data['deskripsi'] = to_data(@$_POST['deskripsi']);
				$data['alamat'] = to_data(@$_POST['alamat']);
				$data['telp'] = to_data(@$_POST['telp']);
				$data['email'] = to_data(@$_POST['email']);
				
				foreach($data as $key=>$value){
					$config['key'] = $key;
					$config['value'] = $value;
					$res = $this->data_config->update($config);
				}
				
				echo json_encode(array('status'=>'success'));
				
				break;
				
			case 'change_theme':
				$mode = to_data($_POST['mode']);
				$tema = to_data($_POST['tema']);
				
				$tmp = array();
				if($mode=='admin'){
					$tmp['key'] = 'skin_admin';
					$tmp['value'] = $tema;
				}else{
					$tmp['key'] = 'skin_frontpage';
					$tmp['value'] = $tema;
				}
				$data = $this->data_config->update($tmp);
				if($data['config_value']==$tema){
					echo json_encode(array('status'=>'success','theme'=>$data['config_value']));
				}else{
					echo json_encode(array('status'=>'error'));
				}
				
				break;
		}
	}
}