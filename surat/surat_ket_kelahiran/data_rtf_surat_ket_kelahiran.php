<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	/*
		Jika saksi1 warga desa, ganti kolom isiannya dengan data dari database penduduk
	*/
	if($input['id_saksi1']) {
		$saksi1 = $this->get_data_surat($input['id_saksi1']);
		$array_replace = array(
	                "[nama_saksi1]"        		=> $saksi1['nama'],
	                "[nik_saksi1]"       			=> $saksi1['nik'],
	                "[tempat_lahir_saksi1]"   => $saksi1['tempatlahir'],
	                "[tanggal_lahir_saksi1]"	=> tgl_indo_dari_str($saksi1['tanggallahir']),
	                "[umur_saksi1]"  					=> $saksi1['umur'],
	                "[pekerjaansaksi1]" 			=> $saksi1['pekerjaan'],
	                "[form_desasaksi1]"       => $config['nama_desa'],
	                "[form_kecsaksi1]"       	=> $config['nama_kecamatan'],
	                "[form_kabsaksi1]"       	=> $config['nama_kabupaten'],
	                "[form_provinsisaksi1]"   => $config['nama_provinsi']
		);
		$buffer = str_replace(array_keys($array_replace), array_values($array_replace), $buffer);
	}

?>