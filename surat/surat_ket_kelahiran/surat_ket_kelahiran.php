<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');?>

<script language="javascript" type="text/javascript">
  function ubah_saksi1(asal){
    $('#saksi1').val(asal);
    if(asal == 1){
      $('.saksi1_desa').show();
      $('.saksi1_luar_desa').hide();
      // Mungkin bug di jquery? Terpaksa hapus class radio button
      $('#label_saksi1_2').removeClass('ui-state-active');
    } else {
      $('.saksi1_desa').hide();
      $('.saksi1_luar_desa').show();
      $('#id_saksi1_validasi').val('*'); // Hapus $id_wanita
      submit_form_ambil_data();
    }
  }

  function ubah_saksi2(asal){
    $('#saksi2').val(asal);
    if(asal == 1){
      $('.saksi2_desa').show();
      $('.saksi2_luar_desa').hide();
      // Mungkin bug di jquery? Terpaksa hapus class radio button
      $('#label_saksi2_2').removeClass('ui-state-active');
    } else {
      $('.saksi2_desa').hide();
      $('.saksi2_luar_desa').show();
      $('#id_saksi2_validasi').val('*'); // Hapus $id_wanita
      submit_form_ambil_data();
    }
  }

  function ubah_pelapor(asal){
    $('#pelapor').val(asal);
    if(asal == 1){
      $('.pelapor_desa').show();
      $('.pelapor_luar_desa').hide();
      // Mungkin bug di jquery? Terpaksa hapus class radio button
      $('#label_pelapor_2').removeClass('ui-state-active');
    } else {
      $('.pelapor_desa').hide();
      $('.pelapor_luar_desa').show();
      $('#id_pelapor_validasi').val('*'); // Hapus $id_wanita
      submit_form_ambil_data();
    }
  }

  function _calculateAge(birthday) { // birthday is a date (dd-mm-yyyy)
    var parts =birthday.split('-');
    // Ubah menjadi format ISO yyyy-mm-dd
    // please put attention to the month (parts[0]), Javascript counts months from 0:
    // January - 0, February - 1, etc
    // https://stackoverflow.com/questions/5619202/converting-string-to-date-in-js
    var birthdate = new Date(parts[2],parts[1]-1,parts[0]);
    var ageDifMs = (new Date()).getTime() - birthdate.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  $(function(){
    var nik = {};
    nik.results = [
      <?php foreach($perempuan as $data){?>
        {id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
      <?php }?>
    ];

    $('#nik').flexbox(nik, {
      resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
      watermark: <?php if($individu){?>'<?php echo $individu['nik']?> - <?php echo spaceunpenetration($individu['nama'])?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
      width: 260,
      noResultsText :'Tidak ada no nik yang sesuai..',
      onSelect: function() {
        $('#'+'main').submit();
      }
    });
  });

  $(function(){
    var saksi1 = {};
    saksi1.results = [
      <?php foreach($penduduk as $data){?>
        {id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
      <?php }?>
    ];

    $('#id_saksi1').flexbox(saksi1, {
      resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
      watermark: <?php if($saksi1){?>'<?php echo $saksi1['nik']?> - <?php echo $saksi1['nama']?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
      width: 260,
      noResultsText :'Tidak ada no nik yang sesuai..',
      onSelect: function() {
        $('#id_saksi1_validasi').val($('#id_saksi1_hidden').val());
        submit_form_ambil_data();
      }
    });
  });

  $(function(){
    var saksi2 = {};
    saksi2.results = [
      <?php foreach($penduduk as $data){?>
        {id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
      <?php }?>
    ];

    $('#id_saksi2').flexbox(saksi2, {
      resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
      watermark: <?php if($saksi2){?>'<?php echo $saksi2['nik']?> - <?php echo $saksi2['nama']?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
      width: 260,
      noResultsText :'Tidak ada no nik yang sesuai..',
      onSelect: function() {
        $('#id_saksi2_validasi').val($('#id_saksi2_hidden').val());
        submit_form_ambil_data();
      }
    });
  });

  $(function(){
    var pelapor = {};
    pelapor.results = [
      <?php foreach($penduduk as $data){?>
        {id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
      <?php }?>
    ];

    $('#id_pelapor').flexbox(pelapor, {
      resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
      watermark: <?php if($pelapor){?>'<?php echo $pelapor['nik']?> - <?php echo $pelapor['nama']?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
      width: 260,
      noResultsText :'Tidak ada no nik yang sesuai..',
      onSelect: function() {
        $('#id_pelapor_validasi').val($('#id_pelapor_hidden').val());
        submit_form_ambil_data();
      }
    });
  });

  function submit_form_ambil_data(){
    $('input').removeClass('required');
    $('select').removeClass('required');
    $('#'+'validasi').attr('action','');
    $('#'+'validasi').attr('target','');
    $('#'+'validasi').submit();
  }

$('document').ready(function(){

  /* set otomatis hari */
  $('input[name=tanggal]').change(function(){
    var hari = {
      0 : 'Minggu', 1 : 'Senin', 2 : 'Selasa', 3 : 'Rabu', 4 : 'Kamis', 5 : 'Jumat', 6 : 'Sabtu'
    };
    var t = $(this).datepicker('getDate');
    var i = t.getDay();
    $(this).closest('td').find('[name=hari]').val(hari[i]);
  });

});

</script>


<style>
  table.form span.judul{
    padding-left: 10px;
    padding-right: 5px;
  }
  .grey {
    background-color: lightgrey;
  }

  table.form.detail th{
      padding:5px;
      background:#fafafa;
      border-right:1px solid #eee;
  }
  table.form.detail td{
      padding:5px;
  }
  .style6 {
    color: #FFFFFF;
    background-color: #1d93dd;
    font-style: italic;
  }
  label { padding-left: 5px; padding-right: 15px; }
</style>

<div id="pageC">
	<table class="inner">
	<tr style="vertical-align:top">
	<td width="937" style="background:#fff;padding:5px;">

<div class="content-header"></div>
<div id="contentpane">
<div class="ui-layout-north panel">
<h3>Surat Keterangan Kelahiran</h3>
</div>

  <div class="ui-layout-center" id="maincontent" style="padding: 5px;">
<table width="919" class="form">
<tr>
<th width="120">NIK / Nama Ibu</th>
<td width="665">
<form action="" id="main" name="main" method="POST">
<div id="nik" name="nik"></div>
</form></tr>
<form id="validasi" action="<?php echo $form_action?>" method="POST" target="_blank">

  <input type="hidden" name="nik" value="<?php echo $individu['id']?>"  class="inputbox required">
  <input id="id_saksi1_validasi" name="id_saksi1" type="hidden" value="<?php echo $_SESSION['id_saksi1']?>"/>
  <input id="id_saksi2_validasi" name="id_saksi2" type="hidden" value="<?php echo $_SESSION['id_saksi2']?>"/>
  <input id="id_pelapor_validasi" name="id_pelapor" type="hidden" value="<?php echo $_SESSION['id_pelapor']?>"/>

<?php if($individu){ //bagian info setelah terpilih?>
  <?php include("donjo-app/views/surat/form/konfirmasi_pemohon.php"); ?>
<?php }?>
<tr>
  <th>Nomor Surat</th>
  <td>
    <input name="nomor" type="text" class="inputbox required" size="12" value="<?php echo $_SESSION['post']['nomor']; ?>"/>
    <span>Terakhir: <?php echo $surat_terakhir['no_surat'];?> (tgl: <?php echo $surat_terakhir['tanggal']?>)</span>
  </td>
</tr>
<tr>
	<th>&nbsp;</th>
	</tr>
<tr>
	<th class="style6">DATA KELAHIRAN :</th>
</tr>
<tr>
	<th>Nama Bayi </th>
	<td><input name="nama_bayi" type="text" class="inputbox required" size="70" value="<?php echo $_SESSION['post']['nama_bayi']?>"/></td>
	</tr>
<tr>
	<th>NIK</th>
	<td><input name="nik_bayi" type="text" class="inputbox required" id="nik_bayi" size="70" value="<?php echo $_SESSION['post']['nik_bayi']?>"/>
	  <em>*isi tanda - jika belum memiliki NIK</em> </td>
</tr>
<tr>
	<th>Jenis Kelamin </th>
	<td>
    <input type="hidden" name="nama_sex">
    <select name="sex" class="required" id="sex" onchange="$('input[name=nama_sex]').val($(this).find(':selected').text());">
      <option value="">Pilih Jenis Kelamin</option>
      <?php foreach($sex as $data){?>
        <option value="<?php echo $data['id']?>" <?php if($data['id']==$_SESSION['post']['sex']) echo 'selected'?>><?php echo $data['nama']?></option>
      <?php }?>
    </select>
  </td>
</tr>
<tr>
	<th>Hari / Tanggal / Jam </th>
	<td><input name="hari" readonly="readonly" type="text" class="inputbox required" size="10" value="<?php echo $_SESSION['post']['hari']?>"/>
/
  <input name="tanggal" type="text" class="inputbox required datepicker" id="tanggal" size="11" value="<?php echo $_SESSION['post']['tanggal']?>"/>
/
<em>*Isi waktu kelahiran etc : 08:00</em>
<input name="jam" type="text" class="inputbox required" size="10" value="<?php echo $_SESSION['post']['jam']?>"/></td>
</tr>
<tr>
  <th>Tempat Dilahirkan </th>
  <td>
    <input name="tempatlahirbayi" type="radio" value="1" id="radio2" <?php if($_SESSION['post']['tempatlahirbayi']=='1'){echo 'checked';}?>/><label for="radio2">RS/RB</label>
    <input name="tempatlahirbayi" type="radio" value="2" id="radio3" <?php if($_SESSION['post']['tempatlahirbayi']=='2'){echo 'checked';}?>/><label for="radio3">Puskesmas</label>
    <input name="tempatlahirbayi" type="radio" value="3" id="radio4" <?php if($_SESSION['post']['tempatlahirbayi']=='3'){echo 'checked';}?>/><label for="radio4">Rumah</label>
    <input name="tempatlahirbayi" type="radio" value="4" id="radio5" <?php if($_SESSION['post']['tempatlahirbayi']=='4'){echo 'checked';}?>/><label for="radio5">Polindes</label>
    <input name="tempatlahirbayi" type="radio" value="5" id="radio6" <?php if($_SESSION['post']['tempatlahirbayi']=='5'){echo 'checked';}?>/><label for="radio6">
    Lainnya</label>
  </td>
</tr>
<tr>
  <th>Alamat Tempat Lahir </th>
  <td><input name="alamat_lahir_bayi" type="text" class="inputbox required" id="alamat_lahir_bayi" size="100" value="<?php echo $_SESSION['post']['alamat_lahir_bayi']?>"/></td>
</tr>
<tr>
  <th>Jenis Kelahiran </th>
  <td valign="baseline">
    <input name="jenislahir" type="radio" value="1" id="radio11" <?php if($_SESSION['post']['jenislahir']=='1'){echo 'checked';}?>/><label for "radio11">Tunggal</label>
    <input name="jenislahir" type="radio" value="2" id="radio12" <?php if($_SESSION['post']['jenislahir']=='2'){echo 'checked';}?>/><label for="radio12">Kembar 2</label>
    <input name="jenislahir" type="radio" value="3" id="radio13" <?php if($_SESSION['post']['jenislahir']=='3'){echo 'checked';}?>/><label for="radio13">Kembar 3</label>
    <input name="jenislahir" type="radio" value="4" id="radio14" <?php if($_SESSION['post']['jenislahir']=='4'){echo 'checked';}?>/><label for="radio14">Kembar 4 </label>
  </td>
</tr>
<tr>
  <th>Kelahiran Anak Ke </th>
  <td><label></label>
      <label for="radio10">
      <input name="Kelahiranke" type="text" class="inputbox required" id="Kelahiranke" size="8" value="<?php echo $_SESSION['post']['Kelahiranke']?>"/>
      &nbsp;<em>*isi dengan angka </em></label></td>
</tr>
<tr>
  <th>Penolong Kelahiran </th>
  <td>
    <input name="penolong" type="radio" value="1" id="radio16" <?php if($_SESSION['post']['penolong']=='1'){echo 'checked';}?>/><label for="radio16">Dokter</label>
    <input name="penolong" type="radio" value="2" id="radio8" <?php if($_SESSION['post']['penolong']=='2'){echo 'checked';}?>/><label for="radio8">Bidan Perawat</label>
    <input name="penolong" type="radio" value="3" id="radio9" <?php if($_SESSION['post']['penolong']=='3'){echo 'checked';}?>/><label for="radio9">Dukun</label>
    <input name="penolong" type="radio" value="4" id="radio15" <?php if($_SESSION['post']['penolong']=='4'){echo 'checked';}?>/><label for="radio10">Lainnya</label>
  </td>
</tr>
<tr>
  <th>&nbsp;</th>
</tr>

<!-- PELAPOR -->
<tr>
  <th class="grey">PELAPOR</th>
  <td class="grey">
    <div class="uiradio">
      <input type="radio" id="pelapor_1" name="pelapor" value="1" <?php if(!empty($pelapor)){echo 'checked';}?> onchange="ubah_pelapor(this.value);">
      <label for="pelapor_1">Warga Desa</label>
      <input type="radio" id="pelapor_2" name="pelapor" value="2" <?php if(empty($pelapor)){echo 'checked';}?> onchange="ubah_pelapor(this.value);">
      <label id="label_pelapor_2" for="pelapor_2">Warga Luar Desa</label>
    </div>
  </td>
</tr>

<tr class="pelapor_desa" <?php if (empty($pelapor)) echo 'style="display: none;"'; ?>>
  <th colspan="2">DATA PELAPOR WARGA DESA</th>
</tr>
<tr class="pelapor_desa" <?php if (empty($pelapor)) echo 'style="display: none;"'; ?>>
  <th class="indent">NIK / Nama</th>
  <td>
    <div id="id_pelapor" name="id_pelapor"></div>
    <?php if($pelapor){ //bagian info setelah terpilih
        $individu = $pelapor;
        include("donjo-app/views/surat/form/konfirmasi_pemohon.php");
    }?>
  </td>
</tr>

<?php if (empty($pelapor)) : ?>
  <tr class="pelapor_luar_desa">
    <th class="style6">DATA PELAPOR LUAR DESA</th>
  </tr>
  <tr class="pelapor_luar_desa">
    <th>Nama</th>
    <td><input name="nama_pelapor" type="text" class="inputbox required" size="100" value="<?php echo $_SESSION['post']['nama_pelapor']?>"/>  </td>
  </tr>
  <tr class="pelapor_luar_desa">
    <th>NIK</th>
    <td><input name="nik_pelapor" type="text" class="inputbox required" size="70" value="<?php echo $_SESSION['post']['nik_pelapor']?>"/></td>
  </tr>
  <tr class="pelapor_luar_desa">
    <th>Tempat Lahir </th>
    <td><input name="tempat_lahir_pelapor" type="text" class="inputbox required" id="tempat_lahir_pelapor" size="40" value="<?php echo $_SESSION['post']['tempat_lahir_pelapor']?>"/>
  <span class="judul"> Tanggal Lahir : </span>
    <input name="tanggal_lahir_pelapor" type="text" class="inputbox required datepicker" id="tanggal_lahir_pelapor" size="11" value="<?php echo $_SESSION['post']['tanggal_lahir_pelapor']?>"onchange="$('input[name=umur_pelapor]').val(_calculateAge($(this).val()));"/>
    <span class="judul"> Umur : </span>
    <input name="umur_pelapor" readonly="readonly" type="text" class="inputbox required" size="5" value="<?php echo $_SESSION['post']['umur_pelapor']?>"/>
      tahun</td>
  </tr>
  <tr class="pelapor_luar_desa">
    <th>Jenis kelamin </th>
    <td>
      <select name="jkpelapor" class="required" id="jkpelapor">
        <option value="">Pilih Jenis Kelamin</option>
        <?php foreach($sex as $data){?>
          <option value="<?php echo $data['id']?>" <?php if($data['id']==$_SESSION['post']['jkpelapor']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
      <span class="judul"> Pekerjaan </span>
      <select name="pekerjaanpelapor" class="required" id="pekerjaanpelapor">
        <option value="">Pilih Pekerjaan</option>
        <?php  foreach($pekerjaan as $data){?>
          <option value="<?php echo $data['nama']?>" <?php if($data['nama']==$_SESSION['post']['pekerjaanpelapor']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
    </td>
  </tr>
  <tr class="pelapor_luar_desa">
    <th>Alamat</th>
    <td><p>Desa <span class="judul"> : </span>
        <input name="desapelapor" type="text" class="inputbox required" id="desapelapor" size="40" value="<?php echo $_SESSION['post']['desapelapor']?>"/>
        <span class="judul"> Kecamatan : </span>
        <input name="kecpelapor" type="text" class="inputbox required" id="kecpelapor" size="40" value="<?php echo $_SESSION['post']['kecpelapor']?>"/>
    </p>
      <p>&nbsp;</p>
      <p>Kab<span class="judul"> &nbsp;:&nbsp; </span>
          <input name="kabpelapor" type="text" class="inputbox required" id="kabpelapor" size="40" value="<?php echo $_SESSION['post']['kabpelapor']?>"/>
       <span class="judul"> Provinsi &nbsp;&nbsp;&nbsp;&nbsp;:  </span>
        <input name="provinsipelapor" type="text" class="inputbox required" id="provinsipelapor" size="40" value="<?php echo $_SESSION['post']['provinsipelapor']?>"/>
  </p>    </td>
  </tr>
<?php endif; ?>
<tr>
  <th>Hubungan Pelapor dengan Bayi</th>
  <td><input name="hubungan_pelapor" type="text" class="inputbox required" id="hubungan_pelapor" size="100" value="<?php echo $_SESSION['post']['hubungan_pelapor']?>"/></td>
</tr>

<!-- SAKSI 1 -->
<tr>
  <th class="grey">SAKSI 1</th>
  <td class="grey">
    <div class="uiradio">
      <input type="radio" id="saksi1_1" name="saksi1" value="1" <?php if(!empty($saksi1)){echo 'checked';}?> onchange="ubah_saksi1(this.value);">
      <label for="saksi1_1">Warga Desa</label>
      <input type="radio" id="saksi1_2" name="saksi1" value="2" <?php if(empty($saksi1)){echo 'checked';}?> onchange="ubah_saksi1(this.value);">
      <label id="label_saksi1_2" for="saksi1_2">Warga Luar Desa</label>
    </div>
  </td>
</tr>

<tr class="saksi1_desa" <?php if (empty($saksi1)) echo 'style="display: none;"'; ?>>
  <th colspan="2">DATA SAKSI 1 WARGA DESA</th>
</tr>
<tr class="saksi1_desa" <?php if (empty($saksi1)) echo 'style="display: none;"'; ?>>
  <th class="indent">NIK / Nama</th>
  <td>
    <div id="id_saksi1" name="id_saksi1"></div>
    <?php if($saksi1){ //bagian info setelah terpilih
        $individu = $saksi1;
        include("donjo-app/views/surat/form/konfirmasi_pemohon.php");
    }?>
  </td>
</tr>

<?php if (empty($saksi1)) : ?>
  <tr class="saksi1_luar_desa">
    <th class="style6">DATA SAKSI 1 LUAR DESA</th>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>Nama</th>
    <td><input name="nama_saksi1" type="text" class="inputbox required" id="nama_saksi1" size="100" value="<?php echo $_SESSION['post']['nama_saksi1']?>"/></td>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>NIK</th>
    <td><input name="nik_saksi1" type="text" class="inputbox required" id="nik_saksi1" size="70" value="<?php echo $_SESSION['post']['nik_saksi2']?>"/></td>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>Tempat Lahir  </th>
    <td>
      <input name="tempat_lahir_saksi1" type="text" class="inputbox required" id="tempat_lahir_saksi1" size="40" value="<?php echo $_SESSION['post']['tempat_lahir_saksi1']?>"/>
      <span class="judul"> Tanggal Lahir : </span>
      <input name="tanggal_lahir_saksi1" type="text" class="inputbox required datepicker" id="tanggal_lahir_saksi1" size="11" onchange="$('input[name=umur_saksi1]').val(_calculateAge($(this).val()));" value="<?php echo $_SESSION['post']['tanggal_lahir_saksi1']?>"/>
      <span class="judul"> Umur : </span>
      <input name="umur_saksi1" readonly="readonly" type="text" class="inputbox required" id="umur_saksi1" size="5" value="<?php echo $_SESSION['post']['umur_saksi1']?>"/>
      tahun
    </td>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>Jenis Kelamin </th>
    <td>
      <select name="jksaksi1" class="required" id="jksaksi1">
        <option value="">Pilih Jenis Kelamin</option>
        <?php foreach($sex as $data){?>
          <option value="<?php echo $data['id']?>" <?php if($data['id']==$_SESSION['post']['jksaksi1']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
      <span class="judul">Pekerjaan </span>
      <select name="pekerjaansaksi1" class="required" id="pekerjaansaksi1">
        <option value="">Pilih Pekerjaan</option>
        <?php  foreach($pekerjaan as $data){?>
          <option value="<?php echo $data['nama']?>" <?php if($data['nama']==$_SESSION['post']['pekerjaansaksi1']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
    </td>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>Alamat</th>
    <td>
      <p>Desa <span class="judul"> : </span>
        <input name="desasaksi1" type="text" class="inputbox required" id="desasaksi1" size="40" value="<?php echo $_SESSION['post']['desasaksi1']?>"/>
        <span class="judul"> Kecamatan : </span>
        <input name="kecsaksi1" type="text" class="inputbox required" id="kecsaksi1" size="40" value="<?php echo $_SESSION['post']['kecsaksi1']?>"/>
      </p>
      <p>&nbsp;</p>
      <p>Kab<span class="judul"> &nbsp;:&nbsp; </span>
          <input name="kabsaksi1" type="text" class="inputbox required" id="kabsaksi1" size="40" value="<?php echo $_SESSION['post']['kabsaksi1']?>"/>
          <span class="judul"> Provinsi &nbsp;&nbsp;&nbsp;&nbsp;: </span>
          <input name="provinsisaksi1" type="text" class="inputbox required" id="provinsisaksi1" size="40" value="<?php echo $_SESSION['post']['provinsisaksi1']?>"/>
      </p>
    </td>
  </tr>
  <tr class="saksi1_luar_desa">
    <th>&nbsp;</th>
  </tr>
<?php endif; ?>

<!-- SAKSI 2 -->
<tr>
  <th class="grey">SAKSI 2</th>
  <td class="grey">
    <div class="uiradio">
      <input type="radio" id="saksi2_1" name="saksi2" value="1" <?php if(!empty($saksi2)){echo 'checked';}?> onchange="ubah_saksi2(this.value);">
      <label for="saksi2_1">Warga Desa</label>
      <input type="radio" id="saksi2_2" name="saksi2" value="2" <?php if(empty($saksi2)){echo 'checked';}?> onchange="ubah_saksi2(this.value);">
      <label id="label_saksi2_2" for="saksi2_2">Warga Luar Desa</label>
    </div>
  </td>
</tr>

<tr class="saksi2_desa" <?php if (empty($saksi2)) echo 'style="display: none;"'; ?>>
  <th colspan="2">DATA SAKSI 2 WARGA DESA</th>
</tr>
<tr class="saksi2_desa" <?php if (empty($saksi2)) echo 'style="display: none;"'; ?>>
  <th class="indent">NIK / Nama</th>
  <td>
    <div id="id_saksi2" name="id_saksi2"></div>
    <?php if($saksi2){ //bagian info setelah terpilih
        $individu = $saksi2;
        include("donjo-app/views/surat/form/konfirmasi_pemohon.php");
    }?>
  </td>
</tr>

<?php if (empty($saksi2)) : ?>
  <tr class="saksi2_luar_desa">
    <th class="style6">DATA SAKSI 2 LUAR DESA</th>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>Nama</th>
    <td><input name="nama_saksi2" type="text" class="inputbox required" id="nama_saksi2" size="100"  value="<?php echo $_SESSION['post']['nama_saksi2']?>"/></td>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>NIK</th>
    <td><input name="nik_saksi2" type="text" class="inputbox required" id="nik_saksi2" size="70" value="<?php echo $_SESSION['post']['nik_saksi2']?>"/></td>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>Tempat Lahir </th>
    <td>
      <input name="tempat_lahir_saksi2" type="text" class="inputbox required" id="tempat_lahir_saksi2" size="40" value="<?php echo $_SESSION['post']['tempat_lahir_saksi2']?>"/>
      <span class="judul"> Tanggal Lahir : </span>
      <input name="tanggal_lahir_saksi2" type="text" class="inputbox required datepicker" id="tanggal_lahir_saksi2" size="11" onchange="$('input[name=umur_saksi2]').val(_calculateAge($(this).val()));" value="<?php echo $_SESSION['post']['tanggal_lahir_saksi2']?>"/>
      <span class="judul"> Umur : </span>
      <input name="umur_saksi2" readonly="readonly" type="text" class="inputbox required" id="umur_saksi2" size="5" value="<?php echo $_SESSION['post']['umur_saksi2']?>"/>
      tahun
    </td>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>Jenis Kelamin </th>
    <td>
      <select name="jksaksi2" class="required" id="jksaksi2">
        <option value="">Pilih Jenis Kelamin</option>
        <?php foreach($sex as $data){?>
          <option value="<?php echo $data['id']?>" <?php if($data['id']==$_SESSION['post']['jksaksi2']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
      <span class="judul">Pekerjaan </span>
      <select name="pekerjaansaksi2" class="required" id="pekerjaansaksi2">
        <option value="">Pilih Pekerjaan</option>
        <?php  foreach($pekerjaan as $data){?>
        <option value="<?php echo $data['nama']?>" <?php if($data['nama']==$_SESSION['post']['pekerjaansaksi2']) echo 'selected'?>><?php echo $data['nama']?></option>
        <?php }?>
      </select>
    </td>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>Alamat</th>
    <td>
      <p>
        Desa <span class="judul"> : </span>
        <input name="desasaksi2" type="text" class="inputbox required" id="desasaksi2" size="40" value="<?php echo $_SESSION['post']['desasaksi2']?>"/>
        <span class="judul"> Kecamatan : </span>
        <input name="kecsaksi2" type="text" class="inputbox required" id="kecsaksi2" size="40" value="<?php echo $_SESSION['post']['kecsaksi2']?>"/>
      </p>
      <p>&nbsp;</p>
      <p>
        Kab<span class="judul"> &nbsp;:&nbsp; </span>
        <input name="kabsaksi2" type="text" class="inputbox required" id="kabsaksi2" size="40" value="<?php echo $_SESSION['post']['kabsaksi2']?>"/>
        <span class="judul"> Provinsi &nbsp;&nbsp;&nbsp;&nbsp;: </span>
        <input name="provinsisaksi2" type="text" class="inputbox required" id="provinsisaksi2" size="40" value="<?php echo $_SESSION['post']['provinsisaksi2']?>"/>
      </p>
    </td>
  </tr>
  <tr class="saksi2_luar_desa">
    <th>&nbsp;</th>
  </tr>
<?php endif; ?>

<tr>
  <th class="style6">PENANDA TANGAN</th>
  <td><p>&nbsp;</p>      </td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>&nbsp;</td>
</tr>
<tr>
  <th>Lokasi Disdukcapil <?php echo ucwords($this->setting->sebutan_kabupaten)?></th>
  <td><input name="lokasi_disdukcapil" type="text" class="inputbox required" size="40" value="<?php echo $_SESSION['post']['lokasi_disdukcapil']?>"/></td>
</tr>
	<?php include("donjo-app/views/surat/form/_pamong.php"); ?>
        </table>
    </div>

    <div class="ui-layout-south panel bottom">
        <div class="left">
            <a href="<?php echo site_url()?>surat" class="uibutton icon prev">Kembali</a>        </div>
        <div class="right">
            <div class="uibutton-group">
                <button class="uibutton" type="reset">Clear</button>

							<button type="button" onclick="$('#'+'validasi').attr('action','<?php echo $form_action?>');$('#'+'validasi').submit();" class="uibutton special"><span class="ui-icon ui-icon-print">&nbsp;</span>Cetak</button>
							<?php if (SuratExport($url)) { ?><button type="button" onclick="$('#'+'validasi').attr('action','<?php echo $form_action2?>');$('#'+'validasi').submit();" class="uibutton confirm"><span class="ui-icon ui-icon-document">&nbsp;</span>Export Doc</button><?php } ?>
            </div>
        </div>
    </div> </form>
</div></td></tr></table>
</div>
