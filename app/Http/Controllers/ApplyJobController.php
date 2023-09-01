<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Jobs;
use App\Models\Notifications;
use App\Models\User;
use App\Models\ApplyJob;
use App\Models\EmailSender;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Response;

class ApplyJobController extends Controller
{

    public function htmlPageUser($cvFile,$userName,$userEmail,$jobPosition)
    {
        $html = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns:v="urn:schemas-microsoft-com:vml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

            <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">


            <title>Material Design for Bootstrap</title>

            <style type="text/css">
            body {
                width: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                mso-margin-top-alt: 0px;
                mso-margin-bottom-alt: 0px;
                mso-padding-alt: 0px 0px 0px 0px;
            }
            p,
            h1,
            h2,
            h3,
            h4 {
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }

            span.preheader {
                display: none;
                font-size: 1px;
            }
            
            html {
                width: 100%;
            }
            
            table {
                font-size: 14px;
                border: 0;
            }

            @media only screen and (max-width: 640px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 20px !important;
                }
                .main-section-header {
                    font-size: 28px !important;
                }
                .show {
                    display: block !important;
                }
                .hide {
                    display: none !important;
                }
                .align-center {
                    text-align: center !important;
                }
                .no-bg {
                    background: none !important;
                }
                /*----- main image -------*/
                .main-image img {
                    width: 440px !important;
                    height: auto !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 440px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 440px !important;
                }
                .container580 {
                    width: 400px !important;
                }
                .main-button {
                    width: 220px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 320px !important;
                    height: auto !important;
                }
                .team-img img {
                    width: 100% !important;
                    height: auto !important;
                }
            }

            @media only screen and (max-width: 479px) {
                /*------ top header ------ */
                .main-header {
                    font-size: 18px !important;
                }
                .main-section-header {
                    font-size: 26px !important;
                }
                /* ====== divider ====== */
                .divider img {
                    width: 280px !important;
                }
                /*-------- container --------*/
                .container590 {
                    width: 280px !important;
                }
                .container590 {
                    width: 280px !important;
                }
                .container580 {
                    width: 260px !important;
                }
                /*-------- secions ----------*/
                .section-img img {
                    width: 280px !important;
                    height: auto !important;
                }
            }
        </style>

        <style type=”text/css”>
        body {
        font-family: arial, sans-serif!important;
        }
        </style>

        </head>
        <body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!-- pre-header -->
    <table style="display:none!important;">
        <tr>
            <td>
                <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                    
                </div>
            </td>
        </tr>
    </table>
    <!-- pre-header end -->
    <!-- header -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">

                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                                <tr>
                                    <td align="center" height="70" style="height:70px;">
                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100%" border="0" style="display: block; width: 100px;" src="https://neptune.link/images/header2.png" alt="" /></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- end header -->

    <!-- big image section -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>

                        <td align="center" class="section-img">
                            <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img (67).jpg" style="display: block; width: 590px;" width="590" border="0" alt="" /></a>




                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">


                            <div style="line-height: 35px">

                                Hello, <span style="color: #5caad2;">'. $userName . ' has applied for '. $jobPosition . ' at Talent and Jobs</span>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                <tr>
                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="center" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">


                                        <div style="line-height: 24px">

                                            Username :  ' .$userName .' <br>
                                            Useremail : '. $userEmail.' <br>
                                            Applied Job Position : '.$jobPosition.'
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="center" style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 26px;">


                                        <div style="line-height: 26px;">
                                            <a href=https://api.talentandjobs.com/public/profile_images/'.$cvFile.' style="color: #ffffff; text-decoration: none;">CV Data</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
                    </tr>


                </table>

            </td>
        </tr>

    </table>
    <!-- end section -->

    <!-- contact section -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr class="hide">
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>
        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>

        <tr>
            <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">

                    <tr>
                        <td>
                            <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <!-- logo -->
                                    <td align="left">
                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px;" src="https://neptune.link/images/footer.png" alt="" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="color: #888888; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">

                                            Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: "Hind Siliguri", Calibri, Sans-serif; font-weight: 400;">contact@mdbootstrap.com</a>

                                        </div>
                                    </td>
                                </tr>

                            </table>

                            <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                </tr>
                            </table>

                            <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                </tr>



                                <tr>
                                    <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" align="right" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <a href="https://www.facebook.com/mdbootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href="https://twitter.com/MDBootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href="https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
        </tr>

    </table>
    <!-- end section -->

    <!-- footer ====== -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">

        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center">

                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                    <tr>
                        <td>
                            <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
                                        <div style="line-height: 24px;">

                                            <span style="color: #333333;">Talent & Jobs Co., LTD. All Rights Reserved</span>

                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                            </table>

                            <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <td align="center">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    Design By 
                                                    <a style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;" href="https://neptunemm.com/">neptunemm</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>

    </table>
    <!-- end footer ====== -->

    </body>

    </html>        
        ';

    return $html;
    }

            public function htmlPage($cvFile,$userName,$userEmail,$jobPosition)
            {
                $html = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns:v="urn:schemas-microsoft-com:vml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">


                    <title>Material Design for Bootstrap</title>

                    <style type="text/css">
                    body {
                        width: 100%;
                        background-color: #ffffff;
                        margin: 0;
                        padding: 0;
                        -webkit-font-smoothing: antialiased;
                        mso-margin-top-alt: 0px;
                        mso-margin-bottom-alt: 0px;
                        mso-padding-alt: 0px 0px 0px 0px;
                    }
                    p,
                    h1,
                    h2,
                    h3,
                    h4 {
                        margin-top: 0;
                        margin-bottom: 0;
                        padding-top: 0;
                        padding-bottom: 0;
                    }

                    span.preheader {
                        display: none;
                        font-size: 1px;
                    }
                    
                    html {
                        width: 100%;
                    }
                    
                    table {
                        font-size: 14px;
                        border: 0;
                    }

                    @media only screen and (max-width: 640px) {
                        /*------ top header ------ */
                        .main-header {
                            font-size: 20px !important;
                        }
                        .main-section-header {
                            font-size: 28px !important;
                        }
                        .show {
                            display: block !important;
                        }
                        .hide {
                            display: none !important;
                        }
                        .align-center {
                            text-align: center !important;
                        }
                        .no-bg {
                            background: none !important;
                        }
                        /*----- main image -------*/
                        .main-image img {
                            width: 440px !important;
                            height: auto !important;
                        }
                        /* ====== divider ====== */
                        .divider img {
                            width: 440px !important;
                        }
                        /*-------- container --------*/
                        .container590 {
                            width: 440px !important;
                        }
                        .container580 {
                            width: 400px !important;
                        }
                        .main-button {
                            width: 220px !important;
                        }
                        /*-------- secions ----------*/
                        .section-img img {
                            width: 320px !important;
                            height: auto !important;
                        }
                        .team-img img {
                            width: 100% !important;
                            height: auto !important;
                        }
                    }

                    @media only screen and (max-width: 479px) {
                        /*------ top header ------ */
                        .main-header {
                            font-size: 18px !important;
                        }
                        .main-section-header {
                            font-size: 26px !important;
                        }
                        /* ====== divider ====== */
                        .divider img {
                            width: 280px !important;
                        }
                        /*-------- container --------*/
                        .container590 {
                            width: 280px !important;
                        }
                        .container590 {
                            width: 280px !important;
                        }
                        .container580 {
                            width: 260px !important;
                        }
                        /*-------- secions ----------*/
                        .section-img img {
                            width: 280px !important;
                            height: auto !important;
                        }
                    }
                </style>

                <style type=”text/css”>
                body {
                font-family: arial, sans-serif!important;
                }
                </style>

                </head>
                <body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
            <!-- pre-header -->
            <table style="display:none!important;">
                <tr>
                    <td>
                        <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                            
                        </div>
                    </td>
                </tr>
            </table>
            <!-- pre-header end -->
            <!-- header -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                            <tr>
                                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center">

                                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                                        <tr>
                                            <td align="center" height="70" style="height:70px;">
                                                <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100%" border="0" style="display: block; width: 100px;" src="https://neptune.link/images/header2.png" alt="" /></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- end header -->

            <!-- big image section -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                            <tr>

                                <td align="center" class="section-img">
                                    <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img (67).jpg" style="display: block; width: 590px;" width="590" border="0" alt="" /></a>




                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">


                                    <div style="line-height: 35px">

                                        Hi Talent & Jobs, <span style="color: #5caad2;">'. $userName . ' has applied for '. $jobPosition . '</span>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center">
                                    <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                        <tr>
                                            <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center">
                                    <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                        <tr>
                                            <td align="center" style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">


                                                <div style="line-height: 24px">

                                                    Username :  ' .$userName .' <br>
                                                    Useremail : '. $userEmail.' <br>
                                                    Applied Job Position : '.$jobPosition.'
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center">
                                    <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                                        <tr>
                                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td align="center" style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 26px;">


                                                <div style="line-height: 26px;">
                                                    <a href=https://api.talentandjobs.com/public/profile_images/'.$cvFile.' style="color: #ffffff; text-decoration: none;">CV Data</a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>


                        </table>

                    </td>
                </tr>

            </table>
            <!-- end section -->

            <!-- contact section -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

                <tr class="hide">
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>
                <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                </tr>

                <tr>
                    <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">

                            <tr>
                                <td>
                                    <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                        <tr>
                                            <!-- logo -->
                                            <td align="left">
                                                <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px;" src="https://neptune.link/images/footer.png" alt="" /></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="color: #888888; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 23px;" class="text_color">
                                                <div style="color: #333333; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">

                                                    Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: "Hind Siliguri", Calibri, Sans-serif; font-weight: 400;">contact@mdbootstrap.com</a>

                                                </div>
                                            </td>
                                        </tr>

                                    </table>

                                    <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                        <tr>
                                            <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                        </tr>
                                    </table>

                                    <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                        <tr>
                                            <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                        </tr>



                                        <tr>
                                            <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table border="0" align="right" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <a href="https://www.facebook.com/mdbootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td>
                                                            <a href="https://twitter.com/MDBootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td>
                                                            <a href="https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
                </tr>

            </table>
            <!-- end section -->

            <!-- footer ====== -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">

                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                            <tr>
                                <td>
                                    <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                        <tr>
                                            <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
                                                <div style="line-height: 24px;">

                                                    <span style="color: #333333;">Talent & Jobs Co., LTD. All Rights Reserved</span>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                        <tr>
                                            <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                        </tr>
                                    </table>

                                    <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                        <tr>
                                            <td align="center">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td align="center">
                                                            Design By 
                                                            <a style="font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;" href="https://neptunemm.com/">neptunemm</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>

            </table>
            <!-- end footer ====== -->

            </body>

            </html>        
                ';

            return $html;
            }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_apply_job = ApplyJob::with('ApplyJobdesignation','ApplyJobdesignation','ApplyJobUserModel','ApplyJobListModel','ApplyJobListModel.jobsmodel','ApplyJobListModel.jobscategoriesmodel')->get();
        $applyJobs = ApplyJob::with('ApplyJobdesignation','job', 'userApply','job.location','job.category')->orderBy('id', 'DESC')->get();
        return $applyJobs;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function sendMail($cvFile,$userName,$userEmail,$jobPosition,$email)
    {
        $htmlPage = $this->htmlPage($cvFile,$userName,$userEmail,$jobPosition);
        $mail = new PHPMailer();
        // configure an SMTP
        $mail->isSMTP();
        $mail->Host = 'send.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'api';
        $mail->Password = 'cdebf2e48ba5c81d6ddc85055106e4bb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('mailtrap@neptunemm.com', 'Talent&Jobs Application Form');
        $mail->addAddress($email, 'user');
        $mail->Subject = 'New Applied Job';
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->Body = $htmlPage;
        // $mail->Body = '<html>Hi there, we are happy to <br>confirm your booking.</br> Please check the document in the attachment.</html>';
        // $mail->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';
        // add attachment
       
        // send the message
        if(!$mail->send()){
            return response()->json([
                'status' => 'Error',
            ]);
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return response()->json([
                'status' => 'success',
                'dd' => "sent"
            ]);
            // echo 'Message has been sent';
        }

    }

    public function sendMailUser($cvFile,$userName,$userEmail,$jobPosition,$email)
    {
        $htmlPage = $this->htmlPageUser($cvFile,$userName,$userEmail,$jobPosition);
        $mail = new PHPMailer();
        // configure an SMTP
        $mail->isSMTP();
        $mail->Host = 'send.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'api';
        $mail->Password = 'cdebf2e48ba5c81d6ddc85055106e4bb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        $mail->setFrom('mailtrap@neptunemm.com', 'You Successfully Applied for a job');
        $mail->addAddress($email, 'user');
        $mail->Subject = 'You Successfully aplied for a job at Talent&Jobs';
        // Set HTML
        $mail->isHTML(TRUE);
        $mail->Body = $htmlPage;
        // $mail->Body = '<html>Hi there, we are happy to <br>confirm your booking.</br> Please check the document in the attachment.</html>';
        // $mail->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';
        // add attachment
       
        // send the message
        if(!$mail->send()){
            return response()->json([
                'status' => 'Error',
            ]);
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return response()->json([
                'status' => 'success',
                'dd' => "sent"
            ]);
            // echo 'Message has been sent';
        }

    }

    // public function sendMail(){
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://send.api.mailtrap.io/api/send',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS =>'{"from":{"email":"mailtrap@neptunemm.com","name":"Mailtrap Test"},"to":[{"email":"thihanhein@neptunemm.com"}],"subject":"You are awesome!","text":"Congrats for sending test email with Mailtrap!","headers":{"X-MT-Category":"Integration Test"}}',
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Bearer cdebf2e48ba5c81d6ddc85055106e4bb',
    //             'Content-Type: application/json'
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     echo $response;
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($userid,$jobid,Request $request)
    {
        // \Mail::to("micaljohn60@gmail.com")->send(new SendMail("test"));
        $alreadyApplied = ApplyJob::where([["user_id",$userid],["job_id",$jobid]])->first();
        if ($alreadyApplied === null) {
            $user_id = User::findOrfail($userid);
            
            $job_list = Jobs::findorfail($jobid);
            
            $job_lists = Jobs::with('location','category')->where('id',$jobid)->get();
            $applyjob= ApplyJob::create([
                'user_id' => $user_id->id,
                'job_id' => $job_list->id,
            ]);

            Notifications::create([
                'title' => "You Successfully Applied for " . $job_list->job_title,
                'body'  => "You Successfully applied for a job. Don't forget to check your email",
                'user_id' =>  $user_id->id,     
                'job_id' => $job_list->id   
            ]);

            $email = EmailSender::where('id',$job_list->email_receiver)->first();

            
            $get_login_user_email = $user_id->email;
        
            //\Mail::to("micaljohn60@gmail.com")->send(new SendMail($job_lists));
            if($applyjob){

            $this->sendMail($user_id->cv_file,$user_id->name,$user_id->email,$job_list->job_title,$email->sender_email);
            $this->sendMailUser($user_id->cv_file,$user_id->name,$user_id->email,$job_list->job_title,$user_id->email);

                return response()->json([
                    'status' => 'success',
                    
                ]);
            }
         }
         else{
            return  Response::json([
                'message ' => "Already Applied Job"
            ],404);
         }
        
    }

 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        $applyJobs = ApplyJob::with('ApplyJobdesignation','job', 'userApply','job.location','job.category')->where('id',$id)->first();
        return $applyJobs;
    }
    public function read($id)
    {
        $jobApply = ApplyJob::findOrFail($id);
        $jobApply->isRead = true;
        $jobApply->save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


        ApplyJob::where('id',$id)->delete();
        
        return [
            'success' => 'Deleted Successful'
        ];
    }



}
