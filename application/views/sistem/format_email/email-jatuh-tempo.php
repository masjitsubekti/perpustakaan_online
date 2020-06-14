<?php 
    date_default_timezone_set('Asia/Jakarta');
    $hari = date('D');
    $tgl = date('Y-m-d');
?>
<html>
<head>
	<style>
		.banner-color {
			background-color: #eb681f;
		}
		.title-color {
			color: #0066cc;
		}
		.button-color {
			border: 3px solid #0652DD;
      color:#0652DD;
		}
    .button-color:hover {
      background:#0652DD;
      color:white;
      cursor:pointer;
    }
		@media screen and (min-width: 500px) {
      .banner-color {
        background-color: #0066cc;
      }
			.title-color {
				color: #eb681f;
			}
			.button-color {
				border: 3px solid #0652DD;
        color:#0652DD;
			}
      .button-color:hover {
        background:#0652DD;
        color:white;
        cursor:pointer;
      }
		}
	</style>
</head>
<body>
	<div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
			<tbody>
				<tr>
					<td align="center">
						<center style="width:100%">
							<table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0"
								style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif"
								width="512">
								<tbody>
									<tr>
										<td bgcolor="#F3F3F3" width="100%"
											style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
											<table border="0" cellspacing="0" cellpadding="0"
												style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important"
												width="100%">
												<tbody>
													<tr>
														<td align="left" valign="middle" width="50%"><span
																style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"><?=$nama_sistem?></span>
														</td>
														<td valign="middle" width="50%" align="right"
															style="padding:0 0 0 10px"><span
																style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"><?=get_hari($hari)?>, <?=tgl_indo($tgl)?></span></td>
														<td width="1">&nbsp;</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left">
											<table border="0" cellspacing="0" cellpadding="0"
												style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
												width="100%">
												<tbody>
													<tr>
														<td width="100%">
															<table border="0" cellspacing="0" cellpadding="0"
																style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
																width="100%">
																<tbody>
																	<tr>
																		<td align="center" bgcolor="#8BC34A"
																			style="padding:20px 48px;color:#ffffff"
																			class="banner-color">
																			<table border="0" cellspacing="0"
																				cellpadding="0"
																				style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
																				width="100%">
																				<tbody>
																					<tr>
																						<td align="center" width="100%">
																							<h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">
                                                Jatuh Tempo Peminjaman
                                              </h1>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td align="center"
																			style="padding:20px 0 10px 0">
																			<table border="0" cellspacing="0"
																				cellpadding="0"
																				style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
																				width="100%">
																				<tbody>
																					<tr>
																						<td align="center" width="100%"
																							style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
																							<h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;"
																								class="title-color">Hi <?=$nama?>,</h3>
																							<p
																								style="font-size: 14px;text-align: left; color:#212121; font-weight: 400; font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">Berikut ini adalah data buku yang anda pinjam dan batas peminjaman akan berakhir pada tanggal <?= tgl_indo($data_pinjam['tgl_kembali']) ?> : </b></p>
                                              <table class="table table-centered table-nowrap" style="font-size: 13.5px; color:#212121; font-weight: 400; font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:15%;">
                                                          ID Anggota
                                                        </td>
                                                        <td style="width:3%;"> : </td>
                                                        <td style="width:30%;">
                                                          <?= $data_pinjam['id_anggota'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:15%;">
                                                          Nama
                                                        </td>
                                                        <td style="width:3%;"> : </td>
                                                        <td style="width:30%;">
                                                          <?= $data_pinjam['nama_anggota'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:15%;">
                                                          Kode Buku
                                                        </td>
                                                        <td style="width:3%;"> : </td>
                                                        <td style="width:30%;">
                                                          <?= $data_pinjam['kode_buku'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:15%;">
                                                          Judul
                                                        </td>
                                                        <td style="width:3%;"> : </td>
                                                        <td style="width:30%;">
                                                          <?= $data_pinjam['judul'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                          Tanggal Pinjam
                                                        </td>
                                                        <td> : </td>
                                                        <td>
                                                          <?= tgl_indo($data_pinjam['tgl_pinjam']) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                          Tanggal Kembali
                                                        </td>
                                                        <td> : </td>
                                                        <td>
                                                          <?= tgl_indo($data_pinjam['tgl_kembali']) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                          Terlambat
                                                        </td>
                                                        <td> : </td>
                                                        <td>
                                                          <?= $data_pinjam['terlambat'] ?> Hari
                                                        </td>
                                                    </tr> 
                                                    <tr>
                                                        <td>
                                                          Denda
                                                        </td>
                                                        <td> : </td>
                                                        <td>
                                                          Rp <?= ($data_pinjam['denda']!="") ? number_format($data_pinjam['denda']) : 0 ?>
                                                        </td>
                                                    </tr> 
                                                    <tr>
                                                        <td>
                                                          Catatan
                                                        </td>
                                                        <td> : </td>
                                                        <td>
                                                          <?= ($catatan!="") ? $catatan : "-" ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                              </table>
                                              <p
																								style="font-size: 14px;text-align: left; color:#212121; font-weight: 400; font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;">Silahkan tekan login sekarang untuk melihat detail peminjaman anda. </b></p>
                                              
                                              <div style="font-weight: 200; text-align: center; margin: 25px;">
																								<a href="<?=$root_apl?>" style="padding:0.6em 1em;border-radius:600px;font-size:14px;text-decoration:none;font-weight:bold"
																									class="button-color">Login Sekarang</a>
																							</div>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																	<tr>
																	</tr>
																	<tr>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left">
											<table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0"
												style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif"
												width="100%">
												<tbody>
													<tr>
														<td align="center" width="100%">
															<table border="0" cellspacing="0" cellpadding="0"
																style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
																width="100%">
																<tbody>
																	<tr>
																		<td align="center" valign="middle" width="100%"
																			style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">
																			Hormat,
																			<br><b><?=$nama_sistem?></b>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td align="center" width="100%">
															<table border="0" cellspacing="0" cellpadding="0"
																style="font-weight:200;font-family:Helvetica,Arial,sans-serif"
																width="100%">
																<tbody>
                                  <tr>
                                    <td  style="padding-bottom:10px 0px;;">
                                      <small style="font-weight:200;font-family:Helvetica,Arial,sans-serif;font-size:8pt;color:#2C3A47">Keterangan : Abaikan email ini jika Anda tidak merasa melakukan peminjaman buku.</small>
                                    </td>
                                  </tr>
																	<tr>
																		<td align="center" style="padding:0 0 20px 0"
																			width="100%"></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
