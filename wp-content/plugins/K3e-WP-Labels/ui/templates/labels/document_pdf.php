<?php

//namespace k3e\ui\templates\growlist;

use TCPDF;

$filename = !empty(htmlentities($_POST['Labels']['document_pdf_name'])) ? htmlentities($_POST['Labels']['document_pdf_name']) : 'labels_' . date('Y-m-d_H:i:s');
$comment = !empty(htmlentities($_POST['Labels']['document_pdf_comment'])) ? htmlentities($_POST['Labels']['document_pdf_comment']) : '';
global $current_user;

// create new PDF document
$pdf = new TCPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($current_user->display_name);
$pdf->SetTitle($filename);
$pdf->SetSubject(__('Arkusz etykiet', 'k3e'));
$pdf->SetKeywords(__('labels', 'k3e'));

// set default header data
$pdf->SetHeaderData(null, null, $filename, null, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array('dejavusans', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 7, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

$content = '<table border="1" cellspacing="2" style="width:100%;">';

$labels = json_decode(get_option('_pdf_labels'));

$j = 0;
$sum = 0;
$height = 0;
foreach ($labels as $rows) {
    $content .= '<tr>';
    foreach ($rows as $cols) {
        $array = get_object_vars($cols);
        $content .= '<td style="width: ' . ( $cols->SIZE == '1' ? 76 : 152 ) . 'px; height: ' . $cols->HEIGHT . 'px; text-align: center;">';
        $line1 = reset($array);
        if ($line1 != "") {
            if($cols->SIZE == '1') { 
                $content .= '<span style="font-weight: bold; font-variant: small-caps; font-size: 9px;">' . $line1 . '</span><br>_______________<br>';
            } else {
            $content .= '<span style="font-weight: bold; font-variant: small-caps; font-size: 12px;">' . $line1 . '</span><br>_______________<br>';
            }
        } 
        
        $content .= $cols->LINE2 . '<br>';
        $content .= '<small>' . $cols->LINE3 . '</small>';
        $content .= '</td>';
    }
    $height += $cols->HEIGHT;

    $content .= '</tr>';
    if ($height >= 720) {
        $height = 0;
        $content .= '<tr>';
        $content .= '<td style="height: ' . ($cols->SIZE == '3' ? 130 : 10) . 'px; text-align: center;">';
        $content .= '</td>';
        $content .= '</tr>';
    }
}

$content .= '</table>';
// Set some content to print

$html = <<<EOD
$content
EOD;

//update_option('_pdf_labels', '');

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$file_path = wp_upload_dir()['path'] . '/' . sanitize_title($filename) . '.pdf';
$file_url = wp_upload_dir()['url'] . '/' . sanitize_title($filename) . '.pdf';
$pdf->Output($file_path, 'F');

$attr = [
    'post_type' => 'attachment',
    'post_mime_type' => 'application/pdf',
    'guid' => $file_url,
    'post_name' => $filename,
    'post_status' => 'inherit',
    'post_title' => $filename,
    'post_content' => $filename,
    'post_excerpt' => $filename,
];
$attach_id = wp_insert_post($attr);

add_post_meta($attach_id, '_wp_attached_file', substr(wp_upload_dir()['subdir'], 1) . '/' . sanitize_title($filename) . '.pdf');
add_post_meta($attach_id, '_labels_document', $filename);
add_post_meta($attach_id, '_document_comment', $comment);

//print_r($attach_id); /* ID is successfuly given, but DOES not show up in Media. Even tried omoitting the $post_id, even though it is totallay valid */
//============================================================+
// END OF FILE
//============================================================+




    