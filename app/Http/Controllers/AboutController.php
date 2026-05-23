<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $timeline = [
            ['year' => '2012', 'title' => 'Started Journalism Career', 'desc' => 'Began as a field reporter covering ground-level news across Bihar and UP.'],
            ['year' => '2020', 'title' => 'Launched YouTube Channel', 'desc' => 'Started Sach Tak YouTube channel to bring unfiltered news to millions.'],
            ['year' => '2021', 'title' => 'Investigative Reporting', 'desc' => 'Broke several major investigative stories on corruption and public interest issues.'],
            ['year' => '2022', 'title' => 'Reached 1 Million Subscribers', 'desc' => 'A milestone that validated the power of independent journalism.'],
            ['year' => '2023', 'title' => 'National Recognition', 'desc' => 'Recognized nationally for fearless reporting and digital media impact.'],
            ['year' => '2024', 'title' => '10M+ Subscribers', 'desc' => 'Crossed 10 million subscribers, becoming one of India\'s top independent journalists.'],
        ];

        $achievements = [
            ['icon' => '📺', 'number' => '10M+', 'label' => 'YouTube Subscribers'],
            ['icon' => '📰', 'number' => '5000+', 'label' => 'Articles Published'],
            ['icon' => '🏆', 'number' => '5+', 'label' => 'Years Reporting'],
            ['icon' => '👁️', 'number' => '500M+', 'label' => 'Total Views'],
        ];

        return view('frontend.about', compact('timeline', 'achievements'));
    }
}
