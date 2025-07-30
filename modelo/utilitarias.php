<?php

function enviarEmail($destino, $asunto, $mensaje, $adjunto = array(), $area = 0, $segundointento = false)
{
    include_once dirname(__DIR__) . '/includes/PHPMailer/src/Exception.php';
    include_once dirname(__DIR__) . '/includes/PHPMailer/src/PHPMailer.php';
    include_once dirname(__DIR__) . '/includes/PHPMailer/src/SMTP.php';
    $_SESSION['erroremail'] = '';
    if (empty($destino)) {
        return $_SESSION['erroremail'] = 'Correo vacio.' . $_SESSION['modulo'];
    }
    $_SESSION['modulo'] = 'correo';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->PluginDir = 'phpmailer/';
    $mail->SetLanguage("es", 'phpmailer/language/');

    if (!defined('SERVER_EMAIL_HOST') || !defined('SERVER_EMAIL_PORT') || !defined('SERVER_EMAIL_USERNAME') || !defined('SERVER_EMAIL_PASSWORD') || !defined('NOMBRE_ADM_PLATAFORMA') || !defined('EMAIL_ADM_PLATAFORMA')) {
        return 'No se ha configurado el servicio SMTP';
    }
    try {
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        if ($segundointento && TIPO_AMBIENTE != 'pruebas') {
            $mail->Host = 'mail.latincoop.com';
            $mail->Username = '_mainaccount@latincoop.com';
            $mail->Password = '2@K8M56YPUo#XuD^NWsZxv';
            $mail->Port = 'ssl';
        } else {
            $mail->Username = SERVER_EMAIL_USERNAME;
            $mail->Password = SERVER_EMAIL_PASSWORD;
            $mail->Host = SERVER_EMAIL_HOST;
            $mail->Port = SERVER_EMAIL_PORT;
        }
        if (SERVER_EMAIL_SECURE != '' && defined('SERVER_EMAIL_SECURE')) {
            $mail->SMTPSecure = SERVER_EMAIL_SECURE;
        }
        $mail->From = EMAIL_ADM_PLATAFORMA;
        $mail->FromName = NOMBRE_ADM_PLATAFORMA;
        //
        if (TIPO_AMBIENTE == 'pruebas') {
            $mail->AddAddress('jhonatan.soporte98@gmail.com');
        } else {
            if (is_array($destino)) {

                foreach (array_unique($destino) as $dest) {
                    if (!empty($dest)) {
                        $dest = trim($dest);
                        $dest = str_replace(" ", "", $dest);
                        $mail->AddAddress($dest);
                    }
                }
            } else {
                if (!empty($destino)) {
                    $destino = trim($destino);
                    $destino = str_replace(" ", "", $destino);
                    $mail->AddAddress($destino);
                }
            }
        }
        $mail->WordWrap = 50;
        if (!empty($adjunto)) {
            foreach ($adjunto as $attach) {
                $mail->AddAttachment($attach);
            }
        }
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $asunto = "=?UTF-8?B?" . base64_encode($asunto) . "=?=";
        $mail->Subject = $asunto;
        if (!$segundointento) {
            switch ($area) {
                case 2:
                    //arelis
                    $mensaje .= '<img src="https://www.asociado.latincoop.com/vista/assets/img/footermail.png" />';
                    break;
                case 0:
                    $mensaje .= '<h4>Cordialmente, <br>Sistema de registro<br><br>Derechos reservados &#169; Latincoop</h4>' . footerEmail();
                    break;

                default:
                    $mensaje .= '';
                    break;
            }
        }
        $mail->Body = $mensaje;

        if (!$mail->Send()) {
            if ($segundointento) {
                return $_SESSION['erroremail'] = '1-Error enviando el recibo al email. Detalle del error => ' . $mail->ErrorInfo . ' \n';
            } else {
                return enviarEmail($destino, $asunto, $mensaje, $adjunto, $area, true);
            }
        } else {
            return true;
        }
    } catch (Exception $e) {
        if ($segundointento) {
            return $_SESSION['erroremail'] = '2-Error enviando el email. Detalle del error => ' . $mail->ErrorInfo . '\n';
        } else {
            return enviarEmail($destino, $asunto, $mensaje, $adjunto, $area, true);
        }
    }
}
