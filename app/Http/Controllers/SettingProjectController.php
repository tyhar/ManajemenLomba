<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;


class SettingProjectController extends Controller
{
    public function edit()
    {
        $setting = Setting::all();
        return Inertia::render('Roles/Admin/Settingproject', [
            'appName' => config('app.name'),
            'emailName' => config('mail.from.name'),
            'settings' => $setting,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'appName' => 'required|string|max:255',
            'emailName' => 'required|string|max:255',
        ]);

        $appName = $request->input('appName');
        $emailName = $request->input('emailName');
        $this->updateEnvironmentFile('APP_NAME', $appName);
        $this->updateEnvironmentFile('MAIL_FROM_NAME', $emailName);

        return redirect()->route('setting.index')->with('success', 'Settings updated successfully.');
    }

    private function updateEnvironmentFile($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, preg_replace(
                '/^' . $key . '=.*/m',
                $key . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}
