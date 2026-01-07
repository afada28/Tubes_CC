<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FounderJourney;
use App\Models\InfoDonation;
use App\Models\Milestone;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Models\SectionCarousel;

class MainPageController extends Controller
{
    public function index()
    {
        // ========== SECTION 1: HERO CAROUSEL ==========
        $carouselData = SectionCarousel::latest()->first();
        $sliders = [];

        if ($carouselData) {
            if ($carouselData->title_1) {
                $sliders[] = [
                    'image' => $carouselData->photo_1 ? 'storage/' . $carouselData->photo_1 : 'images/a.jpg',
                    'title' => $carouselData->title_1,
                    'subtitle' => $carouselData->content_1 ?? 'Menyalurkan kasih untuk sesama yang membutuhkan'
                ];
            }

            if ($carouselData->title_2) {
                $sliders[] = [
                    'image' => $carouselData->photo_2 ? 'storage/' . $carouselData->photo_2 : 'images/2.png',
                    'title' => $carouselData->title_2,
                    'subtitle' => $carouselData->content_2 ?? 'Setiap donasi Anda adalah senyuman bagi mereka'
                ];
            }

            if ($carouselData->title_3) {
                $sliders[] = [
                    'image' => $carouselData->photo_3 ? 'storage/' . $carouselData->photo_3 : 'images/slider3.jpg',
                    'title' => $carouselData->title_3,
                    'subtitle' => $carouselData->content_3 ?? 'Mari bersama ciptakan masa depan yang lebih baik'
                ];
            }
        }

        if (empty($sliders)) {
            $sliders = [
                [
                    'image' => 'images/a.jpg',
                    'title' => 'Bersama Membangun Harapan',
                    'subtitle' => 'Menyalurkan kasih untuk sesama yang membutuhkan'
                ],
                [
                    'image' => 'images/2.png',
                    'title' => 'Berbagi Kebahagiaan',
                    'subtitle' => 'Setiap donasi Anda adalah senyuman bagi mereka'
                ],
                [
                    'image' => 'images/slider3.jpg',
                    'title' => 'Wujudkan Perubahan',
                    'subtitle' => 'Mari bersama ciptakan masa depan yang lebih baik'
                ]
            ];
        }

        // ========== SECTION 2: INTRODUCTION ==========
        $introduction = [
            'title' => 'Introduction',
            'paragraphs' => [
                'We believe that equality is the birthright of every human being — the right to fair opportunities for success and well-being, free from discrimination, favoritism, or barriers beyond one\'s control.',
                'To us, compassion is more than empathy or assistance; it is also about nurturing and upholding noble values — foremost among them, discipline. Discipline is the guiding light that ensures every opportunity is used wisely. Without discipline, even the greatest support can lose its meaning. That is why we believe equality and discipline are two fundamental pillars that sustain human growth, preserve dignity, and drive lasting progress.',
                'These values are not only essential to human life but also bring a positive impact to all of God\'s creation. When people live with fairness and discipline, the universe itself flourishes — in harmony, balance, and sustainability. And above all, we must always remember to respect one another and live each day with gratitude.'
            ]
        ];

        // Core Values
        $values = [
            [
                'icon' => 'bi-people-fill',
                'title' => 'Equality',
                'description' => 'Kesetaraan dalam memberikan bantuan'
            ],
            [
                'icon' => 'bi-shield-check',
                'title' => 'Discipline',
                'description' => 'Disiplin dalam pengelolaan donasi'
            ],
            [
                'icon' => 'bi-heart-fill',
                'title' => 'Life of Gratitude',
                'description' => 'Hidup penuh rasa syukur dan berbagi'
            ]
        ];

        // ========== SECTION 3: ABOUT US ==========
        $aboutData = About::latest()->first();

        $about = [
            'badge' => 'About Us',
            'title_highlight' => $aboutData->title ?? 'Indonesia',
            'subtitle' => 'Melalui transparansi dan komitmen, kami terus berinovasi untuk memberikan dampak positif yang berkelanjutan',
            'gallery' => []
        ];

        // Cek jika data ada
        if ($aboutData) {
            $about = [
                'badge' => 'About Us',
                'title' => $aboutData->title,
                'subtitle' => $aboutData->subtitle,
                'gallery' => []
            ];

            // Gallery 1
            if ($aboutData->gallery_photo_1) {
                $about['gallery'][] = [
                    'image' => 'storage/' . $aboutData->gallery_photo_1,
                    'title' => $aboutData->gallery_title_1,
                    'description' => $aboutData->gallery_content_1,
                    'size' => 'large'
                ];
            }

            // Gallery 2
            if ($aboutData->gallery_photo_2) {
                $about['gallery'][] = [
                    'image' => 'storage/' . $aboutData->gallery_photo_2,
                    'title' => $aboutData->gallery_title_2,
                    'description' => $aboutData->gallery_content_2,
                    'size' => 'small'
                ];
            }
        }

        // Fallback jika tidak ada data
        if (empty($about['gallery'])) {
            $about['gallery'] = [
                [
                    'image' => 'images/default-gallery-1.jpg',
                    'title' => 'Default Gallery 1',
                    'description' => 'Description 1',
                    'size' => 'large'
                ],
                [
                    'image' => 'images/default-gallery-2.jpg',
                    'title' => 'Default Gallery 2',
                    'description' => 'Description 2',
                    'size' => 'small'
                ]
            ];
        }

        // Impact Statistics
        $impactStats = [
            [
                'icon' => 'bi-people-fill',
                'number' => 15000,
                'label' => 'Penerima Manfaat'
            ],
            [
                'icon' => 'bi-grid-3x3-gap-fill',
                'number' => 50,
                'label' => 'Program Aktif'
            ],
            [
                'icon' => 'bi-hand-thumbs-up-fill',
                'number' => 150,
                'label' => 'Relawan'
            ],
            [
                'icon' => 'bi-geo-alt-fill',
                'number' => 35,
                'label' => 'Kota Jangkauan'
            ]
        ];

        // ========== SECTION 4: BELIEFS, VISION, MISSION ==========
        $beliefs = [
            'section_badge' => 'Our Foundation',
            'section_title' => 'Commitment to',
            'section_title_highlight' => 'Change',
            'section_subtitle' => 'Principles and vision that guide our every step in creating a positive impact',

            'our_beliefs' => [
                'icon' => 'bi-lightbulb-fill',
                'title' => 'Our Beliefs',
                'content' => [
                    'Born from compassion and guided by faith, Graha Alfa Amertha Indonesia Foundation stands as a bridge between people, purpose, and planet. We exist to ensure that no one and nothing is left behind — not the poor, not the elderly, not the children in their early years of growth, and not the earth that sustains us. Guided by a spirit of collaboration, the Foundation aspires to work in harmony with national and international initiatives that advance community welfare and environmental responsibility. Our purpose is to complement — not compete with — the good work already being carried out by others, extending compassion where it is most needed and ensuring that sustainability and kindness reach every corner of society.',
                    'Together, these beliefs shape our vision and guide every step of our journey.',
                    'Compassion is not just a feeling — it is a responsibility." — Graha Alfa Amertha Indonesia Foundation —'
                ]
            ],

            'our_vision' => [
                'icon' => 'bi-eye-fill',
                'title' => 'Our Vision',
                'content' => 'Graha Alfa Amertha Indonesia Foundation is an organization dedicated to social, humanitarian, and spiritual causes. United in heart and purpose, we are committed to using the gifts bestowed upon us by the Almighty Creator to become part of a caring and cooperative society — both in Indonesia and globally — working hand in hand to build a better and more dignified life. We strive to act professionally, deeply, educatively, and responsively accordng to the needs of the community, in pursuit of collective well-being and the growth of human potential.'
            ],

            'our_mission' => [
                'icon' => 'bi-flag-fill',
                'title' => 'Our Mission',
                'items' => [
                    'To carry out acts of compassion in the fields of social, humanitarian, and spiritual development.',
                    'To promote care and preservation of flora and fauna as a reflection of our respect for all of God\'s creations.',
                    'To provide education that broadens human understanding — as individuals, families, communities, and global citizens.',
                    'To establish sustainable economic activities as a means of funding and improving collective welfare.',
                    'To foster collaboration and gather support from various sectors of Indonesian and global society in the spirit of humanity.'
                ]
            ],

            'our_goals' => [
                'icon' => 'bi-bullseye',
                'title' => 'Our Goals',
                'items' => [
                    'To instill noble human values without neglecting the spiritual principles taught by each faith and belief.',
                    'To inspire every individual, as God\'s highest creation, to respect and protect all other forms of life.',
                    'To promote education as a foundation for a better, wiser, and more meaningful life.',
                    'To become a self-reliant and respected organization with integrity and purpose.',
                    'To encourage unity and cooperation for humanitarian and environmental causes beyond personal interests.'
                ]
            ],

            'philosophy' => [
                'icon' => 'bi-stars',
                'title' => 'Philosophy & Motto',
                'quote' => 'Let\'s create a place where no one and nothing is left behind.',
                'description' => 'This simple yet profound motto expresses our belief that love, care, and responsibility must embrace all life — from the earliest years of a child\'s journey to the natural world that sustains us. Every action we take reflects this unity: social compassion and environmental care as one continuous act of gratitude.'
            ]
        ];

        // ========== SECTION 5: BACKGROUND STORY ==========
        $backgroundData = Milestone::latest()->first();

        $background = [
            'badge' => 'Our Journey',
            'title' => 'Our',
            'title_highlight' => 'Inspirational',
            'title_suffix' => 'Journey',
            'image' => 'storage/' . $backgroundData->photo,
            'floating_card' => [
                'icon' => 'bi-trophy-fill',
                'number' => '7+',
                'label' => 'Tahun Berdampak'
            ],
            'timeline' => [
                [
                    'title' => $backgroundData->timeline_title_1,
                    'text' => $backgroundData->timeline_content_1,
                ],
                [
                    'title' => $backgroundData->timeline_title_2,
                    'text' => $backgroundData->timeline_content_2,
                ],
                [
                    'title' => $backgroundData->timeline_title_3,
                    'text' => $backgroundData->timeline_content_3,
                ],
                [
                    'title' => $backgroundData->timeline_title_4,
                    'text' => $backgroundData->timeline_content_4,
                ],
            ]
        ];

        // ========== SECTION 6: FOUNDERS JOURNEY ==========
        $journeys = FounderJourney::all()->map(function ($item) {
            return [
                'year' => $item->date_start,
                'title' => $item->title,
                'description' => $item->content,
                'image' => 'storage/' . $item->photo_1,
            ];
        })->toArray();

        $journeySection = [
            'badge' => 'Founder Journey',
            'title' => 'Founder',
            'title_highlight' => 'Journey',
            'subtitle' => 'From a simple dream to realizing real change for thousands of Indonesian families',
            'items' => $journeys
        ];

        // ========== SECTION 7: ACTIVE DONATIONS ==========
        $donations = InfoDonation::where('status', 'active')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->with('donations') // Load relasi donations
            ->get();

        // ========== SECTION 8: ACTIVE VOLUNTEERS ==========
        // FIX: Tambahkan with('participants') dan perbaiki query
        $volunteers = Volunteer::where('status', 'active')
            ->where('date', '>=', now()->subDays(30)) // Ubah filter date agar lebih fleksibel
            ->orderBy('date', 'asc')
            ->take(3)
            ->with('participants') // PENTING: Load relasi participants
            ->get();

        // Debug: Uncomment untuk cek data
        // dd($volunteers->toArray());

        // ========== SECTION 9: CALL TO ACTION ==========
        $cta = [
            'icon' => 'bi-heart-fill',
            'title' => 'Be Part of the',
            'title_highlight' => 'Change',
            'description' => 'Every contribution you make has the power to change lives. Join thousands of donors who have trusted us to channel their generosity.',
            'stats' => [
                [
                    'number' => '15K+',
                    'label' => 'Penerima Manfaat'
                ],
                [
                    'number' => '98%',
                    'label' => 'Transparansi'
                ],
                [
                    'number' => '50+',
                    'label' => 'Program'
                ]
            ]
        ];

        // Compile all data
        $data = [
            'sliders' => $sliders,
            'introduction' => $introduction,
            'values' => $values,
            'about' => $about,
            'impactStats' => $impactStats,
            'beliefs' => $beliefs,
            'background' => $background,
            'journeySection' => $journeySection,
            'journeys' => $journeys,
            'donations' => $donations,
            'volunteers' => $volunteers,
            'cta' => $cta
        ];

        return view('welcome', $data);
    }
}