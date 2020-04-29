<?php

$config = array(
	'signup' => array(
//		array(
//			'field' => 'username',
//			'label' => 'Username',
//			'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]'
//		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|max_length[20]|is_unique[users.email]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[4]|max_length[12]'
		),
		array(
			'field' => 'first-name',
			'label' => 'First Name',
			'rules' => 'required|max_length[20]|alpha'
		),
		array(
			'field' => 'last-name',
			'label' => 'Last Name',
			'rules' => 'required|max_length[20]|alpha'
		)
	),
	'login' => array(
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[4]|max_length[12]'
		)
	)

);
