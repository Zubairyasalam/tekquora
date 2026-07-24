<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Sarah Jenkins',
                'email' => 'sarah@example.com',
                'company' => 'Logistics Pro',
                'service' => 'ai',
                'details' => 'Requesting proposal for integrating machine learning algorithms in our supply chain flow.',
                'priority' => 'Medium',
                'status' => 'Open',
                'created_at' => Carbon::create(2026, 6, 23, 10, 0, 0),
            ],
            [
                'name' => 'David K.',
                'email' => 'david@example.com',
                'company' => 'SaaS Builders',
                'service' => 'web',
                'details' => 'Upgrading legacy Laravel application to the latest version and migrating models.',
                'priority' => 'Low',
                'status' => 'Closed',
                'created_at' => Carbon::create(2026, 6, 22, 14, 30, 0),
            ],
            [
                'name' => 'Elena Rostova',
                'email' => 'elena@example.com',
                'company' => 'Biomed Inc.',
                'service' => 'web',
                'details' => 'Biomed Summit official website review and frontend layout design adjustments.',
                'priority' => 'High',
                'status' => 'Open',
                'created_at' => Carbon::create(2026, 6, 20, 11, 15, 0),
            ],
            [
                'name' => 'Karen Ilan',
                'email' => 'karen@example.com',
                'company' => 'ThemeLabs',
                'service' => 'other',
                'details' => 'General assistance regarding customize options for the premium layout.',
                'priority' => 'Medium',
                'status' => 'Open',
                'created_at' => Carbon::create(2026, 6, 18, 9, 0, 0),
            ],
            [
                'name' => 'Mark Diaz',
                'email' => 'mark@example.com',
                'company' => 'Apex Solutions',
                'service' => 'other',
                'details' => 'Urgent issue regarding server deployment and SSL registration error.',
                'priority' => 'High',
                'status' => 'Closed',
                'created_at' => Carbon::create(2026, 6, 15, 16, 45, 0),
            ],
            [
                'name' => 'Jose D.',
                'email' => 'jose@example.com',
                'company' => 'TechCorp',
                'service' => 'other',
                'details' => 'Management consulting and administrative portal design consultation.',
                'priority' => 'Low',
                'status' => 'Closed',
                'created_at' => Carbon::create(2026, 6, 12, 13, 20, 0),
            ],
        ];

        foreach ($inquiries as $inquiryData) {
            Inquiry::create($inquiryData);
        }
    }
}
