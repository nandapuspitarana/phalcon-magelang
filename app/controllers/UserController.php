<?php

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	$data_user = User::find();
    	$this->view->data_user = $data_user;
    }

    public function addUserAction()
    {
    	$user = new User();

    	if ($this->request->isPost()) {
    		$username = $this->request->getPost('username'); //panah satu digunakan rujukan fungsi this
    		$password = $this->request->getPost('password');
    		$type = $this->request->getPost('type');

    		$user->assign(array(
    			'username' => $username, //panah dua digunakan untuk array
    			'password' => $password,
    			'type' => $type
    		));

    		if ($user->save()) {
    			$notif['title']="Sukses";
    			$notif['text']="Data berhasil disimpan";
    			$notif['type']="succes";
    		}else{
    			$pesan_eror = $user->getMassages();
    			$data_pesan_eror = '';
    			foreach ($pesan_eror as $pesanEror) {
    				$data_pesan_eror="$pesan_eror";
    			}
    			$notif['title']="Eror";
    			$notif['text']="Data tidak berhasil disimpan";
    			$notif['type']="error";
    		}

    		echo json_encode($notif);
    		die();
    	}
    }

     public function editUserAction()
    {
    	if ($this->request->isPost()) {
    		$id = $this->request->getPost('id');
    		$username = $this->request->getPost('username'); //panah satu digunakan rujukan fungsi this
    		$password = $this->request->getPost('password');
    		$type = $this->request->getPost('type');

    		$user = User::findFirst("id='$id'");

    		$user->assign(array(
    			'id' => $id,
    			'username' => $username, //panah dua digunakan untuk array
    			'password' => $password,
    			'type' => $type
    		));

    		if ($user->save()) {
    			$notif['title']="Sukses";
    			$notif['text']="Data berhasil disimpan";
    			$notif['type']="succes";
    		}else{
    			$pesan_eror = $user->getMassages();
    			$data_pesan_eror = '';
    			foreach ($pesan_eror as $pesanEror) {
    				$data_pesan_eror="$pesan_eror";
    			}
    			$notif['title']="Eror";
    			$notif['text']="Data tidak berhasil disimpan";
    			$notif['type']="error";
    		}

    		echo json_encode($notif);
    		die();
    	}
    }
}

