<?php

namespace App\Controllers;

use App\Models\CarModel;

class AdminController extends BaseController
{
	protected $carModel;

	public function __construct()
	{
		$this->carModel = new CarModel();
	}

	public function index()
	{

		$car = $this->carModel
			->join('category', 'car.category_id = category.category_id')
			->findAll();

		$data = [
			'cars' => $car,
		];
		return view('admin/armada', $data);
	}
}
