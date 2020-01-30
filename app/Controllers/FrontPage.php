<?php

namespace App\Controllers;

use Faker\Factory;
use Sober\Controller\Controller;
use App\Controllers\Partials\Image;
use App\Controllers\Partials\Video;

class FrontPage extends Controller
{

	use Image, Video;

	protected $acf = true;

}
