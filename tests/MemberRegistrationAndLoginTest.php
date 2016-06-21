<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberRegistrationAndLoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function registrationValidation()
    {
        $this->visit('/auth/register');
        $this->type('', 'name');
        $this->type('', 'username');
        $this->type('member@app.dev', 'email');
        $this->type('', 'password');
        $this->type('', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs('/auth/register');
        $this->see('Nama harus diisi.');
        $this->see('Username harus diisi.');
        $this->see('Email ini sudah terdaftar.');
        $this->see('Password harus diisi.');
        $this->see('Konfirmasi password harus diisi.');

        $this->type('Nama Member', 'name');
        $this->type('namamember', 'username');
        $this->type('email', 'email');
        $this->type('password', 'password');
        $this->type('password..', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs('/auth/register');
        $this->see('Email tidak valid.');
        $this->see('Konfirmasi password tidak sesuai.');
    }

    /** @test */
    public function memberRegisterSuccessfully()
    {
        $this->visit('/auth/register');
        $this->type('Nama Member', 'name');
        $this->type('namamember', 'username');
        $this->type('email@mail.com', 'email');
        $this->type('password.111', 'password');
        $this->type('password.111', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs('/home');
        $this->see('Selamat datang Nama Member.');
    }

    /** @test */
    public function memberRegisterAndLoginSuccessfully()
    {
        $this->visit('/auth/register');
        $this->type('Nama Member', 'name');
        $this->type('namamember', 'username');
        $this->type('email@mail.com', 'email');
        $this->type('password.111', 'password');
        $this->type('password.111', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs('/home');
        $this->see('Selamat datang Nama Member.');
        $this->click('Keluar');

        $this->visit('/auth/login');
        $this->type('namamember','username');
        $this->type('password.111','password');
        $this->press('Login');
        $this->seePageIs('/home');
        $this->see('Selamat datang kembali Nama Member.');
        $this->click('Keluar');
        $this->seePageIs('/auth/login');
        $this->see('Anda telah logout.');
    }

    /** @test */
    public function memberInvalidLogin()
    {
        $this->visit('/auth/login');
        $this->type('namamember','username');
        $this->type('password.112','password');
        $this->press('Login');
        $this->seePageIs('/auth/login');
        $this->see('Mohon maaf, anda tidak dapat login');
    }
}
