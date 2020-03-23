<?php ?>
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
											<img src="<?= base_url(LOGOPATH.$logo) ?>" style="margin:0 auto;padding:30px 10px 0px 10px;display:block;background-color:#e8e8e8;color:#010101" border="0">
											</a> </td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="width:570px;background-color:#e8e8e8" align="center"><table style="width:550px;padding:10px;background-color:#e8e8e8;margin:0 auto" cellspacing="0" cellpadding="0" align="center">
									<tbody>
										<tr>
											<td style="width:550px;background-color:#ffffff;border-top:1px solid #bbbaba;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;border-radius:5px 5px 0px 0px;">
												<h3 style="color: #999999;margin-top:20px;padding-left: 10px"> Hello Admin , </h3> 
											</td>
										</tr>
										<tr>
											<td style="width:550px;background-color:#ffffff;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;">
												<p style="text-align: center;color: #999999;">Your Current Password is :: <?= $password ?></p>
											</td>
										</tr>
										<tr>
											<td style="width:550px;background-color:#ffffff;border-right:1px solid #bbbaba;border-left:1px solid #bbbaba;">
												<hr style="text-align:center;width:65%;" /> 
											</td>
										</tr>
										
										<tr>
											<td style="width:548px;border-bottom:1px solid #bbbaba;border-left:1px solid #bbbaba;border-right:1px solid #bbbaba;border-radius:0px 0px 5px 5px;background-color:#ffffff" align="center"><table cellspacing="0" cellpadding="0" align="center">
													<tbody>
														<tr>
															<td style="width:478px;padding:10px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center"> You can log in at the following URL: <a href="<?php echo base_url(ADMIN); ?>">Click Here to Login</a></td>
														</tr>
                                                        <tr>
															<td style="width:478px;padding:10px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center">For any query give us a call on <a href="tel:<?php echo $config['MobileNumber']; ?>" style="text-decoration:none;color:#646464" target="_blank"><?php echo $config['MobileNumber']; ?></a> or email <a href="mailto:<?php echo $config['EmailAddress']; ?>"><?php echo $config['EmailAddress']; ?></a></td>
														</tr>
                                                        <tr>
															<td style="width:478px;padding:10px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center">Thank you,<br />Triipster</td>
														</tr>
														<tr>
															<td style="width:498px;font-size:14px;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#ffffff;color:#999999" align="center">&nbsp;</td>
														</tr>
													</tbody>
												</table></td>
										</tr>
									</tbody>
								</table></td>
						</tr>
						<tr>
							<td style="width:600px;background-color:#e8e8e8" align="center"><table style="width:100%;max-width:600px;padding:10px 0 10px 0;margin:0px auto;border-spacing:0" cellspacing="0" cellpadding="0" align="center">
									<tbody>
										<tr>
											<td style="border-collapse:collapse;text-align:center;font-size:0"><table style="width:300px;vertical-align:top;display:inline-block;float:none" cellspacing="0" cellpadding="0" align="left">
													<tbody>
														<tr>
															<td style="padding:10px 20px 10px 20px;font-size:13px;font-weight:bold;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#e8e8e8;color:#3f474e" align="left">Follow Us On</td>
														</tr>
														<tr>
															<td style="width:300px;border-collapse:collapse"><table style="width:300px;background:#e8e8e8;font-size:12px;margin:0 auto" cellspacing="0" cellpadding="0" align="center">
																<tbody>
																	<td style="width:60px;vertical-align:top;text-align:center;" ><a href="<?= $config['FacebookLink'] ?>" target="_blank" > <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/fb.png'); ?>" alt="Facebook" title="Facebook" style="padding:5px" width="29" height="29" border="0"> </a> </td>
																		<td style="width:60px;vertical-align:top;text-align:center;" ><a href="<?= $config['TwitterLink'] ?>" target="_blank" > <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/twitter.png'); ?>" alt="Twitter" title="Twitter" style="padding:5px" width="29" height="29" border="0"> </a> </td>
																		<td style="width:60px;vertical-align:top;text-align:center;" ><a href="<?= $config['GooglePlusLink'] ?>" target="_blank"> <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/google.png'); ?>" alt="Google" title="Google" style="padding:5px" width="29" height="29" border="0"> </a> </td>
																		<td style="width:60px;vertical-align:top;text-align:center" ><a href="<?= $config['YoutubeLink'] ?>" target="_blank"> <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/youtube.png'); ?>" alt="Youtube" title="Youtube" style="padding:5px" width="29" height="29" border="0"> </a> </td>
																		
																		<td style="width:60px;vertical-align:top;text-align:center" ><a href="<?= $config['LinkedinLink'] ?>" target="_blank" > <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/linkdin.png'); ?>" alt="Linkedin" title="Linkedin" style="padding:5px" width="29" height="29" border="0"> </a> </td>
																	</tr>
																</tbody>
															</table></td>
														</tr>
													</tbody>
												</table></td>
										</tr>
									</tbody>
								</table></td>
						</tr>
						<tr>
							<td style="width:600px;background-color:#e8e8e8" align="center"><table style="width:600px;padding-bottom:15px;margin:0 auto" cellspacing="0" cellpadding="0" align="center">
									<tbody>
										<tr>
											<td style="width:560px;padding:10px 20px 5px 20px;font-size:13px;font-weight:bold;font-family:Montserrat,arial,sans-serif;line-height:20px;text-align:center;vertical-align:top;background-color:#e8e8e8;color:#3f474e" align="left">For any further assistance:</td>
										</tr>
										<tr>
											<td style="border-collapse:collapse"><table style="width:290px;padding:5px;background:#e8e8e8;margin:0 auto" cellspacing="0" cellpadding="0" align="center">
													<tbody>
														<tr>
															<td style="width:18px;padding:0 3px 0px 0px;vertical-align:middle"><a href="" style="text-decoration:none;color:#010101" target="_blank"> <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/mail.png'); ?>" alt="Helpdesk"  width="18" height="14" border="0"> </a> </td>
															<td style="width:127px;padding:0 5px 0 0;font-family:Montserrat,Arial,sans-serif;font-size:10px;text-align:left;color:#646464;vertical-align:middle"><a href="mailto:<?php echo $config['EmailAddress']; ?>" style="text-decoration:none;color:#646464" target="_blank"><?php echo $config['EmailAddress']; ?></a> </td>
															<td style="width:18px;padding:0 3px 0px 0px;vertical-align:middle"><a href="tel:<?php echo $config['MobileNumber']; ?>" style="text-decoration:none;color:#646464" target="_blank"> <img src="<?php echo base_url(ASSETPATH.'plugins/mail/img/phone.png'); ?>" alt="Call" width="18" height="14" border="0"> </a> </td>
															<td style="width:101px;font-family:Montserrat,Arial,sans-serif;font-size:10px;text-align:left;color:#646464;vertical-align:middle"><a href="tel:<?php echo $config['MobileNumber']; ?>" style="text-decoration:none;color:#646464" target="_blank"><?php echo $config['MobileNumber']; ?></a> </td>
														</tr>
													</tbody>
												</table></td>
										</tr>
									</tbody>
								</table></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>