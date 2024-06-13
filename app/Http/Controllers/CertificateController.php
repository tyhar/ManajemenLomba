<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Certificate;
use App\Models\TeamMember;
use App\Models\Lomba;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function generateCertificates(Lomba $lomba)
    {
        $user = Auth::user();

        // Fetch team members with the authenticated user and their roles
        $members = TeamMember::with(['team.lomba', 'user'])
            ->where('user_id', $user->id)
            ->get();

        $outputDir = storage_path('app/public/certificates');

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        foreach ($members as $member) {
            if ($member->role == 'ketua' || $member->role == 'member') {
                $filePath = $this->generateCertificate($member, $outputDir);
                Certificate::create([
                    'team_member_id' => $member->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        return response()->json(['message' => 'Certificates generated successfully!']);
    }

    private function generateCertificate($member, $outputDir)
    {
        // Assuming you want to use the first related lomba's sertifikat for the certificate
        $lomba = $member->team->lomba->first();
        $templatePath = $this->getTemplatePath($lomba->sertifikat);
        $template = Image::make($templatePath);

        $template->text($member->user->name, 150, 200, function ($font) {
            $font->file(public_path('fonts/YourFont.ttf'));
            $font->size(24);
            $font->color('#000000');
        });

        $outputPath = $outputDir . '/' . $member->user->name . '_certificate.png';
        $template->save($outputPath);

        return 'certificates/' . $member->user->name . '_certificate.png'; // Relative path for storage
    }

    private function getTemplatePath($template)
    {
        $defaultTemplatePath = public_path('images/default_template.png');
        if ($template) {
            $templatePath = storage_path('app/public/sertifikat_files/' . $template);
            if (file_exists($templatePath)) {
                return $templatePath;
            }
        }
        return $defaultTemplatePath;
    }
}
