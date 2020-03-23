<?php //echo "<pre>"; echo $fname; exit;  ?>
<table style="padding:10px 0 25px 0;margin:0 auto" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center">
	<tbody>
		<tr>
			<td width="600" valign="top"><table style="margin:0 auto" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="e8e8e8" align="center">
					<tbody>
						<tr>
							<td width="100%"><table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="e8e8e8" align="center">
									<tbody>
										<tr>
											<td style="width:600px;background-color:#e8e8e8">
												<a href="" style="text-decoration:none;color:#010101" target="_blank" >
												<?php $logo = $this->common->get_one_value('tblsetting',array('SettingKey'=>'FrontEnd_Logo'),'SettingValue'); ?> 
											<img height="30px" src="<?= LOGOPATH.$logo ?>" style="margin:0 auto;padding:30px 10px 0px 10px;display:block;background-color:#e8e8e8;color:#010101" border="0">
											</a> </td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width:570px;background-color:#e8e8e8" align="center">
								<table style="width:550px;padding:10px;background-color:#e8e8e8;margin:0 auto" cellspacing="0" cellpadding="0" align="center">
									<tbody>
										<tr>
											<td style="width:550px;background-color:#ffffff;border-top:1px solid #bbbaba;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;border-radius:5px 5px 0px 0px;">
												<h3 style="color: #999999;margin-top:20px;padding-left: 10px"> Hello <?= $fname." ".$lname ?>, </h3> 
											</td>
										</tr>
										<tr>
											<td style="width:550px;background-color:#ffffff;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;">
												<p style="text-align: center;color: #999999;">Successfully Registered </p>
											</td>
										</tr>
										
										<tr>
											<td style="width:550px;background-color:#ffffff;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;">
												<hr style="text-align:center;width:65%;" /> 
											</td>
										</tr>
										
										<tr>
											<td style="width:548px;border-bottom:1px solid #bbbaba;border-left:1px solid #bbbaba;border-right:1px solid #bbbaba;border-radius:0px 0px 5px 5px;background-color:#ffffff" align="center">
												<table cellspacing="0" cellpadding="0" align="center">
												<tbody>
													<tr>
														<td style="width:478px;padding:10px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center"> You can log in at the following URL: <a href="<?php echo base_url('login'); ?>">Click Here to Login</a></td>
													</tr>
                                                    <tr>
														<td style="width:478px;padding:10px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center">Thank you,<br /></td>
													</tr>
													<tr>
														<td style="width:498px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center">&nbsp;</td>
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
			</td>
		</tr>
	</tbody>
</table>