<?php

declare(strict_types = 1);

namespace Forms;

class InsertDataIntoCsv
{
	protected string $filename = 'formData.csv';
	protected $file;
	protected array $data;

	public function __construct(string $themeLocation, array $data)
	{
		$this->file = fopen($themeLocation . '/' . $this->filename, 'a');
		$this->data = $data;

		$this->insertData();
	}

	protected function insertData(): void
	{
		fputcsv($this->file, $this->data);

		fclose($this->file);
	}
}
