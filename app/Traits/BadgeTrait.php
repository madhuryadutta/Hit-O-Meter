<?php

// app/Traits/ConditionalTrait.php

namespace App\Traits;

trait BadgeTrait
{
    public function generateBadge($updatedCount, $version = 100)
    {
        if ($version == 1) {
            $svg = '<svg xmlns="http://www.w3.org/2000/svg">
        <g>
          <rect x="0" y="0" width="300" height="100" fill="green"></rect>
          <text x="10" y="50" font-family="Verdana" font-size="35" fill="blue">Profile View:'.$updatedCount.'</text>
        </g>
      </svg>';
        } else {

            $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="100">
  <!-- Background Gradient -->
  <defs>
    <linearGradient id="bgGradient" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
    </linearGradient>
  </defs>
  <rect x="0" y="0" width="100%" height="100%" fill="url(#bgGradient)"/>

  <!-- Text Box -->
  <rect x="10" y="10" width="280" height="80" rx="10" fill="#fff" opacity="0.7"/>
  
  <!-- Icon -->
  <path d="M20 50a5 5 0 0 1-5-5V35a5 5 0 0 1 5-5h50a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H20zM15 30h70a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H15a5 5 0 0 1-5-5V35a5 5 0 0 1 5-5z" fill="#764ba2"/>
  
  <!-- Text -->
  <text x="85" y="60" font-family="Arial" font-size="22" fill="#ff6e40">Profile View: <tspan fill="#333">'.$updatedCount.'</tspan></text>
</svg>';
        }

        return $svg;
    }

    public function notExistBadge($number, $version = 100)
    {
        if ($version == 1) {
            $svg = '<svg xmlns="http://www.w3.org/2000/svg">
        <g>
          <rect x="0" y="0" width="650" height="100" fill="red"></rect>
          <text x="10" y="50" font-family="Verdana" font-size="35" fill="blue">Invalid ID:'.$number.'</text>
        </g>
      </svg>';
        } else {
            $svg = ' <?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="100">
  <!-- Background Gradient -->
  <defs>
    <linearGradient id="bgGradient" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#ffcc80;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#ffa726;stop-opacity:1" />
    </linearGradient>
  </defs>
  <rect x="0" y="0" width="100%" height="100%" fill="url(#bgGradient)"/>

  <!-- Text Box -->
  <rect x="10" y="10" width="280" height="80" rx="10" fill="#fff" opacity="0.7"/>
  
  <!-- Icon -->
  <path d="M20 50a5 5 0 0 1-5-5V35a5 5 0 0 1 5-5h50a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H20zM15 30h70a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H15a5 5 0 0 1-5-5V35a5 5 0 0 1 5-5z" fill="#ff6f00"/>
  
  <!-- Warning Triangle -->
  <path d="M160 25 L140 55 L180 55 Z" fill="#ff6f00"/>
  
  <!-- Text -->
  <text x="60" y="60" font-family="Arial" font-size="24" fill="#333">Invalid ID: '.$number.'</text>
</svg>';
        }

        return $svg;
    }
}
