<?php

namespace App\DataFixtures;

use App\Entity\Links; 
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LinksFixture extends Fixture
{    
    private $buttons  = null;

    public function __construct(){
          $this->buttons = [
            ["name" => "FireWalling",           "alt"=>"FireWalling",           "icon" => Links::$icons[361] ],
            ["name" => "Proxy / Reverse Proxy", "alt"=>"Proxy / Reverse Proxy", "icon" => Links::$icons[635] ],
            ["name" => "IPS / IDS",             "alt"=>"IPS / IDS",             "icon" => Links::$icons[635]],
            ["name" => "Antivirus",             "alt"=>"Antivirus",             "icon" => Links::$icons[636]],
            ["name" => "VPN",                   "alt"=>"VPN",                   "icon" => Links::$icons[122]],
            ["name" => "Honey Pot",             "alt"=>"Honey Pot",             "icon" => Links::$icons[637]],
            ["name" => "SandBoxing",            "alt"=>"SandBoxing",            "icon" => Links::$icons[307]],
            ["name" => "Vulnerability Scan",    "alt"=>"Vulnerability Scan",    "icon" => Links::$icons[638]],
            ["name" => "Scanning",              "alt"=>"Scanning",              "icon" => Links::$icons[596]],
            ["name" => "Authentification",      "alt"=>"Authentification",      "icon" => Links::$icons[142]]
        ];
    }
    public function load(ObjectManager $manager)
    {
     foreach ($this->buttons as  $value) {
        $link = new Links();
        $link->setName($value["name"]);
        $link->setAlt($value["alt"]);
        $link->setIcon($value["icon"]);
        $link->setHref("script1.py");
        $link->setEnable(true);
        $manager->persist($link);
     }
        $manager->flush();
    }
}
