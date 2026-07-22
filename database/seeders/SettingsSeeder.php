<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::set('header_logo_text', 'TekQuora');
        Setting::set('header_logo_path', '/assets/Tekquora_website_logo_cropped.png');
        
        $defaultLinks = [
            [
                'id' => 1,
                'label' => 'Home',
                'url' => '/',
                'is_button' => false
            ],
            [
                'id' => 2,
                'label' => 'About',
                'url' => '/about',
                'is_button' => false
            ],
            [
                'id' => 3,
                'label' => 'Services',
                'url' => '/#services',
                'is_button' => false
            ],
            [
                'id' => 4,
                'label' => 'Projects',
                'url' => '/portfolio',
                'is_button' => false
            ],
            [
                'id' => 5,
                'label' => 'Our Team',
                'url' => '/team',
                'is_button' => false
            ],
            [
                'id' => 6,
                'label' => 'Work Culture',
                'url' => '/work-culture',
                'is_button' => false
            ],
            [
                'id' => 7,
                'label' => 'Careers',
                'url' => '/#careers',
                'is_button' => false
            ],
            [
                'id' => 8,
                'label' => 'Gallery',
                'url' => '/#gallery',
                'is_button' => false
            ],
            [
                'id' => 9,
                'label' => 'Contact',
                'url' => '/contact',
                'is_button' => true
            ]
        ];
        
        Setting::set('header_navigation_links', json_encode($defaultLinks));

        // Hero section defaults
        Setting::set('hero_background_image', '/assets/hero-bg-custom.png');
        Setting::set('hero_title', 'Future-Ready<br>Technology Solutions');
        Setting::set('hero_subtitle', 'Empowering businesses with cutting-edge innovation, AI-driven solutions, and transformative digital experiences that define tomorrow.');
        Setting::set('hero_primary_btn_text', 'See Our Team');
        Setting::set('hero_primary_btn_url', '/team');
        Setting::set('hero_secondary_btn_text', 'Explore Work Culture');
        Setting::set('hero_secondary_btn_url', '/work-culture');

        // About section defaults
        Setting::set('about_image', '/assets/logo.png');
        Setting::set('about_eyebrow', 'ABOUT TEKQUORA');
        Setting::set('about_description_1', 'Founded with a vision to bridge the gap between cutting-edge technology and business success, TekQuora has been at the forefront of digital innovation for over a decade.');
        Setting::set('about_description_2', "We combine deep technical expertise with strategic business insight to deliver solutions that not only meet today's challenges but anticipate tomorrow's opportunities. Our team of expert engineers, designers, and strategists work collaboratively to transform ideas into reality.");
        
        $aboutPoints = [
            '10+ years of industry expertise',
            '500+ successful project deliveries',
            'Global reach across 30+ countries'
        ];
        Setting::set('about_points', json_encode($aboutPoints));
        
        Setting::set('about_stat_value', '6,561+');
        Setting::set('about_stat_label', 'Satisfied Clients');
        Setting::set('about_btn_text', 'Explore More');
        Setting::set('about_btn_url', '/#services');

        // Services section defaults
        Setting::set('services_title', 'Our Services');
        Setting::set('services_subtitle', 'Comprehensive technology solutions designed to accelerate your business growth and drive digital innovation across all industries.');
        
        $defaultServices = [
            [
                'id' => 1,
                'title' => 'Web Development',
                'description' => 'Cutting-edge web applications built with modern frameworks and optimized for performance.',
                'icon' => 'code',
                'link_url' => '#'
            ],
            [
                'id' => 2,
                'title' => 'Mobile Solutions',
                'description' => 'Native and cross-platform mobile apps that deliver exceptional user experiences.',
                'icon' => 'mobile',
                'link_url' => '#'
            ],
            [
                'id' => 3,
                'title' => 'AI & Machine Learning',
                'description' => 'Intelligent solutions powered by machine learning and artificial intelligence technologies.',
                'icon' => 'ai',
                'link_url' => '#'
            ],
            [
                'id' => 4,
                'title' => 'IoT Solutions',
                'description' => 'Connected device ecosystems and IoT platforms for smart business automation.',
                'icon' => 'iot',
                'link_url' => '#'
            ]
        ];
        
        Setting::set('services_list', json_encode($defaultServices));

        // Work Culture defaults
        Setting::set('culture_title', 'Our Work Culture');
        Setting::set('culture_subtitle', "More than just a workplace it's a community where innovation thrives and people grow");
        $defaultCulture = [
            [
                'title' => 'Global Mindset',
                'description' => 'With teams across continents, we embrace diversity and bring global perspectives to local challenges, fostering innovation and collaboration.',
                'image' => '/assets/culture-global.png'
            ],
            [
                'title' => 'Learning Culture',
                'description' => 'Continuous learning is in our DNA. Access courses, workshops, and conferences to stay ahead and grow your expertise.',
                'image' => '/assets/culture-learning.png'
            ],
            [
                'title' => 'Employee Well-being',
                'description' => 'We prioritize the health and happiness of our team with comprehensive benefits, flexible schedules, and a supportive environment.',
                'image' => '/assets/culture-wellbeing.png'
            ],
            [
                'title' => 'Collaborative Spirit',
                'description' => 'Our open workspace fosters creativity and teamwork. We believe the best ideas come from diverse perspectives working together.',
                'image' => '/assets/culture-collaborative.png'
            ],
            [
                'title' => 'Innovation First',
                'description' => 'We encourage experimentation and learning. Failure is just another step towards success in our culture of continuous improvement.',
                'image' => '/assets/culture-innovation.png'
            ]
        ];
        Setting::set('culture_list', json_encode($defaultCulture));

        // Why Join Us defaults
        Setting::set('join_title', 'Why Join TekQuora?');
        Setting::set('join_subtitle', 'More than just a workplace a family that grows together');
        $defaultJoin = [
            [
                'title' => 'Celebrations',
                'description' => 'Regular events & recognition',
                'icon' => 'popper'
            ],
            [
                'title' => 'Work-Life Balance',
                'description' => 'Flexible hours and a supportive environment that values your personal time.',
                'icon' => 'clock'
            ],
            [
                'title' => 'Family Culture',
                'description' => 'A tight-knit team where everyone is valued, heard, and supported.',
                'icon' => 'home'
            ],
            [
                'title' => 'Training Programs',
                'description' => 'Continuous learning & skill development',
                'icon' => 'monitor'
            ]
        ];
        Setting::set('join_list', json_encode($defaultJoin));

        // Gallery defaults
        Setting::set('gallery_title', 'Glimpses of TekQuora Moments');
        Setting::set('gallery_subtitle', 'A sneak peek into our events, celebrations, and team experiences.');
        $defaultGallery = [
            '/assets/glimpse-8.png',
            '/assets/glimpse-1.png',
            '/assets/glimpse-6.jpeg',
            '/assets/glimpse-10.png',
            '/assets/glimpse-13.png',
            '/assets/glimpse-5.png',
            '/assets/glimpse-7.png',
            '/assets/glimpse-14.png',
            '/assets/glimpse-15.png',
            '/assets/glimpse-16.jpeg',
            '/assets/glimpse-17.jpeg'
        ];
        Setting::set('gallery_images', json_encode($defaultGallery));

        // Contact Info defaults
        Setting::set('contact_title', 'Get In Touch');
        Setting::set('contact_subtitle', "Ready to transform your business with cutting-edge technology? Let's discuss your project and bring your vision to life.");
        Setting::set('contact_email', 'tekquora@gmail.com');
        Setting::set('contact_phone', '+91 7373306677');
        Setting::set('contact_location', 'Chennai, Tamil Nadu, India');
        Setting::set('contact_working_hours', 'Mon - Fri: 9:00 AM - 6:00 PM');
        
        $defaultContactCta = [
            'title' => 'Ready to Start Your Project?',
            'description' => 'Schedule a free consultation call to discuss your requirements and get a detailed project proposal.',
            'btn_text' => 'Schedule Consultation',
            'btn_url' => '#'
        ];
        Setting::set('contact_cta', json_encode($defaultContactCta));

        // Footer defaults
        Setting::set('footer_description', 'Pioneering the future of technology with innovative solutions that transform businesses and empower digital growth across industries worldwide.');
        Setting::set('footer_copyright', 'TekQuora Admin Console. Powered by TekQuora CRM.');

        // Team settings
        Setting::set('team_title', 'Meet Our Team');
        Setting::set('team_subtitle', 'The talented individuals who make TekQuora a great place to work');
        
        $teamMembers = [
            [
                'name' => 'MOHAMED LUKMAN',
                'role' => 'Director',
                'type' => 'management',
                'initials' => 'MO',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991ad2e4_1784048017.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Aaaron Isaac Sam M',
                'role' => 'Operation Manager',
                'type' => 'hr_operation',
                'initials' => 'AA',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991aea1f_1784048017.PNG',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Praveen N',
                'role' => 'Full Stack Developer',
                'type' => 'employee',
                'initials' => 'PR',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34db974_1784048180.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Raghul Prasath J',
                'role' => 'Full Stack Developer',
                'type' => 'employee',
                'initials' => 'RA',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34dd0f5_1784048180.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Noorul Ameen',
                'role' => 'Digital Marketing Executive',
                'type' => 'marketing',
                'initials' => 'NO',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991b1fb1_1784048017.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Mohamed Masurdeen',
                'role' => 'Digital Marketing Executive',
                'type' => 'marketing',
                'initials' => 'MO',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991b33d8_1784048017.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Charles Abraham R',
                'role' => 'Software Developer',
                'type' => 'employee',
                'initials' => 'CH',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991afadd_1784048017.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Nancy Narmadha T',
                'role' => 'Full Stack Developer',
                'type' => 'employee',
                'initials' => 'NA',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34de23e_1784048180.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Zubirya Salam Khan',
                'role' => 'Full Stack Developer',
                'type' => 'employee',
                'initials' => 'ZU',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a57154cc8555_1784091980.png',
                'location' => ''
            ],
            [
                'name' => 'Sharan Letiza',
                'role' => 'Client Success Associate',
                'type' => 'hr_operation',
                'initials' => 'SH',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a56645098baa_1784046672.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Grace Edison Inigo J',
                'role' => 'Social Media Executive',
                'type' => 'marketing',
                'initials' => 'GR',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991b1111_1784048017.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Pavithra G',
                'role' => 'Software Developer',
                'type' => 'hr_operation',
                'initials' => 'PA',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34d9c51_1784048180.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Rowena',
                'role' => 'HR Manager',
                'type' => 'hr_operation',
                'initials' => 'RO',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991b46d7_1784048017.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Anto A',
                'role' => 'Software Developer',
                'type' => 'intern',
                'initials' => 'AN',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34e1158_1784048180.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Mohamed Aamir Khan A',
                'role' => 'Web Pentester',
                'type' => 'intern',
                'initials' => 'MO',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34e361a_1784048180.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Yeshwanth Y',
                'role' => 'Software Developer',
                'type' => 'intern',
                'initials' => 'YE',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34e2556_1784048180.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Priyatharshni S',
                'role' => 'Full Stack Developer',
                'type' => 'intern',
                'initials' => 'PR',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34e4a55_1784048180.jpeg',
                'location' => 'Chennai'
            ],
            [
                'name' => 'Sri Raghav Prasath',
                'role' => 'Marketing Executive',
                'type' => 'intern',
                'initials' => 'SR',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566991b569e_1784048017.jpeg',
                'location' => ''
            ],
            [
                'name' => 'Naveen E',
                'role' => 'Full Stack Developer',
                'type' => 'intern',
                'initials' => 'NA',
                'gradient' => 'dev-gradient',
                'image' => '/uploads/member_6a566a34e5991_1784048180.jpeg',
                'location' => 'Chennai'
            ]
        ];
        Setting::set('team_members', json_encode($teamMembers));
    }
}
