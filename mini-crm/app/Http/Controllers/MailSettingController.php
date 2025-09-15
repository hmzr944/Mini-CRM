<?php

    namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailSetting;

class MailSettingController extends Controller
{
    public function index()
    {
        return response()->json(MailSetting::first());
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|string',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        $setting = MailSetting::first();
        if (!$setting) {
            $setting = new MailSetting();
        }

        $setting->updateOrCreate(['id' => $setting->id ?? null], $validated);

        return response()->json(['message' => 'Configuration mise à jour avec succès']);
    }
}


