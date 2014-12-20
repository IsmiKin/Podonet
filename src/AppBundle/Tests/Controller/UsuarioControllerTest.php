<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuarioControllerTest extends WebTestCase
{
    public function testPerfilusuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/perfil');
    }

    public function testEditarperfil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/perfil/editar');
    }

    public function testContactoadministrador()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/perfil/contacto');
    }

    public function testAyudausuario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/perfil/ayuda');
    }

}
