<?php
class ErrorController extends Controller{
    public function index()
	{
		$this->view('inicio\404');
	}

}