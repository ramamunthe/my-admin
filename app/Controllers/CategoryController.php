<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{

	protected $categoryModel;

	public function __construct()
	{
		$this->categoryModel = new CategoryModel();
	}

	public function index()
	{
		$data = [
			'categories' => $this->categoryModel->orderBy('category_id', 'DESC')->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/category', $data);
	}

	public function store()
	{
		if (!$this->validate([
			'title_category' => [
				'rules'  => 'required|is_unique[category.title_category]',
				'errors' => [
					'required' => 'Nama Kategori tidak boleh Kosong.',
					'is_unique' => 'Nama Kategori sudah terdaftar.'
				]
			],
		])) {
			return redirect()->back()->withInput();
		}


		$slug_category = url_title($this->request->getVar('title_category'), '-', true);
		$attr = $this->request->getVar();
		$attr['slug_category'] = $slug_category;
		$this->categoryModel->save($attr);
		session()->setFlashdata('success', 'Data berhasil ditambahkan');
		return redirect()->to('/admin-category');
	}

	public function update()
	{

		$slug = $this->request->getVar('slug_category');
		$namaLama = $this->categoryModel->where(['slug_category' => $slug])->first();
		if ($namaLama['title_category'] == $this->request->getVar('title_category')) {
			$rule_nama = 'required';
		} else {
			$rule_nama = 'required|is_unique[category.title_category]';
		}
		if (!$this->validate([
			'title_category' => [
				'rules'  => $rule_nama,
				'errors' => [
					'required' => 'Nama Kategori tidak boleh Kosong.',
					'is_unique' => 'Nama Kategori sudah terdaftar.'
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$slug_category = url_title($this->request->getVar('title_category'), '-', true);
		$attr = $this->request->getVar();
		$attr['slug_category'] = $slug_category;
		$this->categoryModel->save($attr);
		session()->setFlashdata('success', 'Data berhasil diubah');
		return redirect()->to('/admin-category');
	}

	public function delete($id)
	{
		$category = $this->categoryModel->find($id);
		$this->categoryModel->delete($category);
		session()->setFlashdata('success', 'Data berhasil dihapus');
		return redirect()->to('/admin-category');
	}
}
