<?php 
	function upload_poli($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/poli/temp_upload/";
		$dirs                     ="assets/img/poli/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/poli/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/poli/'.$new_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 1052;
		$config['height']         = 762;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_pp_dokter($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/pp_dokter/temp_upload/";
		$dirs                     ="assets/img/pp_dokter/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/pp_dokter/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/pp_dokter/'.$new_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 1052;
		$config['height']         = 762;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_pp_user($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/pp_user/temp_upload/";
		$dirs                     ="assets/img/pp_user/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/pp_user/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/pp_user/'.$new_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 1052;
		$config['height']         = 762;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_slide($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/slide/temp_upload/";
		$dirs                     ="assets/img/slide/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/slide/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/slide/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}

	function upload_galeri($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/galeri/temp_upload/";
		$dirs                     ="assets/img/galeri/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/galeri/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/galeri/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	

	function upload_thumbnail_berita($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/thumbnail_berita/temp_upload/";
		$dirs                     ="assets/img/thumbnail_berita/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/thumbnail_berita/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/thumbnail_berita/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_thumbnail_artikel($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/thumbnail_artikel/temp_upload/";
		$dirs                     ="assets/img/thumbnail_artikel/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/thumbnail_artikel/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/thumbnail_artikel/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_thumbnail_laman($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/thumbnail_laman/temp_upload/";
		$dirs                     ="assets/img/thumbnail_laman/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/thumbnail_laman/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/thumbnail_laman/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}
	function upload_sertifikat($file,$new)
	{
		$CI                       =& get_instance();
		$foto                     =$_FILES[$file]['name'];
		$dir                      ="assets/img/sertifikat/temp_upload/";
		$dirs                     ="assets/img/sertifikat/";
		$file                     =$file;
		$n                        =date('YmdHis');
		$new_name                 =$new.$n.'.png';
		$vdir_upload              = $dir;
		$file_name                =$_FILES[''.$file.'']["name"];
		$vfile_upload             = $vdir_upload . $file;
		$tmp_name                 =$_FILES[''.$file.'']["tmp_name"];
		move_uploaded_file($tmp_name, $dir.$file_name);
		$source_url               =$dir.$file_name;
		$CI->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = 'assets/img/sertifikat/temp_upload/'.$foto;
		$config['new_image']      = 'assets/img/sertifikat/'.$new_name;
		$config['create_thumb'] = TRUE;
		$CI->image_lib->clear();
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		// unlink($source_url);
		return($new_name);
	}

	function lakukan_upload_file($input_file,$folder,$tipe_extensi){
		$CI =& get_instance();
		$CI->load->library('upload');
		$fileData = array();
        // File upload script
        $CI->upload->initialize(array(
            'upload_path' => '.'.$folder,
            'overwrite' => false,
            'encrypt_name' => true,
            'allowed_types' => $tipe_extensi,
		));
		
		if ($CI->upload->do_upload($input_file)) {

			$data = $CI->upload->data(); // Get the file data
			$fileData[] = $data; // It's an array with many data
			// Interate throught the data to work with them
			foreach ($fileData as $file) {
				$file_data = $file;
			}

			$response['success'] = TRUE;
			$response['original_name'] = $file_data['orig_name'];
			$response['message'] = "Berhasil Upload File : ".$file_data['orig_name'];
			$response['file_name'] = $file_data['file_name'];
		} else {
			$response['success'] = FALSE;
			$response['message'] = $CI->upload->display_errors();
			$response['file_name'] = "";
		}
		return $response;
	}
	
	function lakukan_upload_file_dokumen($new_name,$input_file,$folder,$tipe_extensi){
		$CI =& get_instance();
		$CI->load->library('upload');
		$fileData = array();
        // File upload script
        $CI->upload->initialize(array(
            'upload_path' => '.'.$folder,
            'overwrite' => false,
            'encrypt_name' => true,
            'allowed_types' => $tipe_extensi,
		));
		
		if ($CI->upload->do_upload($input_file)) {

			$data = $CI->upload->data(); // Get the file data
			$fileData[] = $data; // It's an array with many data
			// Interate throught the data to work with them
			foreach ($fileData as $file) {
				$file_data = $file;
			}

			$response['success'] = TRUE;
			$response['original_name'] = $file_data['orig_name'];
			$response['message'] = "Berhasil Upload File : ".$file_data['orig_name'];
			$response['file_name'] = $new_name.'_'.$file_data['file_name'];
		} else {
			$response['success'] = FALSE;
			$response['message'] = $CI->upload->display_errors();
			$response['file_name'] = "";
		}
		return $response;
	}
	
	function upload_multiple(){
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
 
        $this->load->library('upload',$config);
        for ($i=1; $i <=5 ; $i++) { 
            if(!empty($_FILES['filefoto'.$i]['name'])){
                if(!$this->upload->do_upload('filefoto'.$i))
                    $this->upload->display_errors();  
                else
                    echo "Foto berhasil di upload";
            }
        }
                 
	}
	
	function lakukan_upload_file_mobile_objek($foto,$folder,$tipe_extensi){
		$CI                       =& get_instance();
		if($foto!=""){
			$image = base64_decode($foto);

			$new_name = 'mobile';
			$filename = $new_name . '_' . md5(uniqid(rand(), true)) . '.' . 'png';
			$path = '.' . $folder;
			file_put_contents($path . $filename, $image);
			return $filename;
		}else{
			return "";
		}
	}

	function upload_file_mobile_objek_nonbase64($foto,$folder,$tipe_extensi){
		$CI                       =& get_instance();
		$foto = ($CI->input->post($input_file) != "") ? $CI->input->post($input_file) : "";
		if($foto!=""){
			$image = $foto;

			$new_name = 'mobile';
			$filename = $new_name . '_' . md5(uniqid(rand(), true)) . '.' . 'png';
			$path = '.' . $folder;
			file_put_contents($path . $filename, $image);
			return $filename;
		}else{
			return "";
		}
	}

	function generate_barcode($kode,$folder){
		if($kode!=""){
			$new_name = 'BARCODE';
			$filename = $new_name . '_' . $kode . '_' . md5(uniqid(rand(), true)) . '.' . 'jpg';

			$path = $folder;
			$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
			file_put_contents($path . $filename, $generator->getBarcode($kode, $generator::TYPE_CODE_128));	
			return $filename;
		}else{
			return "";
		}
	}
?>