<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamMember;
use App\Models\Lomba;
use App\Models\Setting;

class CertificateController extends Controller
{
    public function process($lomba_id)
    {
        if (!auth()->check()) 
        {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $user = Auth::user();
        
        // Fetch the team and ensure it exists
        $team = $user->team()->where('lomba_id', $lomba_id)->with(['lomba', 'user'])->first();
        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }
        
        // Fetch members of the team along with their roles
        $members = TeamMember::where('team_id', $team->id)
            ->with(['user' => function($query) {
                $query->select('id', 'name');
            }])
            ->get();
        
        // Fetch the lomba to get the certificate template
        $lomba = Lomba::find($lomba_id);
        if (!$lomba || !$lomba->sertifikat) {
            return response()->json(['error' => 'Certificate template not found'], 404);
        }
        
        // Fetch the setting to get the title
        $setting = Setting::first(); // Adjust this if there are specific settings related to the lomba or other criteria
        if (!$setting || !$setting->judul) {
            return response()->json(['error' => 'Setting or title not found'], 404);
        }
        
        $certificateTemplatePath = public_path('storage/' . $lomba->sertifikat);

        // Path to save the merged PDF temporarily
        $tempOutputFile = public_path('temp_certificate.pdf');

        // Create an FPDI instance
        $fpdi = new FPDI;

        // Loop through each role and generate certificates
        $roles = ['Ketua', 'Anggota']; // Define roles if fixed, otherwise fetch dynamically
        foreach ($roles as $role) {
            foreach ($members as $member) {
                if ($member->role == $role) {
                    $nama = $member->user->name;
                    $this->fillPDF($fpdi, $certificateTemplatePath, $nama, $role, $lomba->name_lomba);
                }
            }
        }

        // Output the final merged PDF temporarily
        $fpdi->Output($tempOutputFile, 'F');

        // Construct the filename using name_lomba and judul
        $outputFilename = 'sertifikat_' . $lomba->name_lomba . '_' . $setting->name . '.pdf';

        // Return the file as a response with the dynamic filename
        return response()->download($tempOutputFile, $outputFilename)->deleteFileAfterSend(true);
    }

    public function fillPDF($fpdi, $file, $nama, $role, $nameLomba)
    {
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);
    
        // Generate certificate number in the format YYYY-MM-DD-XX
        $date = date('Y-m-d');
        $certNumber = $date . '-' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
    
        // Define positions for certificate number
        $certNumberLeft = 10;
        $certNumberTop = 10;
    
        // Add certificate number text
        $fpdi->SetFont('helvetica', '', 12); // Increased font size
        $fpdi->SetTextColor(25, 26, 25);
        $fpdi->Text($certNumberLeft, $certNumberTop, $certNumber);
    
        // Calculate center positions for name and role
        $fpdi->SetFont('helvetica', '', 20);
        $nameWidth = $fpdi->GetStringWidth($nama);
        $nameX = ($size['width'] - $nameWidth) / 2;
        $nameY = 105; // Adjust as needed for vertical position
    
        $fpdi->SetFont('helvetica', '', 15);
        $roleText = 'Sebagai ' . $role;
        $roleWidth = $fpdi->GetStringWidth($roleText);
        $roleX = ($size['width'] - $roleWidth) / 2;
        $roleY = $nameY + 10; // Adjust as needed for vertical position
    
        $fpdi->SetFont('helvetica', '', 15);
        $lombaText = 'Lomba ' . $nameLomba;
        $lombaWidth = $fpdi->GetStringWidth($lombaText);
        $lombaX = ($size['width'] - $lombaWidth) / 2;
        $lombaY = $roleY + 10; // Adjust as needed for vertical position
    
        // Add name text
        $fpdi->SetFont('helvetica', '', 20);
        $fpdi->SetTextColor(25, 26, 25);
        $fpdi->Text($nameX, $nameY, $nama);
    
        // Add role text
        $fpdi->SetFont('helvetica', '', 15);
        $fpdi->Text($roleX, $roleY, $roleText);
    
        // Add lomba text
        $fpdi->SetFont('helvetica', '', 15);
        $fpdi->Text($lombaX, $lombaY, $lombaText);
    }
}
