<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Ramsey\Uuid\Uuid;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/permohonan-akun');

        $response->assertStatus(200);
    }

    public function test_form_screen_can_be_rendered(){
        $response = $this->get('/permohonan-akun/detail');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/permohonan-akun/save', [
            'uuid' => '1564545645646456',
            'jenis' => '2',
            'penyelenggara' => '001',
            'nama_instansi' => 'Unit Test',
            'email_instansi' => 'unittest@gmail.com',
            'alamat' => 'Test',
            'telepon' => '08999999',
            'propinsi' => '33',
            'kab_kota' => '3306',
            'file1' => 'testfile',
            'file2' => 'testfile',
            'file3' => 'testfile'
        ]);

        $response->assertRedirect('/permohonan-akun');
    }
}
