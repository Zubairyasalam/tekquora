<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'TVK Tiruchengodu Digital Portal',
                'category' => 'web',
                'description' => 'A modern web platform providing party news updates, membership management, official announcements, and citizen engagement services.',
                'tech_tags' => ['React.js', 'Node.js', 'MySQL'],
                'image_1' => '/assets/projects/project-tvk.jpg',
                'image_2' => '/assets/projects/project-1.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'MCC IGH',
                'category' => 'web',
                'description' => 'Integrated healthcare management system designed to streamline patient records, appointments, and administrative workflows.',
                'tech_tags' => ['Laravel', 'SQLite', 'Bootstrap'],
                'image_1' => '/assets/projects/project-3.jpg',
                'image_2' => '/assets/projects/project-5.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Conference Management System',
                'category' => 'web',
                'description' => 'A web-based conference management platform for handling participant registrations, event schedules, speaker details, and conference information.',
                'tech_tags' => ['Laravel', 'Bootstrap', 'SQLite'],
                'image_1' => '/assets/projects/conference-management.png',
                'image_2' => '/assets/projects/project-3.jpg',
                'sort_order' => 3,
            ],
            [
                'title' => 'MCC AI - Language Platform',
                'category' => 'ai',
                'description' => 'An AI-powered language platform for real-time voice transcription, audio analysis, translation, and workspace management.',
                'tech_tags' => ['React', 'Python Flask', 'SQLite'],
                'image_1' => '/assets/projects/project-6.jpg',
                'image_2' => '/assets/projects/project-2.jpg',
                'sort_order' => 4,
            ],
            [
                'title' => 'EchoScribe AI',
                'category' => 'web',
                'description' => 'EchoScribe AI is an all-in-one platform that provides real-time voice transcription, translation, AI-powered analysis, summaries, and transcription management.',
                'tech_tags' => ['React', 'Python Flask', 'SQLite'],
                'image_1' => '/assets/projects/project-2.jpg',
                'image_2' => '/assets/projects/project-6.jpg',
                'sort_order' => 5,
            ],
            [
                'title' => 'Student Portal Mobile App',
                'category' => 'mobile',
                'description' => 'A student learning management system with Flutter frontend supporting course management, assignments, calendar view, dashboard, and feedback system.',
                'tech_tags' => ['Flutter', 'Firebase', 'Dart'],
                'image_1' => '/assets/projects/student-portal.jpg',
                'image_2' => '/assets/projects/project-tvk.jpg',
                'sort_order' => 6,
            ],
            [
                'title' => 'Enterprise CRM Platform',
                'category' => 'web',
                'description' => 'A full-featured customer relationship management system with real-time analytics and workflow automation.',
                'tech_tags' => ['Laravel', 'Vue.js', 'MySQL'],
                'image_1' => '/assets/projects/project-1.jpg',
                'image_2' => '/assets/projects/project-3.jpg',
                'sort_order' => 7,
            ],
            [
                'title' => 'Internship Management & Monitoring System (IMMS) - MCC',
                'category' => 'web',
                'description' => 'A web platform to monitor intern attendance, tasks, and daily progress. Features geofenced check-ins and automated email updates.',
                'tech_tags' => ['React', 'FastAPI', 'PostgreSQL/SQLite', 'HTML & CSS'],
                'image_1' => '/assets/projects/project-4.jpg',
                'image_2' => '/assets/projects/project-1.jpg',
                'sort_order' => 8,
            ],
            [
                'title' => 'SecurGate',
                'category' => 'web',
                'description' => 'Enterprise security management platform with access control, incident tracking, and real-time monitoring features.',
                'tech_tags' => ['Laravel', 'SQLite', 'Bootstrap'],
                'image_1' => '/assets/projects/project-5.jpg',
                'image_2' => '/assets/projects/project-3.jpg',
                'sort_order' => 9,
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }
}
