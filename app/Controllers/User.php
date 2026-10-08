<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    protected $helpers = ['url', 'form'];

    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('users/index', $data);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'The username field is required.',
                    'is_unique' => 'That username is already being used.'
                ]
            ],
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The full name field is required.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('users/new', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();

        $userModel->save([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(site_url('users'));
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        return view('users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $rules = [
            'username' => [
                'rules' => "required|is_unique[users.username,id,{$id}]",
                'errors' => [
                    'required' => 'The username field is required.',
                    'is_unique' => 'That username is already being used.'
                ]
            ],
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'The full name field is required.'
                ]
            ],
            'avatar' => [
                'rules' => [
                    'permit_empty',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'ext_in[avatar,jpg,jpeg,png]',
                    'max_size[avatar,2048]'
                ],
                'errors' => [
                    'is_image' => 'The selected file must be an image.',
                    'mime_in' => 'The avatar must be a JPG or PNG image.',
                    'ext_in' => 'The avatar must have a JPG, JPEG, or PNG extension.',
                    'max_size' => 'The avatar must not be larger than 2 MB.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('users/edit', [
                'user'       => $user,
                'validation' => $this->validator
            ]);
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ];

        $avatar = $this->request->getFile('avatar');

        if (
            $avatar !== null &&
            $avatar->isValid() &&
            !$avatar->hasMoved()
        ) {
            $uploadPath = FCPATH . 'uploads';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            // Generate a safe and unique filename.
            $newName = $avatar->getRandomName();

            // Save directly to public/uploads.
            $avatar->move($uploadPath, $newName);

            // Delete the previous avatar when replacing it.
            if (!empty($user['avatar'])) {
                $oldAvatarPath =
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $user['avatar'];

                if (is_file($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            // Save only the filename in the database.
            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to(site_url('users'));
    }
}