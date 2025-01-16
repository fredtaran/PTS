<?php

namespace App\Http\Controllers\doctor;

use App\Models\Tracking;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\doctor\ReferralCtrl;

class PrintCtrl extends Controller
{
    /**
     * Print referral form | Pregnant Checklist
     */
    public function printReferral($track_id)
    {
        $data = array();
        $user = Auth::user();
        $form_type = Tracking::where('id', $track_id)->first();

        if ($form_type) {
            $form_type = $form_type->type;
        } else {
            return redirect('doctor');
        }

        if ($form_type=='normal') {
            $data = ReferralCtrl::normalForm($track_id);
            return self::printNormal($data);
        } else if ($form_type == 'pregnant') {
            $data = ReferralCtrl::pregnantFormv2($track_id);
            Session::put('print_preg', $data);
            return self::printPregnantv2($data);
        }
    }

    /**
     * Pregnant v2 form
     */
    public function printPregnantv2($record)
    {
        return view('doctor.print_pregv2', [
            'data' => $record
        ]);
    }

    /**
     * Print patient consent
     */
    public function patientConsent ()
    {
        $pdf = new Fpdf();
        $x = ($pdf->getPageWidth())-20;

        $image1 = "img/logo.png";
        $image2 = "img/bgp.png";  
        $image3 = "img/DOHCHDNM.png";  

        $pdf->setTopMargin(17);
        $pdf->setTitle("Consent Form");
        $pdf->addPage();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(0, 3.5, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 20.78));
        $y = $pdf->getY();
        $pdf->SetXY($x/2+80, $y-7);
        $pdf->MultiCell($x/2, 4,  $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 20.78));
    
        $pdf->SetFont('Arial','B', 10);
        $pdf->Cell(0, 0, "Republic of the Philippines", 0, "", "C");
       
        $pdf->ln();
        $pdf->Cell(0, 10, "Department of Health", 0, "", "C");
        $pdf->ln();
        $pdf->Cell(0, 0, "Center for Health Development", 0, "", "C");
        $pdf->ln();
        $pdf->Cell(0, 10, "Northern Mindanao Region", 0, "", "C");
        $pdf->ln();
        $pdf->ln();
        $pdf->Cell(0, 5, "PATIENT CONSENT", 0, "", "C");
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln();
        
        $pdf->MultiCell(0, 7, self::black($pdf, "I, _______________________________________ hereby give my consent to send or transmit my health data or"), 0, 'L');
        $pdf->MultiCell(0, 7, self::black($pdf, "information to the Electronic Referral (E Referral) for the purpose of referring patients to other facilites"), 0, 'L');
        $pdf->MultiCell(0, 7, self::black($pdf, "and/or the Department of Healths (DOHs) National Health Data Reporting Requirements."), 0, 'L');
        $pdf->Ln();

        $pdf->MultiCell(0, 7, self::black($pdf, "As such, I was made to understand that:"), 0, 'L');
        $pdf->Ln();

        $pdf->Cell(0, 7, "1. I am giving permission to Name of Facility and/or Health Care Provider who is involved in my care delivery", 0, "", "L");
        $pdf->ln();
        $pdf->Cell(0, 7, "to gather and transmit pertinent health data or information to PhilHealth or DOH as applicable via", 0, "", "C");
        $pdf->ln();
        $pdf->Cell(0, 7, "authorized and recognized data centers/ providers.", 0, "", "C");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(0, 7, "2. I understand that appropriate safety measures have been put in place to protect the privacy and security", 0, "", "L");
        $pdf->ln();
        $pdf->Cell(0, 7, "of my well-being, health information, and other rights under laws governing data privacy and security, and", 0, "", "C");
        $pdf->ln();
        $pdf->Cell(0, 7, "related issuances.", 0, "", "C");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(0, 7, "3. This consent is valid in PHIE Lite and other DOH National Health Data Reporting Requirements until it is", 0, "", "L");
        $pdf->ln();
        $pdf->Cell(0, 7, "revoked by myself or my duly authorized representative.", 0, "", "C");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(0, 7, "4. I am made aware that I can cancel my consent at any time without giving reasons and without concerning", 0, "", "L");
        $pdf->ln();
        $pdf->Cell(0, 7, "any disadvantage for my medical treatment and/or services.", 0, "", "C");
        $pdf->Ln();
        $pdf->Ln();

        $pdf->MultiCell(0, 7, self::black($pdf, "I certify that I have been made to understand my rights in a language and manner understandable to me by a"), 0, 'L');
        $pdf->MultiCell(0, 7, self::black($pdf, "representative of the facility/health care provider and that the health data or information is true and complete to the"), 0, 'L');
        $pdf->MultiCell(0, 7, self::black($pdf, "best of my knowledge."), 0, 'L');
        $pdf->Ln();

        $pdf->MultiCell(0, 7, self::black($pdf, "Signed this Date of Month, Year at Time."), 0, 'L');     
        $pdf->Ln();

        $pdf->MultiCell($x/2, 7, self::black($pdf, "_______________________________"), 0, 'L');
        $y = $pdf->getY();
        $pdf->SetXY($x/2+10, $y-7);
        $pdf->MultiCell($x/2, 7, self::black($pdf, "_______________________________"), 0);

        $pdf->MultiCell($x/2, 7, self::black($pdf, "Name of Patient/Representative"), 0, 'L');
        $y = $pdf->getY();
        $pdf->SetXY($x/2+10, $y-7);
        $pdf->MultiCell($x/2, 7, self::black($pdf, "Representative of Health Facility"), 0);

        $pdf->MultiCell($x/2, 7, self::black($pdf, "(Signature over printed name)"), 0, 'L');
        $y = $pdf->getY();
        $pdf->SetXY($x/2+10, $y-7);
        $pdf->MultiCell($x/2, 7, self::black($pdf, "(Signature over printed name)"), 0);
        $pdf->Ln();
        $pdf->MultiCell(0, 7, self::black($pdf, "Contact Number: _____________________"), 0, 'L');
        $pdf->Output();
        exit;
    }

    /**
     * Black function
     */
    public function black($pdf, $val)
    {
        $y = $pdf->getY()+4.5;
        $x = $pdf->getX()+2;
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',10);
        return $pdf->Text($x,$y,$val);
    }
}
