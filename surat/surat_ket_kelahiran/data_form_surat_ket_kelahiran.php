<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

		$data['warganegara'] = $this->penduduk_model->list_warganegara();
		$data['agama'] = $this->penduduk_model->list_agama();
		$data['pekerjaan'] = $this->penduduk_model->list_pekerjaan('ucwords');
		$data['sex'] = $this->penduduk_model->list_sex();

		$_SESSION['post'] = $_POST;
		if($this->input->post('saksi1')==2) unset($_SESSION['id_saksi1']);
		if($_POST['id_saksi1'] != '' AND $_POST['id_saksi1'] !='*'){
			$data['saksi1']=$this->surat_model->get_penduduk($_POST['id_saksi1']);
			$_SESSION['id_saksi1'] = $_POST['id_saksi1'];
		}elseif ($_POST['id_saksi1'] !='*' AND isset($_SESSION['id_saksi1'])){
			$data['saksi1']=$this->surat_model->get_penduduk($_SESSION['id_saksi1']);
		}else{
			unset($data['saksi1']);
			unset($_SESSION['id_saksi1']);
		}

?>