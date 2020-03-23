<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
        <title><?=$site_title?></title>
        <style type="text/css">

            body{width: 100%; background-color: #0d0b0c; margin:0; padding:0; -webkit-font-smoothing: antialiased;mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;}

            p,h1,h2,h3,h4{margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;}

            span.preheader{display: none; font-size: 1px;}

            html{width: 100%;}

            table{font-size: 12px;border: 0;}

            .menu-space{padding-right:25px;}

            a,a:hover { text-decoration:none; color:#FFF;}

            @media only screen and (max-width:640px){
                body {width:auto!important;}
                table [class=main] {width:440px !important;}
                table [class=two-left] {width:420px !important; margin:0px auto;}
                table [class=full] {width:100% !important; margin:0px auto;}
                table [class=two-left-inner] {width:400px !important; margin:0px auto;}
                table [class=menu-icon] { display:none;}
            }

            @media only screen and (max-width:479px) {
                body {width:auto!important;}
                table [class=main]  {width:310px !important;}
                table [class=two-left] {width:300px !important; margin:0px auto;}
                table [class=full] {width:100% !important; margin:0px auto;}
                table [class=two-left-inner] {width:280px !important; margin:0px auto;}
                table [class=menu-icon] { display:none;}
            }
        </style>
    </head>
    <body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <!--Main Table Start-->
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#0d0b0c">
            <tr>
                <td align="center" valign="top">
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
                        <tr>
                            <td height="100" align="center" valign="top" style="font-size:100px; line-height:100px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="330" align="center" valign="top" style="background:#363839; -moz-border-radius: 4px 4px 0px 0px; border-radius: 4px 4px 0px 0px;">
                                <table width="510" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left">
                                    <tr>
                                        <td height="40" align="left" valign="top" style="font-size:40px; line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <table width="105" border="0" align="left" cellpadding="0" cellspacing="0" class="full">
                                                <tr>
                                                    <td align="center" valign="top"><a href="#"><img editable="true" mc:edit="bm9-01" src="<?= LOGOPATH.getSiteSetting('FrontEnd_Logo'); ?>" alt="Offbeat" title="Offbeat" style="display:block" width="105" height="40"/></a></td>
                                                </tr>
                                            </table>
                                            <table border="0" align="right" cellpadding="0" cellspacing="0" class="full">
                                                <tr>
                                                    <td height="8" align="center" valign="top" style="font-size:8px; line-height:8px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFF; font-weight:bold;" mc:edit="bm9-02"><multiline>Hello! <?=isset($user_name) ? $user_name : '';?></multiline></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50" align="left" valign="top" style="font-size:50px; line-height:50px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left">
                                              
                                                <tr>
                                                    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#FFF; font-weight:normal; line-height:32px;" mc:edit="bm9-04"><multiline>Thanks For Your Sponsor School</multiline></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:25px; color:#FFF; font-weight:bold; text-transform:uppercase;" mc:edit="bm9-05"><multiline>payment success</multiline></td>
                                                </tr>
                                                <tr>
                                                    <td height="10" align="center" valign="top" style="font-size:10px; line-height:10px;">&nbsp;</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td align="left" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:15px; color:#FFF; font-weight:normal; line-height:24px; padding:0px 25px;" mc:edit="bm9-06"><multiline></multiline></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:15px; color:#FFF; font-weight:normal; line-height:24px; padding:0px 25px;" mc:edit="bm9-06"><multiline></multiline></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:15px; color:#FFF; font-weight:normal; line-height:24px; padding:0px 25px;" mc:edit="bm9-06">
                                                        <multiline>

                                                        Paymen method  : <span style="font-weight: bold;">
                                                            <?=$payment_method; ?><br>
                                                        Payment status : <span style="font-weight: bold;">
                                                            <?=$payment_status; ?><br>
                                                        Currency code : <span style="font-weight: bold;">
                                                            <?=$currency_code; ?><br>
                                                        Payment gross : <span style="font-weight: bold;">
                                                            <?=$payment_gross; ?><br>
                                                        Transaction Id : <span style="font-weight: bold;">
                                                            <?=$txn_id; ?><br>
                                                            
                                                        </span>
                                                    </multiline></td>
                                                </tr>
                                                <tr>
                                                    <td height="40" align="center" valign="top">&nbsp;</td>
                                                </tr>
                                             
                                                <tr>
                                                    <td height="80" align="center" valign="top">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top" style="background:#FFF;">
                                <table width="380" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left">
                                    <tr>
                                        <td height="45" align="center" valign="top" style="font-size:45px; line-height:45px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="15" align="center" valign="top" style="font-size:15px; line-height:15px;">&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; font-weight:bold; line-height:28px;" mc:edit="bm9-14"><multiline>Copyright &copy; 2019 <?=getSiteSetting('FrontEnd_Title')?>.</multiline></td>
                                    </tr>
                                    <tr>
                                        <td height="30" align="center" valign="top" style="font-size:30px; line-height:30px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="100" align="center" valign="top" style="font-size:100px; line-height:100px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--Main Table End-->
    </body>
</html>