<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only fetch settings if the database table exists to avoid errors during migrations
        if (Schema::hasTable('settings')) {
            View::composer('*', function ($view) {
                // Header settings
                $logoText = Setting::get('header_logo_text', 'TekQuora');
                $logoPath = Setting::get('header_logo_path', '/assets/navbar-logo.png');
                $linksJson = Setting::get('header_navigation_links');
                $links = $linksJson ? json_decode($linksJson, true) : [];
                
                // Hero settings
                $heroImage = Setting::get('hero_background_image', 'assets/hero-bg-custom.png');
                $heroTitle = Setting::get('hero_title', 'Future-Ready<br>Technology Solutions');
                $heroSubtitle = Setting::get('hero_subtitle', '');
                $heroPrimaryText = Setting::get('hero_primary_btn_text', 'See Our Team');
                $heroPrimaryUrl = Setting::get('hero_primary_btn_url', '/team');
                $heroSecondaryText = Setting::get('hero_secondary_btn_text', 'Explore Work Culture');
                $heroSecondaryUrl = Setting::get('hero_secondary_btn_url', '/#culture');

                // About Page Dedicated Settings
                $aboutHeroTitle = Setting::get('about_hero_title', 'About Us');
                $aboutHeroSubtitle = Setting::get('about_hero_subtitle', 'Pioneering technology solutions and empowering digital growth since 2016.');

                $aboutTekquoraTitle = Setting::get('about_tekquora_title', 'About TekQuora');
                $aboutTekquoraP1 = Setting::get('about_tekquora_p1') ?: Setting::get('about_description_1', 'TekQuora is a technology-driven company focused on building innovative digital solutions that help businesses grow, streamline operations, and stay ahead in a fast-changing digital world. We specialize in transforming ideas into practical, scalable, and user-friendly software products that solve real business challenges.');
                $aboutTekquoraP2 = Setting::get('about_tekquora_p2') ?: Setting::get('about_description_2', 'Founded with a vision to combine technology, creativity, and business strategy, TekQuora works with startups, enterprises, and organizations to deliver high-quality web applications, mobile apps, business platforms, and custom digital solutions. Our team is passionate about creating products that are not only visually modern but also technically strong, reliable, and performance-focused.');

                $ourValuesTitle = Setting::get('about_values_title', 'Our Values');
                $ourValuesSubtitle = Setting::get('about_values_subtitle', 'The principles that guide everything we build and deliver.');
                $ourValuesJson = Setting::get('about_values_items');
                $ourValuesItems = $ourValuesJson ? json_decode($ourValuesJson, true) : [];

                $ourApproachTitle = Setting::get('about_approach_title', 'Our Approach');
                $ourApproachP1 = Setting::get('about_approach_p1', 'At TekQuora, every project begins with understanding the client’s vision, goals, and challenges. We follow a practical and collaborative approach where planning, design, development, testing, and deployment are all handled with attention to quality and performance.');
                $ourApproachP2 = Setting::get('about_approach_p2', 'We don’t just develop software — we build digital experiences that support long-term business success. Our team works closely with clients to ensure transparency, adaptability, and timely delivery throughout the project lifecycle.');

                $whyChooseTitle = Setting::get('about_why_choose_title', 'Why Choose TekQuora');
                $whyChoosePointsJson = Setting::get('about_why_choose_points');
                $whyChoosePoints = $whyChoosePointsJson ? json_decode($whyChoosePointsJson, true) : [];

                $growTitle = Setting::get('about_grow_title', 'GROW BEYOND BORDERS WITH TEKQUORA');
                $growSubtitle = Setting::get('about_grow_subtitle', "Whether you're paying a freelancer or a full team overseas, TekQuora makes it simple, fast, secure, and with no sacrifice for every detail.");
                $growBtnText = Setting::get('about_grow_btn_text', 'Explore More');
                $growBtnUrl = Setting::get('about_grow_btn_url', '/contact');

                // Services settings
                $servicesTitle = Setting::get('services_title', 'Our Services');
                $servicesSubtitle = Setting::get('services_subtitle', '');
                $servicesListJson = Setting::get('services_list');
                $servicesList = $servicesListJson ? json_decode($servicesListJson, true) : [];

                // Culture settings
                $cultureTitle = Setting::get('culture_title', 'Our Work Culture');
                $cultureSubtitle = Setting::get('culture_subtitle', "More than just a workplace it's a community where innovation thrives and people grow");
                $cultureListJson = Setting::get('culture_list');
                $cultureList = $cultureListJson ? json_decode($cultureListJson, true) : [];

                // Why Join Us settings
                $joinTitle = Setting::get('join_title', 'Why Join TekQuora?');
                $joinSubtitle = Setting::get('join_subtitle', "More than just a workplace a family that grows together");
                $joinListJson = Setting::get('join_list');
                $joinList = $joinListJson ? json_decode($joinListJson, true) : [];

                // Gallery settings
                $galleryTitle = Setting::get('gallery_title', 'Glimpses of TekQuora Moments');
                $gallerySubtitle = Setting::get('gallery_subtitle', '');
                $galleryImagesJson = Setting::get('gallery_images');
                $galleryImages = $galleryImagesJson ? json_decode($galleryImagesJson, true) : [];

                // Contact settings
                $contactTitle = Setting::get('contact_title', "Let's Connect");
                $contactSubtitle = Setting::get('contact_subtitle', "Have questions? Want to join our team? We'd love to hear from you.");
                $contactEmail = Setting::get('contact_email', 'tekquora@gmail.com');
                $contactPhone = Setting::get('contact_phone', '+91 93452 72947');
                $contactLocation = Setting::get('contact_location', 'Chennai, Tamil Nadu, India');
                $contactWorkingHours = Setting::get('contact_working_hours', 'Mon - Fri: 9:00 AM - 6:00 PM');
                $contactMapUrl = Setting::get('contact_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.003584852924!2d80.2422709!3d12.965429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d61081515ef%3A0xc346617fcbd8ad94!2sKandancavadi%2520Perungudi!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin');
                $contactCtaJson = Setting::get('contact_cta');
                $contactCta = $contactCtaJson ? json_decode($contactCtaJson, true) : [];

                // Footer settings
                $footerDescription = Setting::get('footer_description', 'Pioneering the future of technology with innovative solutions that transform businesses and empower digital growth across industries worldwide.');
                $footerCopyright = Setting::get('footer_copyright', '© ' . date('Y') . ' TekQuora. All rights reserved. Crafted with innovation and precision.');
                $footerSocialsJson = Setting::get('footer_socials');
                $footerSocials = $footerSocialsJson ? json_decode($footerSocialsJson, true) : [
                    'facebook' => 'https://www.facebook.com/profile.php?id=61585230471650', 'twitter' => '#', 'linkedin' => '#', 'instagram' => 'https://www.instagram.com/tekquora2025/?hl=en', 'whatsapp' => 'https://wa.me/919345272947'
                ];
                $footerCol1Title = Setting::get('footer_col1_title', 'Services');
                $footerCol1LinksJson = Setting::get('footer_col1_links');
                $footerCol1Links = $footerCol1LinksJson ? json_decode($footerCol1LinksJson, true) : [
                    ['label' => 'Web Development', 'url' => '/#services'],
                    ['label' => 'Mobile Apps', 'url' => '/#services'],
                    ['label' => 'Cloud Services', 'url' => '/#services'],
                    ['label' => 'AI Solutions', 'url' => '/#services'],
                    ['label' => 'Cybersecurity', 'url' => '/#services'],
                    ['label' => 'Data Analytics', 'url' => '/#services']
                ];
                $footerCol2Title = Setting::get('footer_col2_title', 'Company');
                $footerCol2LinksJson = Setting::get('footer_col2_links');
                $footerCol2Links = $footerCol2LinksJson ? json_decode($footerCol2LinksJson, true) : [
                    ['label' => 'About Us', 'url' => '/#about'],
                    ['label' => 'Our Team', 'url' => '/team'],
                    ['label' => 'News & Blog', 'url' => '#'],
                    ['label' => 'Case Studies', 'url' => '#'],
                    ['label' => 'Contact', 'url' => '/contact']
                ];
                $footerCol3Title = Setting::get('footer_col3_title', 'Resources');
                $footerCol3LinksJson = Setting::get('footer_col3_links');
                $footerCol3Links = $footerCol3LinksJson ? json_decode($footerCol3LinksJson, true) : [
                    ['label' => 'Documentation', 'url' => '#'],
                    ['label' => 'API Reference', 'url' => '#'],
                    ['label' => 'Support Center', 'url' => '#'],
                    ['label' => 'Community', 'url' => '#'],
                    ['label' => 'Partners', 'url' => '#'],
                    ['label' => 'Downloads', 'url' => '#']
                ];

                // Projects settings
                $projectsTitle = Setting::get('projects_title', 'Our Projects');
                $projectsSubtitle = Setting::get('projects_subtitle', 'Explore our latest projects showcasing innovation, technical excellence, and transformative digital solutions across various industries.');

                // Team settings
                $teamTitle = Setting::get('team_title', 'Meet Our Team');
                $teamSubtitle = Setting::get('team_subtitle', 'The talented individuals who make TekQuora a great place to work');
                $teamMembersJson = Setting::get('team_members');
                $teamMembers = $teamMembersJson ? json_decode($teamMembersJson, true) : [
                    ['name' => 'Ramachandran Subramaniyan', 'role' => 'Director & CTO', 'type' => 'management', 'initials' => 'RS', 'gradient' => 'management-gradient', 'image' => '/assets/team-1.jpg', 'location' => 'Chennai', 'description' => 'Driving innovation and aligning technology with business goals.', 'linkedin' => '#'],
                    ['name' => 'Joe Madhan Gunasekar', 'role' => 'Chief Financial & Operations Officer', 'type' => 'management', 'initials' => 'JG', 'gradient' => 'management-gradient', 'image' => '/assets/team-2.jpg', 'location' => 'Chennai', 'description' => 'Overseeing finance and operations to drive growth and efficiency.', 'linkedin' => '#'],
                    ['name' => 'Karthick Balasubramaniyan', 'role' => 'Project Manager', 'type' => 'management', 'initials' => 'KB', 'gradient' => 'management-gradient', 'image' => '/assets/team-3.jpg', 'location' => 'Chennai', 'description' => 'Planning, coordinating, and executing projects to ensure timely delivery and client satisfaction.', 'linkedin' => '#'],
                    ['name' => 'Kantha Subramanian', 'role' => 'Technical Architect', 'type' => 'management', 'initials' => 'KS', 'gradient' => 'management-gradient', 'image' => '/assets/team-4.jpg', 'location' => 'Chennai', 'description' => 'Leading development teams to deliver scalable, high-performance solutions.', 'linkedin' => '#'],
                    ['name' => 'Arun Kumar', 'role' => 'Managing Director', 'type' => 'employee', 'initials' => 'AK', 'gradient' => 'management-gradient'],
                    ['name' => 'Deepa Ram', 'role' => 'Chief Technology Officer', 'type' => 'employee', 'initials' => 'DR', 'gradient' => 'management-gradient'],
                    ['name' => 'Priya Sharma', 'role' => 'HR Head', 'type' => 'employee', 'initials' => 'PS', 'gradient' => 'hr-gradient'],
                    ['name' => 'Rajesh V', 'role' => 'Lead UI/UX Designer', 'type' => 'employee', 'initials' => 'RV', 'gradient' => 'design-gradient'],
                    ['name' => 'Anjali Nair', 'role' => 'UI/UX Design Intern', 'type' => 'intern', 'initials' => 'AN', 'gradient' => 'design-gradient'],
                    ['name' => 'Siddharth Sen', 'role' => 'Lead Full-Stack Developer', 'type' => 'employee', 'initials' => 'SS', 'gradient' => 'dev-gradient'],
                    ['name' => 'Vijay Kumar', 'role' => 'Senior Developer', 'type' => 'employee', 'initials' => 'VK', 'gradient' => 'dev-gradient'],
                    ['name' => 'Meera R', 'role' => 'Frontend Developer Intern', 'type' => 'intern', 'initials' => 'MR', 'gradient' => 'dev-gradient']
                ];

                $view->with([
                    'headerSettings' => [
                        'logo_text' => $logoText,
                        'logo_path' => $logoPath,
                        'navigation_links' => $links,
                    ],
                    'heroSettings' => [
                        'background_image' => $heroImage,
                        'title' => $heroTitle,
                        'subtitle' => $heroSubtitle,
                        'primary_btn_text' => $heroPrimaryText,
                        'primary_btn_url' => $heroPrimaryUrl,
                        'secondary_btn_text' => $heroSecondaryText,
                        'secondary_btn_url' => $heroSecondaryUrl,
                    ],
                    'aboutPageSettings' => [
                        'hero_title' => $aboutHeroTitle,
                        'hero_subtitle' => $aboutHeroSubtitle,
                        'tekquora_title' => $aboutTekquoraTitle,
                        'tekquora_p1' => $aboutTekquoraP1,
                        'tekquora_p2' => $aboutTekquoraP2,
                        'values_title' => $ourValuesTitle,
                        'values_subtitle' => $ourValuesSubtitle,
                        'values_items' => $ourValuesItems,
                        'approach_title' => $ourApproachTitle,
                        'approach_p1' => $ourApproachP1,
                        'approach_p2' => $ourApproachP2,
                        'why_choose_title' => $whyChooseTitle,
                        'why_choose_points' => $whyChoosePoints,
                        'grow_title' => $growTitle,
                        'grow_subtitle' => $growSubtitle,
                        'grow_btn_text' => $growBtnText,
                        'grow_btn_url' => $growBtnUrl,
                    ],
                    'aboutSettings' => [
                        'image' => $aboutImage ?? 'assets/Tekquora_icon_with_bg_cropped.png',
                        'eyebrow' => $aboutEyebrow ?? 'ABOUT TEKQUORA',
                        'description_1' => $aboutTekquoraP1,
                        'description_2' => $aboutTekquoraP2,
                        'points' => $aboutPoints ?? [],
                        'stat_value' => $aboutStatValue ?? '6,561+',
                        'stat_label' => $aboutStatLabel ?? 'Satisfied Clients',
                        'btn_text' => $aboutBtnText ?? 'Explore More',
                        'btn_url' => $aboutBtnUrl ?? '/about',
                    ],
                    'servicesSettings' => [
                        'title' => $servicesTitle,
                        'subtitle' => $servicesSubtitle,
                        'list' => $servicesList,
                    ],
                    'cultureSettings' => [
                        'title' => $cultureTitle,
                        'subtitle' => $cultureSubtitle,
                        'list' => $cultureList,
                    ],
                    'joinSettings' => [
                        'title' => $joinTitle,
                        'subtitle' => $joinSubtitle,
                        'list' => $joinList,
                    ],
                    'gallerySettings' => [
                        'title' => $galleryTitle,
                        'subtitle' => $gallerySubtitle,
                        'images' => $galleryImages,
                    ],
                    'contactSettings' => [
                        'title' => $contactTitle,
                        'subtitle' => $contactSubtitle,
                        'email' => $contactEmail,
                        'phone' => $contactPhone,
                        'location' => $contactLocation,
                        'working_hours' => $contactWorkingHours,
                        'map_url' => $contactMapUrl,
                        'cta' => $contactCta,
                    ],
                    'footerSettings' => [
                        'description' => $footerDescription,
                        'copyright' => $footerCopyright,
                        'socials' => $footerSocials,
                        'col1_title' => $footerCol1Title,
                        'col1_links' => $footerCol1Links,
                        'col2_title' => $footerCol2Title,
                        'col2_links' => $footerCol2Links,
                        'col3_title' => $footerCol3Title,
                        'col3_links' => $footerCol3Links,
                    ],
                    'projectsSettings' => [
                        'title' => $projectsTitle,
                        'subtitle' => $projectsSubtitle,
                    ],
                    'teamSettings' => [
                        'title' => $teamTitle,
                        'subtitle' => $teamSubtitle,
                        'members' => $teamMembers,
                    ],
                    'systemConfig' => [
                        'primary_color' => Setting::get('primary_color', '#0061ff'),
                        'enable_secondary_theme' => Setting::get('enable_secondary_theme', '0'),
                        'secondary_color' => Setting::get('secondary_color', '#7c3aed'),
                    ],
                    'projects' => \App\Models\Project::orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get()
                ]);
            });
        }
    }
}
